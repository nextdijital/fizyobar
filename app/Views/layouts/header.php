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

<?php
$cleanUri = trim($currentUri ?? '', '/');
$isHomePage = in_array($cleanUri, ['', 'tr', 'en', 'fizyobar', 'fizyobar/tr', 'fizyobar/en'], true);
$isDarkPage = str_contains($cleanUri, 'blog') || str_contains($cleanUri, 'articles') || str_contains($cleanUri, 'makaleler');
?>
    <!-- Gezinme Çubuğu (Editorial Mimarisi: Sol Menü • Orta Logo • Sağ Aksiyon) -->
    <header class="site-header <?= $isHomePage ? 'header-hero-transparent' : ($isDarkPage ? 'header-dark-theme' : '') ?>" id="siteHeader">
        <div class="header-container">
            <!-- 1. Sol Menü (Betella Mimarisi: STUDIO • PROGRAMLAR • ETKİNLİKLER • KURUMSAL) -->
            <nav class="header-nav-left" id="navMenu">
                <ul class="nav-list">
                    <!-- STUDIO Dropdown (Referans Birebir) -->
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/studio') ?>" class="nav-link <?= (str_contains($currentUri, '/studio') || str_contains($currentUri, '/recipes') || str_contains($currentUri, '/guides') || str_contains($currentUri, '/plans') || str_contains($currentUri, '/articles') || str_contains($currentUri, '/makaleler') || str_contains($currentUri, '/blog')) ? 'active' : '' ?>">
                            STUDIO <span class="nav-chevron">▸</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/studio') ?>" class="dropdown-link">Studio Ana Sayfa <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/plans') ?>" class="dropdown-link">Beslenme Planları <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/guides') ?>" class="dropdown-link">Rehberler <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/recipes') ?>" class="dropdown-link">Tarifler <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/makaleler') ?>" class="dropdown-link">Makaleler <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/blog') ?>" class="dropdown-link">Blog <span class="dropdown-chevron">▸</span></a>
                        </div>
                    </li>

                    <!-- PROGRAMLAR Dropdown -->
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/programs') ?>" class="nav-link <?= str_contains($currentUri, '/programs') ? 'active' : '' ?>">
                            PROGRAMLAR <span class="nav-chevron">▸</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/programs') ?>" class="dropdown-link">Tüm Programlar <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/programs') ?>" class="dropdown-link">4 Haftalık Online Detox Kampı <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/programs') ?>" class="dropdown-link">Warrior Yoga Serisi <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/events') ?>" class="dropdown-link">Platform &amp; SUP Yoga <span class="dropdown-chevron">▸</span></a>
                        </div>
                    </li>

                    <!-- ETKİNLİKLER Dropdown -->
                    <li class="nav-item-dropdown">
                        <a href="<?= url('/events') ?>" class="nav-link <?= (str_contains($currentUri, '/events') || str_contains($currentUri, '/duyurular') || str_contains($currentUri, '/haberler') || str_contains($currentUri, '/announcements') || str_contains($currentUri, '/news')) ? 'active' : '' ?>">
                            ETKİNLİKLER <span class="nav-chevron">▸</span>
                        </a>
                        <div class="dropdown-menu">
                            <a href="<?= url('/events') ?>" class="dropdown-link">Etkinlikler <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/duyurular') ?>" class="dropdown-link">Duyurular <span class="dropdown-chevron">▸</span></a>
                            <a href="<?= url('/haberler') ?>" class="dropdown-link">Haberler <span class="dropdown-chevron">▸</span></a>
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
                </ul>
            </nav>

            <!-- 2. Orta Logo (Barlow Condensed Tipografik Marka Mimarisi) -->
            <div class="header-center-logo">
                <a href="<?= url('/') ?>" class="brand-logo-link brand-logo-type" aria-label="FİZYOBAR Ana Sayfa">
                    <span class="logo-text-main">FİZYOBAR</span>
                    <span class="logo-text-sub">BODY • ADAPT • REFRAME</span>
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
                        <span class="user-role-tag"><?= (auth_user()['role'] ?? '') === 'admin' ? 'XPANEL' : 'MOVEMENT SPACE' ?></span>
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
