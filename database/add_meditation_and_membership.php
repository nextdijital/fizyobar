<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Env.php';

\Core\Env::load(__DIR__ . '/../.env');

$pdo = \Core\Database::getConnection();

echo "Running migrations for Meditation Gift Course & Membership Plan Types...\n";

// 1. Add plan_type column to enrollments if not exists
try {
    $columns = $pdo->query("SHOW COLUMNS FROM enrollments LIKE 'plan_type'")->fetchAll();
    if (empty($columns)) {
        $pdo->exec("ALTER TABLE enrollments ADD COLUMN plan_type ENUM('monthly', 'yearly') DEFAULT 'monthly' AFTER payment_status");
        echo "- Added plan_type to enrollments table.\n";
    } else {
        echo "- plan_type already exists on enrollments.\n";
    }
} catch (\Throwable $e) {
    echo "- Note on plan_type: " . $e->getMessage() . "\n";
}

// 2. Add or update course 4: 3'lü Meditasyon & Vagus Sinir Regülasyonu
$courseSlug = '3lu-meditasyon-serisi';
$stmt = $pdo->prepare("SELECT id FROM courses WHERE slug = ?");
$stmt->execute([$courseSlug]);
$existingCourse = $stmt->fetch();

if (!$existingCourse) {
    $stmtInsert = $pdo->prepare("
        INSERT INTO courses (title, slug, subtitle, description, category, price, duration_weeks, badge_title, badge_icon, image_url, is_featured, is_active, sort_order)
        VALUES (?, ?, ?, ?, 'online', 750.00, 1, 'Hediye Bonus', '🧘', 'assets/images/betina-outdoor-stretch.jpg', 0, 1, 4)
    ");
    $stmtInsert->execute([
        '3\'lü Meditasyon & Vagus Sinir Regülasyonu (Hediye Paket)',
        $courseSlug,
        'Derin uyku, stres azaltma ve otonom sinir sistemi dengesi için 3 özel seans.',
        'Fizyoterapist Betina Tansuğ rehberliğinde diyafram nefesi, vagus sinir stimülasyonu ve hücresel gevşeme seansları. Paket satın alan tüm üyelere özel hediye olarak açılır.'
    ]);
    $courseId = (int)$pdo->lastInsertId();
    echo "- Created course 3'lü Meditasyon (ID: $courseId)\n";
} else {
    $courseId = (int)$existingCourse['id'];
    echo "- Meditation course already exists (ID: $courseId)\n";
}

// 3. Insert the 3 lessons for Course 4
$lessonsData = [
    [
        'day' => 1,
        'title' => 'Ders 1: Vagus & Derin Uyku Meditasyonu',
        'focus' => 'Beden Taraması & Otonom Sinir Sistemi',
        'desc' => 'Parasempatik sinir sistemini aktive ederek gün boyu biriken sempatik gerginliği çözen, derin uyku fazına geçişi hızlandıran rehberli gevşeme.',
        'url' => 'https://www.youtube.com/watch?v=inpok4MKVLM',
        'vid' => 'inpok4MKVLM',
        'duration' => 15
    ],
    [
        'day' => 2,
        'title' => 'Ders 2: Sabah Berraklığı & Diyafram Nefesi',
        'focus' => 'Prana, Odak & Zihinsel Dinginlik',
        'desc' => 'Güne berrak ve dengeli bir zihinle başlamak için diyafram temelli prana nefes akışı ve omurga farkındalığı seansı.',
        'url' => 'https://www.youtube.com/watch?v=sTANio_2E0Q',
        'vid' => 'sTANio_2E0Q',
        'duration' => 15
    ],
    [
        'day' => 3,
        'title' => 'Ders 3: Kortizol Düşürücü Akşam Sıfırlaması',
        'focus' => 'Stres Azaltma & Hücresel Dinginlik',
        'desc' => 'Yoğun günün ardından stres hormonu kortizolü düşüren, kalp ritmini yatıştıran ve vagal tonusu artıran restoratif meditasyon.',
        'url' => 'https://www.youtube.com/watch?v=v7AYKMP6rOE',
        'vid' => 'v7AYKMP6rOE',
        'duration' => 20
    ]
];

foreach ($lessonsData as $les) {
    $checkLes = $pdo->prepare("SELECT id FROM course_lessons WHERE course_id = ? AND day_number = ?");
    $checkLes->execute([$courseId, $les['day']]);
    if (!$checkLes->fetch()) {
        $insLes = $pdo->prepare("
            INSERT INTO course_lessons (course_id, day_number, title, focus_area, description, youtube_url, youtube_video_id, duration_minutes, equipment, sort_order, is_free_preview)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Mat veya Rahat Koltuk', ?, 0)
        ");
        $insLes->execute([
            $courseId,
            $les['day'],
            $les['title'],
            $les['focus'],
            $les['desc'],
            $les['url'],
            $les['vid'],
            $les['duration'],
            $les['day']
        ]);
        echo "  + Inserted lesson {$les['day']}: {$les['title']}\n";
    } else {
        echo "  - Lesson {$les['day']} already exists.\n";
    }
}

// 4. Auto-enroll existing approved users to this meditation gift package so they have it immediately!
$approvedUsers = $pdo->query("SELECT DISTINCT user_id FROM enrollments WHERE payment_status = 'approved'")->fetchAll(\PDO::FETCH_COLUMN);
foreach ($approvedUsers as $uid) {
    $checkUserGift = $pdo->prepare("SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?");
    $checkUserGift->execute([$uid, $courseId]);
    if (!$checkUserGift->fetch()) {
        $insGift = $pdo->prepare("
            INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, plan_type, amount, is_gift, gift_message, approved_at, start_date, expires_at, created_at)
            VALUES (?, ?, 'iban', 'approved', 'yearly', 0.00, 1, 'Hediye 3lü Meditasyon Paketi', NOW(), CURDATE(), DATE_ADD(NOW(), INTERVAL 365 DAY), NOW())
        ");
        $insGift->execute([$uid, $courseId]);
        echo "  * Granted meditation gift to user ID $uid\n";
    }
}

echo "Migration completed successfully!\n";
