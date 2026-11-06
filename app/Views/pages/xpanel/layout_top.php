<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($metaTitle ?? 'xPanel Yönetim Merkezi') ?> | Fizyobar</title>
    <meta name="robots" content="noindex, nofollow">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    
    <style>
        .xpanel-header {
            background-color: var(--black);
            color: var(--white);
            border-bottom: 2px solid var(--primary);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .xpanel-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        .xpanel-nav a {
            font-size: 0.78rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #a1a1aa;
            padding: 0.4rem 0.2rem;
            position: relative;
        }
        .xpanel-nav a:hover, .xpanel-nav a.active {
            color: var(--white);
        }
        .xpanel-nav a.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--primary);
        }
        .notify-badge {
            background-color: #ef4444;
            color: #fff;
            padding: 2px 6px;
            font-size: 0.65rem;
            border-radius: 99px;
            font-weight: 700;
            margin-left: 3px;
        }
        .xpanel-table {
            width: 100%;
            border-collapse: collapse;
            font-size: var(--font-sm);
            background: var(--white);
            border-radius: var(--radius-sm);
            overflow: hidden;
            box-shadow: var(--shadow-subtle);
        }
        .xpanel-table th, .xpanel-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border-light);
            text-align: left;
        }
        .xpanel-table th {
            background-color: #f8f8f8;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            color: var(--text-muted);
        }
        .xpanel-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 1.5rem;
            box-shadow: var(--shadow-subtle);
        }
    </style>
</head>
<body style="background-color: #f8f8f8;">

    <!-- xPanel Üst Bar -->
    <header class="xpanel-header">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 1.5rem;">
                <a href="<?= url('/xpanel') ?>" style="display: flex; align-items: center; gap: 0.75rem; color: #fff;">
                    <img src="<?= asset('assets/images/logo-white.png') ?>" alt="FİZYOBAR" style="height: 28px; width: auto;">
                    <span style="background-color: var(--primary); padding: 2px 6px; font-size: 0.7rem; border-radius: 2px; font-weight: 700; letter-spacing: 0.05em;">XPANEL</span>
                </a>

                <nav class="xpanel-nav">
                    <a href="<?= url('/xpanel') ?>" class="<?= $currentUri === '/xpanel' || $currentUri === '/tr/xpanel' ? 'active' : '' ?>">Genel Bakış</a>
                    <a href="<?= url('/xpanel/enrollments') ?>" class="<?= str_contains($currentUri, 'enrollments') ? 'active' : '' ?>">
                        IBAN & Ödemeler
                        <?php 
                            $pendingCount = (int)(\Core\Database::fetch("SELECT COUNT(*) as cnt FROM enrollments WHERE payment_status = 'pending'")['cnt'] ?? 0);
                            if ($pendingCount > 0): 
                        ?>
                            <span class="notify-badge"><?= $pendingCount ?></span>
                        <?php endif; ?>
                    </a>
                    <a href="<?= url('/xpanel/courses') ?>" class="<?= str_contains($currentUri, 'courses') ? 'active' : '' ?>">Eğitim & Videolar</a>
                    <a href="<?= url('/xpanel/settings') ?>" class="<?= str_contains($currentUri, 'settings') ? 'active' : '' ?>">Site & Ödeme Ayarları</a>
                    <a href="<?= url('/xpanel/users') ?>" class="<?= str_contains($currentUri, 'users') ? 'active' : '' ?>">Kullanıcılar</a>
                </nav>
            </div>

            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="<?= url('/') ?>" target="_blank" style="font-size: var(--font-xs); color: #a1a1aa; letter-spacing: 0.05em;">
                    Siteyi Gör &rarr;
                </a>
                <a href="<?= url('/xpanel/logout') ?>" class="btn btn-outline btn-xs" style="border-color: #444; color: #fff;">
                    Çıkış Yap
                </a>
            </div>
        </div>
    </header>

    <main class="container" style="padding-top: var(--space-lg); padding-bottom: var(--space-xl);">
        <?php if (!empty($flash)): ?>
            <div style="background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.85rem 1.25rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; font-size: var(--font-sm);">
                ✓ <?= e($flash) ?>
            </div>
        <?php endif; ?>

