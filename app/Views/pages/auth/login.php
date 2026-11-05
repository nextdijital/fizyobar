<?php
declare(strict_types=1);
?>

<div class="page-hero">
    <div class="container">
        <span class="badge-pill section-badge">ÖĞRENCİ VE ÜYE GİRİŞİ</span>
        <h1 class="section-title" style="font-size: var(--font-h1);">Hesabınıza Giriş Yapın</h1>
        <p class="section-subtitle">Eğitimlerinize, video derslerinize ve kazanılan rozetlerinize ulaşın.</p>
    </div>
</div>

<section style="padding: var(--space-xl) 0;">
    <div class="container" style="max-width: 520px;">
        <div class="form-luxury">
            <?php if (!empty($error)): ?>
                <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 0.85rem 1rem; border-radius: var(--radius-sm); margin-bottom: 1.25rem; font-size: var(--font-sm);">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= url('/login/process') ?>" method="POST">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label" for="email">E-Posta Adresi</label>
                    <input type="email" id="email" name="email" class="form-input" required placeholder="ornek@fizyobar.com">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Şifre</label>
                    <input type="password" id="password" name="password" class="form-input" required placeholder="••••••••">
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        GİRİŞ YAP &rarr;
                    </button>
                </div>

                <div style="text-align: center; margin-top: 1.25rem; font-size: var(--font-sm); color: var(--text-muted);">
                    Henüz üye değil misiniz? <a href="<?= url('/register') ?>" style="color: var(--primary); text-decoration: underline;">Hemen Kayıt Olun</a>
                </div>
            </form>
        </div>
    </div>
</section>

