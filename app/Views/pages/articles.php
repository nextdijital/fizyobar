<?php
declare(strict_types=1);
/**
 * @var array $articles
 * @var array $currentArticle
 * @var bool $isSingle
 * @var string $activeCategory
 */
$isSingle = $isSingle ?? false;
$activeCategory = $activeCategory ?? 'all';
?>

<!-- ==============================================================================
     FİZYOBAR MAKALELER (LÜKS DARK EDİTORYAL MİMARİ - LİSTELEME & DETAY OKUYUCU)
     ============================================================================== -->
<div class="editorial-dark-page">
    <div class="container">
        <!-- 1. Üst Başlık & Kategori Filtreleri -->
        <header class="editorial-dark-hero">
            <h1 class="editorial-display-title">
                Kanıta dayalı anatomi<br>ve longevity.
            </h1>

            <div class="editorial-tags-row" id="articleTagsRow">
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'all' && !$isSingle) ? 'active' : '' ?>" data-filter="all">TÜMÜ</button>
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'biyomekanik' || ($isSingle && $currentArticle['category_slug'] === 'biyomekanik')) ? 'active' : '' ?>" data-filter="biyomekanik">SERVİKAL BİYOMEKANİK</button>
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'longevity' || ($isSingle && $currentArticle['category_slug'] === 'longevity')) ? 'active' : '' ?>" data-filter="longevity">HÜCRESEL LONGEVITY</button>
                <button type="button" class="editorial-tag-pill <?= ($activeCategory === 'fasya' || ($isSingle && $currentArticle['category_slug'] === 'fasya')) ? 'active' : '' ?>" data-filter="fasya">FASYA AĞI</button>
            </div>
        </header>

        <!-- İnce Bölücü Çizgi -->
        <div class="editorial-divider"></div>

        <!-- ======================================================================
             GÖRÜNÜM 1: TÜM MAKALELER ARŞİVİ & KATEGORİ LİSTESİ (VARSAYILAN / TÜMÜ)
             ====================================================================== -->
        <section id="articlesArchiveView" style="<?= $isSingle ? 'display: none;' : 'display: block;' ?>">
            <div class="editorial-archive-intro">
                <span class="editorial-feed-kicker">LİTERATÜR &amp; TÜM MAKALELER</span>
                <h2 class="editorial-archive-title" id="archiveFilterTitle">Yayınlanan Tüm Bilimsel Araştırmalar</h2>
            </div>

            <div class="editorial-posts-grid" id="articlesPostsGrid">
                <?php foreach ($articles as $article): ?>
                    <a href="<?= url('/makaleler?id=' . $article['id']) ?>" class="editorial-post-card" data-category="<?= e($article['category_slug']) ?>">
                        <div class="post-card-top">
                            <span class="post-card-badge"><?= e($article['category']) ?></span>
                            <span class="post-card-time"><?= e($article['read_time']) ?></span>
                        </div>
                        <h3 class="post-card-title"><?= e($article['title']) ?></h3>
                        <p class="post-card-excerpt"><?= e($article['excerpt']) ?></p>
                        <div class="post-card-bottom">
                            <span class="post-card-link">OKU VE İNCELE &rarr;</span>
                            <span class="post-card-date"><?= e($article['date']) ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ======================================================================
             GÖRÜNÜM 2: SEÇİLİ TEKİL MAKALE OKUMA ALANI (ASİMETRİK EDİTORYAL GRİD)
             ====================================================================== -->
        <section id="articleReaderView" style="<?= $isSingle ? 'display: block;' : 'display: none;' ?>">
            <!-- Üst Gezinme & Geri Dön Çubuğu -->
            <div class="editorial-reader-nav">
                <a href="<?= url('/makaleler') ?>" class="editorial-back-btn" id="btnBackToArchive">
                    &larr; TÜM MAKALELERE DÖN
                </a>
                <span class="editorial-reading-kicker" id="readingKicker">
                    <?= e($currentArticle['category']) ?> &bull; <?= e($currentArticle['read_time']) ?>
                </span>
            </div>

            <div class="editorial-split-layout">
                <!-- Sol Kolon: Sembol • Bilimsel Kategori • Tıklanabilir Diğer Makaleler • Tarih -->
                <aside class="editorial-sidebar">
                    <div class="editorial-symbol-wrap">
                        <svg width="44" height="44" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.3">
                            <circle cx="24" cy="24" r="18" stroke="rgba(255,255,255,0.3)"></circle>
                            <ellipse cx="24" cy="24" rx="18" ry="8" stroke="#ffffff"></ellipse>
                            <ellipse cx="24" cy="24" rx="8" ry="18" stroke="rgba(255,255,255,0.7)"></ellipse>
                        </svg>
                    </div>

                    <h2 class="editorial-sidebar-title">FİZYOBAR MAKALE</h2>

                    <ul class="editorial-sidebar-list">
                        <?php foreach ($articles as $idx => $a): ?>
                            <li>
                                <a href="<?= url('/makaleler?id=' . $a['id']) ?>" class="editorial-sidebar-link <?= ($a['id'] === $currentArticle['id']) ? 'active' : '' ?>">
                                    <?= sprintf('%02d', $idx + 1) ?>. <?= e($a['title']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="editorial-date-badge">
                        <span><?= e($currentArticle['date']) ?></span>
                    </div>
                </aside>

                <!-- Sağ Kolon: Yazı Ağırlıklı Bilimsel Makale Gövdesi -->
                <article class="editorial-main-content">
                    <h3 class="editorial-story-headline">
                        <?= e($currentArticle['lead']) ?>
                    </h3>

                    <!-- Bölüm I: İki Kolonlu Detaylı Metin -->
                    <div class="editorial-two-col-text">
                        <p><?= $currentArticle['content_col1'] ?></p>
                        <p><?= $currentArticle['content_col2'] ?></p>
                    </div>

                    <!-- Bilimsel Vurgu / Klinik Alıntı Kutusu -->
                    <div class="editorial-callout-box">
                        <div class="callout-kicker">KLİNİK GÖZLEM &amp; VAKA ÇIKARIMI</div>
                        <blockquote class="callout-quote">
                            "<?= e($currentArticle['callout_quote']) ?>"
                        </blockquote>
                        <span class="callout-author">&mdash; <?= e($currentArticle['author']) ?>, Uzman Fizyoterapist &amp; Longevity Eğitmeni</span>
                    </div>

                    <!-- Bölüm II: Fasya ve Longevity İncelemesi (Yazı Ağırlıklı Derin Analiz) -->
                    <div class="editorial-two-col-text" style="margin-top: 1.5rem;">
                        <p><?= $currentArticle['content_col3'] ?></p>
                        <p><?= $currentArticle['content_col4'] ?></p>
                    </div>

                    <!-- Bilimsel Referanslar ve Literatür Notları -->
                    <div class="editorial-references-block">
                        <span class="references-title">BİLİMSEL REFERANSLAR VE ANATOMİK KAYNAKLAR</span>
                        <ol class="references-list">
                            <?php foreach ($currentArticle['references'] as $ref): ?>
                                <li><?= e($ref) ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </article>
            </div>

            <!-- Okuma Altı: Diğer Makaleler Grid -->
            <div class="editorial-sub-divider"></div>

            <section class="editorial-feed-section">
                <div class="editorial-feed-header">
                    <span class="editorial-feed-kicker">LİTERATÜR &amp; ARŞİV</span>
                    <h4 class="editorial-feed-title">Diğer Bilimsel Araştırmalar</h4>
                </div>

                <div class="editorial-posts-grid">
                    <?php foreach ($articles as $article): ?>
                        <a href="<?= url('/makaleler?id=' . $article['id']) ?>" class="editorial-post-card <?= ($article['id'] === $currentArticle['id']) ? 'current-active-card' : '' ?>">
                            <div class="post-card-top">
                                <span class="post-card-badge"><?= e($article['category']) ?></span>
                                <span class="post-card-time"><?= e($article['read_time']) ?></span>
                            </div>
                            <h3 class="post-card-title"><?= e($article['title']) ?></h3>
                            <p class="post-card-excerpt"><?= e($article['excerpt']) ?></p>
                            <div class="post-card-bottom">
                                <span class="post-card-link">OKU VE İNCELE &rarr;</span>
                                <span class="post-card-date"><?= e($article['date']) ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </section>
    </div>
</div>

<!-- ==============================================================================
     KATEGORİ & ARŞİV DİNAMİK FİLTRELEME SCRİPTİ
     ============================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('#articleTagsRow .editorial-tag-pill');
    const archiveView = document.getElementById('articlesArchiveView');
    const readerView = document.getElementById('articleReaderView');
    const cards = document.querySelectorAll('#articlesPostsGrid .editorial-post-card');
    const archiveTitle = document.getElementById('archiveFilterTitle');
    const backBtn = document.getElementById('btnBackToArchive');

    const categoryTitles = {
        'all': 'Yayınlanan Tüm Bilimsel Araştırmalar',
        'biyomekanik': 'Servikal Biyomekanik ve Omurga Araştırmaları',
        'longevity': 'Hücresel Longevity ve Mitokondri Analizleri',
        'fasya': 'Fasya Ağı ve Postür İncelemeleri'
    };

    function showArchive(filter) {
        // Detay okuyucusunu gizle, tüm makaleler gridini göster
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
            ? '<?= url('/makaleler') ?>' 
            : '<?= url('/makaleler') ?>?cat=' + encodeURIComponent(filter);
        window.history.pushState({ filter: filter }, '', newUrl);

        // Sayfayı yumuşakça grid başına kaydır
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

    // "Tüm Makalelere Dön" butonuna tıklama
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
