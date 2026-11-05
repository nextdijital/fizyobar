<?php
declare(strict_types=1);

require_once 'C:/xampp/htdocs/fizyobar/core/Env.php';
require_once 'C:/xampp/htdocs/fizyobar/core/Database.php';

\Core\Env::load('C:/xampp/htdocs/fizyobar/.env');
$db = \Core\Database::getConnection();

if (!$db) {
    die("DB connection failed\n");
}

// 1. Seed Admin & Student Users
$adminPass = password_hash('admin123', PASSWORD_BCRYPT);
$studentPass = password_hash('ogrenci123', PASSWORD_BCRYPT);

$stmt = $db->prepare("INSERT INTO users (full_name, email, phone, password_hash, role, status) VALUES 
(?, ?, ?, ?, 'admin', 'active'),
(?, ?, ?, ?, 'student', 'active')
ON DUPLICATE KEY UPDATE full_name = VALUES(full_name), password_hash = VALUES(password_hash)");

$stmt->execute([
    'Betina Tansuğ (Admin)', 'admin@fizyobar.com', '05357056828', $adminPass,
    'Örnek Öğrenci', 'ogrenci@fizyobar.com', '05321112233', $studentPass
]);

// 2. Seed Settings
$settings = [
    'site_title' => 'FİZYOBAR | Wellness Experiences by Betina Tansuğ',
    'brand_name' => 'FİZYOBAR',
    'founder_name' => 'Betina Tansuğ (Fizyoterapist & Yoga Eğitmeni)',
    'phone' => '0535 705 68 28',
    'whatsapp' => 'https://wa.me/905357056828',
    'email' => 'betinabaram@gmail.com',
    'instagram' => '@fizyobar',
    'instagram_url' => 'https://instagram.com/fizyobar',
    'location' => 'Yenibaraj Mah. Gülek Plaza, Seyhan / Adana',
    'announcement_text' => 'WELLNESS EXPERIENCES BY BETINA TANSUĞ • 4 HAFTALIK DETOX & YOGA KAMPI YENİ DÖNEMİ BAŞLIYOR',
    'iban_bank' => 'Garanti BBVA',
    'iban_name' => 'Betina Tansuğ',
    'iban_no' => 'TR33 0006 2000 0001 2345 6789 01',
    'iban_notes' => 'Ödeme açıklama alanına Ad Soyad ve Referans Kodunuzu mutlaka yazınız.',
    'iyzico_status' => '0',
    'iyzico_api_key' => '',
    'iyzico_secret_key' => '',
    'iyzico_base_url' => 'https://sandbox-api.iyzipay.com'
];

$stmtSetting = $db->prepare("INSERT INTO settings (`key`, `value`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)");
foreach ($settings as $k => $v) {
    $stmtSetting->execute([$k, $v]);
}

// 3. Seed Courses
$courses = [
    [
        'title' => '4 Haftalık Online Detox & Yoga Kampı',
        'slug' => 'online-detox-yoga-kampi',
        'subtitle' => 'Ev konforunda canlı yoga dersleri, metabolik farkındalık ve birebir rehberlik.',
        'description' => 'Haftalık canlı seanslar, WhatsApp üzerinden günlük beslenme ve alışkanlık takibi, glisemik denge rehberi.',
        'category' => 'online',
        'price' => 1850.00,
        'duration_weeks' => 4,
        'badge_title' => 'Detox & Longevity Master',
        'badge_icon' => '🌿',
        'is_featured' => 1,
        'sort_order' => 1,
        'lessons' => [
            ['Hafta 1: Metabolik Uyanış ve Diyafram Nefesi', 'Güne enerjik başlama ve vagus sinirini uyararak kortizolü düşürme pratikleri.', 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'sTANio_2E0Q', 25],
            ['Hafta 2: Omurga Hareketliliği & Eklem Açma', 'Boyun, omuz ve bel bölgesindeki kronik gerginliği azaltan fonksiyonel akış.', 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'v7AYKMP6rOE', 30],
            ['Hafta 3: Glisemik Denge & Tokluk Farkındalığı', 'Rafine şeker krizlerini yönetme, GLP-1 desteği ve stabil enerji metabolizması.', 'https://www.youtube.com/watch?v=inpok4MKVLM', 'inpok4MKVLM', 35],
            ['Hafta 4: Sürdürülebilir Longevity Rutini', 'Kamp sonrası kazanılan pratikleri kalıcı bir yaşam stiline dönüştürme seansı.', 'https://www.youtube.com/watch?v=sTANio_2E0Q', 'sTANio_2E0Q', 40]
        ]
    ],
    [
        'title' => 'Warrior Yoga: Güç & Biyomekanik',
        'slug' => 'warrior-yoga-guc-biyomekanik',
        'subtitle' => 'Yüksek tempolu, kalori harcatırken eklemleri koruyan fonksiyonel yoga serisi.',
        'description' => 'Fizyoterapist bakış açısıyla tasarlanmış, güç ve dayanıklılığı artıran dinamik akışlar.',
        'category' => 'online',
        'price' => 1250.00,
        'duration_weeks' => 3,
        'badge_title' => 'Warrior Flow Champion',
        'badge_icon' => '⚡',
        'is_featured' => 0,
        'sort_order' => 2,
        'lessons' => [
            ['Modül 1: Alt Ekstremite & Pelvik Güç', 'Kalça stabilizasyonu ve bacak hizalanması pratikleri.', 'https://www.youtube.com/watch?v=v7AYKMP6rOE', 'v7AYKMP6rOE', 25],
            ['Modül 2: Core & Üst Gövde Entegrasyonu', 'Derin karın kasları ve skapular stabilite odaklı dinamik akış.', 'https://www.youtube.com/watch?v=inpok4MKVLM', 'inpok4MKVLM', 30]
        ]
    ]
];

foreach ($courses as $c) {
    $stmtC = $db->prepare("INSERT INTO courses (title, slug, subtitle, description, category, price, duration_weeks, badge_title, badge_icon, is_featured, sort_order) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE title=VALUES(title), price=VALUES(price)");
    
    $stmtC->execute([
        $c['title'], $c['slug'], $c['subtitle'], $c['description'], $c['category'],
        $c['price'], $c['duration_weeks'], $c['badge_title'], $c['badge_icon'],
        $c['is_featured'], $c['sort_order']
    ]);

    $courseId = $db->lastInsertId();
    if ($courseId == 0) {
        $found = \Core\Database::fetch("SELECT id FROM courses WHERE slug = ?", [$c['slug']]);
        $courseId = $found['id'] ?? 1;
    }

    $sort = 1;
    foreach ($c['lessons'] as $l) {
        $stmtL = $db->prepare("INSERT INTO course_lessons (course_id, title, description, youtube_url, youtube_video_id, duration_minutes, sort_order) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtL->execute([$courseId, $l[0], $l[1], $l[2], $l[3], $l[4], $sort++]);
    }
}

// 4. Sample Enrollment for Demo Student
$user = \Core\Database::fetch("SELECT id FROM users WHERE email = 'ogrenci@fizyobar.com'");
$firstCourse = \Core\Database::fetch("SELECT id, price FROM courses LIMIT 1");
if ($user && $firstCourse) {
    $db->prepare("INSERT INTO enrollments (user_id, course_id, payment_method, payment_status, amount, sender_name, receipt_ref, approved_at) 
    VALUES (?, ?, 'iban', 'approved', ?, 'Örnek Öğrenci', 'FT-2026-001', NOW())
    ON DUPLICATE KEY UPDATE payment_status = 'approved'")
    ->execute([$user['id'], $firstCourse['id'], $firstCourse['price']]);

    // Give 1 completed lesson & 1 badge for demonstration
    $firstLesson = \Core\Database::fetch("SELECT id FROM course_lessons WHERE course_id = ? ORDER BY sort_order ASC LIMIT 1", [$firstCourse['id']]);
    if ($firstLesson) {
        $db->prepare("INSERT IGNORE INTO user_lesson_progress (user_id, course_id, lesson_id, is_completed) VALUES (?, ?, ?, 1)")
           ->execute([$user['id'], $firstCourse['id'], $firstLesson['id']]);

        $db->prepare("INSERT IGNORE INTO user_badges (user_id, course_id, badge_code, badge_name, badge_icon) VALUES (?, ?, 'first_step', 'İlk Adım Rozeti', '🌱')")
           ->execute([$user['id'], $firstCourse['id']]);
    }
}

echo "Database seeded successfully!\n";

