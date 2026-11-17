<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Env.php';

\Core\Env::load(__DIR__ . '/../.env');

$pdo = \Core\Database::getConnection();

echo "Running migrations for xPanel extensions...\n";

// 1. Alter enrollments to support gifts if not present
try {
    $columns = $pdo->query("SHOW COLUMNS FROM enrollments LIKE 'is_gift'")->fetchAll();
    if (empty($columns)) {
        $pdo->exec("ALTER TABLE enrollments ADD COLUMN is_gift TINYINT(1) DEFAULT 0 AFTER admin_notes");
        $pdo->exec("ALTER TABLE enrollments ADD COLUMN gift_message VARCHAR(255) NULL AFTER is_gift");
        echo "- Added is_gift and gift_message to enrollments table.\n";
    }
} catch (\Throwable $e) {
    echo "- Note on enrollments: " . $e->getMessage() . "\n";
}

// 2. Create site_pages table
$pdo->exec("
CREATE TABLE IF NOT EXISTS site_pages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL UNIQUE,
    page_title VARCHAR(150) NOT NULL,
    data_json LONGTEXT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "- Checked/created site_pages table.\n";

// 3. Create site_announcements table
$pdo->exec("
CREATE TABLE IF NOT EXISTS site_announcements (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    badge VARCHAR(100) NULL,
    date_text VARCHAR(100) NULL,
    location VARCHAR(150) NULL,
    spot TEXT NULL,
    content LONGTEXT NULL,
    sort_order INT DEFAULT 1,
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "- Checked/created site_announcements table.\n";

// 4. Create user_tasks table
$pdo->exec("
CREATE TABLE IF NOT EXISTS user_tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    category ENUM('exercise', 'nutrition', 'longevity', 'habit') DEFAULT 'exercise',
    description TEXT NULL,
    points INT DEFAULT 20,
    due_date DATE NULL,
    status ENUM('pending', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
    assigned_by INT UNSIGNED NULL,
    completed_at DATETIME NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "- Checked/created user_tasks table.\n";

// 5. Create user_loyalty table
$pdo->exec("
CREATE TABLE IF NOT EXISTS user_loyalty (
    user_id INT UNSIGNED PRIMARY KEY,
    points INT DEFAULT 100,
    tier ENUM('starter', 'bronze', 'silver', 'gold', 'master') DEFAULT 'starter',
    streak_days INT DEFAULT 0,
    total_completed_workouts INT DEFAULT 0,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "- Checked/created user_loyalty table.\n";

// 6. Create user_activity_logs table
$pdo->exec("
CREATE TABLE IF NOT EXISTS user_activity_logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    action_type VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    admin_id INT UNSIGNED NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_act (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "- Checked/created user_activity_logs table.\n";

// 7. Create user_notes table
$pdo->exec("
CREATE TABLE IF NOT EXISTS user_notes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    admin_id INT UNSIGNED NOT NULL,
    note TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user_notes (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
");
echo "- Checked/created user_notes table.\n";

// Seed default site_pages if empty
$existingPages = $pdo->query("SELECT COUNT(*) FROM site_pages")->fetchColumn();
if ((int)$existingPages === 0) {
    $defaultPages = [
        [
            'page_key' => 'home',
            'page_title' => 'Ana Sayfa (Home)',
            'data_json' => json_encode([
                'hero_kicker' => 'WELLNESS EXPERIENCES BY BETINA TANSUĞ',
                'hero_title' => 'BEDENİNİZİ YENİDEN HİZALAYIN',
                'hero_subtitle' => 'Klinik fizyoterapi temelli yoga ve biyomekanik hareket sistemiyle kronik ağrılardan uzak, güçlü ve esnek bir bedene kavuşun.',
                'btn_primary_text' => 'PROGRAMINI BUL & BAŞLA',
                'btn_primary_link' => '/tr/programs',
                'bar_system_title' => 'Bar System’i Keşfet',
                'bar_system_desc' => 'Klinik anatomi ve biyomekanik prensipleriyle yapılandırılmış, omurga sağlığını ve eklem mobilitesini artıran bütünsel hareket metodolojisi.',
                'guide_title' => 'Meet Your Guide — Betina ile Tanış',
                'guide_spot' => 'Klinik Fizyoterapist & Bar System Kurucusu. 10 yılı aşkın klinik tecrübesiyle binlerce danışana rehberlik ediyor.',
                'guide_btn_text' => 'Biyografiyi Keşfet & İncele',
                'guide_btn_link' => '/tr/betina-tansug'
            ], JSON_UNESCAPED_UNICODE)
        ],
        [
            'page_key' => 'betina',
            'page_title' => 'Betina Tansuğ (Hakkında & Biyografi)',
            'data_json' => json_encode([
                'title' => 'BETİNA TANSUĞ',
                'subtitle' => 'HAREKETİN BİLİMSEL DÖNÜŞÜMÜ',
                'bio_role' => 'KLİNİK FİZYOTERAPİST • BAR SYSTEM KURUCUSU',
                'bio_p1' => 'Fizyoterapist kimliğim sayesinde insan bedenini anatomik, biyomekanik ve fonksiyonel açıdan ele alıyor; yoga ve mobilite pratiğini kanıta dayalı bilimsel bir temele oturtuyorum.',
                'bio_p2' => 'Hareketi dönemsel bir heves değil; omurga sağlığını, eklem mobilitesini ve otonom sinir sistemi dengesini koruyan, uzun ve ağrısız bir ömür için kalıcı bir yaşam disiplini haline getiriyoruz.',
                'featured_box_title' => 'BLOGLARDAN SEÇMELER',
                'featured_box_items' => "Klinik Anatomi & Omurga Hizalanması\nPostür & Fasyal Bütünlük\nEklem Mobilitesi ve Güç\nVagus Sinir Dengesi ve Nefes\nLongevity & Sağlıklı Yaş Alma Rutinleri"
            ], JSON_UNESCAPED_UNICODE)
        ],
        [
            'page_key' => 'studio',
            'page_title' => 'Studio & Bar Kitchen',
            'data_json' => json_encode([
                'title' => 'STUDIO & BAR KITCHEN',
                'subtitle' => 'FONKSİYONEL BESLENME & HÜCRESEL YENİLENME',
                'kitchen_desc' => 'Rafine şekersiz, anti-enflamatuar ve GLP-1 dengeleyici bütünsel tarifler ile longevity yaşam rutinleri.',
                'contact_address' => 'Yenibaraj Mah. Gülek Plaza, Seyhan / Adana',
                'contact_phone' => '0535 705 68 28',
                'contact_whatsapp' => 'https://wa.me/905357056828'
            ], JSON_UNESCAPED_UNICODE)
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO site_pages (page_key, page_title, data_json) VALUES (?, ?, ?)");
    foreach ($defaultPages as $dp) {
        $stmt->execute([$dp['page_key'], $dp['page_title'], $dp['data_json']]);
    }
    echo "- Seeded default site_pages.\n";
}

// Seed default announcements if empty
$existingAnn = $pdo->query("SELECT COUNT(*) FROM site_announcements")->fetchColumn();
if ((int)$existingAnn === 0) {
    $defaultAnnouncements = [
        [
            'title' => '4 HAFTALIK METABOLİK DETOX & YOGA KAMPI',
            'badge' => '01. BİLDİRİ • ONLINE KAMP',
            'date_text' => '18 KASIM 2026',
            'location' => 'CANLI ZOOM & WHATSAPP TAKİP GRUBU',
            'spot' => 'Metabolik yenilenme, GLP-1 dengeleyici fonksiyonel beslenme rehberi ve haftada 3 gün canlı yoga seansları.',
            'content' => 'Yeni dönem online detoks kampımızda Betina Tansuğ rehberliğinde hücresel temizlenme, insülin dengesi ve omurga sağlığı için bir araya geliyoruz. Program kapsamında canlı pratikler, kişiye özel beslenme takibi, haftalık glisemik menü planları ve sürekli eğitmen desteği sunulmaktadır.',
            'sort_order' => 1
        ],
        [
            'title' => 'KLİNİK ANATOMİ VE FASYA MOBİLİTE ATÖLYESİ',
            'badge' => '02. BİLDİRİ • STÜDYO WORKSHOP',
            'date_text' => '24 KASIM 2026',
            'location' => 'FİZYOBAR STÜDYO SEYHAN',
            'spot' => 'Miyofasyal gevşeme teknikleri, tetik nokta uygulamaları ve duruş bozukluklarına yönelik 4 saatlik yoğun anatomi eğitimi.',
            'content' => 'Fasya ağının biyomekanik anatomisi ve postüral bozulmalar üzerindeki rolünün derinlemesine inceleneceği bu hibrit atölyede, bedeninizdeki kronik kısıtlılıkları açmanın ve fasyal sağlığı korumanın pratik yollarını deneyimleyeceksiniz.',
            'sort_order' => 2
        ],
        [
            'title' => 'BAR KITCHEN KIŞ DETOKSU VE GLP-1 BESLENME GÜNLERİ',
            'badge' => '03. BİLDİRİ • BESLENME ETKİNLİĞİ',
            'date_text' => '02 ARALIK 2026',
            'location' => 'ONLINE WEBINAR & REHBER',
            'spot' => 'Kış mevsimine hazırlık, bağışıklık protokolleri ve rafine şekersiz fonksiyonel mutfak atölyesi.',
            'content' => 'Bağışıklık sistemini destekleyen antioksidan zengini tarifler, bağırsak mikrobiyotasını güçlendiren fermente gıdalar ve doğal tokluk hormonlarını optimize eden beslenme ilkeleri üzerine kapsamlı bir kılavuz.',
            'sort_order' => 3
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO site_announcements (title, badge, date_text, location, spot, content, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($defaultAnnouncements as $da) {
        $stmt->execute([$da['title'], $da['badge'], $da['date_text'], $da['location'], $da['spot'], $da['content'], $da['sort_order']]);
    }
    echo "- Seeded default site_announcements.\n";
}

// Seed loyalty records for existing users if missing
$users = $pdo->query("SELECT id FROM users")->fetchAll(\PDO::FETCH_COLUMN);
$loyaltyStmt = $pdo->prepare("INSERT IGNORE INTO user_loyalty (user_id, points, tier, streak_days, total_completed_workouts) VALUES (?, 100, 'starter', 3, 3)");
foreach ($users as $uid) {
    $loyaltyStmt->execute([$uid]);
}
echo "- Initialized user_loyalty for existing users.\n";

echo "Migration finished successfully!\n";
