<?php
declare(strict_types=1);
$currentUri = \Core\Router::getCurrentUri();
$adminUser = \Core\Auth::user();
$pendingCount = (int)(\Core\Database::fetch("SELECT COUNT(*) as cnt FROM enrollments WHERE payment_status = 'pending'")['cnt'] ?? 0);
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($metaTitle ?? 'xPanel Yönetim Merkezi') ?> | Fizyobar</title>
    <meta name="robots" content="noindex, nofollow">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    
    <style>
        :root {
            --xp-sidebar-bg: #0d0d0f;
            --xp-sidebar-width: 275px;
            --xp-sidebar-border: rgba(255, 255, 255, 0.08);
            --xp-pill: 999px;
            --xp-primary: #111111;
        }

        body.xpanel-body-layout {
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', var(--font-sans), -apple-system, sans-serif;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
        }

        /* 1. SOL MENÜ (SIDEBAR) */
        .xp-sidebar {
            width: var(--xp-sidebar-width);
            min-width: var(--xp-sidebar-width);
            background-color: var(--xp-sidebar-bg);
            color: #ffffff;
            height: 100vh;
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 1px solid var(--xp-sidebar-border);
            z-index: 1000;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .xp-sidebar-brand {
            padding: 1.75rem 1.5rem 1.25rem 1.5rem;
            border-bottom: 1px solid var(--xp-sidebar-border);
        }

        .xp-brand-title {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin: 0;
            line-height: 1;
        }

        .xp-brand-tag {
            background: #ffffff;
            color: #000000;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: var(--xp-pill);
            letter-spacing: 0.08em;
        }

        .xp-brand-motto {
            font-size: 0.66rem;
            color: #71717a;
            margin-top: 0.5rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Navigasyon Listesi */
        .xp-nav-section {
            padding: 1.25rem 0.85rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .xp-nav-label {
            font-size: 0.66rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #52525b;
            padding: 0.4rem 0.75rem;
            margin-bottom: 0.2rem;
            display: block;
        }

        .xp-nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.1rem;
            color: #a1a1aa;
            text-decoration: none;
            border-radius: var(--xp-pill);
            font-size: 0.84rem;
            font-weight: 500;
            transition: all 0.2s ease;
            letter-spacing: 0.01em;
        }

        .xp-nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.07);
        }

        .xp-nav-link.active {
            color: #ffffff;
            background: #1f1f23;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .xp-nav-link-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .xp-nav-icon {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            display: inline-block;
        }

        .xp-badge-count {
            background-color: #ef4444;
            color: #ffffff;
            padding: 2px 7px;
            font-size: 0.68rem;
            border-radius: var(--xp-pill);
            font-weight: 700;
        }

        /* Alt Yönetici & Çıkış Kutusu */
        .xp-sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid var(--xp-sidebar-border);
            background: rgba(0, 0, 0, 0.25);
        }

        .xp-user-info-box {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.85rem;
        }

        .xp-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #27272a;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 700;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .xp-user-meta {
            overflow: hidden;
        }

        .xp-user-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: #ffffff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .xp-user-role {
            font-size: 0.68rem;
            color: #71717a;
        }

        .xp-footer-actions {
            display: flex;
            gap: 0.5rem;
        }

        .xp-btn-side-action {
            flex: 1;
            text-align: center;
            padding: 0.5rem 0.6rem;
            font-size: 0.74rem;
            font-weight: 600;
            border-radius: var(--xp-pill);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .xp-btn-side-site {
            background: rgba(255, 255, 255, 0.08);
            color: #e4e4e7;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .xp-btn-side-site:hover {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
        }

        .xp-btn-side-logout {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.25);
        }
        .xp-btn-side-logout:hover {
            background: #ef4444;
            color: #ffffff;
        }

        /* 2. SAĞ İÇERİK ALANI (MAIN CONTENT) */
        .xp-main-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .xp-top-bar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 2.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .xp-breadcrumb {
            font-size: 0.82rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .xp-content-area {
            flex: 1;
            padding: 2rem 2.5rem 3.5rem 2.5rem;
            max-width: 1400px;
            width: 100%;
            box-sizing: border-box;
            margin: 0 auto;
        }

        /* FİZYOBAR GENEL BUTON STANDARDI (OVAL / PILL) */
        .xp-btn-pill-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            background: #000000;
            color: #ffffff !important;
            border: 1px solid #000000;
            border-radius: var(--xp-pill);
            padding: 0.6rem 1.45rem;
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.12);
        }
        .xp-btn-pill-primary:hover {
            background: #27272a;
            border-color: #27272a;
            transform: translateY(-1px);
        }

        .xp-btn-pill-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            background: #ffffff;
            color: #0f172a !important;
            border: 1px solid #cbd5e1;
            border-radius: var(--xp-pill);
            padding: 0.5rem 1.25rem;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .xp-btn-pill-outline:hover {
            border-color: #0f172a;
            background: #f8fafc;
        }

        /* Tablo İçi Aksiyon Pill Butonları */
        .xp-btn-action-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.85rem;
            font-size: 0.74rem;
            font-weight: 600;
            border-radius: var(--xp-pill);
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: 1px solid transparent;
            line-height: 1.2;
        }
        .xp-btn-action-edit {
            background: #f1f5f9;
            color: #0f172a !important;
            border-color: #cbd5e1;
        }
        .xp-btn-action-edit:hover {
            background: #0f172a;
            color: #ffffff !important;
            border-color: #0f172a;
        }
        .xp-btn-action-approve {
            background: #047857;
            color: #ffffff !important;
            border-color: #047857;
        }
        .xp-btn-action-approve:hover {
            background: #065f46;
        }
        .xp-btn-action-danger {
            background: #fef2f2;
            color: #dc2626 !important;
            border-color: #fecaca;
        }
        .xp-btn-action-danger:hover {
            background: #dc2626;
            color: #ffffff !important;
        }

        /* Kart ve Tablo Standartları */
        .xpanel-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            margin-bottom: 1.5rem;
        }
        .xpanel-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .xpanel-table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.06em;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        .xpanel-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }
        .xpanel-table tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="xpanel-body-layout">

    <!-- =========================================================================
         SOL MENÜ (SIDEBAR NAVIGATION)
         ========================================================================= -->
    <aside class="xp-sidebar">
        <div>
            <!-- Marka & Başlık -->
            <div class="xp-sidebar-brand">
                <a href="<?= url('/xpanel') ?>" class="xp-brand-title">
                    FİZYOBAR
                    <span class="xp-brand-tag">XPANEL</span>
                </a>
                <div class="xp-brand-motto">BODY &bull; ADAPT &bull; REFRAME</div>
            </div>

            <!-- Menü Linkleri -->
            <nav class="xp-nav-section">
                <span class="xp-nav-label">Yönetim Menüsü</span>

                <a href="<?= url('/xpanel') ?>" class="xp-nav-link <?= $currentUri === '/xpanel' || $currentUri === '/tr/xpanel' ? 'active' : '' ?>">
                    <span class="xp-nav-link-left">
                        <span class="xp-nav-icon">📊</span>
                        <span>Genel Bakış</span>
                    </span>
                </a>

                <a href="<?= url('/xpanel/enrollments') ?>" class="xp-nav-link <?= str_contains($currentUri, 'enrollments') ? 'active' : '' ?>">
                    <span class="xp-nav-link-left">
                        <span class="xp-nav-icon">💳</span>
                        <span>IBAN &amp; Ödemeler</span>
                    </span>
                    <?php if ($pendingCount > 0): ?>
                        <span class="xp-badge-count" title="<?= $pendingCount ?> onay bekleyen ödeme"><?= $pendingCount ?></span>
                    <?php endif; ?>
                </a>

                <a href="<?= url('/xpanel/courses') ?>" class="xp-nav-link <?= str_contains($currentUri, 'courses') ? 'active' : '' ?>">
                    <span class="xp-nav-link-left">
                        <span class="xp-nav-icon">🎬</span>
                        <span>Eğitim &amp; Videolar</span>
                    </span>
                </a>

                <a href="<?= url('/xpanel/nutrition') ?>" class="xp-nav-link <?= str_contains($currentUri, 'nutrition') ? 'active' : '' ?>">
                    <span class="xp-nav-link-left">
                        <span class="xp-nav-icon">🍏</span>
                        <span>Studio &amp; Tarif / Rehber</span>
                    </span>
                </a>

                <a href="<?= url('/xpanel/users') ?>" class="xp-nav-link <?= str_contains($currentUri, 'users') ? 'active' : '' ?>">
                    <span class="xp-nav-link-left">
                        <span class="xp-nav-icon">👥</span>
                        <span>Kullanıcılar &amp; İlerleme</span>
                    </span>
                </a>

                <a href="<?= url('/xpanel/settings') ?>" class="xp-nav-link <?= str_contains($currentUri, 'settings') ? 'active' : '' ?>">
                    <span class="xp-nav-link-left">
                        <span class="xp-nav-icon">⚙️</span>
                        <span>Site &amp; Ödeme Ayarları</span>
                    </span>
                </a>
            </nav>
        </div>

        <!-- Alt Yönetici Bilgisi & Aksiyonlar -->
        <div class="xp-sidebar-footer">
            <div class="xp-user-info-box">
                <div class="xp-user-avatar">
                    <?= mb_substr($adminUser['full_name'] ?? 'A', 0, 1) ?>
                </div>
                <div class="xp-user-meta">
                    <div class="xp-user-name"><?= e($adminUser['full_name'] ?? 'Superadmin') ?></div>
                    <div class="xp-user-role"><?= e($adminUser['email'] ?? 'Yönetici') ?></div>
                </div>
            </div>

            <div class="xp-footer-actions">
                <a href="<?= url('/') ?>" target="_blank" class="xp-btn-side-action xp-btn-side-site" title="Ön yüzü yeni sekmede aç">
                    Siteyi Gör ↗
                </a>
                <a href="<?= url('/xpanel/logout') ?>" class="xp-btn-side-action xp-btn-side-logout">
                    Çıkış Yap
                </a>
            </div>
        </div>
    </aside>

    <!-- =========================================================================
         SAĞ İÇERİK ALANI (MAIN CONTENT AREA)
         ========================================================================= -->
    <div class="xp-main-wrapper">
        <!-- Üst Bilgi Barı -->
        <header class="xp-top-bar">
            <div class="xp-breadcrumb">
                <span>xPanel</span>
                <span>/</span>
                <strong style="color: #0f172a;"><?= e($metaTitle ?? 'Yönetim Merkezi') ?></strong>
            </div>

            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <span style="display: inline-flex; align-items: center; gap: 0.35rem; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-radius: var(--xp-pill); padding: 0.25rem 0.75rem; font-size: 0.74rem; font-weight: 600;">
                    <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981; display: inline-block;"></span>
                    Sistem Aktif
                </span>
            </div>
        </header>

        <!-- Asıl Sayfa İçeriği -->
        <main class="xp-content-area">
            <?php if (!empty($flash)): ?>
                <div style="background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.85rem 1.25rem; border-radius: var(--xp-pill); margin-bottom: 1.5rem; font-size: 0.84rem; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">
                    <span>✓</span>
                    <span><?= e($flash) ?></span>
                </div>
            <?php endif; ?>
