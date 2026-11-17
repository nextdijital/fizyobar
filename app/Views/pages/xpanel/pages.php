<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';

$activeTab = $activeTab ?? ($_GET['tab'] ?? 'home');
$data = $pages[$activeTab]['data'] ?? [];

$tabMeta = [
    'header_nav' => [
        'name' => 'Üst Menü, Logo & Duyuru',
        'icon' => '🏷️',
        'desc' => 'Site üst duyuru bandı, ana marka logosu görselleri, sloganı ve menü butonları.',
        'live_url' => url('/'),
    ],
    'home' => [
        'name' => 'Ana Sayfa',
        'icon' => '🏠',
        'desc' => 'Ana vitrin video/görsel alanı, butonlar, 5 minimalist ikon, Bar System kartları ve Betina ile Tanış bölümü.',
        'live_url' => url('/'),
    ],
    'programs' => [
        'name' => 'Programlar & Paketler',
        'icon' => '🏋️',
        'desc' => 'Vitrin afiş görseli, buton yönlendirmeleri, Öncesi/Sonrası dönüşüm fotoğrafları ve üyelik planları.',
        'live_url' => url('/programs'),
    ],
    'betina' => [
        'name' => 'Betina Tansuğ & Metot',
        'icon' => '🧘',
        'desc' => 'Betina Tansuğ 3 büyük vitrin portre fotoğrafı, biyografi metinleri ve Bar System metodolojisi.',
        'live_url' => url('/betina-tansug'),
    ],
    'detox' => [
        'name' => 'Online Detoks Kampı',
        'icon' => '🌿',
        'desc' => '4 haftalık online detoks kapak afiş görseli, kayıt butonları, fiyatlandırma ve WhatsApp destek linkleri.',
        'live_url' => url('/detox'),
    ],
    'studio' => [
        'name' => 'Stüdyo & Mutfak',
        'icon' => '🥗',
        'desc' => 'Stüdyo vitrin tabak görseli, fonksiyonel tarifler, rehberler ve buton yönlendirmeleri.',
        'live_url' => url('/studio'),
    ],
    'events' => [
        'name' => 'Etkinlikler & Haberler',
        'icon' => '📅',
        'desc' => 'Canlı etkinlik afiş görselleri, rezervasyon buton linkleri ve duyurular.',
        'live_url' => url('/events'),
    ],
    'corporate' => [
        'name' => 'Kurumsal & Wellness',
        'icon' => '🏢',
        'desc' => 'Kurumsal ergonomi kapak görseli, 3 şirket modülü ve teklif alma buton linkleri.',
        'live_url' => url('/corporate'),
    ],
    'find_program' => [
        'name' => 'Programını Bul (Test)',
        'icon' => '🧭',
        'desc' => 'Test karşılama arka plan görseli, adım soruları, buton linkleri ve yapay zeka analiz yönlendirmesi.',
        'live_url' => url('/programini-bul'),
    ],
    'footer_contact' => [
        'name' => 'İletişim, Alt Bilgi & Sosyal',
        'icon' => '📞',
        'desc' => 'WhatsApp iletişim hattı, klinik lokasyonu, sosyal medya kanalları ve arka plan dokusu.',
        'live_url' => url('/#footer'),
    ],
    'legal' => [
        'name' => 'Yasal & KVKK Metinleri',
        'icon' => '⚖️',
        'desc' => 'KVKK, gizlilik ve üyelik sözleşmesi başlıkları ve hızlı geri dönüş buton linki.',
        'live_url' => url('/kvkk'),
    ],
];

$currentInfo = $tabMeta[$activeTab] ?? $tabMeta['home'];

/**
 * Otomatik Sayfa / Kategori Seçicili Akıllı Buton Linki Alanı
 */
function renderLinkPicker(string $name, string $value, string $label = 'Buton Hedef Linki', string $hint = ''): void {
    $predefined = [
        '' => '-- Otomatik Sayfa / Kategori Seçin --',
        '/tr' => '🏠 Ana Sayfa',
        '/tr/programs' => '🏋️ Programlar & Paketler',
        '/tr/detox' => '🌿 4 Haftalık Online Detoks Kampı',
        '/tr/programini-bul' => '🧭 Programını Bul (Test Sihirbazı)',
        '/tr/betina-tansug' => '🧘 Betina Tansuğ (Biyografi)',
        '/tr/betina-tansug#bar-system' => '🧬 Bar System Metodolojisi',
        '/tr/studio' => '🥗 Stüdyo & Mutfak Genel',
        '/tr/recipes' => '🍲 Mutfak (Fonksiyonel Tarifler)',
        '/tr/guides' => '📖 Yaşam & Beslenme Rehberleri',
        '/tr/plans' => '📋 Beslenme Planları',
        '/tr/events' => '📅 Canlı Etkinlikler & Buluşmalar',
        '/tr/news' => '📢 Haberler & Duyurular',
        '/tr/corporate' => '🏢 Kurumsal Wellness & Ergonomi',
        '/tr#footer' => '📞 İletişim & Randevu Bölümü',
        'https://wa.me/905357056828' => '💬 WhatsApp Danışma Hattı',
        'https://instagram.com/fizyobar' => '📷 Instagram Hesabı',
        'https://youtube.com/@fizyobar' => '▶️ YouTube Kanalı',
        'https://linkedin.com/company/fizyobar' => '💼 LinkedIn',
        '/tr/kvkk' => '⚖️ KVKK Aydınlatma Metni',
        '/tr/privacy' => '🔒 Gizlilik Politikası',
        '/tr/terms' => '📜 Kullanım Şartları & Sözleşme',
        '/tr/refund' => '↩️ İptal & İade Koşulları',
        '/tr/cookies' => '🍪 Çerez Politikası'
    ];
    ?>
    <div class="xp-form-group">
        <label class="xp-form-label"><?= e($label) ?></label>
        <div class="xp-link-picker-wrap">
            <select class="xp-link-quick-select" onchange="const inp = this.parentElement.querySelector('input'); if(this.value){ inp.value = this.value; }">
                <?php foreach ($predefined as $url => $text): ?>
                    <option value="<?= e($url) ?>" <?= $value === $url ? 'selected' : '' ?>><?= e($text) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="<?= e($name) ?>" class="xp-form-input" style="flex: 2; min-width: 220px;" value="<?= e($value) ?>" placeholder="Örn: /tr/programs">
        </div>
        <div class="xp-input-hint"><?= !empty($hint) ? e($hint) : 'Listeden hazır sayfa seçerek otomatik yönlendirebilir veya özel URL yazabilirsiniz.' ?></div>
    </div>
    <?php
}

/**
 * Canlı Önizlemeli, Manuel Dosya Yüklemeli ve Hazır Sistem Görselleri Seçicili Medya Alanı
 */
function renderImagePicker(string $name, string $value, string $label = 'Görsel / Medya Alanı', string $hint = ''): void {
    $predefinedImages = [
        '' => '-- Hazır Sistem Görseli / Medyası Seçin --',
        '/assets/images/hero-poster.jpg' => '🖼️ Hero Video Posteri (hero-poster.jpg)',
        '/assets/videos/hero.mp4' => '🎬 Hero Arka Plan Videosu (hero.mp4)',
        '/assets/images/betina-outdoor-inversion.jpg' => '🧘 Betina Outdoor Yoga Pozu (inversion.jpg)',
        '/assets/images/betina-studio-forward-fold.jpg' => '🧘 Betina Stüdyo Pozu (forward-fold.jpg)',
        '/assets/images/betina-outdoor-stretch.jpg' => '🧘 Betina Açık Hava Esneme (stretch.jpg)',
        '/assets/images/betina-user-photo1.jpg' => '👤 Betina Portre 1 (user-photo1.jpg)',
        '/assets/images/betina-user-photo2.jpg' => '👤 Betina Portre 2 (user-photo2.jpg)',
        '/assets/images/kitchen-hero-plate.png' => '🥗 Bar Kitchen Sağlıklı Tabak (kitchen-plate.png)',
        '/assets/images/trans-1-before.webp' => '💪 Dönüşüm 1 Öncesi (trans-1-before.webp)',
        '/assets/images/trans-1-after.webp' => '💪 Dönüşüm 1 Sonrası (trans-1-after.webp)',
        '/assets/images/trans-2-before.webp' => '💪 Dönüşüm 2 Öncesi (trans-2-before.webp)',
        '/assets/images/trans-2-after.webp' => '💪 Dönüşüm 2 Sonrası (trans-2-after.webp)',
        '/assets/images/trans-3-before.webp' => '💪 Dönüşüm 3 Öncesi (trans-3-before.webp)',
        '/assets/images/trans-3-after.webp' => '💪 Dönüşüm 3 Sonrası (trans-3-after.webp)',
        '/assets/images/transformation-before-hq.webp' => '✨ HQ Dönüşüm Öncesi',
        '/assets/images/transformation-after-hq.webp' => '✨ HQ Dönüşüm Sonrası',
        '/assets/images/logo.png' => '🏷️ Fizyobar Logo Siyah (logo.png)',
        '/assets/images/logo-white.png' => '🏷️ Fizyobar Logo Beyaz (logo-white.png)',
        '/assets/images/fizyobar-logo.jpg' => '🏷️ Fizyobar Kare Logo (fizyobar-logo.jpg)',
        '/assets/images/floral-wallpaper-cream.jpg' => '🌿 Doğal Floral Doku (cream.jpg)'
    ];

    preg_match('/\[([^\]]+)\]/', $name, $matches);
    $fieldKey = $matches[1] ?? preg_replace('/[^a-zA-Z0-9_]/', '', $name);
    $pickerId = 'picker_' . $fieldKey;

    $previewUrl = !empty($value) ? (str_starts_with($value, 'http') ? $value : url($value)) : '';
    $isVideo = str_ends_with(strtolower($value), '.mp4');
    $hasImage = !empty($value);
    ?>
    <div class="xp-image-picker-box" id="<?= e($pickerId) ?>" data-field-key="<?= e($fieldKey) ?>">
        <div class="xp-image-picker-header">
            <span class="xp-image-picker-title">
                <span>🖼️</span> <?= e($label) ?>
            </span>
            <span class="xp-image-picker-status <?= $hasImage ? 'active' : '' ?>">
                <?= $hasImage ? '✓ Görsel Tanımlı' : '⚪ Görsel Seçilmedi' ?>
            </span>
        </div>

        <div class="xp-image-picker-card">
            <!-- Sol: Büyük Net Canlı Önizleme Alanı -->
            <div class="xp-preview-container">
                <img src="<?= e($previewUrl) ?>" class="xp-preview-img" alt="Önizleme" style="<?= ($hasImage && !$isVideo) ? '' : 'display: none;' ?>" onerror="this.style.display='none'; this.parentElement.querySelector('.xp-preview-empty').style.display='flex';">
                
                <?php if ($isVideo): ?>
                    <video src="<?= e($previewUrl) ?>" class="xp-preview-video" muted loop autoplay playsinline></video>
                <?php endif; ?>

                <div class="xp-preview-empty" style="<?= $hasImage ? 'display: none;' : 'display: flex;' ?>">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span>Görsel Yüklenmedi<br><strong style="font-size:0.7rem; color:#64748b;">(Önizleme Yok)</strong></span>
                </div>

                <!-- AJAX Yükleme Durum Katmanı -->
                <div class="xp-upload-spinner" style="display: none;">
                    <div class="xp-spinner-circle"></div>
                    <span>Yükleniyor...</span>
                </div>
            </div>

            <!-- Sağ: Manuel Yükleme, Kütüphane ve URL Kontrolleri -->
            <div class="xp-picker-controls">
                <!-- 1. Bilgisayardan Manuel Dosya Seçme / Yükleme Satırı -->
                <div class="xp-picker-upload-row">
                    <label class="xp-upload-file-btn">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        <span>📁 Bilgisayardan Görsel Seç &amp; Yükle</span>
                        <input type="file" accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml,video/mp4" class="xp-file-input" style="display: none;" onchange="handleImageFileSelect(this, '<?= e($pickerId) ?>')">
                    </label>

                    <button type="button" class="xp-btn-remove-img" onclick="handleClearImage('<?= e($pickerId) ?>')" title="Görseli kaldır" style="<?= $hasImage ? 'display: inline-flex;' : 'display: none;' ?>">
                        ✕ Kaldır
                    </button>

                    <span class="xp-upload-status-msg" style="display: none;"></span>
                </div>

                <!-- 2. Hazır Sistem Görselleri Kütüphanesi -->
                <div>
                    <select class="xp-link-quick-select" style="max-width: 100%;" onchange="handleSelectPredefined(this, '<?= e($pickerId) ?>')">
                        <?php foreach ($predefinedImages as $path => $title): ?>
                            <option value="<?= e($path) ?>" <?= $value === $path ? 'selected' : '' ?>><?= e($title) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- 3. Değer Inputu (URL / Dosya Yolu) -->
                <div>
                    <input type="text" name="<?= e($name) ?>" class="xp-form-input xp-image-val-input" value="<?= e($value) ?>" placeholder="/assets/images/ornek.jpg veya https://..." oninput="handleUrlInputChange(this, '<?= e($pickerId) ?>')">
                </div>

                <!-- Form gönderiminde yedek multipart input -->
                <input type="file" name="upload_files[<?= e($fieldKey) ?>]" class="xp-fallback-file-input" style="display: none;">
            </div>
        </div>

        <div class="xp-input-hint">
            <?= !empty($hint) ? e($hint) : 'Bilgisayarınızdan manuel görsel yükleyebilir, kütüphaneden seçebilir veya dosya yolu/URL girebilirsiniz. Yüklenen görsel anında önizlenir.' ?>
        </div>
    </div>
    <?php
}
?>

<!-- Üst Kapsül Navigasyon Sekmeleri (OripioFin Dashboard Stili) -->
<div class="xp-pills-nav" style="margin-bottom: 1.25rem;">
    <?php foreach ($tabMeta as $key => $meta): ?>
        <a href="<?= url('/xpanel/pages?tab=' . $key) ?>" class="xp-pill-item <?= $activeTab === $key ? 'active' : '' ?>">
            <span><?= $meta['icon'] ?></span>
            <span><?= e($meta['name']) ?></span>
        </a>
    <?php endforeach; ?>
</div>

<!-- EN YUKARIYA SABİTLENMİŞ (STICKY) KAYDETME VE BAŞLIK BARI -->
<div class="xp-top-sticky-bar">
    <div style="display: flex; align-items: center; gap: 0.65rem;">
        <span style="font-size: 1.45rem; line-height: 1;"><?= $currentInfo['icon'] ?></span>
        <div>
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <h1 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0; text-transform: uppercase; letter-spacing: 0.04em;">
                    <?= e($currentInfo['name']) ?>
                </h1>
                <span class="xp-badge-live">● Canlıda Aktif</span>
            </div>
            <span style="font-size: 0.78rem; color: #64748b; margin-top: 2px; display: block;">
                <?= e($currentInfo['desc']) ?>
            </span>
        </div>
    </div>

    <div style="display: flex; gap: 0.75rem; align-items: center;">
        <a href="<?= e($currentInfo['live_url']) ?>" target="_blank" class="xp-btn-pill-outline" style="font-size: 0.84rem; padding: 0.55rem 1.15rem;" title="Canlı sayfayı yeni sekmede aç">
            <span>Ön Yüzde Canlı Gör</span>
            <span>↗</span>
        </a>

        <button type="submit" form="pageEditForm" class="xp-btn-save-primary">
            <span>💾</span>
            <span>DEĞİŞİKLİKLERİ KAYDET</span>
        </button>
    </div>
</div>

<form id="pageEditForm" action="<?= url('/xpanel/pages/save') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
    <?= csrf_field() ?>
    <input type="hidden" name="page_key" value="<?= e($activeTab) ?>">

    <!-- =========================================================================
         1. TAB: HEADER, LOGO & DUYURU BANDI
         ========================================================================= -->
    <?php if ($activeTab === 'header_nav'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • ÜST DUYURU BANDI</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">En Üst Duyuru &amp; Kicker Şeridi</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Sitenin en tepesindeki bordo renkli ince duyuru ve kamp bildirim şeridi.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Duyuru / Slogan Metni</label>
                <input type="text" name="data[top_announcement_text]" class="xp-form-input" value="<?= e($data['top_announcement_text'] ?? 'WELLNESS EXPERIENCES BY BETINA TANSUĞ • 4 HAFTALIK DETOX & YOGA KAMPI YENİ DÖNEMİ BAŞLIYOR') ?>" required>
                <div class="xp-input-hint">Sayfanın en üstünde akan bildirim cümlesi.</div>
            </div>

            <div class="xp-form-grid">
                <div class="xp-form-group">
                    <label class="xp-form-label">Aksiyon Buton Yazısı</label>
                    <input type="text" name="data[top_announcement_action]" class="xp-form-input" value="<?= e($data['top_announcement_action'] ?? 'HEMEN KATIL →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[top_announcement_link]', (string)($data['top_announcement_link'] ?? '/tr/detox'), 'Aksiyon Buton Hedef Linki'); ?>
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 2 • LOGO GÖRSELLERİ &amp; MARKA TİPOGRAFİSİ</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Logo Dosyaları ve Tipografik Metinler</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Hem görsel logo hem de tipografik metin logo alanları.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div>
                    <?php renderImagePicker('data[header_logo_image]', (string)($data['header_logo_image'] ?? '/assets/images/logo.png'), 'Koyu Tema / Standart Logo Görseli'); ?>
                </div>
                <div>
                    <?php renderImagePicker('data[header_logo_white]', (string)($data['header_logo_white'] ?? '/assets/images/logo-white.png'), 'Beyaz / Şeffaf Header Logo Görseli'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Ana Marka Adı (Tipografik Metin)</label>
                    <input type="text" name="data[logo_main]" class="xp-form-input" value="<?= e($data['logo_main'] ?? 'FİZYOBAR') ?>" required>
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Alt Tipografik Slogan</label>
                    <input type="text" name="data[logo_sub]" class="xp-form-input" value="<?= e($data['logo_sub'] ?? 'BODY • ADAPT • REFRAME') ?>" required>
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 3 • NAVİGASYON &amp; AKSİYON BUTONU</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Sağ Üst Menü Butonu &amp; Yönlendirmesi</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Menünün en sağında yer alan bordo renkli oval çağrı butonu.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div class="xp-form-group">
                    <label class="xp-form-label">Menü Buton Metni</label>
                    <input type="text" name="data[nav_btn_text]" class="xp-form-input" value="<?= e($data['nav_btn_text'] ?? 'KAMPA KATIL') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[nav_btn_link]', (string)($data['nav_btn_link'] ?? '/tr/detox'), 'Menü Buton Hedef Linki'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         2. TAB: ANA SAYFA (HOME)
         ========================================================================= -->
    <?php elseif ($activeTab === 'home'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • HERO VİDEO &amp; KARŞILAMA VİTRİNİ</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Hero Arka Plan Videosu, Görseli ve Butonları</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Ziyaretçiyi karşılayan ana video/görsel medyası ve aksiyon butonları.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div>
                    <?php renderImagePicker('data[hero_media_url]', (string)($data['hero_media_url'] ?? '/assets/videos/hero.mp4'), 'Hero Arka Plan Videosu / Görseli', 'Video için .mp4 yolu veya statik arka plan görsel yolu'); ?>
                </div>
                <div>
                    <?php renderImagePicker('data[hero_poster_url]', (string)($data['hero_poster_url'] ?? '/assets/images/hero-poster.jpg'), 'Hero Video Kapak Görseli (Poster)', 'Video yüklenirken veya mobil cihazlarda gösterilen kapak resmi'); ?>
                </div>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Üst Kicker / Tanıtım Başlığı</label>
                <input type="text" name="data[hero_kicker]" class="xp-form-input" value="<?= e($data['hero_kicker'] ?? 'WELLNESS EXPERIENCES BY BETINA TANSUĞ') ?>" required>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Ana Büyük Başlık</label>
                <input type="text" name="data[hero_title]" class="xp-form-input" value="<?= e($data['hero_title'] ?? 'BEDENİNİZİ YENİDEN HİZALAYIN') ?>" required>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Spot Açıklama Metni</label>
                <textarea name="data[hero_subtitle]" rows="3" class="xp-form-textarea"><?= e($data['hero_subtitle'] ?? 'Klinik fizyoterapi ve fonksiyonel yoga disipliniyle omurga sağlığı, derin mobilite ve uzun ömürlü hareket özgürlüğü.') ?></textarea>
            </div>

            <div class="xp-form-grid">
                <div class="xp-form-group">
                    <label class="xp-form-label">1. Ana Buton Metni</label>
                    <input type="text" name="data[btn_primary_text]" class="xp-form-input" value="<?= e($data['btn_primary_text'] ?? 'PROGRAMINI BUL & BAŞLA') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[btn_primary_link]', (string)($data['btn_primary_link'] ?? '/tr/programini-bul'), '1. Ana Buton Hedef Linki'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 0.5rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">2. İkincil Buton Metni (Opsiyonel)</label>
                    <input type="text" name="data[btn_secondary_text]" class="xp-form-input" value="<?= e($data['btn_secondary_text'] ?? 'BAR SYSTEM\'İ KEŞFET') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[btn_secondary_link]', (string)($data['btn_secondary_link'] ?? '/tr/betina-tansug#bar-system'), '2. İkincil Buton Hedef Linki'); ?>
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 2 • BAR SYSTEM'İ KEŞFET</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Bar System 3 Temel Sütun Kartı &amp; Butonu</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Ana sayfada 5 ikonun altındaki 3 kartlık patentli metodoloji alanı.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Bölüm Ana Başlığı</label>
                <input type="text" name="data[bar_system_title]" class="xp-form-input" value="<?= e($data['bar_system_title'] ?? 'BAR SYSTEM\'İ KEŞFET') ?>" required>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Bölüm Alt Açıklaması</label>
                <textarea name="data[bar_system_desc]" rows="2" class="xp-form-textarea"><?= e($data['bar_system_desc'] ?? 'Fizyoterapi temelli hareket bilimi ve yoga disiplinini birleştiren, omurga sağlığını ve longevity odaklı kalıcı bir yaşam disiplinini koruyan patentli metodumuz.') ?></textarea>
            </div>

            <div class="xp-form-grid-3" style="margin-top: 1rem;">
                <!-- Kart 1 -->
                <div style="background: #fafbfc; border: 1px solid #eef2f6; border-radius: 14px; padding: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--xp-primary); margin-bottom: 0.5rem;">KART 01</div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Başlık</label>
                        <input type="text" name="data[card1_title]" class="xp-form-input" value="<?= e($data['card1_title'] ?? 'Biyomekanik Denge') ?>">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Açıklama</label>
                        <textarea name="data[card1_desc]" rows="3" class="xp-form-textarea"><?= e($data['card1_desc'] ?? 'Klinik anatomi ve eklem mobilitesini koruyarak omurgayı anatomik ekseninde yeniden hizalayan, sakatlık riskini sıfırlayan akışlar.') ?></textarea>
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Alt Etiket (Tag)</label>
                        <input type="text" name="data[card1_tag]" class="xp-form-input" value="<?= e($data['card1_tag'] ?? 'KLİNİK ANATOMİ') ?>">
                    </div>
                </div>

                <!-- Kart 2 -->
                <div style="background: #fafbfc; border: 1px solid #eef2f6; border-radius: 14px; padding: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--xp-primary); margin-bottom: 0.5rem;">KART 02</div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Başlık</label>
                        <input type="text" name="data[card2_title]" class="xp-form-input" value="<?= e($data['card2_title'] ?? 'Nöro-Biyolojik Regülasyon') ?>">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Açıklama</label>
                        <textarea name="data[card2_desc]" rows="3" class="xp-form-textarea"><?= e($data['card2_desc'] ?? 'Diyafram nefesi ve vagus sinir uyarımı ile stres hormonlarını dengeleyen, sempatik alarm halini dindiren sinir sistemi onarımı.') ?></textarea>
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Alt Etiket (Tag)</label>
                        <input type="text" name="data[card2_tag]" class="xp-form-input" value="<?= e($data['card2_tag'] ?? 'VAGUS & SİNİR SİSTEMİ') ?>">
                    </div>
                </div>

                <!-- Kart 3 -->
                <div style="background: #fafbfc; border: 1px solid #eef2f6; border-radius: 14px; padding: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--xp-primary); margin-bottom: 0.5rem;">KART 03</div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Başlık</label>
                        <input type="text" name="data[card3_title]" class="xp-form-input" value="<?= e($data['card3_title'] ?? 'Sürdürülebilir Longevity') ?>">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Açıklama</label>
                        <textarea name="data[card3_desc]" rows="3" class="xp-form-textarea"><?= e($data['card3_desc'] ?? 'Hücresel canlılığı, mitokondriyal kapasiteyi ve fonksiyonel esnekliği destekleyen, ömür boyu kalıcı sağlıklı yaşam disiplini.') ?></textarea>
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Alt Etiket (Tag)</label>
                        <input type="text" name="data[card3_tag]" class="xp-form-input" value="<?= e($data['card3_tag'] ?? 'HÜCRESEL SAĞLIK') ?>">
                    </div>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 1.25rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Bölüm Alt Buton Metni</label>
                    <input type="text" name="data[bar_btn_text]" class="xp-form-input" value="<?= e($data['bar_btn_text'] ?? 'BAR SYSTEM\'İ KEŞFET →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[bar_btn_link]', (string)($data['bar_btn_link'] ?? '/tr/betina-tansug#bar-system'), 'Buton Hedef Linki'); ?>
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 3 • DOLULUK &amp; 500+ YOGİ BARI</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Kontenjan İlerleme Çubuğu &amp; Satış Butonu</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Paketlerin satışı için aciliyet hissi oluşturan doluluk yüzdesi ve butonu.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div class="xp-form-group">
                    <label class="xp-form-label">Sol Rozet Metni</label>
                    <input type="text" name="data[progress_badge]" class="xp-form-input" value="<?= e($data['progress_badge'] ?? 'CANLI DÖNEM KONTENJANI') ?>">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Kalan Koltuk / Kişi Metni</label>
                    <input type="text" name="data[progress_seats]" class="xp-form-input" value="<?= e($data['progress_seats'] ?? 'Son 8 Kişilik Kontenjan') ?>">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Doluluk Oranı Yüzdesi</label>
                    <input type="text" name="data[progress_percent]" class="xp-form-input" value="<?= e($data['progress_percent'] ?? '%87') ?>">
                </div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Doluluk Kapanış Uyarı Notu</label>
                <input type="text" name="data[progress_notice]" class="xp-form-input" value="<?= e($data['progress_notice'] ?? 'Kontenjan dolduğunda yeni kayıtlar bir sonraki döneme kadar kapanır.') ?>">
            </div>

            <div class="xp-form-grid">
                <div class="xp-form-group">
                    <label class="xp-form-label">Satış Butonu Metni</label>
                    <input type="text" name="data[progress_btn_text]" class="xp-form-input" value="<?= e($data['progress_btn_text'] ?? '500+ KALİSTHENİCS YOGİ ARASINA KATIL →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[progress_btn_link]', (string)($data['progress_btn_link'] ?? '/tr/programs'), 'Satış Butonu Hedef Linki'); ?>
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 4 • MEET YOUR GUIDE (BETİNA İLE TANIŞ)</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Eğitmen Görseli, Tanıtım Biyografisi &amp; Butonu</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Ana sayfanın altındaki kurucu eğitmen tanıtım bloğu.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div>
                    <?php renderImagePicker('data[meet_guide_image]', (string)($data['meet_guide_image'] ?? '/assets/images/betina-user-photo1.jpg'), 'Eğitmen Fotoğrafı / Portresi'); ?>
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Bölüm Başlığı</label>
                    <input type="text" name="data[meet_guide_title]" class="xp-form-input" value="<?= e($data['meet_guide_title'] ?? 'MEET YOUR GUIDE • BETINA TANSUĞ') ?>">
                    <div style="margin-top: 0.75rem;">
                        <label class="xp-form-label">Eğitmen Ünvanı</label>
                        <input type="text" name="data[meet_guide_subtitle]" class="xp-form-input" value="<?= e($data['meet_guide_subtitle'] ?? 'Klinik Fizyoterapist, Fonksiyonel Yoga Eğitmeni & BAR System Kurucusu') ?>">
                    </div>
                </div>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Tanıtım Biyografisi</label>
                <textarea name="data[meet_guide_bio]" rows="3" class="xp-form-textarea"><?= e($data['meet_guide_bio'] ?? '10 yılı aşkın klinik tecrübesiyle binlerce danışanına ağrısız hareket özgürlüğü ve hücresel zindelik kazandıran Betina Tansuğ rehberliğinde bedeninize saygı duymayı öğrenin.') ?></textarea>
            </div>

            <div class="xp-form-grid">
                <div class="xp-form-group">
                    <label class="xp-form-label">Buton Metni</label>
                    <input type="text" name="data[meet_guide_btn]" class="xp-form-input" value="<?= e($data['meet_guide_btn'] ?? 'BETİNA TANSUĞ İLE TANIŞ →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[meet_guide_link]', (string)($data['meet_guide_link'] ?? '/tr/betina-tansug'), 'Buton Hedef Linki'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         3. TAB: PROGRAMLAR & PAKETLER
         ========================================================================= -->
    <?php elseif ($activeTab === 'programs'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • SAYFA VİTRİNİ &amp; BANNER</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Eğitim &amp; Dönüşüm Paketleri Vitrini</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Programlar sayfasının en üstündeki başlık, banner görseli ve butonlar.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[programs_hero_image]', (string)($data['programs_hero_image'] ?? '/assets/images/betina-outdoor-stretch.jpg'), 'Programlar Üst Banner / Kapak Görseli'); ?>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Üst Kicker Metni</label>
                <input type="text" name="data[page_kicker]" class="xp-form-input" value="<?= e($data['page_kicker'] ?? 'KLİNİK FİZYOTERAPİ • KALİSTHENİCS YOGA') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Ana Büyük Başlık</label>
                <input type="text" name="data[page_title]" class="xp-form-input" value="<?= e($data['page_title'] ?? 'EĞİTİM & DÖNÜŞÜM PAKETLERİ') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Alt Açıklama Metni</label>
                <textarea name="data[page_subtitle]" rows="2" class="xp-form-textarea"><?= e($data['page_subtitle'] ?? 'Fizyoterapist Betina Tansuğ metodolojisiyle bedeninize kalıcı fonksiyon, anatomik güç ve estetik denge kazandıran 28 günlük bilimsel programlar:') ?></textarea>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Kontenjan Buton Metni</label>
                    <input type="text" name="data[capacity_btn_text]" class="xp-form-input" value="<?= e($data['capacity_btn_text'] ?? '500+ KALİSTHENİCS YOGİ ARASINA KATIL →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[capacity_btn_link]', (string)($data['capacity_btn_link'] ?? '/tr/programs#packages'), 'Kontenjan Butonu Hedef Linki'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 0.5rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Canlı Kamp Sayfası Buton Metni</label>
                    <input type="text" name="data[camp_shortcut_text]" class="xp-form-input" value="<?= e($data['camp_shortcut_text'] ?? '4 Haftalık Online Detox & Yoga Kampı Sayfası →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[camp_shortcut_link]', (string)($data['camp_shortcut_link'] ?? '/tr/detox'), 'Kamp Sayfası Buton Linki'); ?>
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 2 • PAKET STANDART İÇERİKLERİ</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Paketlerin Altında Gösterilen 3 Standart İçerik</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Kullanıcının talep ettiği: +12 antrenman, +28 gün, %100 ekipmansız maddeleri.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid-3">
                <div class="xp-form-group">
                    <label class="xp-form-label">1. Madde (Antrenman)</label>
                    <input type="text" name="data[feature_workouts]" class="xp-form-input" value="<?= e($data['feature_workouts'] ?? '+12 Antrenman (Adım Adım Video Rehberli)') ?>">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">2. Madde (Süre)</label>
                    <input type="text" name="data[feature_duration]" class="xp-form-input" value="<?= e($data['feature_duration'] ?? '+28 Günlük Program Takibi') ?>">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">3. Madde (Ekipman)</label>
                    <input type="text" name="data[feature_equipment]" class="xp-form-input" value="<?= e($data['feature_equipment'] ?? '%100 Ekipmansız Evde Uygulanabilir') ?>">
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 3 • ÜYELİK MODELİ (AYLIK &amp; YILLIK)</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Üyelik Planı Bilgilendirme Kartları &amp; Butonları</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Aylık pakette yalnızca kendi eğitimi ve kitchen; yıllık planda her şey açık.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div style="background: #fafbfc; border: 1px solid #eef2f6; border-radius: 14px; padding: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--xp-primary); margin-bottom: 0.5rem;">AYLIK ÜYELİK PLANI</div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Başlık</label>
                        <input type="text" name="data[membership_monthly_title]" class="xp-form-input" value="<?= e($data['membership_monthly_title'] ?? 'Aylık Üyelik Planı') ?>">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Açıklama &amp; Kapsam</label>
                        <textarea name="data[membership_monthly_desc]" rows="3" class="xp-form-textarea"><?= e($data['membership_monthly_desc'] ?? 'Seçtiğiniz antrenman paketine ve Bar Kitchen içeriklerine sınırsız erişim hakkı sağlar.') ?></textarea>
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Buton Metni</label>
                        <input type="text" name="data[membership_monthly_btn]" class="xp-form-input" value="<?= e($data['membership_monthly_btn'] ?? 'Aylık Plana Katıl') ?>">
                    </div>
                    <div>
                        <?php renderLinkPicker('data[membership_monthly_link]', (string)($data['membership_monthly_link'] ?? '/tr/programs#monthly'), 'Aylık Plan Buton Linki'); ?>
                    </div>
                </div>

                <div style="background: #fafbfc; border: 1px solid #eef2f6; border-radius: 14px; padding: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--xp-primary); margin-bottom: 0.5rem;">YILLIK PREMİUM VIP PLANI</div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Başlık</label>
                        <input type="text" name="data[membership_yearly_title]" class="xp-form-input" value="<?= e($data['membership_yearly_title'] ?? 'Yıllık Premium VIP Üyelik Planı') ?>">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Açıklama &amp; Kapsam</label>
                        <textarea name="data[membership_yearly_desc]" rows="3" class="xp-form-textarea"><?= e($data['membership_yearly_desc'] ?? 'Tüm antrenman serilerine, Bar Kitchen beslenme rehberlerine, mikro rutinlere ve kapalı üye etkinliklerine tam erişim.') ?></textarea>
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Buton Metni</label>
                        <input type="text" name="data[membership_yearly_btn]" class="xp-form-input" value="<?= e($data['membership_yearly_btn'] ?? 'Yıllık VIP Plana Katıl') ?>">
                    </div>
                    <div>
                        <?php renderLinkPicker('data[membership_yearly_link]', (string)($data['membership_yearly_link'] ?? '/tr/programs#yearly'), 'Yıllık Plan Buton Linki'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 4 • BEFORE / AFTER DÖNÜŞÜM GÖRSELLERİ</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Güç &amp; İncelme Dönüşüm Fotoğrafları</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Öğrencilerin 28 günlük öncesi / sonrası karşılaştırma görselleri.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div>
                    <?php renderImagePicker('data[transform_img1_before]', (string)($data['transform_img1_before'] ?? '/assets/images/trans-1-before.webp'), '1. Dönüşüm (Öncesi / Before)'); ?>
                </div>
                <div>
                    <?php renderImagePicker('data[transform_img1_after]', (string)($data['transform_img1_after'] ?? '/assets/images/trans-1-after.webp'), '1. Dönüşüm (Sonrası / After)'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div>
                    <?php renderImagePicker('data[transform_img2_before]', (string)($data['transform_img2_before'] ?? '/assets/images/trans-2-before.webp'), '2. Dönüşüm (Öncesi / Before)'); ?>
                </div>
                <div>
                    <?php renderImagePicker('data[transform_img2_after]', (string)($data['transform_img2_after'] ?? '/assets/images/trans-2-after.webp'), '2. Dönüşüm (Sonrası / After)'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">1. Kategori Başlığı</label>
                    <input type="text" name="data[transform_tab1_title]" class="xp-form-input" value="<?= e($data['transform_tab1_title'] ?? 'Güç Dönüşümleri') ?>">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">2. Kategori Başlığı</label>
                    <input type="text" name="data[transform_tab2_title]" class="xp-form-input" value="<?= e($data['transform_tab2_title'] ?? 'İncelme & Postür Dönüşümleri') ?>">
                </div>
            </div>
        </div>

    <!-- =========================================================================
         4. TAB: BETINA TANSUĞ (BİYOGRAFİ & BAR SYSTEM)
         ========================================================================= -->
    <?php elseif ($activeTab === 'betina'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • VİTRİN 3 BÜYÜK FOTOĞRAFI</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Sayfa Üst Vitrin Fotoğrafları</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Betina Tansuğ sayfasındaki büyük vitrin fotoğrafları.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid-3">
                <div>
                    <?php renderImagePicker('data[betina_hero_image1]', (string)($data['betina_hero_image1'] ?? '/assets/images/betina-studio-forward-fold.jpg'), '1. Sol Vitrin Fotoğrafı (Siyah-Beyaz)'); ?>
                </div>
                <div>
                    <?php renderImagePicker('data[betina_hero_image2]', (string)($data['betina_hero_image2'] ?? '/assets/images/betina-outdoor-inversion.jpg'), '2. Orta Vitrin Fotoğrafı (Palmiye/Yoga)'); ?>
                </div>
                <div>
                    <?php renderImagePicker('data[betina_profile_image]', (string)($data['betina_profile_image'] ?? '/assets/images/betina-user-photo2.jpg'), '3. Eğitmen Portresi / Yakın Plan'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Ana İsim Başlığı</label>
                    <input type="text" name="data[hero_title]" class="xp-form-input" value="<?= e($data['hero_title'] ?? 'BETİNA TANSUĞ©') ?>">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Slogan Şeridi</label>
                    <input type="text" name="data[hero_kicker]" class="xp-form-input" value="<?= e($data['hero_kicker'] ?? 'HAREKETİN BİLİMSEL DÖNÜŞÜMÜ →') ?>">
                </div>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 2 • KLİNİK FİZYOTERAPİST KARTI</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Eğitmen Kimliği &amp; Yaşam Disiplini</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Görselin hemen sağında yer alan ilk biyografi kartı.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Kart Başlığı</label>
                <input type="text" name="data[card1_title]" class="xp-form-input" value="<?= e($data['card1_title'] ?? 'KLİNİK FİZYOTERAPİST - BAR SYSTEM KURUCUSU') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">1. Paragraf (Klinik &amp; Bilimsel Temel)</label>
                <textarea name="data[card1_p1]" rows="3" class="xp-form-textarea"><?= e($data['card1_p1'] ?? 'Fizyoterapist kimliğim sayesinde insan bedenini anatomik, biyomekanik ve fonksiyonel açıdan ele alıyor; yoga ve mobilite pratiğini kanıta dayalı bilimsel bir temele oturtuyorum.') ?></textarea>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">2. Paragraf (Yaşam Disiplini &amp; Omurga)</label>
                <textarea name="data[card1_p2]" rows="3" class="xp-form-textarea"><?= e($data['card1_p2'] ?? 'Hareketi dönemsel bir heves değil; omurga sağlığını, eklem mobilitesini ve otonom sinir sistemi dengesini koruyan, uzun ve ağrısız bir ömür için kalıcı bir yaşam disiplini haline getiriyoruz.') ?></textarea>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 3 • BAR SYSTEM METODOLOJİSİ &amp; BUTONU</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Bilimsel Temel &amp; Eğitim Programına Yönlendirme Butonu</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Bar System metodolojisinin altındaki yönlendirme butonu ve detaylı metinler.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Kart Başlığı</label>
                <input type="text" name="data[card2_title]" class="xp-form-input" value="<?= e($data['card2_title'] ?? 'BAR SYSTEM METODOLOJİSİ VE BİLİMSEL TEMELİ') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">1. Paragraf (Body. Adapt. Reframe Tanımı)</label>
                <textarea name="data[card2_p1]" rows="3" class="xp-form-textarea"><?= e($data['card2_p1'] ?? 'BAR System (Body. Adapt. Reframe): Klinik fizyoterapi ilkelerini, omurga biyomekaniğini ve yoga disiplinini bir araya getiren patentli bir hareket ve longevity metodolojisidir. Bedenin doğal anatomik eksenine saygı duyarak, sakatlık riskini sıfırlayan akışlarla kas-iskelet sistemini derinlemesine yeniden hizalar ve güçlendirir.') ?></textarea>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">2. Paragraf (Vagus Siniri &amp; Parasempatik Onarım)</label>
                <textarea name="data[card2_p2]" rows="3" class="xp-form-textarea"><?= e($data['card2_p2'] ?? 'Bu metodoloji yalnızca yüzeysel kasları çalıştırmayı değil; diyafram nefesi ve vagus siniri uyarımıyla otonom sinir sistemini parasempatik moda geçirmeyi hedefler. Böylece kronik sempatik stres alarmı dindirilir, kortizol seviyeleri dengelenir, omurga üzerindeki kompresyon baskısı kalkar ve hücresel mitokondriyal enerji kapasitesi desteklenir.') ?></textarea>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Aksiyon Buton Metni</label>
                    <input type="text" name="data[bar_system_detail_btn]" class="xp-form-input" value="<?= e($data['bar_system_detail_btn'] ?? 'EĞİTİM PROGRAMLARINI İNCELE →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[bar_system_detail_link]', (string)($data['bar_system_detail_link'] ?? '/tr/programs'), 'Buton Hedef Linki'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         5. TAB: 4 HAFTALIK ONLINE DETOX KAMPI
         ========================================================================= -->
    <?php elseif ($activeTab === 'detox'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • KAMP AFİŞ GÖRSELİ &amp; KARŞILAMA</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Detox &amp; Yoga Kampı Kapak Görseli ve Başlığı</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">4 haftalık online arınma ve yoga kampının ana görseli ve tanıtımı.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[camp_hero_image]', (string)($data['camp_hero_image'] ?? '/assets/images/betina-outdoor-stretch.jpg'), 'Kamp Kapak / Tanıtım Afiş Görseli'); ?>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Üst Slogan</label>
                <input type="text" name="data[camp_kicker]" class="xp-form-input" value="<?= e($data['camp_kicker'] ?? 'WELLNESS EXPERIENCES BY BETINA TANSUĞ') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Ana Kamp Başlığı</label>
                <input type="text" name="data[camp_title]" class="xp-form-input" value="<?= e($data['camp_title'] ?? '4 HAFTALIK ONLİNE DETOX & YOGA KAMPI') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Spot Açıklama</label>
                <textarea name="data[camp_subtitle]" rows="2" class="xp-form-textarea"><?= e($data['camp_subtitle'] ?? 'Birebir WhatsApp takipli, beslenme planlı ve canlı rehberlikli bütüncül arınma dönemi.') ?></textarea>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 2 • FORMAT, SÜRE &amp; BUTON LİNKLERİ</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Katılım Butonları &amp; WhatsApp Destek Hattı</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Süre, canlı format, kayıt linki ve doğrudan WhatsApp bağlantısı.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div class="xp-form-group">
                    <label class="xp-form-label">Kamp Süresi</label>
                    <input type="text" name="data[camp_duration]" class="xp-form-input" value="<?= e($data['camp_duration'] ?? '4 Hafta • 28 Gün') ?>">
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Katılım Ücreti Metni</label>
                    <input type="text" name="data[camp_price]" class="xp-form-input" value="<?= e($data['camp_price'] ?? '1.250 TL') ?>">
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">1. Kayıt Butonu Metni</label>
                    <input type="text" name="data[camp_cta_text]" class="xp-form-input" value="<?= e($data['camp_cta_text'] ?? 'KAMPA KAYIT OL & YERİNİ AYIRT') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[camp_cta_link]', (string)($data['camp_cta_link'] ?? '/tr/checkout/1'), '1. Kayıt Butonu Hedef Linki'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 0.5rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">2. WhatsApp Destek Buton Metni</label>
                    <input type="text" name="data[camp_wa_text]" class="xp-form-input" value="<?= e($data['camp_wa_text'] ?? 'WHATSAPP İLE BİLGİ AL') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[camp_wa_link]', (string)($data['camp_wa_link'] ?? 'https://wa.me/905357056828'), '2. WhatsApp Butonu Linki'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         6. TAB: STUDIO & BAR KITCHEN
         ========================================================================= -->
    <?php elseif ($activeTab === 'studio'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • STUDIO VİTRİN GÖRSELİ &amp; BAŞLIK</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Fizyobar Studio &amp; Bar Kitchen Görseli</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Beslenme, tarifler ve rehberler ana giriş görseli ve metinleri.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[studio_hero_image]', (string)($data['studio_hero_image'] ?? '/assets/images/kitchen-hero-plate.png'), 'Bar Kitchen Sağlıklı Tabak / Vitrin Görseli'); ?>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Ana Başlık</label>
                <input type="text" name="data[studio_title]" class="xp-form-input" value="<?= e($data['studio_title'] ?? 'FİZYOBAR STUDIO & BAR KITCHEN') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Alt Açıklama</label>
                <textarea name="data[studio_subtitle]" rows="2" class="xp-form-textarea"><?= e($data['studio_subtitle'] ?? 'Beslenme rehberleri, fonksiyonel tarifler, mitokondriyal sağlık ve mikro rutinler.') ?></textarea>
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 2 • İÇERİK KATEGORİ TANITIMLARI &amp; BUTONLARI</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Tarifler ve Rehberler Buton Yönlendirmeleri</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Ziyaretçiyi tariflere ve rehberlere yönlendiren buton linkleri.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid">
                <div style="background: #fafbfc; border: 1px solid #eef2f6; border-radius: 14px; padding: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--xp-primary); margin-bottom: 0.5rem;">TARİFLER (KITCHEN)</div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Başlık</label>
                        <input type="text" name="data[recipes_title]" class="xp-form-input" value="<?= e($data['recipes_title'] ?? 'Fonksiyonel Tarifler & Bar Kitchen') ?>">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Açıklama</label>
                        <textarea name="data[recipes_desc]" rows="2" class="xp-form-textarea"><?= e($data['recipes_desc'] ?? 'Rafine şekersiz, anti-inflamatuar ve GLP-1 tok tutucu Longevity tarifleri.') ?></textarea>
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Buton Metni</label>
                        <input type="text" name="data[recipes_btn_text]" class="xp-form-input" value="<?= e($data['recipes_btn_text'] ?? 'TARİFLERİ KEŞFET →') ?>">
                    </div>
                    <div>
                        <?php renderLinkPicker('data[recipes_btn_link]', (string)($data['recipes_btn_link'] ?? '/tr/recipes'), 'Tarifler Buton Hedef Linki'); ?>
                    </div>
                </div>

                <div style="background: #fafbfc; border: 1px solid #eef2f6; border-radius: 14px; padding: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 800; color: var(--xp-primary); margin-bottom: 0.5rem;">REHBERLER &amp; KILAVUZ</div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Başlık</label>
                        <input type="text" name="data[guides_title]" class="xp-form-input" value="<?= e($data['guides_title'] ?? 'Yaşam & Beslenme Rehberleri') ?>">
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Açıklama</label>
                        <textarea name="data[guides_desc]" rows="2" class="xp-form-textarea"><?= e($data['guides_desc'] ?? 'Sirkadiyen ritim, sirkadiyen uyku kalitesi ve hücresel yenilenme kılavuzları.') ?></textarea>
                    </div>
                    <div class="xp-form-group">
                        <label class="xp-form-label">Buton Metni</label>
                        <input type="text" name="data[guides_btn_text]" class="xp-form-input" value="<?= e($data['guides_btn_text'] ?? 'REHBERLERİ OKU →') ?>">
                    </div>
                    <div>
                        <?php renderLinkPicker('data[guides_btn_link]', (string)($data['guides_btn_link'] ?? '/tr/guides'), 'Rehberler Buton Hedef Linki'); ?>
                    </div>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         7. TAB: ETKİNLİKLER & HABERLER
         ========================================================================= -->
    <?php elseif ($activeTab === 'events'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • ETKİNLİK AFİŞİ &amp; REZERVASYON BUTONU</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Canlı Etkinlikler Afiş Görseli ve Butonları</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Fizyobar topluluk buluşmaları ve atölye afişi.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[events_hero_image]', (string)($data['events_hero_image'] ?? '/assets/images/betina-outdoor-inversion.jpg'), 'Etkinlikler Kapak Afiş Görseli'); ?>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Etkinlikler Ana Başlığı</label>
                <input type="text" name="data[events_title]" class="xp-form-input" value="<?= e($data['events_title'] ?? 'ETKİNLİKLER & BULUŞMALAR') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Açıklama Metni</label>
                <textarea name="data[events_subtitle]" rows="2" class="xp-form-textarea"><?= e($data['events_subtitle'] ?? 'Fizyobar topluluğuyla bir araya geldiğimiz yüz yüze atölyeler, kamplar ve canlı buluşmalar.') ?></textarea>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Rezervasyon / Katılım Buton Metni</label>
                    <input type="text" name="data[events_cta_text]" class="xp-form-input" value="<?= e($data['events_cta_text'] ?? 'BİLET AL / REZERVASYON YAP →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[events_cta_link]', (string)($data['events_cta_link'] ?? 'https://wa.me/905357056828'), 'Etkinlik Buton Hedef Linki'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         8. TAB: KURUMSAL & WELLNESS
         ========================================================================= -->
    <?php elseif ($activeTab === 'corporate'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • KURUMSAL BANNER GÖRSELİ &amp; TEKLİF BUTONU</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Şirketler İçin Ergonomi Görseli ve Teklif Butonu</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Kurumsal şirket çalışanlarına özel sağlık çözümleri vitrini.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[corporate_hero_image]', (string)($data['corporate_hero_image'] ?? '/assets/images/betina-studio-forward-fold.jpg'), 'Kurumsal Sayfa Banner Görseli'); ?>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Ana Başlık</label>
                <input type="text" name="data[corporate_title]" class="xp-form-input" value="<?= e($data['corporate_title'] ?? 'KURUMSAL WELLNESS & ERGONOMİ') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Spot Açıklama</label>
                <textarea name="data[corporate_subtitle]" rows="2" class="xp-form-textarea"><?= e($data['corporate_subtitle'] ?? 'Şirket çalışanlarınızın omurga sağlığını, odaklanma kapasitesini ve enerjisini artıran ergonomi ve hareket seansları.') ?></textarea>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Teklif İste Buton Metni</label>
                    <input type="text" name="data[corporate_form_btn]" class="xp-form-input" value="<?= e($data['corporate_form_btn'] ?? 'KURUMSAL TEKLİF İSTE →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[corporate_form_link]', (string)($data['corporate_form_link'] ?? '/tr/corporate#form'), 'Teklif Butonu Hedef Linki'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         9. TAB: PROGRAMINI BUL (QUIZ & ASİSTAN)
         ========================================================================= -->
    <?php elseif ($activeTab === 'find_program'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • QUIZ ARKA PLAN GÖRSELİ &amp; BUTONLARI</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Beden Analiz Sihirbazı Görseli ve Navigasyonu</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Programını Bul interaktif sihirbazının soru başlıkları ve butonları.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[quiz_bg_image]', (string)($data['quiz_bg_image'] ?? '/assets/images/hero-poster.jpg'), 'Quiz Karşılama Arka Plan Görseli'); ?>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Adım Sayacı Metni</label>
                <input type="text" name="data[quiz_step_counter]" class="xp-form-input" value="<?= e($data['quiz_step_counter'] ?? '1 of 4 • Öncelikli Beden Hedefiniz') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Ana Soru Başlığı</label>
                <input type="text" name="data[quiz_title]" class="xp-form-input" value="<?= e($data['quiz_title'] ?? 'Hangi hedefe odaklanmak istiyorsunuz?') ?>">
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">İleri Butonu Metni</label>
                    <input type="text" name="data[quiz_btn_next]" class="xp-form-input" value="<?= e($data['quiz_btn_next'] ?? 'DEVAM ET →') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[quiz_btn_next_link]', (string)($data['quiz_btn_next_link'] ?? '/tr/programini-bul?step=2'), 'İleri Butonu Link / Aksiyonu'); ?>
                </div>
            </div>

            <div class="xp-form-grid" style="margin-top: 0.5rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">Geri Butonu Metni</label>
                    <input type="text" name="data[quiz_btn_back]" class="xp-form-input" value="<?= e($data['quiz_btn_back'] ?? '← GERİ DÖN') ?>">
                </div>
                <div>
                    <?php renderLinkPicker('data[quiz_btn_back_link]', (string)($data['quiz_btn_back_link'] ?? '/tr'), 'Geri Dönüş Hedef Linki'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         10. TAB: İLETİŞİM, FOOTER & SOSYAL MEDYA
         ========================================================================= -->
    <?php elseif ($activeTab === 'footer_contact'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • HIZLI İLETİŞİM, WHATSAPP &amp; ARKA PLAN DOKUSU</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">İletişim Kanalları ve Footer Arka Plan Görseli</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Sitenin her yerinde ve footerda kullanılan iletişim bilgileri.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[footer_bg_image]', (string)($data['footer_bg_image'] ?? '/assets/images/floral-wallpaper-cream.jpg'), 'Footer Arka Plan Dokusu / Deseni'); ?>
            </div>

            <div class="xp-form-grid" style="margin-top: 1rem;">
                <div class="xp-form-group">
                    <label class="xp-form-label">WhatsApp İletişim Numarası</label>
                    <input type="text" name="data[contact_whatsapp]" class="xp-form-input" value="<?= e($data['contact_whatsapp'] ?? '+90 535 705 68 28') ?>" required>
                </div>
                <div>
                    <?php renderLinkPicker('data[contact_whatsapp_link]', (string)($data['contact_whatsapp_link'] ?? 'https://wa.me/905357056828'), 'WhatsApp Doğrudan Chat Linki'); ?>
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Resmi E-posta Adresi</label>
                    <input type="email" name="data[contact_email]" class="xp-form-input" value="<?= e($data['contact_email'] ?? 'betinabaram@gmail.com') ?>" required>
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label">Telefon Numarası</label>
                    <input type="text" name="data[contact_phone]" class="xp-form-input" value="<?= e($data['contact_phone'] ?? '0535 705 68 28') ?>">
                </div>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">Fiziki Stüdyo &amp; Klinik Adresi</label>
                <input type="text" name="data[contact_address]" class="xp-form-input" value="<?= e($data['contact_address'] ?? 'Yenibaraj Mah. Gülek Plaza, Seyhan / Adana') ?>">
            </div>
        </div>

        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 2 • SOSYAL MEDYA KANAL LİNKLERİ</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Sosyal Medya Profil Bağlantıları</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Footer ve sayfalardaki sosyal medya bağlantı adresleri.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div class="xp-form-grid-3">
                <div>
                    <?php renderLinkPicker('data[social_instagram]', (string)($data['social_instagram'] ?? 'https://instagram.com/fizyobar'), 'Instagram Profili'); ?>
                </div>
                <div>
                    <?php renderLinkPicker('data[social_youtube]', (string)($data['social_youtube'] ?? 'https://youtube.com/@fizyobar'), 'YouTube Kanalı'); ?>
                </div>
                <div>
                    <?php renderLinkPicker('data[social_linkedin]', (string)($data['social_linkedin'] ?? 'https://linkedin.com/company/fizyobar'), 'LinkedIn Profili'); ?>
                </div>
            </div>
        </div>

    <!-- =========================================================================
         11. TAB: YASAL & KVKK METİNLERİ
         ========================================================================= -->
    <?php elseif ($activeTab === 'legal'): ?>
        <div class="xp-editor-card">
            <div class="xp-editor-card-header">
                <div>
                    <span class="xp-badge-section">BÖLÜM 1 • YASAL METİNLER, BANNER &amp; GERİ DÖNÜŞ BUTONU</span>
                    <h2 style="font-size: 1.1rem; font-weight: 700; color: var(--xp-text); margin: 0 0 0.2rem 0;">Yasal Politika Başlıkları ve Görseli</h2>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">KVKK, gizlilik ve üyelik şartları başlıkları.</span>
                </div>
                <span class="xp-badge-live">● Sitede Canlı</span>
            </div>

            <div>
                <?php renderImagePicker('data[legal_banner_image]', (string)($data['legal_banner_image'] ?? '/assets/images/hero-poster.jpg'), 'Yasal Sayfalar Üst Banner Görseli'); ?>
            </div>

            <div class="xp-form-group" style="margin-top: 1rem;">
                <label class="xp-form-label">KVKK Aydınlatma Metni Başlığı</label>
                <input type="text" name="data[kvkk_title]" class="xp-form-input" value="<?= e($data['kvkk_title'] ?? 'Kişisel Verilerin Korunması (KVKK) Aydınlatma Metni') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Gizlilik ve Güvenlik Politikası Başlığı</label>
                <input type="text" name="data[privacy_title]" class="xp-form-input" value="<?= e($data['privacy_title'] ?? 'Gizlilik ve Güvenlik Politikası') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Kullanım Şartları ve Üyelik Sözleşmesi Başlığı</label>
                <input type="text" name="data[terms_title]" class="xp-form-input" value="<?= e($data['terms_title'] ?? 'Kullanım Şartları ve Üyelik Sözleşmesi') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">İptal ve İade Koşulları Başlığı</label>
                <input type="text" name="data[refund_title]" class="xp-form-input" value="<?= e($data['refund_title'] ?? 'İptal ve İade Koşulları') ?>">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label">Çerez (Cookie) Politikası Başlığı</label>
                <input type="text" name="data[cookies_title]" class="xp-form-input" value="<?= e($data['cookies_title'] ?? 'Çerez (Cookie) Politikası') ?>">
            </div>

            <div style="margin-top: 1rem;">
                <?php renderLinkPicker('data[legal_back_link]', (string)($data['legal_back_link'] ?? '/tr'), 'Hızlı Geri Dönüş Buton Linki'); ?>
            </div>
        </div>
    <?php endif; ?>
</form>

<script>
var BASE_URL = '<?= url('') ?>';
var UPLOAD_ENDPOINT = '<?= url('/xpanel/upload-image') ?>';
var CSRF_TOKEN = '<?= csrf_token() ?>';

function handleImageFileSelect(fileInput, pickerId) {
    if (!fileInput.files || !fileInput.files[0]) return;
    var file = fileInput.files[0];

    var box = document.getElementById(pickerId);
    if (!box) return;

    var previewImg = box.querySelector('.xp-preview-img');
    var emptyPlaceholder = box.querySelector('.xp-preview-empty');
    var spinner = box.querySelector('.xp-upload-spinner');
    var valInput = box.querySelector('.xp-image-val-input');
    var removeBtn = box.querySelector('.xp-btn-remove-img');
    var statusPill = box.querySelector('.xp-image-picker-status');
    var fallbackInput = box.querySelector('.xp-fallback-file-input');

    // Anında client-side yerel blob önizleme göster
    var localBlobUrl = URL.createObjectURL(file);
    if (previewImg) {
        previewImg.src = localBlobUrl;
        previewImg.style.display = 'block';
    }
    if (emptyPlaceholder) {
        emptyPlaceholder.style.display = 'none';
    }
    if (removeBtn) {
        removeBtn.style.display = 'inline-flex';
    }

    // Yedek multipart dosya aktarımı (standart form submit durumunda)
    try {
        var dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        if (fallbackInput) fallbackInput.files = dataTransfer.files;
    } catch(e) {}

    // Arka planda AJAX ile sunucuya anında yükleme
    if (spinner) spinner.style.display = 'flex';
    var formData = new FormData();
    formData.append('image', file);
    formData.append('csrf_token', CSRF_TOKEN);

    fetch(UPLOAD_ENDPOINT, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(function(res) {
        if (!res.ok) throw new Error('Yükleme hatası');
        return res.json();
    })
    .then(function(data) {
        if (spinner) spinner.style.display = 'none';
        if (data.success && data.url) {
            if (valInput) valInput.value = data.url;
            var finalUrl = data.url.startsWith('http') ? data.url : (BASE_URL + data.url);
            if (previewImg) previewImg.src = finalUrl;
            if (statusPill) {
                statusPill.className = 'xp-image-picker-status active';
                statusPill.textContent = '✓ Sunucuya Yüklendi';
            }
        }
    })
    .catch(function(err) {
        if (spinner) spinner.style.display = 'none';
        // Hata olsa dahi yerel önizleme kalır ve fallback input üzerinden form submit edildiğinde kaydedilir
        if (statusPill) {
            statusPill.className = 'xp-image-picker-status active';
            statusPill.textContent = '✓ Seçildi (Kaydetmede Yüklenecek)';
        }
    });
}

function handleSelectPredefined(select, pickerId) {
    var val = select.value;
    var box = document.getElementById(pickerId);
    if (!box) return;

    var valInput = box.querySelector('.xp-image-val-input');
    var previewImg = box.querySelector('.xp-preview-img');
    var emptyPlaceholder = box.querySelector('.xp-preview-empty');
    var removeBtn = box.querySelector('.xp-btn-remove-img');
    var statusPill = box.querySelector('.xp-image-picker-status');

    if (val) {
        if (valInput) valInput.value = val;
        var src = val.startsWith('http') ? val : (BASE_URL + val);
        if (previewImg) {
            previewImg.src = src;
            previewImg.style.display = 'block';
        }
        if (emptyPlaceholder) emptyPlaceholder.style.display = 'none';
        if (removeBtn) removeBtn.style.display = 'inline-flex';
        if (statusPill) {
            statusPill.className = 'xp-image-picker-status active';
            statusPill.textContent = '✓ Sistem Görseli Seçildi';
        }
    } else {
        handleClearImage(pickerId);
    }
}

function handleUrlInputChange(input, pickerId) {
    var val = input.value.trim();
    var box = document.getElementById(pickerId);
    if (!box) return;

    var previewImg = box.querySelector('.xp-preview-img');
    var emptyPlaceholder = box.querySelector('.xp-preview-empty');
    var removeBtn = box.querySelector('.xp-btn-remove-img');
    var statusPill = box.querySelector('.xp-image-picker-status');

    if (val) {
        var src = val.startsWith('http') ? val : (BASE_URL + val);
        if (previewImg) {
            previewImg.src = src;
            previewImg.style.display = 'block';
        }
        if (emptyPlaceholder) emptyPlaceholder.style.display = 'none';
        if (removeBtn) removeBtn.style.display = 'inline-flex';
        if (statusPill) {
            statusPill.className = 'xp-image-picker-status active';
            statusPill.textContent = '✓ Görsel Tanımlı';
        }
    } else {
        if (previewImg) previewImg.style.display = 'none';
        if (emptyPlaceholder) emptyPlaceholder.style.display = 'flex';
        if (removeBtn) removeBtn.style.display = 'none';
        if (statusPill) {
            statusPill.className = 'xp-image-picker-status';
            statusPill.textContent = '⚪ Görsel Seçilmedi';
        }
    }
}

function handleClearImage(pickerId) {
    var box = document.getElementById(pickerId);
    if (!box) return;

    var valInput = box.querySelector('.xp-image-val-input');
    var fileInput = box.querySelector('.xp-file-input');
    var fallbackInput = box.querySelector('.xp-fallback-file-input');
    var select = box.querySelector('.xp-link-quick-select');
    var previewImg = box.querySelector('.xp-preview-img');
    var emptyPlaceholder = box.querySelector('.xp-preview-empty');
    var removeBtn = box.querySelector('.xp-btn-remove-img');
    var statusPill = box.querySelector('.xp-image-picker-status');

    if (valInput) valInput.value = '';
    if (fileInput) fileInput.value = '';
    if (fallbackInput) fallbackInput.value = '';
    if (select) select.value = '';
    if (previewImg) {
        previewImg.src = '';
        previewImg.style.display = 'none';
    }
    if (emptyPlaceholder) emptyPlaceholder.style.display = 'flex';
    if (removeBtn) removeBtn.style.display = 'none';
    if (statusPill) {
        statusPill.className = 'xp-image-picker-status';
        statusPill.textContent = '⚪ Görsel Kaldırıldı';
    }
}
</script>

<?php require __DIR__ . '/layout_bottom.php'; ?>
