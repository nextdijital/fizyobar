<?php
declare(strict_types=1);

$announcements = $announcements ?? [];
$defaultImages = [
    asset('assets/images/betina-outdoor-stretch.jpg'),
    asset('assets/images/betina-studio-forward-fold.jpg'),
    asset('assets/images/kitchen-hero-plate.webp'),
    asset('assets/images/betina-user-photo1.jpg'),
    asset('assets/images/betina-outdoor-inversion.jpg'),
];
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

    <!-- 2. Kartlı Vitrin Bölümü (Modern Kartlar + Sağ Alt İçe Kavisli Çentik & Sola Çapraz Ok Butonu) -->
    <section class="announcements-stage-section">
        <div class="announcements-showcase-shell">
            <div class="anno-showcase-grid">
                <?php foreach ($announcements as $idx => $item): ?>
                    <?php 
                        $rawImg = !empty($item['image']) ? $item['image'] : $defaultImages[$idx % count($defaultImages)];
                        if (str_starts_with((string)$rawImg, 'http')) {
                            $imgUrl = $rawImg;
                        } else {
                            $cleanImgPath = ltrim(str_replace('/fizyobar/', '', (string)$rawImg), '/');
                            $imgUrl = asset($cleanImgPath);
                        }
                        $isFirst = ($idx === 0);
                        $shortTitle = $item['short_title'] ?? $item['title'];
                    ?>
                    <article class="anno-visual-card <?= $isFirst ? 'is-featured' : '' ?>" 
                             data-index="<?= $idx ?>"
                             data-id="<?= (int)$item['id'] ?>"
                             role="button"
                             tabindex="0"
                             aria-haspopup="dialog"
                             aria-label="<?= htmlspecialchars((string)$item['title']) ?>">
                        
                        <!-- Arka Plan Görseli & Şeffaf Gradyan Karartması -->
                        <div class="anno-card-bg-wrap">
                            <img src="<?= htmlspecialchars((string)$imgUrl) ?>" 
                                 alt="<?= htmlspecialchars((string)$item['title']) ?>" 
                                 class="anno-card-bg"
                                 loading="lazy">
                            <div class="anno-card-overlay"></div>
                        </div>

                        <!-- Kart Üst Rozet / Kategori -->
                        <div class="anno-card-top">
                            <span class="anno-pill-tag"><?= htmlspecialchars((string)($item['badge'] ?? $item['category'] ?? 'Duyuru')) ?></span>
                        </div>

                        <!-- Kart Sol Alt Bilgi Alanı -->
                        <div class="anno-card-bottom-info">
                            <span class="anno-card-date"><?= htmlspecialchars((string)$item['date']) ?></span>
                            <h3 class="anno-card-title"><?= htmlspecialchars((string)$shortTitle) ?></h3>
                            <?php if (!empty($item['location'])): ?>
                                <span class="anno-card-location">📍 <?= htmlspecialchars((string)$item['location']) ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- SAĞ ALT KÖŞE ÇENTİĞİ (VEKTÖREL SVG İLE KUSURSUZ KAVİS - KARE BEYAZLIK OLUŞTURMAZ) -->
                        <div class="anno-corner-cutout" aria-hidden="true">
                            <svg class="anno-corner-svg" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M 70 0 A 22 22 0 0 0 48 22 A 28 28 0 0 1 22 48 A 22 22 0 0 0 0 70 L 70 70 Z" fill="#ffffff"/>
                            </svg>
                            <div class="anno-circle-btn" title="Detayları İncele">
                                <!-- SOLA ÇAPRAZ OK (↖ - KARTI GÖSTEREN YÖN) -->
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="17" y1="17" x2="7" y2="7"></line>
                                    <polyline points="17 7 7 7 7 17"></polyline>
                                </svg>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 3. Sade Duyuru Detay Modalı (Marka Fontu, Koyu Bordo Dolgulu Buton & Sade İçerik) -->
    <div class="anno-modal-backdrop" id="annoModal" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="anno-modal-dialog">
            <button type="button" class="anno-modal-close" id="annoModalClose" aria-label="Kapat">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div class="anno-modal-body">
                <!-- Üst Minimal Meta -->
                <div class="anno-modal-meta">
                    <span class="anno-modal-badge" id="modalBadge">BİLDİRİ</span>
                    <span class="anno-modal-dot">&bull;</span>
                    <span class="anno-modal-date" id="modalDate">-</span>
                </div>

                <!-- Sade Başlık -->
                <h2 class="anno-modal-title" id="modalTitle">-</h2>
                
                <!-- Konum -->
                <div class="anno-modal-location" id="modalLocationWrap">
                    <span id="modalLocation">-</span>
                </div>

                <!-- Sade Açıklama Metni -->
                <div class="anno-modal-prose">
                    <p id="modalContent">-</p>
                </div>

                <!-- Dolgulu Aksiyon Butonu & Marka Fontu (Kibar, Dengeli & Kusursuz Türkçe) -->
                <div class="anno-modal-footer">
                    <a href="#" target="_blank" rel="noopener noreferrer" class="stage-cta-btn" id="modalCtaBtn">
                        <span id="modalCtaText">Detaylı Bilgi &amp; WhatsApp</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal ve Kart Verileri JS -->
<script>
window.__ANNOUNCEMENTS_DATA__ = <?= json_encode($announcements, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.anno-visual-card');
    const modal = document.getElementById('annoModal');
    const closeBtn = document.getElementById('annoModalClose');

    const mBadge = document.getElementById('modalBadge');
    const mDate = document.getElementById('modalDate');
    const mTitle = document.getElementById('modalTitle');
    const mLocationWrap = document.getElementById('modalLocationWrap');
    const mLocation = document.getElementById('modalLocation');
    const mContent = document.getElementById('modalContent');
    const mCtaBtn = document.getElementById('modalCtaBtn');
    const mCtaText = document.getElementById('modalCtaText');

    function openAnnouncement(idx) {
        const item = window.__ANNOUNCEMENTS_DATA__[idx];
        if (!item) return;

        mBadge.textContent = item.badge || item.category || 'Bildiri';
        mDate.textContent = item.date || '';
        mTitle.textContent = item.title || '';

        if (item.location) {
            mLocation.textContent = '📍 ' + item.location;
            mLocationWrap.style.display = 'block';
        } else {
            mLocationWrap.style.display = 'none';
        }

        mContent.textContent = item.content || item.summary || '';

        if (item.cta_link) {
            mCtaBtn.href = item.cta_link;
            mCtaText.textContent = item.cta_text || 'Detaylı Bilgi & WhatsApp';
            mCtaBtn.style.display = 'inline-flex';
        } else {
            mCtaBtn.style.display = 'none';
        }

        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    cards.forEach(card => {
        card.addEventListener('click', function() {
            const idx = parseInt(this.getAttribute('data-index'), 10);
            openAnnouncement(idx);
        });

        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const idx = parseInt(this.getAttribute('data-index'), 10);
                openAnnouncement(idx);
            }
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('is-open')) {
            closeModal();
        }
    });
});
</script>
