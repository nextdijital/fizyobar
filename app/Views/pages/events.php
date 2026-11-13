<?php
declare(strict_types=1);

$hideFooter = true;
$events = $events ?? [];
?>

<style>
/* Etkinlik Sayfasında Sayfa Dikey Kaydırmasını Tamamen Engelle */
html, body {
    overflow: hidden !important;
    height: 100% !important;
    max-height: 100vh !important;
}
body > .main-content {
    overflow: hidden !important;
    height: calc(100vh - 110px) !important;
    max-height: calc(100vh - 110px) !important;
    padding: 0 !important;
    margin: 0 !important;
}
</style>

<div class="events-horizontal-viewport" id="eventsViewport">
    <!-- 1. Yatay Genişleyen Şeritler Parkuru (Horizontal Stripe Slider) -->
    <div class="events-stripe-track" id="eventsStripeTrack" role="region" aria-label="Etkinlikler Galerisi">
        <?php foreach ($events as $index => $ev): ?>
            <?php 
                $isActive = ($index === 0);
                $padNum = str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT);
            ?>
            <article class="event-stripe-panel <?= $isActive ? 'is-expanded' : '' ?>"
                     data-index="<?= $index ?>"
                     data-id="<?= (int)$ev['id'] ?>"
                     style="--stripe-color: <?= htmlspecialchars($ev['color']) ?>; --stripe-text: <?= htmlspecialchars($ev['text_color']) ?>;"
                     tabindex="0"
                     role="button"
                     aria-expanded="<?= $isActive ? 'true' : 'false' ?>"
                     aria-label="<?= htmlspecialchars((string)$ev['title']) ?>">
                
                <!-- Arka Plan Katmanı (Görsel + Karartma Gradyanı) -->
                <div class="event-panel-bg" style="background-image: url('<?= htmlspecialchars((string)$ev['image']) ?>');">
                    <div class="event-panel-overlay"></div>
                </div>

                <!-- Dikey Dar Şerit İçeriği (Collapsed Stripe Tab) -->
                <div class="event-stripe-tab">
                    <div class="event-stripe-tab-top">
                        <span class="event-stripe-tab-num"><?= $padNum ?></span>
                    </div>
                    <div class="event-stripe-tab-label">
                        <span class="event-stripe-tab-text"><?= htmlspecialchars((string)$ev['short_title']) ?></span>
                    </div>
                    <div class="event-stripe-tab-bottom">
                        <span class="event-stripe-tab-indicator" aria-hidden="true">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 8 8 12 12 16"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Genişlemiş İçerik Alanı -->
                <div class="event-expanded-content">
                    <!-- Sol Alt Köşe Beyaz Kutu: Sadece Konum, Büyük Başlık ve Açıklama -->
                    <div class="event-white-card">
                        <div class="event-white-card-loc">
                            📍 <?= htmlspecialchars((string)$ev['location']) ?>
                        </div>

                        <h2 class="event-white-card-title"><?= htmlspecialchars((string)$ev['title']) ?></h2>

                        <p class="event-white-card-desc">
                            <?= htmlspecialchars((string)$ev['description']) ?>
                        </p>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <!-- 2. Sağ Alt Gezinme Okları (Next / Prev) -->
    <div class="events-nav-controls" aria-label="Etkinlik Gezinme">
        <button type="button" class="events-nav-btn prev" id="eventsNavPrev" aria-label="Önceki Etkinlik" title="Önceki">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <span class="events-nav-divider" aria-hidden="true"></span>
        <button type="button" class="events-nav-btn next" id="eventsNavNext" aria-label="Sonraki Etkinlik" title="Sonraki">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('eventsStripeTrack');
    const panels = Array.from(document.querySelectorAll('.event-stripe-panel'));
    const prevBtn = document.getElementById('eventsNavPrev');
    const nextBtn = document.getElementById('eventsNavNext');

    if (!track || panels.length === 0) return;

    function activatePanel(panel) {
        if (!panel) return;

        panels.forEach(p => {
            p.classList.remove('is-expanded');
            p.setAttribute('aria-expanded', 'false');
        });

        panel.classList.add('is-expanded');
        panel.setAttribute('aria-expanded', 'true');

        // Sadece panel görünür alanın dışına taşmışsa sakin bir şekilde görünür alana al
        const rect = panel.getBoundingClientRect();
        const trackRect = track.getBoundingClientRect();
        if (rect.left < trackRect.left || rect.right > trackRect.right) {
            panel.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'nearest'
            });
        }
    }

    panels.forEach(panel => {
        panel.addEventListener('click', function() {
            activatePanel(this);
        });
        panel.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                activatePanel(this);
            }
        });
    });

    // Sonraki / Önceki Butonları
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const current = track.querySelector('.event-stripe-panel.is-expanded');
            const currentIndex = panels.indexOf(current);
            const nextIndex = (currentIndex + 1) % panels.length;
            activatePanel(panels[nextIndex]);
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const current = track.querySelector('.event-stripe-panel.is-expanded');
            const currentIndex = panels.indexOf(current);
            const prevIndex = (currentIndex - 1 + panels.length) % panels.length;
            activatePanel(panels[prevIndex]);
        });
    }

    // Klavye Yön Tuşları
    window.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') {
            nextBtn && nextBtn.click();
        } else if (e.key === 'ArrowLeft') {
            prevBtn && prevBtn.click();
        }
    });

    // Fare Tekerleği ile Yatay Kaydırma
    track.addEventListener('wheel', function(e) {
        if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
            e.preventDefault();
            track.scrollLeft += e.deltaY * 1.15;
        }
    }, { passive: false });
});
</script>
