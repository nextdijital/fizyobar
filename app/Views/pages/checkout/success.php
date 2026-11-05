<?php
declare(strict_types=1);
?>

<div class="page-hero">
    <div class="container" style="max-width: 680px;">
        <span class="badge-pill section-badge" style="background-color: #ecfdf5; color: #065f46; border-color: #a7f3d0;">
            ✓ BİLDİRİMİNİZ BAŞARIYLA ALINDI
        </span>
        <h1 class="section-title" style="font-size: var(--font-h1);">Ödeme Talebiniz İnceleniyor</h1>
        <p class="section-subtitle">
            <strong><?= e($enrollment['course_title']) ?></strong> programına kaydınız oluşturuldu.
        </p>
    </div>
</div>

<section style="padding: var(--space-xl) 0;">
    <div class="container" style="max-width: 600px;">
        <div class="form-luxury" style="text-align: center;">
            <div style="font-size: 3.5rem; color: #10b981; margin-bottom: 1rem;">⏳</div>

            <h3 style="font-size: 1.25rem; font-weight: 500; color: var(--black); margin-bottom: 0.5rem;">
                Referans No: #<?= (int)$enrollment['id'] ?>
            </h3>

            <p style="color: var(--text-muted); font-size: var(--font-sm); line-height: 1.7; margin-bottom: 1.5rem;">
                Havale / EFT bildiriminiz yetkili ekibimize iletilmiştir. Banka transferiniz kontrol edildikten sonra (genellikle 15-30 dakika içinde) aboneliğiniz onaylanacak ve video dersleriniz panelinizde açılacaktır.
            </p>

            <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?= url('/dashboard') ?>" class="btn btn-primary btn-sm">
                    ÖĞRENCİ PANELİME GİT &rarr;
                </a>
                <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20%23<?= $enrollment['id'] ?>%20numaral%C4%B1%20havale%20bildirimimi%20yapt%C4%B1m." target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                    WhatsApp'tan Bildir
                </a>
            </div>
        </div>
    </div>
</section>

