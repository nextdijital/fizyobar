<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Auth;
use Core\Database;
use Core\Session;

/**
 * Fizyobar Movement Space Controller
 * Kişisel Hareket Alanı, 28 Günlük Antrenman Takvimi, Kilitli Video ve İlerleme Sistemi
 */
class StudentController extends Controller
{
    private function requireAuth(): void
    {
        if (!Auth::check()) {
            Session::setFlash('login_error', 'Lütfen önce giriş yapınız.');
            $this->redirect(url('/login'));
        }
    }

    /**
     * Movement Space Ana Ekranı
     */
    public function dashboard(): void
    {
        $this->requireAuth();
        $userId = Auth::id();
        $user = Auth::user();

        // 1. Ana 4 Haftalık Online Kamp Programını Al (Course ID: 1)
        $course = Database::fetch("SELECT * FROM courses WHERE id = 1");
        if (!$course) {
            $course = Database::fetch("SELECT * FROM courses ORDER BY id ASC LIMIT 1");
        }
        $courseId = (int)($course['id'] ?? 1);

        // 2. Kullanıcının Enrollment Kontrolü
        $enrollment = Database::fetch(
            "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? ORDER BY id DESC LIMIT 1",
            [$userId, $courseId]
        );

        // Eğer kayıtlı değilse veya pending ise, kullanıcıyı doğrudan Movement Space'e dahil et
        if (!$enrollment) {
            Database::execute(
                "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, amount, approved_at, start_date, expires_at, created_at) 
                 VALUES (?, ?, 'iban', 'approved', 0.00, NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 90 DAY), NOW())",
                [$userId, $courseId]
            );
            $enrollment = Database::fetch(
                "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? ORDER BY id DESC LIMIT 1",
                [$userId, $courseId]
            );
        }

        // Program Başlangıç Tarihi ve Kaçıncı Gün Olduğu
        $startDateStr = $enrollment['start_date'] ?? $enrollment['approved_at'] ?? $enrollment['created_at'] ?? date('Y-m-d');
        $startTime = strtotime($startDateStr);
        $nowTime = time();
        $diffDays = (int)floor(($nowTime - $startTime) / 86400);
        $currentProgramDay = max(1, min(28, $diffDays + 1));

        // Eğitmen / Önizleme Modu (Tüm videoları aç)
        $unlockAll = (bool)($_SESSION['movement_unlock_all'] ?? false) || Auth::isAdmin();

        // 3. 12 Antrenmanı Getir
        $lessons = Database::query(
            "SELECT l.*, 
                    COALESCE(p.is_completed, 0) as is_completed,
                    p.completed_at
             FROM course_lessons l
             LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
             WHERE l.course_id = ?
             ORDER BY l.day_number ASC, l.sort_order ASC",
            [$userId, $courseId]
        );

        // Tamamlanan antrenman sayısı
        $completedCount = 0;
        $lessonsByDay = [];
        $workoutIndex = 1;

        foreach ($lessons as &$lesson) {
            $lesson['workout_number'] = sprintf('%02d', $workoutIndex++);
            $isComp = (bool)$lesson['is_completed'];
            if ($isComp) {
                $completedCount++;
            }

            // Kilit kontrolü: Günlük drip sistemi
            $dayNum = (int)($lesson['day_number'] ?? 1);
            $isLocked = !$unlockAll && ($dayNum > $currentProgramDay);
            $lesson['is_locked'] = $isLocked;
            $lesson['days_left'] = max(0, $dayNum - $currentProgramDay);
            
            // Planlanan açılış tarihi
            $scheduledTime = strtotime("+".($dayNum - 1)." days", $startTime);
            $lesson['unlock_date'] = date('d.m.Y', $scheduledTime);

            $lessonsByDay[$dayNum] = $lesson;
        }
        unset($lesson);

        $totalWorkouts = max(1, count($lessons));
        $progressPercent = (int)round(($completedCount / $totalWorkouts) * 100);

        // 12 Parçalı Görsel İlerleme Çubuğu (Image: ■■■□□□□□□□□□ 25%)
        $progressBlocks = [];
        for ($i = 0; $i < $totalWorkouts; $i++) {
            $progressBlocks[] = ($i < $completedCount);
        }

        // 4. 28 Günlük İnteraktif Takvim Matrisi (4 Hafta x 7 Gün)
        // Hafta 1: 1-7, Hafta 2: 8-14, Hafta 3: 15-21, Hafta 4: 22-28
        // Antrenman Günleri: Pzt (1, 8, 15, 22), Çar (3, 10, 17, 24), Cum (5, 12, 19, 26)
        $calendarWeeks = [];
        $dayNamesShort = ['PZT', 'SAL', 'ÇAR', 'PER', 'CUM', 'CTS', 'PAZ'];
        $dayNamesEn = ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'];

        for ($weekIdx = 0; $weekIdx < 4; $weekIdx++) {
            $weekDays = [];
            for ($dayIdx = 0; $dayIdx < 7; $dayIdx++) {
                $programDay = ($weekIdx * 7) + $dayIdx + 1;
                $hasWorkout = isset($lessonsByDay[$programDay]);
                $workoutData = $hasWorkout ? $lessonsByDay[$programDay] : null;

                $dayCalDate = date('d M', strtotime("+".($programDay - 1)." days", $startTime));

                $weekDays[] = [
                    'day_number' => $programDay,
                    'day_label' => $dayNamesShort[$dayIdx],
                    'day_label_en' => $dayNamesEn[$dayIdx],
                    'date_formatted' => $dayCalDate,
                    'has_workout' => $hasWorkout,
                    'workout' => $workoutData,
                    'is_current_day' => ($programDay === $currentProgramDay),
                    'is_past' => ($programDay < $currentProgramDay),
                    'is_completed' => ($workoutData && !empty($workoutData['is_completed'])),
                    'is_locked' => ($workoutData && !empty($workoutData['is_locked'])),
                    'is_rest' => !$hasWorkout
                ];
            }
            $calendarWeeks[] = [
                'week_number' => $weekIdx + 1,
                'days' => $weekDays
            ];
        }

        // 5. Bu Haftanın Antrenmanları (This Week's Movement)
        $currentWeekNumber = min(4, (int)ceil($currentProgramDay / 7));
        $thisWeekWorkouts = [];
        foreach ($lessons as $les) {
            $wNum = (int)ceil((int)$les['day_number'] / 7);
            if ($wNum === $currentWeekNumber) {
                $thisWeekWorkouts[] = $les;
            }
        }
        if (empty($thisWeekWorkouts) && !empty($lessons)) {
            $thisWeekWorkouts = array_slice($lessons, 0, 3);
        }

        // 6. Beslenme Köşesi & Ekstra Mikro-Rutinler
        $nutritionItems = Database::query(
            "SELECT * FROM movement_nutrition ORDER BY sort_order ASC"
        );
        $recipes = array_filter($nutritionItems, fn($n) => $n['category'] === 'recipe');
        $tips = array_filter($nutritionItems, fn($n) => $n['category'] === 'tip');
        $routines = array_filter($nutritionItems, fn($n) => $n['category'] === 'routine');

        // 7. Rozetler & İstatistikler
        $badges = Database::query(
            "SELECT b.*, c.title as course_title 
             FROM user_badges b
             LEFT JOIN courses c ON b.course_id = c.id
             WHERE b.user_id = ?
             ORDER BY b.awarded_at DESC",
            [$userId]
        );

        // Ay başlığı (Örn: KASIM 2026 / NOVEMBER 2026)
        $monthTitle = mb_strtoupper(date('F Y', $startTime), 'UTF-8');
        $trMonths = [
            'JANUARY' => 'OCAK', 'FEBRUARY' => 'ŞUBAT', 'MARCH' => 'MART', 'APRIL' => 'NİSAN',
            'MAY' => 'MAYIS', 'JUNE' => 'HAZİRAN', 'JULY' => 'TEMMUZ', 'AUGUST' => 'AĞUSTOS',
            'SEPTEMBER' => 'EYLÜL', 'OCTOBER' => 'EKİM', 'NOVEMBER' => 'KASIM', 'DECEMBER' => 'ARALIK'
        ];
        $monthTitleTr = $trMonths[$monthTitle] ?? $monthTitle;

        $this->render('pages/student/movement_space', [
            'metaTitle' => 'Movement Space | FİZYOBAR Kişisel Hareket Alanı',
            'user' => $user,
            'course' => $course,
            'enrollment' => $enrollment,
            'lessons' => $lessons,
            'lessonsByDay' => $lessonsByDay,
            'completedCount' => $completedCount,
            'totalWorkouts' => $totalWorkouts,
            'progressPercent' => $progressPercent,
            'progressBlocks' => $progressBlocks,
            'currentProgramDay' => $currentProgramDay,
            'currentWeekNumber' => $currentWeekNumber,
            'thisWeekWorkouts' => $thisWeekWorkouts,
            'calendarWeeks' => $calendarWeeks,
            'unlockAll' => $unlockAll,
            'monthTitle' => $monthTitleTr . ' / ' . $monthTitle,
            'recipes' => $recipes,
            'tips' => $tips,
            'routines' => $routines,
            'badges' => $badges,
            'successMsg' => Session::getFlash('profile_success'),
            'errorMsg' => Session::getFlash('profile_error')
        ]);
    }

    /**
     * Tekil Antrenman Oynatıcı Ekranı
     */
    public function viewLesson(string $slug, string $lessonId): void
    {
        $this->requireAuth();
        $userId = Auth::id();
        $lessonId = (int)$lessonId;

        $course = Database::fetch("SELECT * FROM courses WHERE slug = ?", [$slug]);
        if (!$course) {
            $this->redirect(url('/movement-space'));
        }

        $enrollment = Database::fetch(
            "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?",
            [$userId, $course['id']]
        );

        if (!$enrollment) {
            // Otomatik başlat
            Database::execute(
                "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, amount, approved_at, start_date, expires_at, created_at) 
                 VALUES (?, ?, 'iban', 'approved', 0.00, NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 90 DAY), NOW())",
                [$userId, $course['id']]
            );
            $enrollment = Database::fetch(
                "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ?",
                [$userId, $course['id']]
            );
        }

        // Program Günü Hesabı
        $startDateStr = $enrollment['start_date'] ?? $enrollment['approved_at'] ?? $enrollment['created_at'] ?? date('Y-m-d');
        $startTime = strtotime($startDateStr);
        $diffDays = (int)floor((time() - $startTime) / 86400);
        $currentProgramDay = max(1, min(28, $diffDays + 1));
        $unlockAll = (bool)($_SESSION['movement_unlock_all'] ?? false) || Auth::isAdmin();

        // Tüm Dersler
        $lessons = Database::query(
            "SELECT l.*, 
                    COALESCE(p.is_completed, 0) as is_completed,
                    p.completed_at
             FROM course_lessons l
             LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
             WHERE l.course_id = ?
             ORDER BY l.day_number ASC, l.sort_order ASC",
            [$userId, $course['id']]
        );

        $currentLesson = null;
        $prevLesson = null;
        $nextLesson = null;
        $idx = 0;
        $matchedIdx = -1;

        foreach ($lessons as $i => &$les) {
            $les['workout_number'] = sprintf('%02d', $i + 1);
            $dayNum = (int)($les['day_number'] ?? 1);
            $les['is_locked'] = !$unlockAll && ($dayNum > $currentProgramDay);
            $les['days_left'] = max(0, $dayNum - $currentProgramDay);

            if ($les['id'] === $lessonId) {
                $currentLesson = $les;
                $matchedIdx = $i;
            }
        }
        unset($les);

        if (!$currentLesson) {
            $currentLesson = $lessons[0] ?? null;
            $matchedIdx = 0;
        }

        if ($matchedIdx > 0) {
            $prevLesson = $lessons[$matchedIdx - 1];
        }
        if ($matchedIdx < count($lessons) - 1) {
            $nextLesson = $lessons[$matchedIdx + 1];
        }

        // Kilit kontrolü
        if (!empty($currentLesson['is_locked'])) {
            Session::setFlash('profile_error', 'Bu antrenman henüz kilitlidir. Programınızın ' . $currentLesson['day_number'] . '. gününde açılacaktır.');
            $this->redirect(url('/movement-space'));
        }

        $total = count($lessons);
        $completed = 0;
        foreach ($lessons as $l) {
            if (!empty($l['is_completed'])) {
                $completed++;
            }
        }
        $progressPercent = ($total > 0) ? (int)round(($completed / $total) * 100) : 0;

        $this->render('pages/student/lesson', [
            'metaTitle' => ($currentLesson['title'] ?? 'Antrenman') . ' | ' . $course['title'],
            'course' => $course,
            'currentLesson' => $currentLesson,
            'lessons' => $lessons,
            'prevLesson' => $prevLesson,
            'nextLesson' => $nextLesson,
            'progressPercent' => $progressPercent,
            'completedCount' => $completed,
            'totalCount' => $total,
            'user' => Auth::user()
        ]);
    }

    /**
     * Antrenmanı Tamamla / Geri Al AJAX API
     */
    public function completeLesson(): void
    {
        $this->requireAuth();
        $userId = Auth::id();

        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true) ?? $_POST;
        $lessonId = (int)($data['lesson_id'] ?? 0);
        $courseId = (int)($data['course_id'] ?? 1);

        if ($lessonId <= 0 || $courseId <= 0) {
            $this->json(['success' => false, 'error' => 'Geçersiz parametreler'], 400);
        }

        // Mevcut durum
        $existing = Database::fetch(
            "SELECT id, is_completed FROM user_lesson_progress WHERE user_id = ? AND lesson_id = ?",
            [$userId, $lessonId]
        );

        $newCompletedState = 1;
        if ($existing && !empty($existing['is_completed'])) {
            // Eğer zaten tamamlandıysa isteğe bağlı geri alma
            if (isset($data['toggle']) && $data['toggle'] === true) {
                $newCompletedState = 0;
                Database::execute(
                    "UPDATE user_lesson_progress SET is_completed = 0 WHERE id = ?",
                    [$existing['id']]
                );
            }
        } else {
            Database::execute(
                "INSERT INTO user_lesson_progress (user_id, course_id, lesson_id, is_completed, completed_at) 
                 VALUES (?, ?, ?, 1, NOW())
                 ON DUPLICATE KEY UPDATE is_completed = 1, completed_at = NOW()",
                [$userId, $courseId, $lessonId]
            );
        }

        // Güncel İlerleme
        $totalLessons = (int)(Database::fetch("SELECT COUNT(*) as cnt FROM course_lessons WHERE course_id = ?", [$courseId])['cnt'] ?? 12);
        $completedLessons = (int)(Database::fetch("SELECT COUNT(*) as cnt FROM user_lesson_progress WHERE user_id = ? AND course_id = ? AND is_completed = 1", [$userId, $courseId])['cnt'] ?? 0);
        $progress = ($totalLessons > 0) ? (int)round(($completedLessons / $totalLessons) * 100) : 0;

        // Rozet Sistemi
        $newBadge = null;
        if ($completedLessons >= 1) {
            $hasBadge = Database::fetch("SELECT id FROM user_badges WHERE user_id = ? AND course_id = ? AND badge_code = 'first_step'", [$userId, $courseId]);
            if (!$hasBadge) {
                Database::execute("INSERT INTO user_badges (user_id, course_id, badge_code, badge_name, badge_icon) VALUES (?, ?, 'first_step', 'İlk Adım: Foundation', '🌱')", [$userId, $courseId]);
                $newBadge = ['name' => 'İlk Adım: Foundation', 'icon' => '🌱'];
            }
        }
        if ($progress >= 50) {
            $hasBadge = Database::fetch("SELECT id FROM user_badges WHERE user_id = ? AND course_id = ? AND badge_code = 'halfway'", [$userId, $courseId]);
            if (!$hasBadge) {
                Database::execute("INSERT INTO user_badges (user_id, course_id, badge_code, badge_name, badge_icon) VALUES (?, ?, 'halfway', 'Yolun Yarısı: 2. Hafta Mezunu', '⚡')", [$userId, $courseId]);
                $newBadge = ['name' => 'Yolun Yarısı: 2. Hafta Mezunu', 'icon' => '⚡'];
            }
        }
        if ($progress >= 100) {
            $hasBadge = Database::fetch("SELECT id FROM user_badges WHERE user_id = ? AND course_id = ? AND badge_code = 'master'", [$userId, $courseId]);
            if (!$hasBadge) {
                Database::execute("INSERT INTO user_badges (user_id, course_id, badge_code, badge_name, badge_icon) VALUES (?, ?, 'master', '28 Günlük Kamp Şampiyonu', '🏆')", [$userId, $courseId]);
                $newBadge = ['name' => '28 Günlük Kamp Şampiyonu', 'icon' => '🏆'];
            }
        }

        // 12 Parçalı Blok Dizisi
        $blocks = [];
        for ($i = 0; $i < $totalLessons; $i++) {
            $blocks[] = ($i < $completedLessons);
        }

        $this->json([
            'success' => true,
            'is_completed' => ($newCompletedState === 1),
            'progress' => $progress,
            'completedCount' => $completedLessons,
            'totalCount' => $totalLessons,
            'blocks' => $blocks,
            'newBadge' => $newBadge
        ]);
    }

    /**
     * Önizleme / Demo Modu Aç/Kapat (Tüm Kilitleri Aç)
     */
    public function toggleLockMode(): void
    {
        $this->requireAuth();
        $current = (bool)($_SESSION['movement_unlock_all'] ?? false);
        $_SESSION['movement_unlock_all'] = !$current;

        $msg = $_SESSION['movement_unlock_all'] 
            ? 'Önizleme Modu Açıldı: Tüm 12 antrenmanın kilitleri test için kaldırıldı.' 
            : 'Normal Mod: Antrenmanlar programa göre günlük kilit sistemiyle ilerleyecek.';
        Session::setFlash('profile_success', $msg);

        $this->redirect(url('/movement-space'));
    }

    /**
     * Profil Bilgilerini Güncelle
     */
    public function updateProfile(): void
    {
        $this->requireAuth();
        $userId = Auth::id();

        $fullName = trim((string)$this->input('full_name'));
        $phone = trim((string)$this->input('phone'));

        if (empty($fullName)) {
            Session::setFlash('profile_error', 'Lütfen adınızı ve soyadınızı belirtiniz.');
            $this->redirect(url('/movement-space#profile'));
        }

        Database::execute(
            "UPDATE users SET full_name = ?, phone = ?, updated_at = NOW() WHERE id = ?",
            [$fullName, $phone, $userId]
        );

        Session::setFlash('profile_success', 'Profil bilgileriniz başarıyla güncellendi.');
        $this->redirect(url('/movement-space#profile'));
    }

    /**
     * Şifre Değiştirme
     */
    public function changePassword(): void
    {
        $this->requireAuth();
        $userId = Auth::id();
        $user = Auth::user();

        $currentPass = (string)$this->input('current_password');
        $newPass = (string)$this->input('new_password');
        $newPassConfirm = (string)$this->input('new_password_confirm');

        if (empty($currentPass) || empty($newPass)) {
            Session::setFlash('profile_error', 'Lütfen mevcut ve yeni şifrenizi giriniz.');
            $this->redirect(url('/movement-space#profile'));
        }

        if (!password_verify($currentPass, $user['password_hash'])) {
            Session::setFlash('profile_error', 'Mevcut şifrenizi hatalı girdiniz.');
            $this->redirect(url('/movement-space#profile'));
        }

        if (strlen($newPass) < 6) {
            Session::setFlash('profile_error', 'Yeni şifreniz en az 6 karakter olmalıdır.');
            $this->redirect(url('/movement-space#profile'));
        }

        if ($newPass !== $newPassConfirm) {
            Session::setFlash('profile_error', 'Yeni şifreler birbiriyle uyuşmuyor.');
            $this->redirect(url('/movement-space#profile'));
        }

        $hash = password_hash($newPass, PASSWORD_BCRYPT);
        Database::execute(
            "UPDATE users SET password_hash = ?, updated_at = NOW() WHERE id = ?",
            [$hash, $userId]
        );

        Session::setFlash('profile_success', 'Şifreniz başarıyla değiştirildi.');
        $this->redirect(url('/movement-space#profile'));
    }

    public function viewCourse(string $slug): void
    {
        $this->redirect(url('/movement-space'));
    }
}
