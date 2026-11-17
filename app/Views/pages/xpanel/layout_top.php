<?php
declare(strict_types=1);
$currentUri = \Core\Router::getCurrentUri();
$adminUser = \Core\Auth::user();
$pendingCount = (int)(\Core\Database::fetch("SELECT COUNT(*) as cnt FROM enrollments WHERE payment_status = 'pending'")['cnt'] ?? 0);
$currentTab = $_GET['tab'] ?? ($currentUri === '/xpanel/pages' || str_contains($currentUri, 'pages') ? 'home' : '');
$isPagesRoute = str_contains($currentUri, 'pages');
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr" class="xp-html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($metaTitle ?? 'Yönetim Merkezi') ?> | Fizyobar</title>
    <meta name="robots" content="noindex, nofollow">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('assets/css/xpanel.css') ?>?v=<?= time() ?>">

    <!-- Global Scrollbar Ayarları (Tablolarda Yatay Scrollbar Görünür) -->
    <style>
        html, body {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        html::-webkit-scrollbar, body::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }
        /* Tablolarda yatay kaydırma çubuğu her zaman temiz ve görünür olsun */
        .xpanel-table-wrap {
            scrollbar-width: thin !important;
            scrollbar-color: #cbd5e1 #f8fafc !important;
        }
        .xpanel-table-wrap::-webkit-scrollbar {
            height: 7px !important;
            display: block !important;
        }
        .xpanel-table-wrap::-webkit-scrollbar-track {
            background: #f8fafc !important;
            border-radius: 999px;
        }
        .xpanel-table-wrap::-webkit-scrollbar-thumb {
            background: #cbd5e1 !important;
            border-radius: 999px;
        }
        .xpanel-table-wrap::-webkit-scrollbar-thumb:hover {
            background: #94a3b8 !important;
        }
    </style>
</head>
<body class="xp-body">

    <!-- Mobilde Menü Açıldığında Karartma Katmanı -->
    <div class="xp-sidebar-overlay" id="xpSidebarOverlay"></div>

    <!-- =========================================================================
         SOL SIDEBAR (YÖNETİM MENÜSÜ & PROFİL)
         ========================================================================= -->
    <aside class="xp-sidebar" id="xpSidebar">
        <!-- Marka & Mobil Kapatma Butonu -->
        <div class="xp-sidebar-brand">
            <a href="<?= url('/xpanel') ?>" class="xp-brand-link">
                <h1 class="xp-brand-title">
                    FİZYOBAR
                    <span class="xp-brand-tag">YÖNETİM</span>
                </h1>
                <span class="xp-brand-motto">BEDEN &bull; UYUM &bull; DÖNÜŞÜM</span>
            </a>
            <button type="button" class="xp-mobile-close-btn" id="xpSidebarClose" aria-label="Menüyü Kapat">
                ✕
            </button>
        </div>

<?php
$isCrmRoute = str_contains($currentUri, 'users') || str_contains($currentUri, 'enrollments') || str_contains($currentUri, 'courses') || str_contains($currentUri, 'announcements') || str_contains($currentUri, 'nutrition');
?>
        <!-- Bağımsız Kaydırılabilir Menü Öğeleri -->
        <div class="xp-sidebar-nav-scroll">
            <nav class="xp-nav-section">
                <!-- 1. KONSOL -->
                <a href="<?= url('/xpanel') ?>" class="xp-nav-link <?= ($currentUri === '/xpanel' || $currentUri === '/tr/xpanel') && !$isPagesRoute ? 'active' : '' ?>">
                    <span class="xp-nav-left">
                        <span class="xp-nav-icon">📊</span>
                        <span>Genel Bakış</span>
                    </span>
                </a>

                <!-- 2. ÖN YÜZ SAYFALARI & YAPILANDIRMA (AÇILIR KAPANIR ACCORDION) -->
                <div class="xp-nav-group <?= $isPagesRoute ? 'is-open' : '' ?>" id="navGroupPages">
                    <button type="button" class="xp-nav-group-header" onclick="toggleNavGroup('navGroupPages')">
                        <span class="xp-nav-group-title">
                            <span class="xp-nav-icon">🎨</span>
                            <span>Ön Yüz Sayfaları</span>
                        </span>
                        <svg class="xp-nav-group-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="xp-nav-group-items">
                        <a href="<?= url('/xpanel/pages?tab=header_nav') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'header_nav' ? 'active' : '' ?>">
                            <span>🏷️</span>
                            <span>Üst Menü, Logo &amp; Duyuru</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=home') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'home' ? 'active' : '' ?>">
                            <span>🏠</span>
                            <span>Ana Sayfa</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=programs') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'programs' ? 'active' : '' ?>">
                            <span>🏋️</span>
                            <span>Programlar &amp; Paketler</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=betina') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'betina' ? 'active' : '' ?>">
                            <span>🧘</span>
                            <span>Betina Tansuğ &amp; Metot</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=detox') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'detox' ? 'active' : '' ?>">
                            <span>🌿</span>
                            <span>Online Detoks Kampı</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=studio') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'studio' ? 'active' : '' ?>">
                            <span>🥗</span>
                            <span>Stüdyo &amp; Mutfak</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=events') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'events' ? 'active' : '' ?>">
                            <span>📅</span>
                            <span>Etkinlikler &amp; Haberler</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=corporate') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'corporate' ? 'active' : '' ?>">
                            <span>🏢</span>
                            <span>Kurumsal &amp; Wellness</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=find_program') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'find_program' ? 'active' : '' ?>">
                            <span>🧭</span>
                            <span>Programını Bul (Test)</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=footer_contact') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'footer_contact' ? 'active' : '' ?>">
                            <span>📞</span>
                            <span>İletişim, Alt Menü &amp; Sosyal</span>
                        </a>
                        <a href="<?= url('/xpanel/pages?tab=legal') ?>" class="xp-nav-sub-link <?= $isPagesRoute && $currentTab === 'legal' ? 'active' : '' ?>">
                            <span>⚖️</span>
                            <span>Yasal &amp; KVKK Metinleri</span>
                        </a>
                    </div>
                </div>

                <!-- 3. ÖĞRENCİ & KURSİYER YÖNETİMİ (AÇILIR KAPANIR ACCORDION) -->
                <div class="xp-nav-group <?= $isCrmRoute ? 'is-open' : '' ?>" id="navGroupCrm">
                    <button type="button" class="xp-nav-group-header" onclick="toggleNavGroup('navGroupCrm')">
                        <span class="xp-nav-group-title">
                            <span class="xp-nav-icon">👥</span>
                            <span>Öğrenci &amp; Kursiyer Yönetimi</span>
                            <?php if ($pendingCount > 0): ?>
                                <span class="xp-badge-count" style="margin-left: 6px;"><?= $pendingCount ?></span>
                            <?php endif; ?>
                        </span>
                        <svg class="xp-nav-group-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="xp-nav-group-items">
                        <a href="<?= url('/xpanel/users') ?>" class="xp-nav-sub-link <?= str_contains($currentUri, 'users') ? 'active' : '' ?>">
                            <span>👥</span>
                            <span>Kullanıcılar &amp; Sadakat</span>
                        </a>
                        <a href="<?= url('/xpanel/enrollments') ?>" class="xp-nav-sub-link <?= str_contains($currentUri, 'enrollments') ? 'active' : '' ?>">
                            <span>💳</span>
                            <span>Banka &amp; Havale Ödemeleri</span>
                            <?php if ($pendingCount > 0): ?>
                                <span class="xp-badge-count" style="margin-left: auto;"><?= $pendingCount ?></span>
                            <?php endif; ?>
                        </a>
                        <a href="<?= url('/xpanel/courses') ?>" class="xp-nav-sub-link <?= str_contains($currentUri, 'courses') ? 'active' : '' ?>">
                            <span>🎬</span>
                            <span>Eğitim &amp; Seanslar</span>
                        </a>
                        <a href="<?= url('/xpanel/announcements') ?>" class="xp-nav-sub-link <?= str_contains($currentUri, 'announcements') ? 'active' : '' ?>">
                            <span>📢</span>
                            <span>Duyurular &amp; Bülten</span>
                        </a>
                        <a href="<?= url('/xpanel/nutrition') ?>" class="xp-nav-sub-link <?= str_contains($currentUri, 'nutrition') ? 'active' : '' ?>">
                            <span>🍏</span>
                            <span>Mutfak &amp; Beslenme Rehberi</span>
                        </a>
                    </div>
                </div>

                <!-- 4. YAPILANDIRMA & AYARLAR -->
                <a href="<?= url('/xpanel/settings') ?>" class="xp-nav-link <?= str_contains($currentUri, 'settings') ? 'active' : '' ?>">
                    <span class="xp-nav-left">
                        <span class="xp-nav-icon">⚙️</span>
                        <span>Site &amp; Ödeme Ayarları</span>
                    </span>
                </a>
            </nav>
        </div>

        <!-- Alt Yönetici Bilgisi & Aksiyonlar (Her zaman en altta sabit) -->
        <div class="xp-sidebar-footer">
            <div class="xp-user-card">
                <div class="xp-user-avatar">
                    <?= mb_substr($adminUser['full_name'] ?? 'S', 0, 1) ?>
                </div>
                <div class="xp-user-meta">
                    <div class="xp-user-name"><?= e($adminUser['full_name'] ?? 'Süper Yönetici') ?></div>
                    <div class="xp-user-role"><?= e($adminUser['email'] ?? 'Yönetici') ?></div>
                </div>
            </div>

            <div class="xp-footer-actions">
                <a href="<?= url('/') ?>" target="_blank" class="xp-btn-side-site" title="Site ön yüzünü yeni sekmede aç">
                    <span>Siteyi Gör</span>
                    <span>↗</span>
                </a>
                <a href="<?= url('/xpanel/logout') ?>" class="xp-btn-side-logout">
                    <span>Çıkış Yap</span>
                </a>
            </div>
        </div>
    </aside>

    <!-- =========================================================================
         SAĞ İÇERİK ALANI (MAIN CONTENT AREA)
         ========================================================================= -->
    <div class="xp-main-wrapper">
        <!-- Üst Bar & Mobil Hamburger -->
        <header class="xp-top-bar">
            <div class="xp-top-bar-left">
                <button type="button" class="xp-hamburger-btn" id="xpHamburgerBtn" aria-label="Menüyü Aç">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <div class="xp-breadcrumb">
                    <span>Yönetim</span>
                    <span>/</span>
                    <strong><?= e($metaTitle ?? 'Kontrol Paneli') ?></strong>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div class="xp-top-status-badge">
                    <span class="xp-status-dot"></span>
                    <span>Sistem Aktif</span>
                </div>
            </div>
        </header>

        <!-- Asıl Sayfa İçeriği -->
        <main class="xp-content-area">
            <?php if (!empty($flash)): ?>
                <div style="background-color: var(--xp-emerald-light); border: 1px solid #a7f3d0; color: #065f46; padding: 0.85rem 1.25rem; border-radius: var(--xp-radius-md); margin-bottom: 1.5rem; font-size: 0.84rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem;">
                    <span>✓</span>
                    <span><?= e($flash) ?></span>
                </div>
            <?php endif; ?>
