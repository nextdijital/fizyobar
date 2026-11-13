<?php
declare(strict_types=1);

$announcements = $announcements ?? [];
$symbols = ['✱', '✤', '◎', '✧', '❀'];
?>

<div class="announcements-page-wrapper">
    <!-- 1. Ortalanmış Başlık Alanı -->
    <header class="announcements-centered-hero">
        <div class="container text-center">
            <span class="announcements-hero-kicker">GÜNCEL BÜLTEN &bull; BİLDİRİLER</span>
            <h1 class="announcements-centered-title">DUYURULAR</h1>
            <p class="announcements-centered-desc">
                Yeni dönem online kampları, canlı atölyeler ve stüdyo etkinlik takvimi.
            </p>
        </div>
    </header>

    <!-- 2. İki Kolonlu Split Sahne: Sol Dikey Kutu Listesi + Sağ Açık Kart -->
    <section class="announcements-stage-section">
        <div class="container" style="max-width: 1240px;">
            <div class="announcements-split-layout">
                
                <!-- SOL KOLON: Dikey Kutu Listesi (Kullanıcı İsteği: Sol Tarafta Kutu Listesi) -->
                <aside class="announcements-sidebar-strip">
                    <div class="sidebar-sticky-wrapper">
                        <div class="sidebar-kicker-title">DUYURU LİSTESİ</div>

                        <div class="sidebar-cards-list" role="tablist" aria-label="Duyurular Listesi">
                            <?php foreach ($announcements as $idx => $item): ?>
                                <?php 
                                    $isActive = ($idx === 0);
                                    $symbol = $symbols[$idx % count($symbols)];
                                    $shortTitle = $item['short_title'] ?? $item['title'];
                                ?>
                                <button type="button" 
                                        class="slumber-side-card <?= $isActive ? 'is-active' : '' ?>"
                                        data-index="<?= $idx ?>"
                                        id="sidebar-card-<?= (int)$item['id'] ?>"
                                        role="tab"
                                        aria-selected="<?= $isActive ? 'true' : 'false' ?>"
                                        aria-controls="stage-card-<?= (int)$item['id'] ?>">
                                    
                                    <div class="side-card-top">
                                        <div class="side-card-title-group">
                                            <span class="side-card-num"><?= htmlspecialchars((string)$item['number']) ?>.</span>
                                            <span class="side-card-title"><?= htmlspecialchars((string)$shortTitle) ?></span>
                                        </div>
                                        <span class="side-card-symbol" aria-hidden="true"><?= $symbol ?></span>
                                    </div>

                                    <div class="side-card-bottom">
                                        <span class="side-card-date"><?= htmlspecialchars((string)$item['date']) ?></span>
                                        <span class="side-card-arrow" aria-hidden="true">&rarr;</span>
                                    </div>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </aside>

                <!-- SAĞ KOLON: Aktif Açılan Büyük Kart Alanı (İçerik Sahnesi) -->
                <main class="announcements-main-stage">
                    <?php foreach ($announcements as $idx => $item): ?>
                        <?php 
                            $isActive = ($idx === 0);
                            $symbol = $symbols[$idx % count($symbols)];
                        ?>
                        <article class="stage-expanded-card <?= $isActive ? 'is-active' : '' ?>" 
                                 id="stage-card-<?= (int)$item['id'] ?>"
                                 data-index="<?= $idx ?>"
                                 role="region"
                                 aria-labelledby="sidebar-card-<?= (int)$item['id'] ?>">
                            
                            <div class="stage-card-inner">
                                <!-- Üst Satır: Kategori, Tarih ve Sembol -->
                                <div class="stage-card-meta-bar">
                                    <div class="stage-meta-left">
                                        <span class="stage-num-badge"><?= htmlspecialchars((string)$item['number']) ?>. BİLDİRİ</span>
                                        <span class="stage-meta-sep">&bull;</span>
                                        <span class="stage-date">📅 <?= htmlspecialchars((string)$item['date']) ?></span>
                                        <?php if (!empty($item['category'])): ?>
                                            <span class="stage-meta-sep">&bull;</span>
                                            <span class="stage-category"><?= htmlspecialchars((string)$item['category']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <span class="stage-card-symbol" aria-hidden="true"><?= $symbol ?></span>
                                </div>

                                <!-- Başlık -->
                                <h2 class="stage-card-title"><?= htmlspecialchars((string)$item['title']) ?></h2>

                                <!-- Konum -->
                                <?php if (!empty($item['location'])): ?>
                                    <div class="stage-card-location">
                                        📍 <?= htmlspecialchars((string)$item['location']) ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Özet Vurgusu -->
                                <?php if (!empty($item['summary'])): ?>
                                    <div class="stage-card-lead">
                                        <p><?= htmlspecialchars((string)$item['summary']) ?></p>
                                    </div>
                                <?php endif; ?>

                                <!-- Tam Duyuru Metni -->
                                <div class="stage-card-prose">
                                    <p><?= nl2br(htmlspecialchars((string)$item['content'])) ?></p>
                                </div>

                                <!-- Detay Maddeleri -->
                                <?php if (!empty($item['details']) && is_array($item['details'])): ?>
                                    <ul class="stage-card-bullets">
                                        <?php foreach ($item['details'] as $det): ?>
                                            <li>
                                                <span class="bullet-icon" aria-hidden="true">✦</span>
                                                <span><?= htmlspecialchars((string)$det) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <!-- Aksiyon Butonu & Mühür -->
                                <?php if (!empty($item['cta_text'])): ?>
                                    <div class="stage-card-footer">
                                        <a href="<?= htmlspecialchars((string)$item['cta_link']) ?>" 
                                           target="<?= str_starts_with((string)$item['cta_link'], 'http') ? '_blank' : '_self' ?>"
                                           rel="noopener noreferrer" 
                                           class="stage-cta-btn">
                                            <span><?= htmlspecialchars((string)$item['cta_text']) ?></span>
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                <polyline points="12 5 19 12 12 19"></polyline>
                                            </svg>
                                        </a>
                                        <span class="stage-archive-tag">FİZYOBAR RESMİ DUYURUSU</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </article>
                    <?php endforeach; ?>
                </main>

            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sideCards = document.querySelectorAll('.slumber-side-card');
    const stageCards = document.querySelectorAll('.stage-expanded-card');

    sideCards.forEach(card => {
        card.addEventListener('click', function() {
            const index = this.getAttribute('data-index');

            sideCards.forEach(c => {
                c.classList.remove('is-active');
                c.setAttribute('aria-selected', 'false');
            });
            stageCards.forEach(s => {
                s.classList.remove('is-active');
            });

            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            const target = document.querySelector(`.stage-expanded-card[data-index="${index}"]`);
            if (target) {
                target.classList.add('is-active');
                
                // Mobilde aktif kart açılınca hafifçe görünür alana kaydır
                if (window.innerWidth <= 960) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
});
</script>
