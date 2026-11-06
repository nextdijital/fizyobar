<?php
declare(strict_types=1);
?>

<!-- Rehberler Sayfası: Sade, Ferah & Betella Stili Mimari -->
<section class="editorial-subpage-section">
    <div class="container">
        <!-- 1. Sade ve Güçlü Betella Stili Başlık -->
        <div class="programs-hero-clean text-center">
            <h1 class="programs-headline">REHBERLER</h1>
            <p class="editorial-subpage-desc">Longevity, vagus siniri regülasyonu, biyomekanik ve derin hücresel toparlanma kılavuzları</p>
            
            <!-- Betella Kapsül Toggle Seçici -->
            <div class="betella-toggle-wrap">
                <div class="betella-toggle-pill" role="tablist">
                    <button type="button" class="betella-toggle-btn active" data-filter="all" role="tab" aria-selected="true">
                        Tümü
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="vagus" role="tab" aria-selected="false">
                        Vagus &amp; Nefes
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="biomechanic" role="tab" aria-selected="false">
                        Biyomekanik &amp; Postür
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="longevity" role="tab" aria-selected="false">
                        Longevity
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="sleep" role="tab" aria-selected="false">
                        Uyku
                    </button>
                </div>
            </div>
        </div>

        <!-- 2. Sade ve Net Rehber Kartları Izgarası -->
        <div class="editorial-cards-grid" id="guidesGrid">
            <?php foreach ($guides as $guide): ?>
                <article class="editorial-clean-card" data-category="<?= htmlspecialchars($guide['category']) ?>">
                    <div class="editorial-card-top">
                        <div class="editorial-meta-row">
                            <span class="editorial-pill-tag"><?= htmlspecialchars($guide['category_label']) ?></span>
                            <span class="editorial-meta-info">📖 <?= htmlspecialchars($guide['read_time']) ?></span>
                        </div>
                        <h2 class="editorial-card-title"><?= htmlspecialchars($guide['title']) ?></h2>
                        <p class="editorial-card-text"><?= htmlspecialchars($guide['subtitle']) ?></p>
                    </div>

                    <div class="editorial-card-middle">
                        <h4 class="editorial-sub-title">TEMEL ÇIKARIMLAR</h4>
                        <ul class="editorial-bullet-list">
                            <?php foreach ($guide['highlights'] as $hl): ?>
                                <li>
                                    <span class="betella-check" aria-hidden="true">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                            <circle cx="10" cy="10" r="10" fill="#111111"/>
                                            <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span><?= htmlspecialchars($hl) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="editorial-card-bottom">
                        <button type="button" class="btn-clean-plan btn-guide-modal"
                                data-title="<?= htmlspecialchars($guide['title']) ?>"
                                data-category="<?= htmlspecialchars($guide['category_label']) ?>"
                                data-readtime="<?= htmlspecialchars($guide['read_time']) ?>"
                                data-highlights='<?= json_encode($guide['highlights'], JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                data-summary="<?= htmlspecialchars($guide['summary']) ?>">
                            REHBERİ OKU
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- 3. Alt Destek Notu -->
        <div class="programs-minimal-footer text-center">
            <p>Bedeninize uygun egzersiz ve toparlanma protokolü için <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer">Fizyoterapist ile WhatsApp'tan iletişime geçin &rarr;</a></p>
        </div>
    </div>
</section>

<!-- Rehber Detay Modal Penceresi -->
<div id="guideModal" class="clean-editorial-modal" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="modalGuideTitle">
    <div class="modal-backdrop-clean" id="guideModalBackdrop"></div>
    <div class="modal-content-clean">
        <button type="button" class="modal-close-clean" id="guideModalClose" aria-label="Kapat">&times;</button>
        <span class="editorial-pill-tag" id="modalGuideBadge"></span>
        <h3 class="modal-recipe-heading" id="modalGuideTitle"></h3>
        <p class="modal-recipe-meta" id="modalGuideMeta"></p>

        <div class="modal-recipe-body">
            <h4 class="editorial-sub-title">PROTOKOL ÖZETİ</h4>
            <p class="modal-instructions-text" id="modalGuideSummary" style="font-size: 0.95rem; line-height: 1.7; color: #27272a;"></p>

            <h4 class="editorial-sub-title" style="margin-top: 1.5rem;">UYGULAMA ADIMLARI</h4>
            <ul class="editorial-bullet-list" id="modalGuideHighlights"></ul>
        </div>
        
        <div style="margin-top: 2rem;">
            <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20rehberler%20ve%20uygulama%20hakk%C4%B1nda%20dan%C4%B1%C5%9Fmak%20istiyorum." target="_blank" rel="noopener noreferrer" class="btn-clean-plan">
                WHATSAPP İLE DANIŞIN &rarr;
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtreleme
    const filterBtns = document.querySelectorAll('.betella-toggle-btn');
    const cards = document.querySelectorAll('.editorial-clean-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');

            const filter = this.dataset.filter;
            cards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Rehber Detay Modalı
    const modal = document.getElementById('guideModal');
    const modalClose = document.getElementById('guideModalClose');
    const backdrop = document.getElementById('guideModalBackdrop');
    const modalBtns = document.querySelectorAll('.btn-guide-modal');

    const mBadge = document.getElementById('modalGuideBadge');
    const mTitle = document.getElementById('modalGuideTitle');
    const mMeta = document.getElementById('modalGuideMeta');
    const mSum = document.getElementById('modalGuideSummary');
    const mHl = document.getElementById('modalGuideHighlights');

    modalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            mTitle.textContent = this.dataset.title;
            mBadge.textContent = this.dataset.category;
            mMeta.textContent = '📖 ' + this.dataset.readtime;
            mSum.textContent = this.dataset.summary;

            mHl.innerHTML = '';
            try {
                const highlights = JSON.parse(this.dataset.highlights);
                highlights.forEach(item => {
                    const li = document.createElement('li');
                    li.innerHTML = '<span class="betella-check" aria-hidden="true"><svg width="16" height="16" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="10" fill="#111111"/><path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span>' + item + '</span>';
                    mHl.appendChild(li);
                });
            } catch(e) {}

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    });

    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    modalClose.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
});
</script>

