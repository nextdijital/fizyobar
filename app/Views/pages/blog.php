<?php
declare(strict_types=1);
/**
 * @var array $posts
 * @var array $currentPost
 * @var bool $isSingle
 * @var string $activeCategory
 */
$isSingle = $isSingle ?? false;
$activeCategory = $activeCategory ?? 'all';
?>

<!-- ==============================================================================
     FİZYOBAR BLOG (LÜKS DARK EDİTORYAL MİMARİ - LİSTELEME & DETAY OKUYUCU)
     ============================================================================== -->
<div class="editorial-dark-page">
    <div class="container">
        <!-- 1. Üst Başlık & Kategori Filtreleri -->
        <header class="editorial-dark-hero">
            <h1 class="editorial-display-title">
                Bedeninle yeniden<br>bağ kur.
            </h1>

            <div class="editorial-tags-row" id="blogTagsRow">
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'all' && !$isSingle) ? 'active' : '' ?>" data-filter="all">TÜMÜ</button>
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'kamp' || ($isSingle && $currentPost['category_slug'] === 'kamp')) ? 'active' : '' ?>" data-filter="kamp">KAMP DENEYİMİ</button>
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'rutin' || ($isSingle && $currentPost['category_slug'] === 'rutin')) ? 'active' : '' ?>" data-filter="rutin">GÜNLÜK RUTİN</button>
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'beslenme' || ($isSingle && $currentPost['category_slug'] === 'beslenme')) ? 'active' : '' ?>" data-filter="beslenme">BESLENME &amp; GLP-1</button>
            </div>
        </header>

        <!-- İnce Bölücü Çizgi -->
        <div class="editorial-divider"></div>

        <!-- ======================================================================
             GÖRÜNÜM 1: TÜM BLOGLAR ARŞİVİ & KATEGORİ LİSTESİ (VARSAYILAN / TÜMÜ)
             ====================================================================== -->
        <section id="blogArchiveView" style="<?= $isSingle ? 'display: none;' : 'display: block;' ?>">
            <div class="editorial-archive-intro">
                <span class="editorial-feed-kicker">ARŞİV &amp; TÜM BLOGLAR</span>
                <h2 class="editorial-archive-title" id="blogArchiveFilterTitle">Öne Çıkan Tüm Günlük Notları</h2>
            </div>

            <div class="editorial-posts-grid" id="blogPostsGrid">
                <?php foreach ($posts as $post): ?>
                    <a href="<?= url('/blog?id=' . $post['id']) ?>" class="editorial-post-card" data-category="<?= e($post['category_slug']) ?>">
                        <div class="post-card-top">
                            <span class="post-card-badge"><?= e($post['badge']) ?></span>
                            <span class="post-card-time"><?= e($post['read_time']) ?></span>
                        </div>
                        <h3 class="post-card-title"><?= e($post['title']) ?></h3>
                        <p class="post-card-excerpt"><?= e($post['excerpt']) ?></p>
                        <div class="post-card-bottom">
                            <span class="post-card-link">OKU VE İNCELE &rarr;</span>
                            <span class="post-card-date"><?= e($post['date']) ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ======================================================================
             GÖRÜNÜM 2: SEÇİLİ TEKİL BLOG OKUMA ALANI (ASİMETRİK EDİTORYAL GRİD)
             ====================================================================== -->
        <section id="blogReaderView" style="<?= $isSingle ? 'display: block;' : 'display: none;' ?>">
            <!-- Üst Gezinme & Geri Dön Çubuğu -->
            <div class="editorial-reader-nav">
                <a href="<?= url('/blog') ?>" class="editorial-back-btn" id="btnBackToBlogArchive">
                    &larr; TÜM YAZILARA DÖN
                </a>
                <span class="editorial-reading-kicker" id="blogReadingKicker">
                    <?= e($currentPost['badge']) ?> &bull; <?= e($currentPost['read_time']) ?>
                </span>
            </div>

            <div class="editorial-split-layout">
                <!-- Sol Kolon: Sembol • Başlık • Tıklanabilir Diğer Yazılar • Tarih -->
                <aside class="editorial-sidebar">
                    <div class="editorial-symbol-wrap">
                        <svg width="44" height="44" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.3">
                            <ellipse cx="20" cy="24" rx="14" ry="14" stroke="rgba(255,255,255,0.7)"></ellipse>
                            <ellipse cx="24" cy="24" rx="14" ry="14" stroke="#ffffff"></ellipse>
                            <ellipse cx="28" cy="24" rx="14" ry="14" stroke="rgba(255,255,255,0.7)"></ellipse>
                        </svg>
                    </div>

                    <h2 class="editorial-sidebar-title">FİZYOBAR GÜNLÜK</h2>

                    <ul class="editorial-sidebar-list">
                        <?php foreach ($posts as $idx => $p): ?>
                            <li>
                                <a href="<?= url('/blog?id=' . $p['id']) ?>" class="editorial-sidebar-link <?= ($p['id'] === $currentPost['id']) ? 'active' : '' ?>">
                                    <?= sprintf('%02d', $idx + 1) ?>. <?= e($p['title']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="editorial-date-badge">
                        <span><?= e($currentPost['date']) ?></span>
                    </div>
                </aside>

                <!-- Sağ Kolon: Aktif Okunan Blog Yazısı -->
                <article class="editorial-main-content">
                    <h3 class="editorial-story-headline">
                        <?= e($currentPost['lead']) ?>
                    </h3>

                    <div class="editorial-two-col-text">
                        <p><?= $currentPost['content_col1'] ?></p>
                        <p><?= $currentPost['content_col2'] ?></p>
                    </div>

                    <!-- Editoryal Büyük Görsel -->
                    <div class="editorial-media-frame">
                        <picture>
                            <source srcset="<?= asset($currentPost['image']) ?>" type="image/jpeg">
                            <img 
                                src="<?= asset($currentPost['image']) ?>" 
                                alt="<?= e($currentPost['title']) ?>" 
                                class="editorial-main-image"
                                loading="lazy"
                            >
                        </picture>
                    </div>
                </article>
            </div>

            <!-- Okuma Altı: Diğer Bloglar Grid -->
            <div class="editorial-sub-divider"></div>

            <section class="editorial-feed-section">
                <div class="editorial-feed-header">
                    <span class="editorial-feed-kicker">ARŞİV &amp; GÜNLÜK NOTLARI</span>
                    <h4 class="editorial-feed-title">Diğer Blog Yazıları</h4>
                </div>

                <div class="editorial-posts-grid">
                    <?php foreach ($posts as $post): ?>
                        <a href="<?= url('/blog?id=' . $post['id']) ?>" class="editorial-post-card <?= ($post['id'] === $currentPost['id']) ? 'current-active-card' : '' ?>">
                            <div class="post-card-top">
                                <span class="post-card-badge"><?= e($post['badge']) ?></span>
                                <span class="post-card-time"><?= e($post['read_time']) ?></span>
                            </div>
                            <h3 class="post-card-title"><?= e($post['title']) ?></h3>
                            <p class="post-card-excerpt"><?= e($post['excerpt']) ?></p>
                            <div class="post-card-bottom">
                                <span class="post-card-link">OKU VE İNCELE &rarr;</span>
                                <span class="post-card-date"><?= e($post['date']) ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </section>
    </div>
</div>

<!-- ==============================================================================
     BLOG KATEGORİ & ARŞİV DİNAMİK FİLTRELEME SCRİPTİ
     ============================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('#blogTagsRow .editorial-tag-pill');
    const archiveView = document.getElementById('blogArchiveView');
    const readerView = document.getElementById('blogReaderView');
    const cards = document.querySelectorAll('#blogPostsGrid .editorial-post-card');
    const archiveTitle = document.getElementById('blogArchiveFilterTitle');
    const backBtn = document.getElementById('btnBackToBlogArchive');

    const categoryTitles = {
        'all': 'Öne Çıkan Tüm Günlük Notları',
        'kamp': 'Online Kamp Deneyimleri ve Dönüşüm Hikayeleri',
        'rutin': 'Sabah ve Akşam Günlük Mobilite Rutinleri',
        'beslenme': 'Fonksiyonel Beslenme ve GLP-1 Yönetimi'
    };

    function showArchive(filter) {
        // Okuma modunu gizle, tüm bloglar gridini göster
        if (readerView) readerView.style.display = 'none';
        if (archiveView) archiveView.style.display = 'block';

        // Buton aktifliklerini güncelle
        filterButtons.forEach(btn => {
            if (btn.getAttribute('data-filter') === filter) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // Başlığı güncelle
        if (archiveTitle && categoryTitles[filter]) {
            archiveTitle.textContent = categoryTitles[filter];
        }

        // Kartları filtrele
        cards.forEach(card => {
            const cat = card.getAttribute('data-category');
            if (filter === 'all' || cat === filter) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });

        // URL'yi güncelle
        const newUrl = (filter === 'all') 
            ? '<?= url('/blog') ?>' 
            : '<?= url('/blog') ?>?cat=' + encodeURIComponent(filter);
        window.history.pushState({ filter: filter }, '', newUrl);

        // Yumuşakça grid başına kaydır
        archiveView.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Kategori butonlarına tıklama
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const filter = this.getAttribute('data-filter');
            showArchive(filter);
        });
    });

    // "Tüm Yazılara Dön" butonuna tıklama
    if (backBtn) {
        backBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showArchive('all');
        });
    }

    // İlk yüklemede URL'de cat parametresi varsa uygula
    const urlParams = new URLSearchParams(window.location.search);
    const initialCat = urlParams.get('cat');
    if (initialCat && !urlParams.get('id')) {
        showArchive(initialCat);
    }
});
</script>
