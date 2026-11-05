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
            Session::setFlash('login_error', 'Yönetim paneline erişmek için yetkili yönetici girişi yapınız.');
            $this->redirect(url('/login'));
        }
    }

    public function index(): void
    {
        $this->requireAdmin();

        $stats = [
            'total_students' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM users WHERE role = 'student'")['cnt'] ?? 0),
            'total_courses' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM courses")['cnt'] ?? 0),
            'pending_enrollments' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM enrollments WHERE payment_status = 'pending'")['cnt'] ?? 0),
            'approved_enrollments' => (int)(Database::fetch("SELECT COUNT(*) as cnt FROM enrollments WHERE payment_status = 'approved'")['cnt'] ?? 0),
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
        $title = trim((string)$this->input('title'));
        $description = trim((string)$this->input('description'));
        $youtubeUrl = trim((string)$this->input('youtube_url'));
        $duration = (int)$this->input('duration_minutes', 20);
        $sortOrder = (int)$this->input('sort_order', 1);

        // YouTube video ID'sini linkten otomatik ayıkla
        $videoId = '';
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $youtubeUrl, $match)) {
            $videoId = $match[1];
        } else {
            $videoId = $youtubeUrl; // Doğrudan ID yazıldıysa
        }

        if ($id > 0) {
            Database::execute(
                "UPDATE course_lessons SET title = ?, description = ?, youtube_url = ?, youtube_video_id = ?, duration_minutes = ?, sort_order = ? WHERE id = ? AND course_id = ?",
                [$title, $description, $youtubeUrl, $videoId, $duration, $sortOrder, $id, $courseId]
            );
        } else {
            Database::execute(
                "INSERT INTO course_lessons (course_id, title, description, youtube_url, youtube_video_id, duration_minutes, sort_order) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)",
                [$courseId, $title, $description, $youtubeUrl, $videoId, $duration, $sortOrder]
            );
        }

        Session::setFlash('xpanel_msg', 'Video ders başarıyla kaydedildi.');
        $this->redirect(url('/xpanel/courses/' . $courseId . '/lessons'));
    }

    public function deleteLesson(): void
    {
        $this->requireAdmin();
        $courseId = (int)$this->input('course_id');
        $id = (int)$this->input('id');

        Database::execute("DELETE FROM course_lessons WHERE id = ? AND course_id = ?", [$id, $courseId]);
        Session::setFlash('xpanel_msg', 'Video ders silindi.');
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

        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/enrollments', [
            'metaTitle' => 'Abonelik & IBAN Ödeme Onayları | xPanel',
            'enrollments' => $enrollments,
            'flash' => $flash
        ], false);
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
                    (SELECT COUNT(*) FROM enrollments WHERE user_id = u.id AND payment_status = 'approved') as active_courses
             FROM users u
             ORDER BY u.id DESC"
        );

        $flash = Session::getFlash('xpanel_msg');

        $this->render('pages/xpanel/users', [
            'metaTitle' => 'Kullanıcı & Öğrenci Yönetimi | xPanel',
            'users' => $users,
            'flash' => $flash
        ], false);
    }
}

