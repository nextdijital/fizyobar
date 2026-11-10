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
    private function requireAuth(string $redirectAfter = ''): void
    {
        if (!Auth::check()) {
            if (!empty($redirectAfter)) {
                Session::set('intended_url', $redirectAfter);
            }
            Session::setFlash('login_error', 'Satın alma veya kayıt işlemi için lütfen önce giriş yapınız ya da üye olunuz.');
            $this->redirect(url('/login'));
        }
    }

    public function checkout(string $courseId): void
    {
        $this->requireAuth('/checkout/' . (int)$courseId);
        $courseId = (int)$courseId;

        $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [$courseId]);
        if (!$course) {
            $this->redirect(url('/programs'));
        }

        // Kullanıcının zaten onaylı aboneliği var mı?
        $existing = Database::fetch(
            "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? AND payment_status = 'approved'",
            [Auth::id(), $course['id']]
        );

        if ($existing) {
            $this->redirect(url('/course/' . $course['slug']));
        }

        $infoMsg = Session::getFlash('checkout_info');

        $this->render('pages/checkout/index', [
            'metaTitle' => 'Kayıt & Ödeme | ' . $course['title'],
            'course' => $course,
            'infoMsg' => $infoMsg,
            'ibanBank' => Setting::get('iban_bank', 'Garanti BBVA'),
            'ibanName' => Setting::get('iban_name', 'Betina Tansuğ'),
            'ibanNo' => Setting::get('iban_no', 'TR33 0006 2000 0001 2345 6789 01'),
            'ibanNotes' => Setting::get('iban_notes', 'Açıklama alanına Ad Soyad ve Referans Kodunu yazınız.'),
            'iyzicoActive' => (Setting::get('iyzico_status', '0') === '1')
        ]);
    }

    public function submitIban(string $courseId): void
    {
        $this->requireAuth();
        $courseId = (int)$courseId;
        $userId = Auth::id();

        $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [$courseId]);
        if (!$course) {
            $this->redirect(url('/programs'));
        }

        $senderName = trim((string)$this->input('sender_name'));
        $receiptRef = trim((string)$this->input('receipt_ref'));

        if (empty($senderName)) {
            Session::setFlash('checkout_error', 'Lütfen havale yapan kişinin adını ve soyadını belirtiniz.');
            $this->redirect(url('/checkout/' . $courseId));
        }

        Database::execute(
            "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, amount, sender_name, receipt_ref, approved_at, start_date, expires_at, created_at) 
             VALUES (?, ?, 'iban', 'approved', ?, ?, ?, NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 90 DAY), NOW())",
            [$userId, $course['id'], $course['price'], $senderName, $receiptRef]
        );

        $enrollmentId = (int)Database::getConnection()->lastInsertId();
        $this->redirect(url('/checkout/success/' . $enrollmentId));
    }

    public function success(string $enrollmentId): void
    {
        $this->requireAuth();
        $enrollmentId = (int)$enrollmentId;
        $userId = Auth::id();

        $enrollment = Database::fetch(
            "SELECT e.*, c.title AS course_title, c.duration_weeks
             FROM enrollments e
             INNER JOIN courses c ON e.course_id = c.id
             WHERE e.id = ? AND e.user_id = ?",
            [$enrollmentId, $userId]
        );

        if (!$enrollment) {
            $this->redirect(url('/dashboard'));
        }

        $this->render('pages/checkout/success', [
            'metaTitle' => 'Ödeme Bildirimi Alındı | Fizyobar',
            'enrollment' => $enrollment
        ]);
    }
}

