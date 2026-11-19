<!DOCTYPE html>
<html lang="<?= e($currentLang) ?>" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    
    <!-- Sayfa Başlığı ve Açıklaması -->
    <title><?= e($metaTitle ?? __('brand.name') . ' | ' . __('brand.subtitle')) ?></title>
    <meta name="description" content="<?= e($metaDescription ?? __('brand.positioning')) ?>">
    
    <!-- Güvenlik ve Arama Motoru Ayarları -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="Betina Tansuğ - Fizyobar">
    <?= csrf_meta() ?>

    <!-- Open Graph (Sosyal Medya Paylaşım Uyumu) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="FİZYOBAR">
    <meta property="og:title" content="<?= e($metaTitle ?? __('brand.name') . ' | ' . __('brand.subtitle')) ?>">
    <meta property="og:description" content="<?= e($metaDescription ?? __('brand.positioning')) ?>">
    <meta property="og:locale" content="<?= $isTr ? 'tr_TR' : 'en_US' ?>">

    <!-- Google Fonts: Barlow Condensed & Cormorant Garamond -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,600;1,700&family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">

    <!-- CSS Stilleri (Cache-busting ile) -->
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/cookie-consent.css') ?>">
    <?php
    $cleanUri = trim($currentUri ?? '', '/');
    $isHomePage = in_array($cleanUri, ['', 'tr', 'en', 'fizyobar', 'fizyobar/tr', 'fizyobar/en'], true);
    $isKitchenPage = (str_contains($cleanUri, 'recipes') || str_contains($cleanUri, 'tarifler') || str_contains($cleanUri, 'bar-kitchen') || str_contains($cleanUri, 'kitchen'));
    $isDarkPage = ($isDarkPage ?? false)
        || str_contains($cleanUri, 'articles')
        || str_contains($cleanUri, 'makaleler');
    $isFinderPage = str_contains($cleanUri, 'programini-bul') || str_contains($cleanUri, 'find-program');
    $isPortalPage = str_contains($cleanUri, 'dashboard')
        || str_contains($cleanUri, 'movement-space')
        || str_contains($cleanUri, 'lesson');
    $isGrayPage = !$isPortalPage && (
        str_contains($cleanUri, 'corporate')
        || str_contains($cleanUri, 'betina-tansug')
        || str_contains($cleanUri, 'about')
        || str_contains($cleanUri, 'hakkimizda')
        || str_contains($cleanUri, 'detox')
    );
    ?>
    <?php if ($isPortalPage): ?>
        <link rel="stylesheet" href="<?= asset('assets/css/student-portal.css') ?>">
    <?php endif; ?>

    <!-- Global Hidden Scrollbars (Scrollbarlar Her Yerde Gizli, Akıcı Kaydırma Aktif) -->
    <style>
        html, body, *, *::before, *::after {
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }
        *::-webkit-scrollbar, html::-webkit-scrollbar, body::-webkit-scrollbar {
            width: 0 !important;
            height: 0 !important;
            display: none !important;
            background: transparent !important;
        }
    </style>
</head>
<?php
// Dinamik Header & Nav Verileri (xPanel Yönetiminden)
$headerNavData = function_exists('page_data') ? page_data('header_nav') : [];
$topAnnouncementText = !empty($headerNavData['top_announcement_text']) ? $headerNavData['top_announcement_text'] : 'WELLNESS EXPERIENCES BY BETINA TANSUĞ • 4 HAFTALIK ONLINE DETOX & YOGA KAMPI YENİ DÖNEMİ BAŞLIYOR';
$topAnnouncementAction = !empty($headerNavData['top_announcement_action']) ? $headerNavData['top_announcement_action'] : 'HEMEN KATIL →';
$topAnnouncementLink = !empty($headerNavData['top_announcement_link']) ? $headerNavData['top_announcement_link'] : '/detox';
if (!empty($topAnnouncementLink) && !str_starts_with($topAnnouncementLink, 'http') && !str_starts_with($topAnnouncementLink, '/fizyobar')) {
    $topAnnouncementLink = url($topAnnouncementLink);
}

$logoMain = !empty($headerNavData['logo_main']) ? $headerNavData['logo_main'] : 'FİZYOBAR';
$logoSub = !empty($headerNavData['logo_sub']) ? $headerNavData['logo_sub'] : 'BODY • ADAPT • REFRAME';

$navBtnText = !empty($headerNavData['nav_btn_text']) ? $headerNavData['nav_btn_text'] : __('nav.cta_action');
$navBtnLink = !empty($headerNavData['nav_btn_link']) ? $headerNavData['nav_btn_link'] : '/detox';
if (!empty($navBtnLink) && !str_starts_with($navBtnLink, 'http') && !str_starts_with($navBtnLink, '/fizyobar')) {
    $navBtnLink = url($navBtnLink);
}
?>
<body class="<?= $isFinderPage ? 'body-finder-pure-white' : ($isKitchenPage ? 'body-kitchen-dark' : ($isGrayPage ? 'body-gray-page' : '')) ?><?= $isPortalPage ? ' body-portal-page' : '' ?>">
<?php if ($isFinderPage): ?>
    <!-- PROGRAMINI BUL: SADECE BEYAZ SAYFA, SOLDA GERİ DÖN, ORTADA FİZYOBAR LOGOSU -->
    <header class="finder-clean-header" id="finderHeader">
        <div class="finder-clean-header-inner">
            <a href="<?= url('/programs') ?>" class="finder-header-back-btn" id="finderHeaderBackBtn" aria-label="Geri Dön" onclick="if (window.history.length > 1 && document.referrer && document.referrer.indexOf(window.location.host) !== -1) { event.preventDefault(); window.history.back(); }">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>GERİ DÖN</span>
            </a>

            <div class="finder-header-logo-wrap">
                <a href="<?= url('/') ?>" class="brand-logo-link brand-logo-type" aria-label="FİZYOBAR Ana Sayfa">
                    <span class="logo-text-main">FİZYOBAR</span>
                    <span class="logo-text-sub">BODY • ADAPT • REFRAME</span>
                </a>
            </div>

            <div class="finder-header-right-ghost" aria-hidden="true"></div>
        </div>
    </header>
<?php elseif ($isPortalPage): ?>
    <!-- ÖĞRENCİ KİŞİSEL ALANI: SADE, DİKKAT DAĞITMAYAN, MOTİVE EDİCİ HEADER -->
    <header class="portal-clean-header" id="portalCleanHeader">
        <div class="portal-clean-header-inner">
            <div class="portal-header-left">
                <a href="<?= url('/') ?>" class="portal-back-to-site-btn" aria-label="Ana Sayfaya Dön">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>ANA SAYFA</span>
                </a>
            </div>

            <div class="portal-header-center">
                <a href="<?= url('/dashboard') ?>" class="brand-logo-link brand-logo-type portal-site-logo-link" aria-label="FİZYOBAR">
                    <span class="logo-text-main">FİZYOBAR</span>
                    <span class="logo-text-sub">BODY • ADAPT • REFRAME</span>
                </a>
            </div>

            <div class="portal-header-right">
                <span class="portal-header-user-badge"><?= htmlspecialchars(auth_user()['full_name'] ?? 'Öğrenci', ENT_QUOTES, 'UTF-8') ?></span>
                <a href="<?= url('/logout') ?>" class="portal-header-exit-btn">ÇIKIŞ YAP</a>
            </div>
        </div>
    </header>
<?php else: ?>
    <!-- Üst Duyuru Bandı (Announcement Top Bar - Dark Sienna #4a1421 - Kenarlara Yaslı) -->
    <div class="top-announcement-bar">
        <div class="announcement-inner">
            <span><?= e($topAnnouncementText) ?></span>
            <a href="<?= e($topAnnouncementLink) ?>" class="announcement-link">
                <?= e($topAnnouncementAction) ?>
            </a>
        </div>
    </div>

    <!-- Gezinme Çubuğu (Editorial Mimarisi: Sol Menü • Orta Logo • Sağ Aksiyon) -->
    <header class="site-header <?= $isKitchenPage ? 'header-kitchen-dark' : ($isHomePage ? 'header-hero-transparent' : ($isDarkPage ? 'header-dark-theme' : ($isGrayPage ? 'header-gray-theme' : ''))) ?>" id="siteHeader">
        <div class="header-container">
            <!-- 1. Sol Menü (Betella Mimarisi: STUDIO • BAR KITCHEN • PROGRAMLAR • ETKİNLİKLER • KURUMSAL) -->
            <nav class="header-nav-left" id="navMenu">
                <ul class="nav-list">
                    <!-- STUDIO Dropdown: Tıklanınca Ana Sayfaya Gider -->
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/') ?>" class="nav-link <?= ($isHomePage || str_contains($currentUri, '/makaleler') || str_contains($currentUri, '/articles') || str_contains($currentUri, '/blog') || str_contains($currentUri, '/beslenme-rehberi') || str_contains($currentUri, '/yasam-rehberi')) ? 'active' : '' ?>">
                            STUDIO <span class="nav-chevron">▸</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/') ?>" class="dropdown-link">Studio Ana Sayfa <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/beslenme-rehberi') ?>" class="dropdown-link">Beslenme Rehberi <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/yasam-rehberi') ?>" class="dropdown-link">Yaşam Rehberi <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/makaleler') ?>" class="dropdown-link">Makaleler <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/blog') ?>" class="dropdown-link">Blog <span class="dropdown-chevron">▸</span></a>
                        </div>
                    </li>

                    <!-- BAR KITCHEN (Doğrudan Link - Alt Kategorisiz) -->
                    <li>
                        <a href="<?= url('/recipes') ?>" class="nav-link <?= (str_contains($cleanUri, 'recipes') || str_contains($cleanUri, 'tarifler') || str_contains($cleanUri, 'kitchen') || str_contains($cleanUri, 'bar-kitchen')) ? 'active' : '' ?>">
                            BAR KITCHEN
                        </a>
                    </li>

                    <!-- PROGRAMLAR Dropdown -->
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/programs') ?>" class="nav-link <?= (str_contains($currentUri, '/programs') || str_contains($currentUri, '/detox')) ? 'active' : '' ?>">
                            PROGRAMLAR <span class="nav-chevron">▸</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/programs') ?>" class="dropdown-link">Tüm Programlar <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/detox') ?>" class="dropdown-link">4 Haftalık Online Detox Kampı <span class="dropdown-chevron">▸</span></a>
                        </div>
                    </li>

                    <!-- ETKİNLİKLER Dropdown -->
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/events') ?>" class="nav-link <?= (str_contains($currentUri, '/events') || str_contains($currentUri, '/duyurular') || str_contains($currentUri, '/announcements')) ? 'active' : '' ?>">
                            ETKİNLİKLER <span class="nav-chevron">▸</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/events') ?>" class="dropdown-link">Etkinlikler <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/duyurular') ?>" class="dropdown-link">Duyurular <span class="dropdown-chevron">▸</span></a>
                        </div>
                    </li>

                    <!-- KURUMSAL Dropdown -->
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/corporate') ?>" class="nav-link <?= (str_contains($currentUri, '/corporate') || str_contains($currentUri, '/betina-tansug') || str_contains($currentUri, '/about') || str_contains($currentUri, '/hakkimizda')) ? 'active' : '' ?>">
                            KURUMSAL <span class="nav-chevron">▸</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/corporate') ?>" class="dropdown-link">Kurumsal Wellbeing Çözümleri <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/betina-tansug') ?>" class="dropdown-link">Betina Tansuğ &amp; Fizyobar <span class="dropdown-chevron">▸</span></a>
                        </div>
                    </li>

                    <!-- Mobil Menü Aksiyon Butonu -->
                    <li class="nav-item-mobile-cta">
                        <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="mobile-menu-cta-btn">
                            <?= __('nav.cta_action') ?> &rarr;
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- 2. Orta Logo (Barlow Condensed Tipografik Marka Mimarisi) -->
            <div class="header-center-logo">
                <a href="<?= url('/') ?>" class="brand-logo-link brand-logo-type" aria-label="<?= e($logoMain) ?> Ana Sayfa">
                    <span class="logo-text-main"><?= e($logoMain) ?></span>
                    <span class="logo-text-sub"><?= e($logoSub) ?></span>
                </a>
            </div>

            <!-- 3. Sağ Aksiyon Alanı (Profil • Dil • Program Butonu) -->
            <div class="header-actions">
                <!-- Kullanıcı Profil / Giriş İkonu -->
                <?php if (auth_check()): ?>
                    <a href="<?= (auth_user()['role'] ?? '') === 'admin' ? url('/xpanel') : url('/dashboard') ?>" class="header-user-btn" title="Hesabım">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="user-role-tag"><?= (auth_user()['role'] ?? '') === 'admin' ? 'YÖNETİM' : 'HAREKET ALANIM' ?></span>
                    </a>
                <?php else: ?>
                    <a href="<?= url('/login') ?>" class="header-user-btn" title="Giriş Yap">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                <?php endif; ?>

                <!-- Dil Seçimi -->
                <div class="lang-switcher" aria-label="Language Selector">
                    <a href="<?= switch_lang_url('tr') ?>" class="lang-btn <?= $isTr ? 'active' : '' ?>" title="Türkçe">TR</a>
                    <span class="lang-divider">/</span>
                    <a href="<?= switch_lang_url('en') ?>" class="lang-btn <?= $isEn ? 'active' : '' ?>" title="English">EN</a>
                </div>

                <!-- Betella Tarzı İnce Çerçeveli Aksiyon Butonu -->
                <a href="<?= e($navBtnLink) ?>" class="btn-betella-cta">
                    <?= e($navBtnText) ?>
                </a>

                <!-- Mobil Hamburger Butonu -->
                <button class="mobile-toggle" id="mobileMenuToggle" aria-label="Menüyü Aç/Kapat" aria-expanded="false">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>
        </div>
    </header>
<?php endif; ?>

    <!-- Ana İçerik Başlangıcı -->
    <main class="main-content">
