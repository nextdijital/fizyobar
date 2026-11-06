<?php
declare(strict_types=1);
?>

<div class="auth-page-wrapper">
    <div class="container auth-container">
        <div class="auth-card">
            <!-- Üst Başlık & Kicker (Ortalanmış, Şık Tipografi) -->
            <div class="auth-header">
                <span class="auth-badge-kicker">ÖĞRENCİ VE ÜYE GİRİŞİ</span>
                <h1 class="auth-main-title">Hesabınıza Giriş Yapın</h1>
                <p class="auth-lead-subtitle">Eğitimlerinize, video kütüphanenize ve seanslarınıza erişin.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="auth-alert-error">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/login/process') ?>" method="POST" class="auth-form">
                <?= csrf_field() ?>

                <div class="auth-form-group">
                    <label class="auth-form-label" for="email">E-POSTA ADRESİ</label>
                    <input type="email" id="email" name="email" class="auth-form-input" required autocomplete="email">
                </div>

                <div class="auth-form-group">
                    <div class="auth-label-row">
                        <label class="auth-form-label" for="password">ŞİFRE</label>
                    </div>
                    <input type="password" id="password" name="password" class="auth-form-input" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn-pill-solid auth-submit-btn">
                    GİRİŞ YAP &rarr;
                </button>

                <div class="auth-footer-nav">
                    <span>Henüz üye değil misiniz?</span>
                    <a href="<?= url('/register') ?>" class="auth-link-bold">Hemen Kayıt Olun</a>
                </div>
            </form>
        </div>
    </div>
</div>

