<?php
declare(strict_types=1);
?>

<div class="page-hero">
    <div class="container" style="max-width: 680px;">
        <span class="badge-pill section-badge" style="background-color: #ecfdf5; color: #065f46; border-color: #a7f3d0;">
            ✓ ABONELİĞİNİZ AKTİFLEŞTİRİLDİ
        </span>
        <h1 class="section-title" style="font-size: var(--font-h1);">Movement Space Alanınız Hazır!</h1>
        <p class="section-subtitle">
            <strong><?= e($enrollment['course_title']) ?></strong> programına kaydınız başarıyla tamamlandı.
        </p>
    </div>
</div>

<section style="padding: var(--space-xl) 0;">
    <div class="container" style="max-width: 600px;">
        <div class="form-luxury" style="text-align: center;">
            <div style="font-size: 3.5rem; color: #10b981; margin-bottom: 1rem;">✨</div>

            <h3 style="font-size: 1.25rem; font-weight: 500; color: var(--black); margin-bottom: 0.5rem;">
                Referans No: #<?= (int)$enrollment['id'] ?>
            </h3>

            <p style="color: var(--text-muted); font-size: var(--font-sm); line-height: 1.7; margin-bottom: 1.5rem;">
                Program kaydınız onaylandı. Kişisel Movement Space alanınıza girerek 28 günlük interaktif antrenman takviminizi inceleyebilir, ilk seansınıza hemen başlayabilirsiniz!
            </p>

            <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?= url('/movement-space') ?>" class="btn btn-primary btn-sm" style="background: #000000; color: #ffffff;">
                    MOVEMENT SPACE'E BAŞLA &rarr;
                </a>
                <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20%23<?= $enrollment['id'] ?>%20numaral%C4%B1%20program%20kayd%C4%B1m%C4%B1%20yapt%C4%B1m." target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                    WhatsApp Eğitmen Hattı
                </a>
            </div>
        </div>
    </div>
</section>

