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

        // 1. Kurs Seçimi: URL parametresi (?course=X), yoksa kullanıcının en son kayıtlı olduğu kurs, yoksa Course ID 1
        $course = null;
        $selectedCourseId = (int)($_GET['course'] ?? 0);
        if ($selectedCourseId > 0) {
            $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [$selectedCourseId]);
        }

        if (empty($course)) {
            // Öncelikli olarak hediye olmayan ana programı (Detoks Kampı vb.) bul
            $mainEnrollment = Database::fetch(
                "SELECT e.course_id 
                 FROM enrollments e
                 WHERE e.user_id = ? AND e.payment_status = 'approved' AND (e.is_gift = 0 OR e.is_gift IS NULL)
                 ORDER BY e.id DESC LIMIT 1",
                [$userId]
            );
            if ($mainEnrollment) {
                $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [(int)$mainEnrollment['course_id']]);
            } else {
                $latestEnrollment = Database::fetch(
                    "SELECT e.course_id 
                     FROM enrollments e
                     WHERE e.user_id = ? AND e.payment_status = 'approved'
                     ORDER BY e.id DESC LIMIT 1",
                    [$userId]
                );
                if ($latestEnrollment) {
                    $course = Database::fetch("SELECT * FROM courses WHERE id = ?", [(int)$latestEnrollment['course_id']]);
                }
            }
        }

        if (empty($course)) {
            $course = Database::fetch("SELECT * FROM courses WHERE id = 1");
            if (!$course) {
                $course = Database::fetch("SELECT * FROM courses ORDER BY id ASC LIMIT 1");
            }
        }
        $courseId = (int)($course['id'] ?? 1);

        // 2. Kullanıcının Tüm Kayıtları (Profil ve Kurs Değiştirme için)
        $userEnrollments = Database::query(
            "SELECT e.*, c.title AS course_title, c.slug AS course_slug, c.duration_weeks
             FROM enrollments e
             INNER JOIN courses c ON e.course_id = c.id
             WHERE e.user_id = ?
             ORDER BY e.id DESC",
            [$userId]
        );

        // Aktif Kursun Kayıt Durumu
        $enrollment = Database::fetch(
            "SELECT * FROM enrollments WHERE user_id = ? AND course_id = ? ORDER BY id DESC LIMIT 1",
            [$userId, $courseId]
        );

        // Otomatik Hediye 3'lü Meditasyon Paketi Tanımlama Kontrolü
        $meditationCourse = Database::fetch("SELECT id FROM courses WHERE slug = '3lu-meditasyon-serisi'");
        if ($meditationCourse) {
            $hasMeditation = Database::fetch(
                "SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?",
                [$userId, $meditationCourse['id']]
            );
            if (!$hasMeditation) {
                Database::execute(
                    "INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, plan_type, amount, is_gift, gift_message, approved_at, start_date, expires_at, created_at)
                     VALUES (?, ?, 'iban', 'approved', 'yearly', 0.00, 1, 'Hediye 3lü Meditasyon Paketi', NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 365 DAY), NOW())",
                    [$userId, $meditationCourse['id']]
                );
            }
        }

        // Eğer henüz kaydı yoksa ve sistemde kayıtlı ilk kullanıcılarsa otomatik erişim aç
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
            $userEnrollments = Database::query(
                "SELECT e.*, c.title AS course_title, c.slug AS course_slug, c.duration_weeks
                 FROM enrollments e
                 INNER JOIN courses c ON e.course_id = c.id
                 WHERE e.user_id = ?
                 ORDER BY e.id DESC",
                [$userId]
            );
        }

        // Yıllık Üyelik Kontrolü: Yıllık abonelerin tüm eğitim ve materyallere tam erişimi vardır
        $isYearlySubscriber = (bool)Database::fetch(
            "SELECT id FROM enrollments WHERE user_id = ? AND payment_status = 'approved' AND plan_type = 'yearly' AND (expires_at IS NULL OR expires_at >= NOW()) LIMIT 1",
            [$userId]
        );

        // Program Başlangıç Tarihi ve Kaçıncı Gün Olduğu
        $startDateStr = $enrollment['start_date'] ?? $enrollment['approved_at'] ?? $enrollment['created_at'] ?? date('Y-m-d');
        $startTime = strtotime($startDateStr);
        $nowTime = time();
        $diffDays = (int)floor(($nowTime - $startTime) / 86400);
        $currentProgramDay = max(1, min(28, $diffDays + 1));

        // SATIN ALMA / ONAYLI ERİŞİM KONTROLÜ:
        // Kullanıcı plan seçip satın alma gerçekleştirdiğinde (payment_status == 'approved'),
        // veya yıllık abone ise, veya admin ise TÜM VİDEOLARA ERİŞİM ANINDA AÇILIR.
        $isEnrolledAndApproved = ($enrollment && $enrollment['payment_status'] === 'approved');
        $unlockAll = $isEnrolledAndApproved || $isYearlySubscriber || (bool)($_SESSION['movement_unlock_all'] ?? false) || Auth::isAdmin();

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

        // Canlı sunucu toleransı: Eğer seçili kurs ID için henüz ders yoksa Course 1 veya sistem derslerini yükle
        if (empty($lessons)) {
            $lessons = Database::query(
                "SELECT l.*, 
                        COALESCE(p.is_completed, 0) as is_completed,
                        p.completed_at
                 FROM course_lessons l
                 LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
                 WHERE l.course_id = 1
                 ORDER BY l.day_number ASC, l.sort_order ASC",
                [$userId]
            );
        }

        if (empty($lessons)) {
            self::ensureDefaultLessonsExist();
            $lessons = Database::query(
                "SELECT l.*, 
                        COALESCE(p.is_completed, 0) as is_completed,
                        p.completed_at
                 FROM course_lessons l
                 LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
                 WHERE l.course_id = 1
                 ORDER BY l.day_number ASC, l.sort_order ASC",
                [$userId]
            );
        }

        if (empty($lessons)) {
            $lessons = Database::query(
                "SELECT l.*, 
                        COALESCE(p.is_completed, 0) as is_completed,
                        p.completed_at
                 FROM course_lessons l
                 LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
                 ORDER BY l.day_number ASC, l.sort_order ASC",
                [$userId]
            );
        }

        if (empty($lessons)) {
            $lessons = self::getDefaultLessonsFallback();
        }

        // Tamamlanan antrenman sayısı
        $completedCount = 0;
        $lessonsByDay = [];
        $workoutIndex = 1;

        foreach ($lessons as $i => &$lesson) {
            $lesson['workout_number'] = sprintf('%02d', $workoutIndex++);
            $isComp = (bool)$lesson['is_completed'];
            if ($isComp) {
                $completedCount++;
            }

            // Kilit kontrolü: Günlük drip sistemi VEYA önceki dersi bitirme
            $dayNum = (int)($lesson['day_number'] ?? 1);
            $scheduledTime = strtotime("+".max(0, $dayNum - 1)." days", $startTime);
            $lesson['unlock_date'] = date('d.m.Y', $scheduledTime);
            $lesson['days_left'] = max(0, $dayNum - $currentProgramDay);

            $prevCompleted = ($i === 0) || !empty($lessons[$i - 1]['is_completed']);
            $calendarUnlocked = ($dayNum <= $currentProgramDay);
            // Gün gün açılma sistemi: Bugün ve geçmiş günler açık, gelecek günler kilitli
            $lesson['is_locked'] = ($dayNum > $currentProgramDay) && empty($lesson['is_completed']);

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
                $isLockedDay = ($programDay > $currentProgramDay) && (!$workoutData || empty($workoutData['is_completed']));

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
                    'is_locked' => $isLockedDay,
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
        $recipes = array_values(array_filter($nutritionItems, fn($n) => $n['category'] === 'recipe'));
        $tips = array_values(array_filter($nutritionItems, fn($n) => $n['category'] === 'tip'));
        $routines = array_values(array_filter($nutritionItems, fn($n) => $n['category'] === 'routine'));

        // 7. Rozetler & İstatistikler
        $badges = Database::query(
            "SELECT b.*, c.title as course_title 
             FROM user_badges b
             LEFT JOIN courses c ON b.course_id = c.id
             WHERE b.user_id = ?
             ORDER BY b.awarded_at DESC",
            [$userId]
        );

        // 8. Sadakat Puanı, Kademe & Streak
        $loyalty = Database::fetch("SELECT * FROM user_loyalty WHERE user_id = ?", [$userId]);
        if (!$loyalty) {
            Database::execute("INSERT IGNORE INTO user_loyalty (user_id, points, tier, streak_days, total_completed_workouts) VALUES (?, 120, 'bronze', 3, ?)", [$userId, $completedCount]);
            $loyalty = Database::fetch("SELECT * FROM user_loyalty WHERE user_id = ?", [$userId]);
        }

        // 9. Özel Görevler (Atanan ödevler)
        $tasks = Database::query(
            "SELECT * FROM user_tasks WHERE user_id = ? ORDER BY CASE WHEN status = 'pending' THEN 1 WHEN status = 'in_progress' THEN 2 ELSE 3 END, id DESC",
            [$userId]
        );

        // 10. Hediye Paketler
        $giftEnrollments = Database::query(
            "SELECT e.*, c.title as course_title, c.duration_weeks, c.badge_title
             FROM enrollments e
             INNER JOIN courses c ON e.course_id = c.id
             WHERE e.user_id = ? AND e.is_gift = 1
             ORDER BY e.id DESC",
            [$userId]
        );

        // Ay başlığı (Örn: KASIM 2026)
        $monthEn = mb_strtoupper(date('F', $startTime), 'UTF-8');
        $trMonths = [
            'JANUARY' => 'OCAK', 'FEBRUARY' => 'ŞUBAT', 'MARCH' => 'MART', 'APRIL' => 'NİSAN',
            'MAY' => 'MAYIS', 'JUNE' => 'HAZİRAN', 'JULY' => 'TEMMUZ', 'AUGUST' => 'AĞUSTOS',
            'SEPTEMBER' => 'EYLÜL', 'OCTOBER' => 'EKİM', 'NOVEMBER' => 'KASIM', 'DECEMBER' => 'ARALIK'
        ];
        $monthTitleTr = ($trMonths[$monthEn] ?? $monthEn) . ' ' . date('Y', $startTime);

        $this->render('pages/student/movement_space', [
            'metaTitle' => 'Kişisel Hareket Alanı | FİZYOBAR',
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
            'monthTitle' => $monthTitleTr,
            'userEnrollments' => $userEnrollments,
            'recipes' => $recipes,
            'tips' => $tips,
            'routines' => $routines,
            'badges' => $badges,
            'loyalty' => $loyalty,
            'tasks' => $tasks,
            'giftEnrollments' => $giftEnrollments,
            'successMsg' => Session::getFlash('profile_success'),
            'errorMsg' => Session::getFlash('profile_error')
        ], true);
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
            $course = Database::fetch("SELECT * FROM courses WHERE slug LIKE ? OR id = ? LIMIT 1", ['%' . $slug . '%', (int)$slug]);
            if (!$course && ($slug === 'detoks' || $slug === 'detox')) {
                $course = Database::fetch("SELECT * FROM courses WHERE slug LIKE '%detox%' OR id = 1 LIMIT 1");
            }
            if (!$course) {
                $course = Database::fetch("SELECT * FROM courses ORDER BY id ASC LIMIT 1");
            }
        }
        if (!$course) {
            $course = [
                'id' => 1,
                'title' => '4 Haftalık Online Detox & Yoga Kampı',
                'slug' => 'online-detox-yoga-kampi',
                'duration_weeks' => 4
            ];
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
        
        // Satın alan / onaylı kullanıcının tüm videoları anında açıktır
        $isEnrolledAndApproved = ($enrollment && $enrollment['payment_status'] === 'approved');
        $unlockAll = $isEnrolledAndApproved || (bool)($_SESSION['movement_unlock_all'] ?? false) || Auth::isAdmin();

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

        if (empty($lessons)) {
            $lessons = Database::query(
                "SELECT l.*, 
                        COALESCE(p.is_completed, 0) as is_completed,
                        p.completed_at
                 FROM course_lessons l
                 LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
                 WHERE l.course_id = 1
                 ORDER BY l.day_number ASC, l.sort_order ASC",
                [$userId]
            );
        }

        if (empty($lessons)) {
            $lessons = Database::query(
                "SELECT l.*, 
                        COALESCE(p.is_completed, 0) as is_completed,
                        p.completed_at
                 FROM course_lessons l
                 LEFT JOIN user_lesson_progress p ON l.id = p.lesson_id AND p.user_id = ?
                 ORDER BY l.day_number ASC, l.sort_order ASC",
                [$userId]
            );
        }

        if (empty($lessons)) {
            $lessons = self::getDefaultLessonsFallback();
        }

        $currentLesson = null;
        $prevLesson = null;
        $nextLesson = null;
        $idx = 0;
        $matchedIdx = -1;

        foreach ($lessons as $i => &$les) {
            $les['workout_number'] = sprintf('%02d', $i + 1);
            $dayNum = (int)($les['day_number'] ?? 1);
            $scheduledTime = strtotime("+".max(0, $dayNum - 1)." days", $startTime);
            $les['unlock_date'] = date('d.m.Y', $scheduledTime);
            $les['days_left'] = max(0, $dayNum - $currentProgramDay);

            $prevCompleted = ($i === 0) || !empty($lessons[$i - 1]['is_completed']);
            $calendarUnlocked = ($dayNum <= $currentProgramDay);
            // Gün gün açılma sistemi
            $les['is_locked'] = ($dayNum > $currentProgramDay) && empty($les['is_completed']);

            if ((int)($les['id'] ?? 0) === $lessonId) {
                $currentLesson = $les;
                $matchedIdx = $i;
            }
        }
        unset($les);

        if (!$currentLesson && !empty($lessons)) {
            $currentLesson = $lessons[0];
            $matchedIdx = 0;
        }

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

        // Kilit kontrolü: Gelecek günlerin seansları kilitlidir
        if (!empty($currentLesson['is_locked'])) {
            Session::setFlash('profile_error', 'Bu antrenman ' . (int)$currentLesson['day_number'] . '. günde açılacaktır. Takviminiz gün gün ilerlemektedir.');
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
    public function completeTask(): void
    {
        $this->requireAuth();
        $userId = Auth::id();
        $taskId = (int)$this->input('task_id');

        if ($taskId > 0) {
            $task = Database::fetch("SELECT * FROM user_tasks WHERE id = ? AND user_id = ?", [$taskId, $userId]);
            if ($task && $task['status'] !== 'completed') {
                Database::execute("UPDATE user_tasks SET status = 'completed', completed_at = NOW() WHERE id = ?", [$taskId]);
                $pts = (int)$task['points'];
                Database::execute("UPDATE user_loyalty SET points = points + ? WHERE user_id = ?", [$pts, $userId]);

                Database::execute(
                    "INSERT INTO user_activity_logs (user_id, action_type, description, created_at)
                     VALUES (?, 'task_completed', ?, NOW())",
                    [$userId, "Öğrenci '{$task['title']}' görevini başarıyla tamamladı (+{$pts} Sadakat Puanı)."]
                );

                Session::setFlash('profile_success', "Tebrikler! '{$task['title']}' görevini tamamladınız ve +{$pts} Sadakat Puanı kazandınız!");

                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                    $this->json([
                        'success' => true,
                        'message' => "Görev tamamlandı!",
                        'points_awarded' => $pts
                    ]);
                    return;
                }
            }
        }

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $this->json(['success' => false, 'error' => 'Görev bulunamadı']);
            return;
        }

        $this->redirect(url('/dashboard'));
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

    /**
     * Canlı Sunucuda Ders Tablosu Boşsa 12 Antrenmanı Otomatik Doldur
     */
    public static function ensureDefaultLessonsExist(): void
    {
        $existing = Database::fetch("SELECT COUNT(*) as cnt FROM course_lessons WHERE course_id = 1");
        if ((int)($existing['cnt'] ?? 0) > 0) {
            return;
        }

        $defaultLessons = [
            [1, 1, 'Foundation: Tüm Beden Hizalanma & Kuvvet', 'Temel Postür & Omurga Stabilitesi', 'Mat & Destek Bloğu', 'Bedenin kinematik zincirini nötral hatta getiren, eklemleri dekomprese eden ve derin core aktivasyonunu başlatan temel güç ve hizalanma seansı.', 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'sTANio_2E0Q', 40, 1],
            [1, 3, 'Mobility Reset: Omurga & Kalça Açıcı', 'Kalça Mobilitesi & Torakal Rotasyon', 'Mat', 'Masa başı gerginliğini ve bel-kalça sıkışmalarını nötralize eden, 3 boyutlu eklem açıklığını artıran akışkan mobilite serisi.', 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'v7AYKMP6rOE', 40, 2],
            [1, 5, 'Core Control: Derin Merkez & Pelvik Taban', 'Transversus Abdominis & Pelvik Güç', 'Mat & Küçük Top (Opsiyonel)', 'Bel omurlarını zırh gibi koruyan derin karın ve pelvik taban kaslarını diyafram nefesiyle senkronize biçimde aktive eden odaklı antrenman.', 'https://www.youtube.com/watch?v=inpok4MKVLM', 'inpok4MKVLM', 40, 3],
            [1, 8, 'Fascial Flow: Bütünsel Fasya Esnekliği', 'Miyofasyal Ağ & Elastik Yaylanma', 'Mat', 'Baştan ayağa tüm bedeni saran kolajen fasya ağını hidrate eden, mikrotravmaları ve doku sertliğini çözen elastik enerji akışı.', 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'sTANio_2E0Q', 40, 4],
            [1, 10, 'Spine Alignment: Torakal Açılım & Boyun', 'İleri Baş Düzeltme & Skapular Retraksiyon', 'Mat & Rulo Havlu', 'Servikal C5-C7 üzerindeki yükü kaldıran, torakal omurgayı dikleştiren ve duruşu zarifçe yeniden programlayan biyomekanik seri.', 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'v7AYKMP6rOE', 40, 5],
            [1, 12, 'Lower Body Power: Bacak & Glute Aktivasyonu', 'Glute Medius & Diz Stabilitesi', 'Mat & Mini Direnç Bandı (Opsiyonel)', 'Diz ve bel sağlığını koruyan güçlü kalça (glute) ve bacak kaslarını eklemleri zorlamadan hedefleyen kinetik kuvvet seansı.', 'https://www.youtube.com/watch?v=inpok4MKVLM', 'inpok4MKVLM', 40, 6],
            [1, 15, 'Dynamic Balance: Denge & Nöromüsküler Koordinasyon', 'Tek Bacak Dengesi & Proprisepsiyon', 'Mat', 'Beyin ile kas lifleri arasındaki iletişimi güçlendiren, eklem algısını ve denge merkezini uyaran dinamik fonksiyonel çalışma.', 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'sTANio_2E0Q', 40, 7],
            [1, 17, 'Vagus & Breath Reset: Otonom Sinir Sistemi Dinginliği', 'Diyafram & Parasempatik Restorasyon', 'Mat & Rahat Minder', 'Kronik sempatik tonusu (stres-kaç modunu) kapatıp vagal aktivasyonu başlatan, kalp atım değişkenliğini (HRV) artıran meditatif hareket akışı.', 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'v7AYKMP6rOE', 40, 8],
            [1, 19, 'Upper Body & Scapula: Omuz Açılımı & Göğüs Kafesi', 'Skapular Dinamik & Göğüs Kafesi Genişliği', 'Mat & Yoga Kemeri/Kemer', 'Masa başı yuvarlak omuz postürünü geride bırakan, nefes kapasitesini artıran ve omuz manşet kaslarını güçlendiren seans.', 'https://www.youtube.com/watch?v=inpok4MKVLM', 'inpok4MKVLM', 40, 9],
            [1, 22, 'Full Body Integration: Bütünsel Güç & Koordinasyon', 'Kombine Akış & Metabolik Canlılık', 'Mat & Destek Bloğu', 'Öğrenilen tüm biyomekanik prensipleri akışkan bir ritimle birleştiren, mitokondriyal biyogenezi destekleyen bütünsel zirve seansı.', 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'sTANio_2E0Q', 40, 10],
            [1, 24, 'Deep Recovery: Eklem Dekompresyonu & Hücresel Onarım', 'Fasya Rahatlatma & Sinir Germeleri', 'Mat & Battaniye/Minder', 'Eklemleri nazikçe açan, dokulardaki laktik asit ve enflamasyon birikimini temizleyen restoratif onarım protokolü.', 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'v7AYKMP6rOE', 40, 11],
            [1, 26, 'Longevity Mastery: Yaşam Boyu Hareket & Mezuniyet', 'Sürdürülebilir Günlük Rutin & Beden Özgürlüğü', 'Mat', '28 günlük yolculuğu taçlandıran, bedene kalıcı özsaygı ve hafiflik kazandıran özel mezuniyet ve devamlılık akışı.', 'https://www.youtube.com/watch?v=inpok4MKVLM', 'inpok4MKVLM', 40, 12],
        ];

        foreach ($defaultLessons as $item) {
            Database::execute(
                "INSERT INTO course_lessons (course_id, day_number, title, focus_area, equipment, description, youtube_url, youtube_video_id, duration_minutes, sort_order, is_free_preview)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)",
                $item
            );
        }
    }

    /**
     * Veritabanı boşsa dahi arayüzün ve seansların kusursuz çalışması için hafıza fallback listesi
     */
    public static function getDefaultLessonsFallback(): array
    {
        return [
            ['id' => 1, 'course_id' => 1, 'day_number' => 1, 'workout_number' => '01', 'title' => 'Foundation: Tüm Beden Hizalanma & Kuvvet', 'focus_area' => 'Temel Postür & Omurga Stabilitesi', 'equipment' => 'Mat & Destek Bloğu', 'description' => 'Bedenin kinematik zincirini nötral hatta getiren temel güç ve hizalanma seansı.', 'youtube_url' => 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'youtube_video_id' => 'sTANio_2E0Q', 'duration_minutes' => 40, 'sort_order' => 1, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 2, 'course_id' => 1, 'day_number' => 3, 'workout_number' => '02', 'title' => 'Mobility Reset: Omurga & Kalça Açıcı', 'focus_area' => 'Kalça Mobilitesi & Torakal Rotasyon', 'equipment' => 'Mat', 'description' => 'Masa başı gerginliğini ve bel-kalça sıkışmalarını nötralize eden akışkan mobilite serisi.', 'youtube_url' => 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'youtube_video_id' => 'v7AYKMP6rOE', 'duration_minutes' => 40, 'sort_order' => 2, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 3, 'course_id' => 1, 'day_number' => 5, 'workout_number' => '03', 'title' => 'Core Control: Derin Merkez & Pelvik Taban', 'focus_area' => 'Transversus Abdominis & Pelvik Güç', 'equipment' => 'Mat & Küçük Top', 'description' => 'Bel omurlarını zırh gibi koruyan derin karın ve pelvik taban aktivasyonu.', 'youtube_url' => 'https://www.youtube.com/watch?v=inpok4MKVLM', 'youtube_video_id' => 'inpok4MKVLM', 'duration_minutes' => 40, 'sort_order' => 3, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 4, 'course_id' => 1, 'day_number' => 8, 'workout_number' => '04', 'title' => 'Fascial Flow: Bütünsel Fasya Esnekliği', 'focus_area' => 'Miyofasyal Ağ & Elastik Yaylanma', 'equipment' => 'Mat', 'description' => 'Tüm bedeni saran kolajen fasya ağını hidrate eden elastik enerji akışı.', 'youtube_url' => 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'youtube_video_id' => 'sTANio_2E0Q', 'duration_minutes' => 40, 'sort_order' => 4, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 5, 'course_id' => 1, 'day_number' => 10, 'workout_number' => '05', 'title' => 'Spine Alignment: Torakal Açılım & Boyun', 'focus_area' => 'İleri Baş Düzeltme & Skapular Retraksiyon', 'equipment' => 'Mat & Rulo Havlu', 'description' => 'Servikal C5-C7 üzerindeki yükü kaldıran ve duruşu yeniden programlayan seri.', 'youtube_url' => 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'youtube_video_id' => 'v7AYKMP6rOE', 'duration_minutes' => 40, 'sort_order' => 5, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 6, 'course_id' => 1, 'day_number' => 12, 'workout_number' => '06', 'title' => 'Lower Body Power: Bacak & Glute Aktivasyonu', 'focus_area' => 'Glute Medius & Diz Stabilitesi', 'equipment' => 'Mat & Mini Direnç Bandı', 'description' => 'Diz ve bel sağlığını koruyan güçlü kalça ve bacak kaslarını hedefleyen kinetik kuvvet seansı.', 'youtube_url' => 'https://www.youtube.com/watch?v=inpok4MKVLM', 'youtube_video_id' => 'inpok4MKVLM', 'duration_minutes' => 40, 'sort_order' => 6, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 7, 'course_id' => 1, 'day_number' => 15, 'workout_number' => '07', 'title' => 'Dynamic Balance: Denge & Nöromüsküler Koordinasyon', 'focus_area' => 'Tek Bacak Dengesi & Proprisepsiyon', 'equipment' => 'Mat', 'description' => 'Beyin ile kas lifleri arasındaki iletişimi güçlendiren dinamik çalışma.', 'youtube_url' => 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'youtube_video_id' => 'sTANio_2E0Q', 'duration_minutes' => 40, 'sort_order' => 7, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 8, 'course_id' => 1, 'day_number' => 17, 'workout_number' => '08', 'title' => 'Vagus & Breath Reset: Otonom Sinir Sistemi Dinginliği', 'focus_area' => 'Diyafram & Parasempatik Restorasyon', 'equipment' => 'Mat & Rahat Minder', 'description' => 'Vagal aktivasyonu başlatan, kalp atım değişkenliğini artıran meditatif hareket akışı.', 'youtube_url' => 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'youtube_video_id' => 'v7AYKMP6rOE', 'duration_minutes' => 40, 'sort_order' => 8, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 9, 'course_id' => 1, 'day_number' => 19, 'workout_number' => '09', 'title' => 'Upper Body & Scapula: Omuz Açılımı & Göğüs Kafesi', 'focus_area' => 'Skapular Dinamik & Göğüs Kafesi Genişliği', 'equipment' => 'Mat & Yoga Kemeri', 'description' => 'Yuvarlak omuz postürünü geride bırakan, nefes kapasitesini artıran seans.', 'youtube_url' => 'https://www.youtube.com/watch?v=inpok4MKVLM', 'youtube_video_id' => 'inpok4MKVLM', 'duration_minutes' => 40, 'sort_order' => 9, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 10, 'course_id' => 1, 'day_number' => 22, 'workout_number' => '10', 'title' => 'Full Body Integration: Bütünsel Güç & Koordinasyon', 'focus_area' => 'Kombine Akış & Metabolik Canlılık', 'equipment' => 'Mat & Destek Bloğu', 'description' => 'Tüm biyomekanik prensipleri birleştiren zirve seansı.', 'youtube_url' => 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'youtube_video_id' => 'sTANio_2E0Q', 'duration_minutes' => 40, 'sort_order' => 10, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 11, 'course_id' => 1, 'day_number' => 24, 'workout_number' => '11', 'title' => 'Deep Recovery: Eklem Dekompresyonu & Hücresel Onarım', 'focus_area' => 'Fasya Rahatlatma & Sinir Germeleri', 'equipment' => 'Mat & Battaniye', 'description' => 'Eklemleri nazikçe açan ve dokulardaki gerginliği temizleyen onarım protokolü.', 'youtube_url' => 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'youtube_video_id' => 'v7AYKMP6rOE', 'duration_minutes' => 40, 'sort_order' => 11, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
            ['id' => 12, 'course_id' => 1, 'day_number' => 26, 'workout_number' => '12', 'title' => 'Longevity Mastery: Yaşam Boyu Hareket & Mezuniyet', 'focus_area' => 'Sürdürülebilir Günlük Rutin & Beden Özgürlüğü', 'equipment' => 'Mat', 'description' => '28 günlük yolculuğu taçlandıran özel mezuniyet ve devamlılık akışı.', 'youtube_url' => 'https://www.youtube.com/watch?v=inpok4MKVLM', 'youtube_video_id' => 'inpok4MKVLM', 'duration_minutes' => 40, 'sort_order' => 12, 'is_free_preview' => 0, 'is_completed' => 0, 'completed_at' => null, 'is_locked' => 0, 'unlock_date' => date('d.m.Y'), 'days_left' => 0],
        ];
    }

    public function viewCourse(string $slug): void
    {
        $this->redirect(url('/movement-space'));
    }
}
