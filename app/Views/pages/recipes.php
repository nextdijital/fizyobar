<?php
declare(strict_types=1);
?>

<!-- Tarifler Sayfası: Sade, Ferah & Betella Stili Mimari -->
<section class="editorial-subpage-section">
    <div class="container">
        <!-- 1. Sade ve Güçlü Betella Stili Başlık -->
        <div class="programs-hero-clean text-center">
            <h1 class="programs-headline">TARİFLER</h1>
            <p class="editorial-subpage-desc">Rafine şekersiz, fonksiyonel, anti-enflamatuar ve glisemik dengeli mutfak pratikleri</p>
            
            <!-- Betella Kapsül Toggle Seçici -->
            <div class="betella-toggle-wrap">
                <div class="betella-toggle-pill" role="tablist">
                    <button type="button" class="betella-toggle-btn active" data-filter="all" role="tab" aria-selected="true">
                        Tümü
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="smoothie" role="tab" aria-selected="false">
                        Smoothie
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="meals" role="tab" aria-selected="false">
                        Öğünler
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="dessert" role="tab" aria-selected="false">
                        Tatlılar
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="drinks" role="tab" aria-selected="false">
                        Detox İksirleri
                    </button>
                </div>
            </div>
        </div>

        <!-- 2. Sade ve Net Tarif Kartları Izgarası -->
        <div class="editorial-cards-grid" id="recipesGrid">
            <?php foreach ($recipes as $item): ?>
                <article class="editorial-clean-card" data-category="<?= htmlspecialchars($item['category']) ?>">
                    <div class="editorial-card-top">
                        <div class="editorial-meta-row">
                            <span class="editorial-pill-tag"><?= htmlspecialchars($item['badge']) ?></span>
                            <span class="editorial-meta-info">⏱ <?= htmlspecialchars($item['time']) ?> • <?= htmlspecialchars($item['calories']) ?></span>
                        </div>
                        <h2 class="editorial-card-title"><?= htmlspecialchars($item['title']) ?></h2>
                        <p class="editorial-card-text"><?= htmlspecialchars($item['description']) ?></p>
                    </div>

                    <div class="editorial-card-middle">
                        <h4 class="editorial-sub-title">ÖNE ÇIKAN İÇERİKLER</h4>
                        <ul class="editorial-bullet-list">
                            <?php foreach (array_slice($item['ingredients'], 0, 3) as $ing): ?>
                                <li>
                                    <span class="betella-check" aria-hidden="true">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                                            <circle cx="10" cy="10" r="10" fill="#111111"/>
                                            <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span><?= htmlspecialchars($ing) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="editorial-card-bottom">
                        <button type="button" class="btn-clean-plan btn-recipe-modal" 
                                data-title="<?= htmlspecialchars($item['title']) ?>"
                                data-badge="<?= htmlspecialchars($item['badge']) ?>"
                                data-time="<?= htmlspecialchars($item['time']) ?>"
                                data-calories="<?= htmlspecialchars($item['calories']) ?>"
                                data-ingredients='<?= json_encode($item['ingredients'], JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                                data-instructions="<?= htmlspecialchars($item['instructions']) ?>">
                            TARİFİ İNCELE
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <!-- 3. Alt Danışma / Destek Kutusu -->
        <div class="programs-minimal-footer text-center">
            <p>Kişiye özel beslenme ve yağ yakımı protokolleri için <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20beslenme%20tarifleri%20ve%20planlar%C4%B1%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." target="_blank" rel="noopener noreferrer">WhatsApp üzerinden doğrudan danışın &rarr;</a></p>
        </div>
    </div>
</section>

<!-- Tarif Detay Modal Penceresi -->
<div id="recipeModal" class="clean-editorial-modal" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="modalRecipeTitle">
    <div class="modal-backdrop-clean" id="recipeModalBackdrop"></div>
    <div class="modal-content-clean">
        <button type="button" class="modal-close-clean" id="recipeModalClose" aria-label="Kapat">&times;</button>
        <span class="editorial-pill-tag" id="modalRecipeBadge"></span>
        <h3 class="modal-recipe-heading" id="modalRecipeTitle"></h3>
        <p class="modal-recipe-meta" id="modalRecipeMeta"></p>

        <div class="modal-recipe-body">
            <h4 class="editorial-sub-title">MALZEMELER</h4>
            <ul class="editorial-bullet-list" id="modalRecipeIngredients"></ul>

            <h4 class="editorial-sub-title" style="margin-top: 1.5rem;">HAZIRLANIŞI</h4>
            <p class="modal-instructions-text" id="modalRecipeInstructions"></p>
        </div>
        
        <div style="margin-top: 2rem;">
            <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20tarifler%20ve%20detox%20kamp%C4%B1%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." target="_blank" rel="noopener noreferrer" class="btn-clean-plan">
                WHATSAPP İLE SORU SOR &rarr;
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Kategori Filtreleme
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

    // Tarif Detay Modalı
    const modal = document.getElementById('recipeModal');
    const modalClose = document.getElementById('recipeModalClose');
    const backdrop = document.getElementById('recipeModalBackdrop');
    const modalBtns = document.querySelectorAll('.btn-recipe-modal');

    const mBadge = document.getElementById('modalRecipeBadge');
    const mTitle = document.getElementById('modalRecipeTitle');
    const mMeta = document.getElementById('modalRecipeMeta');
    const mIng = document.getElementById('modalRecipeIngredients');
    const mInst = document.getElementById('modalRecipeInstructions');

    modalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            mTitle.textContent = this.dataset.title;
            mBadge.textContent = this.dataset.badge;
            mMeta.textContent = '⏱ Hazırlık: ' + this.dataset.time + ' • Kalori: ' + this.dataset.calories;
            mInst.textContent = this.dataset.instructions;

            mIng.innerHTML = '';
            try {
                const ings = JSON.parse(this.dataset.ingredients);
                ings.forEach(item => {
                    const li = document.createElement('li');
                    li.innerHTML = '<span class="betella-check" aria-hidden="true"><svg width="16" height="16" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="10" fill="#111111"/><path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span>' + item + '</span>';
                    mIng.appendChild(li);
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

