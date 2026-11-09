<?php
declare(strict_types=1);
?>

<div class="auth-page-wrapper">
    <div class="container auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <span class="auth-badge-kicker">GÜVENLİK GÜNCELLEMESİ</span>
                <h1 class="auth-main-title">Yeni Şifre Belirleyin</h1>
                <p class="auth-lead-subtitle"><?= e($email ?? '') ?> hesabı için yeni ve güvenli bir şifre oluşturun.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="auth-alert-error">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/reset-password/process') ?>" method="POST" class="auth-form">
                <?= csrf_field() ?>
                <input type="hidden" name="token" value="<?= e($token ?? '') ?>">

                <div class="auth-form-group">
                    <label class="auth-form-label" for="password">YENİ ŞİFRE (EN AZ 6 KARAKTER)</label>
                    <input type="password" id="password" name="password" class="auth-form-input" required autocomplete="new-password" placeholder="••••••••">
                </div>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="password_confirm">YENİ ŞİFRE TEKRARI</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="auth-form-input" required autocomplete="new-password" placeholder="••••••••">
                </div>

                <button type="submit" class="btn-pill-solid auth-submit-btn">
                    ŞİFREYİ GÜNCELLE VE GİRİŞ YAP &rarr;
                </button>

                <div class="auth-footer-nav" style="text-align: center; margin-top: 1.5rem;">
                    <a href="<?= url('/login') ?>" class="auth-link-bold">&larr; Giriş Ekranına Dön</a>
                </div>
            </form>
        </div>
    </div>
</div>

