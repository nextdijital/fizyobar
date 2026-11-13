<?php
declare(strict_types=1);
?>

<div class="bar-kitchen-page">
    <div class="container">
        <!-- 1. Üst Giriş Başlık Alanı (Hero Intro) -->
        <section class="kitchen-hero-intro">
            <div class="kitchen-kicker-row">
                <span class="kitchen-kicker">NOURISH</span>
                <span class="kitchen-kicker-line" aria-hidden="true"></span>
            </div>
            
            <h1 class="kitchen-headline">BAR KITCHEN</h1>
            
            <p class="kitchen-hero-desc">
                Dengeli, gerçek ve bedeni destekleyen tarifler. Rafine şekersiz, anti-enflamatuar ve glisemik dengeli fonksiyonel mutfak pratikleri.
            </p>
        </section>

        <!-- 2. Kategori Filtreleme Barı -->
        <div class="kitchen-filter-bar" id="kitchenFilterBar">
            <div class="kitchen-filter-nav" role="tablist">
                <button type="button" class="kitchen-filter-btn active" data-filter="all">TÜM TARİFLER</button>
                <span class="kitchen-filter-sep" aria-hidden="true">|</span>
                <button type="button" class="kitchen-filter-btn" data-filter="breakfast">KAHVALTI</button>
                <span class="kitchen-filter-sep" aria-hidden="true">|</span>
                <button type="button" class="kitchen-filter-btn" data-filter="meals">ANA ÖĞÜN</button>
                <span class="kitchen-filter-sep" aria-hidden="true">|</span>
                <button type="button" class="kitchen-filter-btn" data-filter="snack">ATIŞTIRMALIK</button>
                <span class="kitchen-filter-sep" aria-hidden="true">|</span>
                <button type="button" class="kitchen-filter-btn" data-filter="dessert">TATLI</button>
                <span class="kitchen-filter-sep" aria-hidden="true">|</span>
                <button type="button" class="kitchen-filter-btn" data-filter="drinks">İÇECEK</button>
            </div>
        </div>

        <!-- 3. Alttaki Koyu Renkli & Ekstra Büyütülmüş Yuvarlak Tabaklı Kartlar -->
        <div class="kitchen-dark-cards-grid" id="kitchenCardsGrid">
            <?php foreach ($recipes as $idx => $item): ?>
                <div class="kitchen-dark-card"
                     data-index="<?= $idx ?>"
                     data-category="<?= htmlspecialchars((string)($item['category'] ?? 'all')) ?>"
                     data-title="<?= htmlspecialchars((string)($item['title'] ?? '')) ?>"
                     data-time="<?= htmlspecialchars((string)($item['time'] ?? '')) ?>"
                     data-badge="<?= htmlspecialchars((string)($item['badge'] ?? '')) ?>"
                     data-image="<?= htmlspecialchars((string)($item['image'] ?? '')) ?>"
                     data-desc="<?= htmlspecialchars((string)($item['description'] ?? '')) ?>"
                     data-ingredients='<?= json_encode($item['ingredients'] ?? [], JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                     data-instructions="<?= htmlspecialchars((string)($item['instructions'] ?? '')) ?>"
                     role="button"
                     tabindex="0"
                     aria-label="<?= htmlspecialchars((string)$item['title']) ?>">
                    
                    <!-- Sol Üstten Dışarı Taşarak Gelen Ekstra Büyütülmüş Yuvarlak Tabak -->
                    <img src="<?= htmlspecialchars((string)($item['image'] ?? '')) ?>" 
                         alt="<?= htmlspecialchars((string)$item['title']) ?>" 
                         class="kitchen-dark-card-plate" 
                         loading="lazy" />

                    <!-- Sağ Üst: Süre ve Yukarı Alınan Ok Butonu -->
                    <div class="kitchen-dark-card-top-meta">
                        <span class="kitchen-dark-card-time"><?= htmlspecialchars((string)$item['time']) ?></span>
                        <span class="kitchen-dark-card-arrow" aria-hidden="true">&rarr;</span>
                    </div>

                    <!-- Kart İçerik (Kalori kaldırıldı, yükseklik daraltıldı) -->
                    <div class="kitchen-dark-card-content">
                        <h4 class="kitchen-dark-card-title"><?= htmlspecialchars((string)$item['title']) ?></h4>
                        <span class="kitchen-dark-card-sub"><?= htmlspecialchars((string)($item['badge'] ?? 'FONKSİYONEL TABAK')) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Tarif Detay Modal Penceresi (Sol Bordo Blok + Sağ İçerik) -->
<div id="recipeModal" class="recipe-notebook-modal" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="modalRecipeTitle">
    <div class="notebook-modal-backdrop" id="recipeModalBackdrop"></div>
    <div class="recipe-split-modal-card">
        <!-- Kapat Butonu -->
        <button type="button" class="notebook-modal-close" id="recipeModalClose" aria-label="Kapat">&times;</button>
        
        <!-- Sol Taraf: Bordo Kalın Blok & Görsel -->
        <div class="modal-bordeaux-col">
            <div class="modal-bordeaux-header">
                <span class="modal-bordeaux-kicker">✦ TARİF DEFTERİ</span>
                <span class="modal-bordeaux-time" id="modalRecipeMeta"></span>
            </div>

            <div class="modal-bordeaux-plate-wrap">
                <img id="modalRecipeImg" src="" alt="Tarif Görseli" class="modal-bordeaux-plate-img" style="display: none;" />
            </div>

            <div class="modal-bordeaux-badge-wrap">
                <span class="modal-bordeaux-pill" id="modalRecipeBadge"></span>
            </div>
        </div>

        <!-- Sağ Taraf: İçerik Alanı -->
        <div class="modal-content-col">
            <div class="modal-content-header">
                <h3 class="notebook-recipe-title" id="modalRecipeTitle"></h3>
            </div>

            <!-- Defter İçi Kaydırılabilir Bölüm -->
            <div class="notebook-body-scroll">
                <div class="notebook-section">
                    <div class="notebook-section-header">
                        <span class="notebook-section-title">MALZEMELER</span>
                        <span class="notebook-rule-line" aria-hidden="true"></span>
                    </div>
                    <ul class="notebook-ingredients-list" id="modalRecipeIngredients"></ul>
                </div>

                <div class="notebook-section" style="margin-top: 1rem;">
                    <div class="notebook-section-header">
                        <span class="notebook-section-title">HAZIRLANIŞI</span>
                        <span class="notebook-rule-line" aria-hidden="true"></span>
                    </div>
                    <p class="notebook-instructions-text" id="modalRecipeInstructions"></p>
                </div>
            </div>

            <!-- Defter Alt Sayfa İmzası -->
            <div class="notebook-footer-sign">
                <span>FIZYOBAR • NOURISH NOTEBOOK</span>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Kartlar ve Filtreleme
    const cards = Array.from(document.querySelectorAll('.kitchen-dark-card'));
    const filterBtns = document.querySelectorAll('.kitchen-filter-btn');

    // 2. Modal Açma / Kapatma (Tarif Defteri)
    const modal = document.getElementById('recipeModal');
    const modalClose = document.getElementById('recipeModalClose');
    const backdrop = document.getElementById('recipeModalBackdrop');
    const mImg = document.getElementById('modalRecipeImg');
    const mBadge = document.getElementById('modalRecipeBadge');
    const mTitle = document.getElementById('modalRecipeTitle');
    const mMeta = document.getElementById('modalRecipeMeta');
    const mIng = document.getElementById('modalRecipeIngredients');
    const mInst = document.getElementById('modalRecipeInstructions');

    function openModal(data) {
        mTitle.textContent = data.title || '';
        mBadge.textContent = data.badge || '';
        mMeta.textContent = '⏱ ' + (data.time || '15 dk');
        mInst.textContent = data.instructions || '';

        if (data.image) {
            mImg.src = data.image;
            mImg.alt = data.title || '';
            mImg.style.display = 'block';
        } else {
            mImg.style.display = 'none';
        }

        mIng.innerHTML = '';
        try {
            const ings = JSON.parse(data.ingredients || '[]');
            ings.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = '<span class="notebook-bullet-icon" aria-hidden="true"><svg width="13" height="13" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="10" fill="#391214"/><path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span>' + item + '</span>';
                mIng.appendChild(li);
            });
        } catch(err) {}

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    cards.forEach(card => {
        card.addEventListener('click', function() {
            openModal(this.dataset);
        });
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openModal(this.dataset);
            }
        });
    });

    // 3. Kategori Filtreleme
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;

            cards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    if (modalClose) modalClose.addEventListener('click', closeModal);
    if (backdrop) backdrop.addEventListener('click', closeModal);
});
</script>
