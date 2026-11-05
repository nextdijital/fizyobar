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

    <!-- Google Fonts: Plus Jakarta Sans & Cormorant Garamond -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">

    <!-- CSS Stilleri (Cache-busting ile) -->
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/cookie-consent.css') ?>">
</head>
<body>
    <!-- Üst Duyuru Bandı (Announcement Top Bar - Dark Sienna #391214 - Kenarlara Yaslı) -->
    <div class="top-announcement-bar">
        <div class="announcement-inner">
            <span>WELLNESS EXPERIENCES BY BETINA TANSUĞ • 4 HAFTALIK ONLINE DETOX & YOGA KAMPI YENİ DÖNEMİ BAŞLIYOR</span>
            <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="announcement-link">
                HEMEN KATIL &rarr;
            </a>
        </div>
    </div>

    <!-- Gezinme Çubuğu (Editorial Mimarisi: Sol Menü • Orta Logo • Sağ Aksiyon) -->
    <header class="site-header" id="siteHeader">
        <div class="header-container">
            <!-- 1. Sol Menü (Kenara Yaslı Gezinme) -->
            <nav class="header-nav-left" id="navMenu">
                <ul class="nav-list">
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/metod') ?>" class="nav-link <?= str_contains($currentUri, '/metod') ? 'active' : '' ?>">
                            <?= __('nav.metod') ?> <span class="nav-chevron">▾</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/metod') ?>" class="dropdown-link">BAR System Nedir?</a>
                            <a href="<?= url('/metod') ?>#biomechanic" class="dropdown-link">Biyomekanik & Denge</a>
                            <a href="<?= url('/metod') ?>#nervous-system" class="dropdown-link">Sinir Sistemi Regülasyonu</a>
                            <a href="<?= url('/metod') ?>#longevity" class="dropdown-link">Sürdürülebilir Longevity</a>
                        </div>
                    </li>

                    <li class="nav-item-dropdown">
                        <a href="<?= url('/programs') ?>" class="nav-link <?= str_contains($currentUri, '/programs') ? 'active' : '' ?>">
                            <?= __('nav.programs') ?> <span class="nav-chevron">▾</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/programs') ?>#featured-program" class="dropdown-link">4 Haftalık Online Detox & Yoga</a>
                            <a href="<?= url('/programs') ?>" class="dropdown-link">Warrior Yoga Serisi</a>
                            <a href="<?= url('/programs') ?>" class="dropdown-link">Mobilite & Esneklik</a>
                            <a href="<?= url('/programs') ?>" class="dropdown-link dropdown-link-all">Tüm Programları Keşfet &rarr;</a>
                        </div>
                    </li>

                    <li class="nav-item-dropdown">
                        <a href="<?= url('/events') ?>" class="nav-link <?= str_contains($currentUri, '/events') ? 'active' : '' ?>">
                            <?= __('nav.events') ?> <span class="nav-chevron">▾</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/events') ?>" class="dropdown-link">Platform & SUP Yoga</a>
                            <a href="<?= url('/events') ?>" class="dropdown-link">Outdoor Topluluk Seansları</a>
                            <a href="<?= url('/events') ?>" class="dropdown-link">Özel Workshoplar</a>
                        </div>
                    </li>

                    <li>
                        <a href="<?= url('/corporate') ?>" class="nav-link <?= str_contains($currentUri, '/corporate') ? 'active' : '' ?>">
                            <?= __('nav.corporate') ?>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- 2. Orta Logo (Tam Sayfa Ortasında) -->
            <div class="header-center-logo">
                <a href="<?= url('/') ?>" class="brand-logo-link" aria-label="Fizyobar Ana Sayfa">
                    <picture>
                        <source srcset="<?= asset('assets/images/logo.webp') ?>" type="image/webp">
                        <img src="<?= asset('assets/images/logo.png') ?>" alt="FİZYOBAR" class="header-logo-img">
                    </picture>
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
                        <span class="user-role-tag"><?= (auth_user()['role'] ?? '') === 'admin' ? 'XPANEL' : 'PANEL' ?></span>
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
                <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="btn-betella-cta">
                    <?= __('nav.cta_action') ?>
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

    <!-- Ana İçerik Başlangıcı -->
    <main class="main-content">
