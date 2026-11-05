<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\Session;

class StudentController extends Controller
{
    private function requireAuth(): void
    {
        if (!Auth::check()) {
            Session::setFlash('login_error', 'Lütfen önce giriş yapınız.');
            $this->redirect(url('/login'));
        }
    }

    public function dashboard(): void
    {
        $this->requireAuth();
        $userId = Auth::id();

        // 1. Kullanıcının kayıtlı olduğu programlar
        $enrollments = Database::query(
            "SELECT e.*, c.title AS course_title, c.slug AS course_slug, c.duration_weeks, c.badge_title, c.badge_icon
             FROM enrollments e
             INNER JOIN courses c ON e.course_id = c.id
             WHERE e.user_id = ?
             ORDER BY e.created_at DESC",
            [$userId]
        );

        // Her program için ilerleme yüzdesini hesapla
        foreach ($enrollments as &$enr) {
            $totalLessons = (int)(Database::fetch(
                "SELECT COUNT(*) as cnt FROM course_lessons WHERE course_id = ?",
                [$enr['course_id']]
            )['cnt'] ?? 0);

            $completedLessons = (int)(Database::fetch(
                "SELECT COUNT(*) as cnt FROM user_lesson_progress WHERE user_id = ? AND course_id = ? AND is_completed = 1",
                [$userId, $enr['course_id']]
            )['cnt'] ?? 0);

            $enr['total_lessons'] = $totalLessons;
            $enr['completed_lessons'] = $completedLessons;
            $enr['progress_percent'] = ($totalLessons > 0) ? (int)round(($completedLessons / $totalLessons) * 100) : 0;
        }

        // 2. Kazanılan Rozetler
        $badges = Database::query(
            "SELECT b.*, c.title as course_title 
             FROM user_badges b
             LEFT JOIN courses c ON b.course_id = c.id
             WHERE b.user_id = ?
             ORDER BY b.awarded_at DESC",
            [$userId]
        );

        $this->render('pages/student/dashboard', [
            'metaTitle' => 'Öğrenci Paneli | Fizyobar',
            'user' => Auth::user(),
            'enrollments' => $enrollments,
            'badges' => $badges
        ]);
    }

    public function viewCourse(string $slug): void
    {
        $this->requireAuth();
        $userId = Auth::id();

        $course = Database::fetch("SELECT * FROM courses WHERE slug = ?", [$slug]);
        if (!$course) {
            $this->redirect(url('/dashboard'));
        }

        // Kullanıcının onaylı aboneliği var mı?
        $enrollment = Database::fetch(
            "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? AND payment_status = 'approved'",
            [$userId, $course['id']]
        );

        if (!$enrollment && !Auth::isAdmin()) {
            Session::setFlash('checkout_info', 'Bu eğitime erişmek için lütfen abonelik oluşturunuz.');
            $this->redirect(url('/checkout/' . $course['id']));
        }

        $lessons = Database::query(
            "SELECT l.*, 
                    COALESCE(p.is_completed, 0) as is_completed
             FROM course_lessons l
             LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
             WHERE l.course_id = ?
             ORDER BY l.sort_order ASC",
            [$userId, $course['id']]
        );

        $firstLessonId = $lessons[0]['id'] ?? 0;
        $this->redirect(url('/course/' . $slug . '/lesson/' . $firstLessonId));
    }

    public function viewLesson(string $slug, string $lessonId): void
    {
        $this->requireAuth();
        $userId = Auth::id();
        $lessonId = (int)$lessonId;

        $course = Database::fetch("SELECT * FROM courses WHERE slug = ?", [$slug]);
        if (!$course) {
            $this->redirect(url('/dashboard'));
        }

        // Erişim kontrolü
        $enrollment = Database::fetch(
            "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? AND payment_status = 'approved'",
            [$userId, $course['id']]
        );

        if (!$enrollment && !Auth::isAdmin()) {
            $this->redirect(url('/checkout/' . $course['id']));
        }

        // Tüm ders listesi
        $lessons = Database::query(
            "SELECT l.*, 
                    COALESCE(p.is_completed, 0) as is_completed
             FROM course_lessons l
             LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
             WHERE l.course_id = ?
             ORDER BY l.sort_order ASC",
            [$userId, $course['id']]
        );

        $currentLesson = Database::fetch("SELECT * FROM course_lessons WHERE id = ? AND course_id = ?", [$lessonId, $course['id']]);
        if (!$currentLesson) {
            $currentLesson = $lessons[0] ?? null;
        }

        // İlerleme yüzdesi
        $total = count($lessons);
        $completed = 0;
        foreach ($lessons as $les) {
            if (!empty($les['is_completed'])) {
                $completed++;
            }
        }
        $progressPercent = ($total > 0) ? (int)round(($completed / $total) * 100) : 0;

        $this->render('pages/student/lesson', [
            'metaTitle' => ($currentLesson['title'] ?? 'Ders') . ' | ' . $course['title'],
            'course' => $course,
            'currentLesson' => $currentLesson,
            'lessons' => $lessons,
            'progressPercent' => $progressPercent,
            'completedCount' => $completed,
            'totalCount' => $total
        ]);
    }

    public function completeLesson(): void
    {
        $this->requireAuth();
        $userId = Auth::id();

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true) ?? $_POST;
        $lessonId = (int)($data['lesson_id'] ?? 0);
        $courseId = (int)($data['course_id'] ?? 0);

        if ($lessonId <= 0 || $courseId <= 0) {
            $this->json(['success' => false, 'error' => 'Geçersiz parametreler'], 400);
        }

        // Dersi tamamlandı olarak işaretle
        Database::execute(
            "INSERT INTO user_lesson_progress (user_id, course_id, lesson_id, is_completed, completed_at) 
             VALUES (?, ?, ?, 1, NOW())
             ON DUPLICATE KEY UPDATE is_completed = 1, completed_at = NOW()",
            [$userId, $courseId, $lessonId]
        );

        // İlerleme yüzdesini hesapla
        $totalLessons = (int)(Database::fetch("SELECT COUNT(*) as cnt FROM course_lessons WHERE course_id = ?", [$courseId])['cnt'] ?? 0);
        $completedLessons = (int)(Database::fetch("SELECT COUNT(*) as cnt FROM user_lesson_progress WHERE user_id = ? AND course_id = ? AND is_completed = 1", [$userId, $courseId])['cnt'] ?? 0);
        $progress = ($totalLessons > 0) ? (int)round(($completedLessons / $totalLessons) * 100) : 0;

        // Rozet Ödüllendirme Mantığı (Gamification)
        $newBadge = null;

        // 1. İlk Ders Tamamlama Rozeti
        if ($completedLessons >= 1) {
            $hasBadge = Database::fetch("SELECT id FROM user_badges WHERE user_id = ? AND course_id = ? AND badge_code = 'first_step'", [$userId, $courseId]);
            if (!$hasBadge) {
                Database::execute("INSERT INTO user_badges (user_id, course_id, badge_code, badge_name, badge_icon) VALUES (?, ?, 'first_step', 'İlk Adım Rozeti', '🌱')", [$userId, $courseId]);
                $newBadge = ['name' => 'İlk Adım Rozeti', 'icon' => '🌱'];
            }
        }

        // 2. Yolun Yarısı Rozeti (%50)
        if ($progress >= 50) {
            $hasBadge = Database::fetch("SELECT id FROM user_badges WHERE user_id = ? AND course_id = ? AND badge_code = 'halfway'", [$userId, $courseId]);
            if (!$hasBadge) {
                Database::execute("INSERT INTO user_badges (user_id, course_id, badge_code, badge_name, badge_icon) VALUES (?, ?, 'halfway', 'Yolun Yarısı Rozeti', '⚡')", [$userId, $courseId]);
                $newBadge = ['name' => 'Yolun Yarısı Rozeti', 'icon' => '⚡'];
            }
        }

        // 3. Program Şampiyonu Rozeti (%100)
        if ($progress >= 100) {
            $hasBadge = Database::fetch("SELECT id FROM user_badges WHERE user_id = ? AND course_id = ? AND badge_code = 'master'", [$userId, $courseId]);
            if (!$hasBadge) {
                $course = Database::fetch("SELECT badge_title, badge_icon FROM courses WHERE id = ?", [$courseId]);
                $badgeTitle = $course['badge_title'] ?: 'Longevity Master';
                $badgeIcon = $course['badge_icon'] ?: '🏆';

                Database::execute("INSERT INTO user_badges (user_id, course_id, badge_code, badge_name, badge_icon) VALUES (?, ?, 'master', ?, ?)", [$userId, $courseId, $badgeTitle, $badgeIcon]);
                $newBadge = ['name' => $badgeTitle, 'icon' => $badgeIcon];
            }
        }

        $this->json([
            'success' => true,
            'progress' => $progress,
            'completedCount' => $completedLessons,
            'totalCount' => $totalLessons,
            'newBadge' => $newBadge
        ]);
    }
}

