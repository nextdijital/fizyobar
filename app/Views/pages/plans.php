<?php
declare(strict_types=1);
?>

<!-- Beslenme Planları Sayfası: Sade, Ferah & Betella Stili Mimari -->
<section class="editorial-subpage-section">
    <div class="container">
        <!-- 1. Sade ve Güçlü Betella Stili Başlık -->
        <div class="programs-hero-clean text-center">
            <h1 class="programs-headline">BESLENME PLANLARI</h1>
            <p class="editorial-subpage-desc">Hücresel toparlanma, glisemik denge ve yağ yakımını destekleyen bilimsel beslenme protokolleri</p>
        </div>

        <!-- 2. Sade ve Net Plan Kartları -->
        <div class="editorial-cards-grid plans-grid-center" id="plansGrid">
            <?php foreach ($plans as $plan): ?>
                <article class="clean-plan-card">
                    <div class="plan-card-top">
                        <span class="editorial-pill-tag" style="margin-bottom: 0.8rem;"><?= htmlspecialchars($plan['badge']) ?></span>
                        <h2 class="clean-plan-title"><?= htmlspecialchars($plan['title']) ?></h2>
                        <p class="clean-plan-subtitle"><?= htmlspecialchars($plan['duration']) ?></p>
                        <p class="editorial-card-text" style="margin-bottom: 1.5rem; font-size: 0.88rem; color: #52525b;"><?= htmlspecialchars($plan['description']) ?></p>
                    </div>

                    <div class="clean-features-list">
                        <?php foreach ($plan['features'] as $feat): ?>
                            <div class="clean-feature-item">
                                <span class="betella-check" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                        <circle cx="10" cy="10" r="10" fill="#111111"/>
                                        <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="feature-text"><?= htmlspecialchars($feat) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="plan-card-bottom" style="margin-top: 2rem;">
                        <a href="<?= $plan['url'] ?>" class="btn-clean-plan">
                            <?= htmlspecialchars($plan['cta']) ?>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- 3. Alt Destek Notu -->
        <div class="programs-minimal-footer text-center">
            <p>Size özel makro ve kalori dengesi hakkında danışmak için <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer">WhatsApp hattımızdan bize yazın &rarr;</a></p>
        </div>
    </div>
</section>

