<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\Session;
use Core\Security;
use Core\Setting;

class CheckoutController extends Controller
{
    /**
     * Hızlı & Güvenli Kayıt ve Havale Ödeme Sayfası
     */
    public function checkout(string $courseId): void
    {
        $courseId = (int)$courseId;
        if ($courseId <= 0) {
            $courseId = 1;
        }

        $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [$courseId]);
        if (!$course) {
            $course = Database::fetch("SELECT * FROM courses ORDER BY sort_order ASC, id ASC LIMIT 1");
        }
        if (!$course) {
            $this->redirect(url('/programs'));
        }

        // Eğer kullanıcı zaten giriş yapmışsa ve bu kursa onaylı erişimi varsa doğrudan panele yönlendir
        if (Auth::check()) {
            $existing = Database::fetch(
                "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? AND payment_status = 'approved'",
                [Auth::id(), $course['id']]
            );
            if ($existing) {
                Session::setFlash('student_msg', 'Bu programa zaten kayıtlısınız. Eğitimlerinize hemen devam edebilirsiniz.');
                $this->redirect(url('/movement-space'));
            }
        }

        $planType = ($_GET['plan'] ?? 'monthly') === 'yearly' ? 'yearly' : 'monthly';
        $yearlyPrice = 7900.00;
        $activePrice = ($planType === 'yearly') ? $yearlyPrice : (float)$course['price'];
        if ($activePrice <= 0) {
            $activePrice = 1850.00;
        }

        $this->render('pages/checkout/index', [
            'metaTitle' => 'Hızlı Kayıt & Havale ile Ödeme | ' . $course['title'],
            'course' => $course,
            'user' => Auth::user(),
            'isLoggedIn' => Auth::check(),
            'planType' => $planType,
            'activePrice' => $activePrice,
            'yearlyPrice' => $yearlyPrice,
            'errorMsg' => Session::getFlash('checkout_error'),
            'infoMsg' => Session::getFlash('checkout_info'),
            'ibanBank' => Setting::get('iban_bank', 'Garanti BBVA'),
            'ibanName' => Setting::get('iban_name', 'Betina Tansuğ'),
            'ibanNo' => Setting::get('iban_no', 'TR33 0006 2000 0001 2345 6789 01'),
            'ibanNotes' => Setting::get('iban_notes', 'Havale açıklama kısmına Adınızı ve Telefon numaranızı yazmanız yeterlidir.'),
            'iyzicoActive' => (Setting::get('iyzico_status', '0') === '1')
        ]);
    }

    /**
     * Hızlı Kayıt, Havale Bildirimi & Anında Eğitim Paneli Aktivasyonu
     */
    public function submitIban(string $courseId): void
    {
        $courseId = (int)$courseId;
        $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [$courseId]);
        if (!$course) {
            $this->redirect(url('/programs'));
        }

        $planType = $this->input('plan_type') === 'yearly' ? 'yearly' : 'monthly';
        $amount = (float)($this->input('amount') ?: (($planType === 'yearly') ? 7900.00 : ($course['price'] > 0 ? $course['price'] : 1850.00)));

        $userId = null;

        // 1. KULLANICI KİMLİK DOĞRULAMA VEYA HIZLI KAYIT
        if (Auth::check()) {
            $userId = (int)Auth::id();
            $user = Auth::user();
            $senderName = trim((string)$this->input('sender_name')) ?: ($user['full_name'] ?? 'Öğrenci');
        } else {
            // Hızlı Kayıt Formu (Ad Soyad, E-posta, Telefon, Şifre)
            $fullName = trim((string)$this->input('full_name'));
            $email = strtolower(trim((string)$this->input('email')));
            $phone = trim((string)$this->input('phone'));
            $password = (string)$this->input('password');

            if (empty($fullName) || empty($email)) {
                Session::setFlash('checkout_error', 'Lütfen Ad Soyad ve E-posta adresinizi eksiksiz belirtiniz.');
                $this->redirect(url('/checkout/' . $courseId . '?plan=' . $planType));
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Session::setFlash('checkout_error', 'Lütfen geçerli bir e-posta adresi yazınız.');
                $this->redirect(url('/checkout/' . $courseId . '?plan=' . $planType));
            }

            // Şifre boşsa varsayılan güvenli şifre oluştur (kullanıcıyı asla bekletmeyiz)
            if (empty($password)) {
                $password = '123456';
            } elseif (strlen($password) < 6) {
                Session::setFlash('checkout_error', 'Şifreniz en az 6 karakter olmalıdır.');
                $this->redirect(url('/checkout/' . $courseId . '?plan=' . $planType));
            }

            $existingUser = Database::fetch("SELECT * FROM users WHERE email = ? LIMIT 1", [$email]);
            if ($existingUser) {
                // Mevcut kullanıcıysa şifresini kontrol et / güncelle ve giriş yap
                if (!password_verify($password, $existingUser['password_hash']) && strlen($password) >= 6) {
                    Database::execute(
                        "UPDATE users SET password_hash = ?, phone = COALESCE(NULLIF(?, ''), phone), updated_at = NOW() WHERE id = ?",
                        [password_hash($password, PASSWORD_BCRYPT), $phone, $existingUser['id']]
                    );
                }
                Auth::login((int)$existingUser['id']);
                $userId = (int)$existingUser['id'];
            } else {
                // Yeni öğrenci oluştur
                $hash = password_hash($password, PASSWORD_BCRYPT);
                Database::execute(
                    "INSERT INTO users (full_name, email, phone, password_hash, role, status, created_at, updated_at) 
                     VALUES (?, ?, ?, ?, 'student', 'active', NOW(), NOW())",
                    [$fullName, $email, $phone, $hash]
                );
                $userId = (int)Database::getConnection()->lastInsertId();
                Auth::login($userId);
            }

            $senderName = trim((string)$this->input('sender_name')) ?: $fullName;
        }

        $receiptRef = trim((string)$this->input('receipt_ref'));
        $durationDays = ($planType === 'yearly') ? 365 : 90;

        // 2. PROGRAM ERİŞİMİ VE ANINDA ONAY (EĞİTİM PANELİ ERİŞİME AÇILIR)
        $existingEnrollment = Database::fetch(
            "SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?",
            [$userId, $course['id']]
        );

        if ($existingEnrollment) {
            Database::execute(
                "UPDATE enrollments SET payment_method = 'iban', payment_status = 'approved', plan_type = ?, amount = ?, sender_name = ?, receipt_ref = ?, approved_at = NOW(), start_date = CURDATE(), expires_at = DATE_ADD(NOW(), INTERVAL ? DAY) WHERE id = ?",
                [$planType, $amount, $senderName, $receiptRef, $durationDays, $existingEnrollment['id']]
            );
            $enrollmentId = (int)$existingEnrollment['id'];
        } else {
            Database::execute(
                "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, plan_type, amount, sender_name, receipt_ref, approved_at, start_date, expires_at, created_at) 
                 VALUES (?, ?, 'iban', 'approved', ?, ?, ?, ?, NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL ? DAY), NOW())",
                [$userId, $course['id'], $planType, $amount, $senderName, $receiptRef, $durationDays]
            );
            $enrollmentId = (int)Database::getConnection()->lastInsertId();
        }

        // Hediye 3'lü Meditasyon Paketi
        $meditationCourse = Database::fetch("SELECT id FROM courses WHERE slug = '3lu-meditasyon-serisi'");
        if ($meditationCourse) {
            $hasMeditation = Database::fetch(
                "SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?",
                [$userId, $meditationCourse['id']]
            );
            if (!$hasMeditation) {
                Database::execute(
                    "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, plan_type, amount, is_gift, gift_message, approved_at, start_date, expires_at, created_at)
                     VALUES (?, ?, 'iban', 'approved', ?, 0.00, 1, 'Kayıt Hediyesi 3lü Meditasyon', NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 365 DAY), NOW())",
                    [$userId, $meditationCourse['id'], $planType]
                );
            }
        }

        $this->redirect(url('/checkout/success/' . $enrollmentId));
    }

    /**
     * Başarılı Kayıt ve Havale Bilgilendirme Ekranı
     */
    public function success(string $enrollmentId): void
    {
        $enrollmentId = (int)$enrollmentId;
        $userId = Auth::id();

        if (!$userId) {
            $this->redirect(url('/login'));
        }

        $enrollment = Database::fetch(
            "SELECT e.*, c.title AS course_title, c.duration_weeks, c.slug AS course_slug
             FROM enrollments e
             INNER JOIN courses c ON e.course_id = c.id
             WHERE e.id = ? AND e.user_id = ?",
            [$enrollmentId, $userId]
        );

        if (!$enrollment) {
            $this->redirect(url('/movement-space'));
        }

        $this->render('pages/checkout/success', [
            'metaTitle' => 'Kayıt Tamamlandı | Fizyobar',
            'enrollment' => $enrollment,
            'ibanBank' => Setting::get('iban_bank', 'Garanti BBVA'),
            'ibanName' => Setting::get('iban_name', 'Betina Tansuğ'),
            'ibanNo' => Setting::get('iban_no', 'TR33 0006 2000 0001 2345 6789 01')
        ]);
    }
}
