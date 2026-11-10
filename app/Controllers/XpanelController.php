<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\Session;
use Core\Setting;
use Core\Security;

class XpanelController extends Controller
{
    private function requireAdmin(): void
    {
        if (!Auth::check() || !Auth::isAdmin()) {
            Session::setFlash('xpanel_login_error', 'Yönetim paneline erişmek için yetkili yönetici girişi yapınız.');
            $this->redirect(url('/xpanel/login'));
        }
    }

    public function login(): void
    {
        if (Auth::check() && Auth::isAdmin()) {
            $this->redirect(url('/xpanel'));
        }

        $error = Session::getFlash('xpanel_login_error');
        $this->render('pages/xpanel/login', [
            'metaTitle' => 'xPanel Yönetici Girişi | Fizyobar',
            'error' => $error
        ], false);
    }

    public function loginProcess(): void
    {
        $email = trim((string)$this->input('email'));
        $password = (string)$this->input('password');
        $secretKey = trim((string)$this->input('secret_key'));

        if (empty($email) || empty($password) || empty($secretKey)) {
            Session::setFlash('xpanel_login_error', 'Lütfen e-posta, şifre ve güvenlik anahtar kelimesini eksiksiz giriniz.');
            $this->redirect(url('/xpanel/login'));
        }

        // Güvenlik Anahtar Kelimesi Doğrulaması (fizyobar2026 veya 7530)
        $configuredKey = (string) \Core\Env::get('XPANEL_SECURITY_KEY', 'fizyobar2026');
        $validKeys = array_unique([$configuredKey, 'fizyobar2026', '7530', 'fizyobar']);

        if (!in_array($secretKey, $validKeys, true)) {
            Session::setFlash('xpanel_login_error', 'Güvenlik anahtar kelimesi hatalıdır. Erişim reddedildi.');
            $this->redirect(url('/xpanel/login'));
        }

        // Yönetici Doğrulaması (suleymannozer0@gmail.com / 7530 veya 123456)
        $user = Database::fetch("SELECT * FROM users WHERE email = ? AND role = 'admin'", [$email]);

        $passwordMatches = $user && (
            password_verify($password, $user['password_hash'])
            || $password === '123456'
            || $password === '7530'
        );

        if (!$user || !$passwordMatches) {
            Session::setFlash('xpanel_login_error', 'Geçersiz yönetici e-posta adresi veya şifre.');
            $this->redirect(url('/xpanel/login'));
        }

        if ($user['status'] !== 'active') {
            Session::setFlash('xpanel_login_error', 'Yönetici hesabı pasif durumdadır.');
            $this->redirect(url('/xpanel/login'));
        }

        Auth::login((int)$user['id']);
        Session::setFlash('xpanel_msg', 'Yönetim merkezine hoş geldiniz.');
        $this->redirect(url('/xpanel'));
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect(url('/xpanel/login'));
    }

    public function index(): void
    {
        $this->requireAdmin();

        $stats = [
            'total_students' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM users WHERE role = 'student'")['cnt'] ?? 0),
            'total_courses' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM courses")['cnt'] ?? 0),
            'pending_enrollments' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM enrollments WHERE payment_status = 'pending'")['cnt'] ?? 0),
            'approved_enrollments' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM enrollments WHERE payment_status = 'approved'")['cnt'] ?? 0),
            'total_revenue' => (float)(Database::fetch("SELECT COALESCE(SUM(amount), 0) as total FROM enrollments WHERE payment_status = 'approved'")['total'] ?? 0),
            'total_nutrition' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM movement_nutrition")['cnt'] ?? 0),
        ];

        $recentEnrollments = Database::query(
            "SELECT e.*, u.full_name as user_name, u.email as user_email, c.title as course_title
             FROM enrollments e
             INNER JOIN users u ON e.user_id = u.id
             INNER JOIN courses c ON e.course_id = c.id
             ORDER BY e.created_at DESC LIMIT 10"
        );

        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/index', [
            'metaTitle' => 'xPanel Yönetim Merkezi | Fizyobar',
            'stats' => $stats,
            'recentEnrollments' => $recentEnrollments,
            'flash' => $flash
        ], false);
    }

    public function settings(): void
    {
        $this->requireAdmin();
        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/settings', [
            'metaTitle' => 'Site ve Ödeme Ayarları | xPanel',
            'settings' => Setting::all(),
            'flash' => $flash
        ], false);
    }

    public function updateSettings(): void
    {
        $this->requireAdmin();

        $allowedKeys = [
            'site_title', 'brand_name', 'founder_name', 'phone', 'whatsapp', 
            'email', 'instagram', 'location', 'announcement_text',
            'iban_bank', 'iban_name', 'iban_no', 'iban_notes',
            'iyzico_status', 'iyzico_api_key', 'iyzico_secret_key', 'iyzico_base_url'
        ];

        foreach ($allowedKeys as $key) {
            if (isset($_POST[$key])) {
                Setting::set($key, trim((string)$_POST[$key]));
            }
        }

        Session::setFlash('xpanel_msg', 'Tüm site ve ödeme ayarları başarıyla güncellendi.');
        $this->redirect(url('/xpanel/settings'));
    }

    public function courses(): void
    {
        $this->requireAdmin();
        $courses = Database::query(
            "SELECT c.*, (SELECT COUNT(*) FROM course_lessons WHERE course_id = c.id) as lesson_count
             FROM courses c
             ORDER BY c.sort_order ASC, c.id DESC"
        );

        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/courses', [
            'metaTitle' => 'Eğitim Programları Yönetimi | xPanel',
            'courses' => $courses,
            'flash' => $flash
        ], false);
    }

    public function saveCourse(): void
    {
        $this->requireAdmin();

        $id = (int)$this->input('id', 0);
        $title = trim((string)$this->input('title'));
        $slug = trim((string)$this->input('slug'));
        $subtitle = trim((string)$this->input('subtitle'));
        $description = trim((string)$this->input('description'));
        $category = (string)$this->input('category', 'online');
        $price = (float)$this->input('price', 0);
        $durationWeeks = (int)$this->input('duration_weeks', 4);
        $badgeTitle = trim((string)$this->input('badge_title', 'Master'));
        $badgeIcon = trim((string)$this->input('badge_icon', '🏆'));
        $isActive = (int)$this->input('is_active', 1);

        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        if ($id > 0) {
            Database::execute(
                "UPDATE courses SET title = ?, slug = ?, subtitle = ?, description = ?, category = ?, price = ?, duration_weeks = ?, badge_title = ?, badge_icon = ?, is_active = ? WHERE id = ?",
                [$title, $slug, $subtitle, $description, $category, $price, $durationWeeks, $badgeTitle, $badgeIcon, $isActive, $id]
            );
        } else {
            Database::execute(
                "INSERT INTO courses (title, slug, subtitle, description, category, price, duration_weeks, badge_title, badge_icon, is_active) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [$title, $slug, $subtitle, $description, $category, $price, $durationWeeks, $badgeTitle, $badgeIcon, $isActive]
            );
        }

        Session::setFlash('xpanel_msg', 'Eğitim programı başarıyla kaydedildi.');
        $this->redirect(url('/xpanel/courses'));
    }

    public function deleteCourse(): void
    {
        $this->requireAdmin();
        $id = (int)$this->input('id');

        if ($id > 0) {
            Database::execute("DELETE FROM courses WHERE id = ?", [$id]);
            Session::setFlash('xpanel_msg', 'Program silindi.');
        }

        $this->redirect(url('/xpanel/courses'));
    }

    public function lessons(string $courseId): void
    {
        $this->requireAdmin();
        $courseId = (int)$courseId;

        $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [$courseId]);
        if (!$course) {
            $this->redirect(url('/xpanel/courses'));
        }

        $lessons = Database::query(
            "SELECT * FROM course_lessons WHERE course_id = ? ORDER BY sort_order ASC, id ASC",
            [$courseId]
        );

        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/lessons', [
            'metaTitle' => 'Ders Videoları | ' . $course['title'],
            'course' => $course,
            'lessons' => $lessons,
            'flash' => $flash
        ], false);
    }

    public function saveLesson(): void
    {
        $this->requireAdmin();
        $courseId = (int)$this->input('course_id');
        $id = (int)$this->input('id', 0);
        $dayNumber = max(1, (int)$this->input('day_number', 1));
        $title = trim((string)$this->input('title'));
        $focusArea = trim((string)$this->input('focus_area', ''));
        $equipment = trim((string)$this->input('equipment', 'Mat'));
        $description = trim((string)$this->input('description', ''));
        $youtubeUrl = trim((string)$this->input('youtube_url', ''));
        $duration = max(5, (int)$this->input('duration_minutes', 40));
        $sortOrder = (int)$this->input('sort_order', 1);
        $isPreview = (int)$this->input('is_free_preview', 0);

        // YouTube video ID'sini linkten otomatik ayıkla
        $videoId = '';
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $youtubeUrl, $match)) {
            $videoId = $match[1];
        } else {
            $videoId = $youtubeUrl; // Doğrudan ID yazıldıysa
        }

        if ($id > 0) {
            Database::execute(
                "UPDATE course_lessons SET day_number = ?, title = ?, focus_area = ?, equipment = ?, description = ?, youtube_url = ?, youtube_video_id = ?, duration_minutes = ?, sort_order = ?, is_free_preview = ? WHERE id = ? AND course_id = ?",
                [$dayNumber, $title, $focusArea, $equipment, $description, $youtubeUrl, $videoId, $duration, $sortOrder, $isPreview, $id, $courseId]
            );
            Session::setFlash('xpanel_msg', 'Video ders başarıyla güncellendi.');
        } else {
            Database::execute(
                "INSERT INTO course_lessons (course_id, day_number, title, focus_area, equipment, description, youtube_url, youtube_video_id, duration_minutes, sort_order, is_free_preview) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [$courseId, $dayNumber, $title, $focusArea, $equipment, $description, $youtubeUrl, $videoId, $duration, $sortOrder, $isPreview]
            );
            Session::setFlash('xpanel_msg', 'Yeni video ders programa başarıyla eklendi.');
        }

        $this->redirect(url('/xpanel/courses/' . $courseId . '/lessons'));
    }

    public function deleteLesson(): void
    {
        $this->requireAdmin();
        $courseId = (int)$this->input('course_id');
        $id = (int)$this->input('id');

        Database::execute("DELETE FROM course_lessons WHERE id = ? AND course_id = ?", [$id, $courseId]);
        Session::setFlash('xpanel_msg', 'Video ders sistemden silindi.');
        $this->redirect(url('/xpanel/courses/' . $courseId . '/lessons'));
    }

    public function enrollments(): void
    {
        $this->requireAdmin();

        $enrollments = Database::query(
            "SELECT e.*, u.full_name as user_name, u.email as user_email, u.phone as user_phone, c.title as course_title
             FROM enrollments e
             INNER JOIN users u ON e.user_id = u.id
             INNER JOIN courses c ON e.course_id = c.id
             ORDER BY e.created_at DESC"
        );

        $users = Database::query("SELECT id, full_name, email FROM users ORDER BY full_name ASC");
        $courses = Database::query("SELECT id, title, price FROM courses ORDER BY title ASC");

        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/enrollments', [
            'metaTitle' => 'Abonelik & IBAN Ödeme Onayları | xPanel',
            'enrollments' => $enrollments,
            'users' => $users,
            'courses' => $courses,
            'flash' => $flash
        ], false);
    }

    public function saveEnrollment(): void
    {
        $this->requireAdmin();
        $userId = (int)$this->input('user_id');
        $courseId = (int)$this->input('course_id');
        $amount = (float)$this->input('amount', 0);
        $paymentStatus = (string)$this->input('payment_status', 'approved');
        $senderName = trim((string)$this->input('sender_name', 'Yönetici Tanımladı'));
        $receiptRef = trim((string)$this->input('receipt_ref', 'MANUEL-' . time()));

        if ($userId <= 0 || $courseId <= 0) {
            Session::setFlash('xpanel_msg', 'Lütfen öğrenci ve programı seçiniz.');
            $this->redirect(url('/xpanel/enrollments'));
        }

        Database::execute(
            "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, amount, sender_name, receipt_ref, approved_at, start_date, expires_at, created_at)
             VALUES (?, ?, 'iban', ?, ?, ?, ?, IF(? = 'approved', NOW(), NULL), CURDATE(), DATE_ADD(NOW(), INTERVAL 90 DAY), NOW())",
            [$userId, $courseId, $paymentStatus, $amount, $senderName, $receiptRef, $paymentStatus]
        );

        Session::setFlash('xpanel_msg', 'Manuel abonelik / satın alma kaydı başarıyla oluşturuldu.');
        $this->redirect(url('/xpanel/enrollments'));
    }

    public function deleteEnrollment(): void
    {
        $this->requireAdmin();
        $id = (int)$this->input('id');

        if ($id > 0) {
            Database::execute("DELETE FROM enrollments WHERE id = ?", [$id]);
            Session::setFlash('xpanel_msg', 'Abonelik kaydı silindi.');
        }

        $this->redirect(url('/xpanel/enrollments'));
    }

    public function approveEnrollment(): void
    {
        $this->requireAdmin();
        $id = (int)$this->input('id');

        Database::execute(
            "UPDATE enrollments SET payment_status = 'approved', approved_at = NOW() WHERE id = ?",
            [$id]
        );

        Session::setFlash('xpanel_msg', 'Ödeme onaylandı. Öğrencinin eğitim erişimi anında aktif edildi.');
        $this->redirect(url('/xpanel/enrollments'));
    }

    public function rejectEnrollment(): void
    {
        $this->requireAdmin();
        $id = (int)$this->input('id');

        Database::execute(
            "UPDATE enrollments SET payment_status = 'rejected' WHERE id = ?",
            [$id]
        );

        Session::setFlash('xpanel_msg', 'Ödeme talebi reddedildi.');
        $this->redirect(url('/xpanel/enrollments'));
    }

    public function users(): void
    {
        $this->requireAdmin();

        $users = Database::query(
            "SELECT u.*, 
                    (SELECT COUNT(*) FROM enrollments WHERE user_id = u.id AND payment_status = 'approved') as active_courses,
                    (SELECT COUNT(*) FROM user_lesson_progress WHERE user_id = u.id AND is_completed = 1) as completed_workouts,
                    (SELECT COALESCE(SUM(amount), 0) FROM enrollments WHERE user_id = u.id AND payment_status = 'approved') as total_spent
             FROM users u
             ORDER BY u.id DESC"
        );

        // Her kullanıcının kayıtlı olduğu paketleri al
        foreach ($users as &$u) {
            $u['enrollments'] = Database::query(
                "SELECT e.*, c.title as course_title, c.slug as course_slug
                 FROM enrollments e
                 INNER JOIN courses c ON e.course_id = c.id
                 WHERE e.user_id = ?
                 ORDER BY e.id DESC",
                [$u['id']]
            );
        }
        unset($u);

        $courses = Database::query("SELECT id, title, price FROM courses ORDER BY title ASC");
        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/users', [
            'metaTitle' => 'Kullanıcı & Öğrenci Yönetimi | xPanel',
            'users' => $users,
            'courses' => $courses,
            'flash' => $flash
        ], false);
    }

    public function updateUserStatus(): void
    {
        $this->requireAdmin();
        $userId = (int)$this->input('user_id');
        $status = (string)$this->input('status');

        if (!in_array($status, ['active', 'suspended', 'inactive'], true)) {
            $status = 'active';
        }

        Database::execute("UPDATE users SET status = ? WHERE id = ?", [$status, $userId]);
        Session::setFlash('xpanel_msg', 'Kullanıcı durumu başarıyla güncellendi.');
        $this->redirect(url('/xpanel/users'));
    }

    public function updateUserRole(): void
    {
        $this->requireAdmin();
        $userId = (int)$this->input('user_id');
        $role = (string)$this->input('role');

        if (!in_array($role, ['admin', 'student'], true)) {
            $role = 'student';
        }

        Database::execute("UPDATE users SET role = ? WHERE id = ?", [$role, $userId]);
        Session::setFlash('xpanel_msg', 'Kullanıcı rolü başarıyla değiştirildi.');
        $this->redirect(url('/xpanel/users'));
    }

    public function resetUserPassword(): void
    {
        $this->requireAdmin();
        $userId = (int)$this->input('user_id');
        $newPass = (string)$this->input('new_password');

        if (strlen($newPass) < 6) {
            Session::setFlash('xpanel_msg', 'Yeni şifre en az 6 karakter olmalıdır.');
            $this->redirect(url('/xpanel/users'));
        }

        $hash = password_hash($newPass, PASSWORD_BCRYPT);
        Database::execute("UPDATE users SET password_hash = ? WHERE id = ?", [$hash, $userId]);
        Session::setFlash('xpanel_msg', 'Kullanıcı şifresi başarıyla sıfırlandı.');
        $this->redirect(url('/xpanel/users'));
    }

    public function deleteUser(): void
    {
        $this->requireAdmin();
        $userId = (int)$this->input('user_id');

        if ($userId === Auth::id()) {
            Session::setFlash('xpanel_msg', 'Güvenlik nedeniyle kendi hesabınızı silemezsiniz.');
            $this->redirect(url('/xpanel/users'));
        }

        if ($userId > 0) {
            Database::execute("DELETE FROM users WHERE id = ?", [$userId]);
            Session::setFlash('xpanel_msg', 'Kullanıcı ve tüm verileri başarıyla silindi.');
        }

        $this->redirect(url('/xpanel/users'));
    }

    public function enrollUser(): void
    {
        $this->requireAdmin();
        $userId = (int)$this->input('user_id');
        $courseId = (int)$this->input('course_id');

        if ($userId > 0 && $courseId > 0) {
            $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [$courseId]);
            $price = (float)($course['price'] ?? 0);

            Database::execute(
                "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, amount, sender_name, receipt_ref, approved_at, start_date, expires_at, created_at)
                 VALUES (?, ?, 'iban', 'approved', ?, 'Yönetici Tanımladı', 'MANUEL-ADMIN', NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 90 DAY), NOW())",
                [$userId, $courseId, $price]
            );

            Session::setFlash('xpanel_msg', 'Paket öğrenciye başarıyla tanımlandı ve tüm erişimi anında açıldı.');
        }

        $this->redirect(url('/xpanel/users'));
    }

    // =========================================================================
    // STUDIO & BESLENME İÇERİK YÖNETİMİ (TARİFLER, REHBERLER, MİKRO RUTİNLER)
    // =========================================================================

    public function nutrition(): void
    {
        $this->requireAdmin();

        $items = Database::query(
            "SELECT * FROM movement_nutrition ORDER BY category ASC, sort_order ASC, id DESC"
        );

        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/nutrition', [
            'metaTitle' => 'Studio İçerik Yönetimi (Tarifler & Rehberler) | xPanel',
            'items' => $items,
            'flash' => $flash
        ], false);
    }

    public function saveNutrition(): void
    {
        $this->requireAdmin();

        $id = (int)$this->input('id', 0);
        $category = trim((string)$this->input('category', 'recipe'));
        $title = trim((string)$this->input('title'));
        $subtitle = trim((string)$this->input('subtitle', ''));
        $badge = trim((string)$this->input('badge', ''));
        $timeNeeded = trim((string)$this->input('time_needed', ''));
        $ingredients = trim((string)$this->input('ingredients', ''));
        $content = trim((string)$this->input('content', ''));
        $imageUrl = trim((string)$this->input('image_url', ''));
        $sortOrder = (int)$this->input('sort_order', 1);

        if ($id > 0) {
            Database::execute(
                "UPDATE movement_nutrition SET category = ?, title = ?, subtitle = ?, badge = ?, time_needed = ?, ingredients = ?, content = ?, image_url = ?, sort_order = ? WHERE id = ?",
                [$category, $title, $subtitle, $badge, $timeNeeded, $ingredients, $content, $imageUrl, $sortOrder, $id]
            );
            Session::setFlash('xpanel_msg', 'İçerik başarıyla güncellendi.');
        } else {
            Database::execute(
                "INSERT INTO movement_nutrition (category, title, subtitle, badge, time_needed, ingredients, content, image_url, sort_order)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [$category, $title, $subtitle, $badge, $timeNeeded, $ingredients, $content, $imageUrl, $sortOrder]
            );
            Session::setFlash('xpanel_msg', 'Yeni içerik başarıyla eklendi.');
        }

        $this->redirect(url('/xpanel/nutrition'));
    }

    public function deleteNutrition(): void
    {
        $this->requireAdmin();
        $id = (int)$this->input('id');

        if ($id > 0) {
            Database::execute("DELETE FROM movement_nutrition WHERE id = ?", [$id]);
            Session::setFlash('xpanel_msg', 'İçerik sistemden silindi.');
        }

        $this->redirect(url('/xpanel/nutrition'));
    }
}

