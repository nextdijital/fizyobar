<?php
declare(strict_types=1);
?>

<div class="auth-page-wrapper">
    <div class="container auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <span class="auth-badge-kicker">HESAP KURTARMA</span>
                <h1 class="auth-main-title">Şifrenizi mi Unuttunuz?</h1>
                <p class="auth-lead-subtitle">Kayıtlı e-posta adresinizi girin, size şifre sıfırlama bağlantısını ulaştıralım.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="auth-alert-error">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="auth-alert-success" style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); color: #86efac; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; line-height: 1.5;">
                    <p style="margin: 0; font-weight: 600;"><?= e($success) ?></p>
                    <?php if (!empty($resetLink)): ?>
                        <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid rgba(34, 197, 94, 0.2);">
                            <span style="font-size: 0.75rem; color: #a1a1aa; display: block; margin-bottom: 0.4rem;">Geliştirici / Doğrudan Bağlantı:</span>
                            <a href="<?= e($resetLink) ?>" style="color: #ffffff; text-decoration: underline; word-break: break-all; font-size: 0.82rem;">
                                <?= e($resetLink) ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/forgot-password/process') ?>" method="POST" class="auth-form">
                <?= csrf_field() ?>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="email">E-POSTA ADRESİ</label>
                    <input type="email" id="email" name="email" class="auth-form-input" required autocomplete="email" placeholder="ornek@fizyobar.com">
                </div>

                <button type="submit" class="btn-pill-solid auth-submit-btn">
                    SIFIRLAMA BAĞLANTISI GÖNDER &rarr;
                </button>

                <div class="auth-footer-nav" style="display: flex; justify-content: space-between; margin-top: 1.5rem;">
                    <a href="<?= url('/login') ?>" class="auth-link-bold">&larr; Giriş Ekranına Dön</a>
                    <a href="<?= url('/register') ?>" class="auth-link-bold">Yeni Kayıt Ol</a>
                </div>
            </form>
        </div>
    </div>
</div>

