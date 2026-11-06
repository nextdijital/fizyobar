<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($metaTitle ?? 'xPanel Yönetici Girişi | Fizyobar') ?></title>
    <meta name="robots" content="noindex, nofollow">
    <?= csrf_meta() ?>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Stilleri -->
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
    <style>
        .xpanel-login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fafafa;
            padding: 1.5rem;
            box-sizing: border-box;
        }
        .xpanel-login-card {
            width: 100%;
            max-width: 410px;
            background: #ffffff;
            border: 1px solid #e4e4e7;
            border-radius: 20px;
            padding: 2.25rem 2rem 2rem;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        .xpanel-logo-block {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .xpanel-logo-main {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #0e0e0e;
            line-height: 0.95;
            padding-left: 0.18em;
        }
        .xpanel-logo-sub {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.58rem;
            font-weight: 600;
            letter-spacing: 0.34em;
            text-transform: uppercase;
            color: #52525b;
            margin-top: 0.35rem;
            padding-left: 0.34em;
        }
        .xpanel-badge {
            display: inline-block;
            background: rgba(57, 18, 20, 0.08);
            border: 1px solid rgba(57, 18, 20, 0.2);
            color: #391214;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            margin-bottom: 0.4rem;
        }
        .xpanel-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.65rem;
            font-weight: 700;
            color: #111111;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin: 0 0 0.3rem 0;
            line-height: 1.15;
        }
        .xpanel-lead {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.82rem;
            color: #71717a;
            margin: 0 0 1.25rem 0;
        }
        .xpanel-alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 0.6rem 0.85rem;
            border-radius: 10px;
            margin-bottom: 1.15rem;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.82rem;
            line-height: 1.35;
            text-align: left;
        }
        .xpanel-form {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
            text-align: left;
        }
        .xpanel-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
        .xpanel-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #27272a;
        }
        .xpanel-input {
            width: 100%;
            height: 44px;
            padding: 0 0.85rem;
            border: 1px solid #e4e4e7;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.88rem;
            color: #18181b;
            background-color: #ffffff;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .xpanel-input:focus {
            border-color: #391214;
            box-shadow: 0 0 0 3px rgba(57, 18, 20, 0.08);
        }
        .xpanel-btn-submit {
            margin-top: 0.5rem;
            height: 46px;
            background-color: #391214;
            color: #ffffff;
            border: none;
            border-radius: 999px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.15s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .xpanel-btn-submit:hover {
            background-color: #260b0d;
            transform: translateY(-1px);
        }
        .xpanel-security-note {
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid #f4f4f5;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.72rem;
            color: #a1a1aa;
            text-align: center;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="xpanel-login-wrapper">
        <div class="xpanel-login-card">
            <!-- Fizyobar Kalın Tipografik Logo (Kullanıcının İstediği Standart) -->
            <div class="xpanel-logo-block">
                <span class="xpanel-logo-main">FİZYOBAR</span>
                <span class="xpanel-logo-sub">BODY • ADAPT • REFRAME</span>
            </div>

            <span class="xpanel-badge">GÜVENLİ YÖNETİM MERKEZİ</span>
            <h1 class="xpanel-title">xPanel Girişi</h1>
            <p class="xpanel-lead">Yetkili yönetici paneline erişmek için kimliğinizi doğrulayın.</p>

            <?php if (!empty($error)): ?>
                <div class="xpanel-alert-error">
                    <strong>Hata:</strong> <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/xpanel/login/process') ?>" method="POST" class="xpanel-form" autocomplete="off">
                <?= csrf_field() ?>

                <div class="xpanel-form-group">
                    <label class="xpanel-label" for="admin_email">YÖNETİCİ E-POSTA ADRESİ</label>
                    <input type="email" id="admin_email" name="email" class="xpanel-input" required autocomplete="email">
                </div>

                <div class="xpanel-form-group">
                    <label class="xpanel-label" for="admin_password">YÖNETİCİ ŞİFRESİ</label>
                    <input type="password" id="admin_password" name="password" class="xpanel-input" required autocomplete="current-password">
                </div>

                <div class="xpanel-form-group">
                    <label class="xpanel-label" for="secret_key">GÜVENLİK ANAHTAR KELİMESİ</label>
                    <input type="password" id="secret_key" name="secret_key" class="xpanel-input" required autocomplete="off">
                </div>

                <button type="submit" class="xpanel-btn-submit">
                    GÜVENLİ GİRİŞ YAP &rarr;
                </button>

                <div class="xpanel-security-note">
                    🔒 Bu alan yalnızca yetkili Fizyobar yöneticilerine tahsis edilmiştir. Tüm erişim denemeleri IP ve oturum bazlı kayıt altına alınır.
                </div>
            </form>
        </div>
    </div>
</body>
</html>

