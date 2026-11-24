<?php
declare(strict_types=1);

$events = $events ?? [];
$totalEvents = count($events);
$firstEvent = $events[0] ?? null;

// Sonsuz döngü: Ekran kenarlarında asla boşluk kalmaması için 3 set
$loopSets = [0, 1, 2];

// Her etkinlik için veya genel galeri için kare döngü fotoğrafları
$galleryPool = [
    ['img' => asset('assets/images/betina-outdoor-stretch.jpg'), 'title' => 'Açık Hava & Vinyasa Akışı', 'loc' => 'Merkez Park'],
    ['img' => asset('assets/images/betina-outdoor-inversion.jpg'), 'title' => 'Mobilite & Core Denge', 'loc' => 'Festival Alanı'],
    ['img' => asset('assets/images/hero-poster.jpg'), 'title' => 'Gün Batımı Meditasyonu', 'loc' => 'Seyhan Kıyısı'],
    ['img' => asset('assets/images/betina-user-photo1.jpg'), 'title' => 'Platform & Su Dengesi', 'loc' => 'Seyhan Gölü'],
    ['img' => asset('assets/images/betina-user-photo2.jpg'), 'title' => 'Marina & Buz Banyosu', 'loc' => 'Backyard Marina'],
    ['img' => asset('assets/images/betina-studio-forward-fold.jpg'), 'title' => 'Teras & Müzik Akışı', 'loc' => 'Hotel Bosnalı'],
    ['img' => asset('assets/images/Gemini_Generated_Image_87r04087r04087r0.jpg'), 'title' => 'Tarih & Ses Çanağı Banyosu', 'loc' => 'Arkeoloji Müzesi'],
    ['img' => asset('assets/images/Gemini_Generated_Image_zcs2kozcs2kozcs2.jpg'), 'title' => 'Topluluk & İksir Molası', 'loc' => 'Bar Kitchen'],
];
?>

<div class="events-page-wrapper">

    <!-- 1. ÜST ALAN: 3D PERSPECTIVE INFINITE FILMSTRIP (TAMAMEN BUTONSUZ, SAF SANATSAL KARTLAR) -->
    <section class="fzy-events-hero" id="eventsHero">
        <div class="fzy-events-hero-topbar">
            <div class="fzy-events-hero-kicker">
                <span>FİZYOBAR BULUŞMALARI</span>
                <span>/</span>
                <span style="opacity: 0.7;">SEZON 2024 — 2025</span>
            </div>
            <div class="fzy-events-hero-count" id="heroEventCounter">
                [ 01 / <?= str_pad((string)$totalEvents, 2, '0', STR_PAD_LEFT) ?> ]
            </div>
        </div>

        <!-- Sonsuz Döngü Filmstrip Viewport & Rayı -->
        <div class="fzy-filmstrip-viewport" id="filmstripViewport">
            <div class="fzy-filmstrip-track" id="filmstripTrack" role="region" aria-label="Sonsuz Etkinlik Galerisi">
                <?php foreach ($loopSets as $setIndex): ?>
                    <?php foreach ($events as $index => $ev): ?>
                        <?php 
                            $globalIndex = ($setIndex * $totalEvents) + $index;
                            $isInitialActive = ($setIndex === 1 && $index === 0);
                            $padNum = str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT);
                            $headerText = 'KEŞFET: ' . mb_strtoupper((string)$ev['title'], 'UTF-8');
                            $metaText = mb_strtoupper((string)$ev['location'], 'UTF-8') . ' • ' . mb_strtoupper((string)$ev['date_badge'], 'UTF-8');
                            // Kısa ve öz açıklama
                            $shortDesc = (string)($ev['description'] ?? $ev['long_description']);
                            if (mb_strlen($shortDesc, 'UTF-8') > 190) {
                                $shortDesc = mb_substr($shortDesc, 0, 185, 'UTF-8') . '...';
                            }
                        ?>
                        <div class="fzy-film-item <?= $isInitialActive ? 'is-active' : '' ?>"
                             id="filmItem-<?= $globalIndex ?>"
                             data-global-index="<?= $globalIndex ?>"
                             data-event-index="<?= $index ?>"
                             data-id="<?= (int)$ev['id'] ?>"
                             data-num="<?= $padNum ?>"
                             data-title="<?= htmlspecialchars((string)$ev['title']) ?>"
                             data-subtitle="<?= htmlspecialchars((string)($ev['subtitle'] ?? '')) ?>"
                             data-spot="<?= htmlspecialchars((string)($ev['spot'] ?? '')) ?>"
                             data-image="<?= htmlspecialchars((string)$ev['image']) ?>"
                             data-badge="<?= htmlspecialchars((string)$ev['badge']) ?>"
                             data-date="<?= htmlspecialchars((string)$ev['date_badge']) ?>"
                             data-time="<?= htmlspecialchars((string)$ev['time_text']) ?>"
                             data-location="<?= htmlspecialchars((string)$ev['location']) ?>"
                             data-capacity="<?= htmlspecialchars((string)$ev['capacity']) ?>"
                             data-price="<?= htmlspecialchars((string)$ev['price_text']) ?>"
                             data-desc="<?= htmlspecialchars($shortDesc) ?>"
                             data-includes='<?= json_encode($ev['includes'] ?? [], JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
                             data-watext="<?= rawurlencode((string)$ev['wa_text']) ?>"
                             tabindex="0"
                             role="button"
                             aria-label="<?= htmlspecialchars((string)$ev['title']) ?>">

                            <!-- Kart Üstü Editoryal Başlık (Aktif Kartta Görünür - 1:1 Screenshot Tasarımı) -->
                            <div class="fzy-film-header">
                                <span class="fzy-film-header-num">[ <?= $padNum ?> ]</span>
                                <h2 class="fzy-film-header-title"><?= htmlspecialchars($headerText) ?></h2>
                                <span class="fzy-film-header-meta"><?= htmlspecialchars($metaText) ?></span>
                            </div>

                            <!-- 3D Origami Katlanmış Kart Posteri (Üzerinde Buton Yoktur - Saf Fotoğraf Objesi) -->
                            <div class="fzy-film-card">
                                <img src="<?= htmlspecialchars((string)$ev['image']) ?>" 
                                     alt="<?= htmlspecialchars((string)$ev['title']) ?>" 
                                     class="fzy-film-card-img" 
                                     loading="<?= $isInitialActive ? 'eager' : 'lazy' ?>">
                                <div class="fzy-film-card-overlay"></div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- 2. SCROLL-DOWN SEÇİLİ ETKİNLİK DETAY ALANI (KISALTILMIŞ ÖZ YAZI + KARE KAYDIRMALI DÖNGÜ GALERİSİ) -->
    <!-- Kullanıcı Talebi: "etkinlik açıklama yazısını kısalt biraz daha. görseller de kaydırmalı döngüde olsun kare olarak, üzerine gelindiğinde dursun ve tıklayınca büyüsün" -->
    <?php if ($firstEvent): ?>
    <?php 
        $initialDesc = (string)($firstEvent['description'] ?? $firstEvent['long_description']);
        if (mb_strlen($initialDesc, 'UTF-8') > 190) {
            $initialDesc = mb_substr($initialDesc, 0, 185, 'UTF-8') . '...';
        }
    ?>
    <section class="fzy-event-story-section" id="activeEventStory">
        <div class="fzy-event-story-inner">

            <!-- Başlık ve Meta Bilgiler (Kutusuz, Sade Çizgili) -->
            <header class="fzy-story-head">
                <div class="fzy-story-top-row">
                    <span class="fzy-story-badge" id="storyBadge"><?= htmlspecialchars((string)$firstEvent['badge']) ?></span>
                    <span class="fzy-story-sep">•</span>
                    <span class="fzy-story-index-tag" id="storyIndexTag">[ 01 / SEÇİLİ ETKİNLİK BULUŞMASI ]</span>
                </div>
                
                <h1 class="fzy-story-title" id="storyTitle"><?= htmlspecialchars((string)$firstEvent['title']) ?></h1>
                <p class="fzy-story-spot" id="storySpot"><?= htmlspecialchars((string)($firstEvent['spot'] ?? $firstEvent['subtitle'] ?? '')) ?></p>

                <!-- Kutusuz Tek Satır Meta Künye -->
                <div class="fzy-story-inline-meta">
                    <div class="fzy-story-meta-item">
                        <span class="fzy-story-meta-label">Tarih:</span>
                        <span class="fzy-story-meta-val" id="storyDate"><?= htmlspecialchars((string)$firstEvent['date_badge']) ?></span>
                    </div>
                    <div class="fzy-story-meta-item">
                        <span class="fzy-story-meta-label">Saat:</span>
                        <span class="fzy-story-meta-val" id="storyTime"><?= htmlspecialchars((string)$firstEvent['time_text']) ?></span>
                    </div>
                    <div class="fzy-story-meta-item">
                        <span class="fzy-story-meta-label">Buluşma:</span>
                        <span class="fzy-story-meta-val" id="storyLocation"><?= htmlspecialchars((string)$firstEvent['location']) ?></span>
                    </div>
                    <div class="fzy-story-meta-item">
                        <span class="fzy-story-meta-label">Kontenjan:</span>
                        <span class="fzy-story-meta-val" id="storyCapacity"><?= htmlspecialchars((string)$firstEvent['capacity']) ?></span>
                    </div>
                </div>
            </header>

            <!-- Kısaltılmış, Öz ve Ferah Okuma Akışı -->
            <div class="fzy-story-reading-flow">
                
                <p class="fzy-story-lead-p" id="storyDesc">
                    <?= htmlspecialchars($initialDesc) ?>
                </p>

                <!-- Kutusuz Sade 2 Kolon: Akış ve Neler Dahil -->
                <div class="fzy-story-simple-details">
                    <div>
                        <h4 class="fzy-story-detail-col-title">Program Akışı</h4>
                        <ul class="fzy-story-simple-list">
                            <li>09:30 — Karşılama, Matcha & Fonksiyonel İksir Servisi</li>
                            <li>09:45 — Postür Analizi, Nefes & Dinamik Akış</li>
                            <li>11:00 — Derin Meditasyon & Ses Çanağı Frekansı</li>
                            <li>11:30 — Sağlıklı İkramlar & Topluluk Sohbeti</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="fzy-story-detail-col-title">Buluşmaya Dahil Olanlar</h4>
                        <ul class="fzy-story-simple-list" id="storyIncludesList">
                            <?php foreach (($firstEvent['includes'] ?? []) as $inc): ?>
                                <li><?= htmlspecialchars((string)$inc) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- KARE KAYDIRMALI DÖNGÜ GALERİSİ (HOVER PAUSE & TIKLAYINCA BÜYÜME) -->
                <div class="fzy-square-marquee-section" id="squareMarqueeSection">
                    <div class="fzy-square-marquee-track" id="squareMarqueeTrack">
                        <!-- Çift set döngüsü ile kesintisiz sonsuz kaydırma -->
                        <?php for ($k = 0; $k < 2; $k++): ?>
                            <?php foreach ($galleryPool as $pIndex => $photo): ?>
                                <div class="fzy-square-photo-item" 
                                     data-full="<?= htmlspecialchars($photo['img']) ?>"
                                     data-caption="<?= htmlspecialchars($photo['title'] . ' • ' . $photo['loc']) ?>"
                                     onclick="window.openFzyLightbox('<?= htmlspecialchars($photo['img']) ?>', '<?= htmlspecialchars($photo['title'] . ' • ' . $photo['loc']) ?>')">
                                    <img src="<?= htmlspecialchars($photo['img']) ?>" 
                                         alt="<?= htmlspecialchars($photo['title']) ?>" 
                                         class="fzy-square-img" 
                                         loading="lazy">
                                    <div class="fzy-square-overlay-badge">
                                        <span><?= htmlspecialchars($photo['title']) ?></span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Alt Etkinlik Değiştirme Butonları -->
                <div class="fzy-story-footer-action">
                    <div class="fzy-story-nav-switcher">
                        <button type="button" class="fzy-story-switch-btn prev" id="storyPrevBtn" aria-label="Önceki Etkinlik">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            <span>Önceki Etkinlik</span>
                        </button>
                        <button type="button" class="fzy-story-switch-btn next" id="storyNextBtn" aria-label="Sonraki Etkinlik">
                            <span>Sonraki Etkinlik</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <?php endif; ?>


    <!-- 3. SEZON TAKVİMİ -->
    <section class="events-schedule-section" id="eventsSchedule">
        <div class="schedule-header-wrap">
            <div>
                <span class="schedule-kicker">2024 — 2025 BULUŞMA LİSTESİ</span>
                <h2 class="schedule-title">Sezon Etkinlik Takvimi</h2>
            </div>
            <div>
                <a href="https://wa.me/905357056828?text=Merhaba,%20tüm%20sezon%20etkinlik%20takvimi%20hakkında%20bilgi%20almak%20istiyorum." 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   style="color: #d19ba5; font-weight: 800; font-size: 0.85rem; text-decoration: none; text-transform: uppercase; letter-spacing: 0.08em;">
                    Tüm Sezonu Danışın →
                </a>
            </div>
        </div>

        <div class="schedule-list-container">
            <?php foreach ($events as $idx => $item): ?>
                <?php $padIdx = str_pad((string)($idx + 1), 2, '0', STR_PAD_LEFT); ?>
                <div class="schedule-row" 
                     onclick="window.selectEventByOriginIndex(<?= $idx ?>); document.getElementById('activeEventStory')?.scrollIntoView({ behavior: 'smooth' });">
                    <div class="schedule-row-inner">
                        <span class="schedule-date-num"><?= $padIdx ?></span>
                        
                        <div class="schedule-badge-col">
                            <span><?= htmlspecialchars((string)$item['badge']) ?></span>
                        </div>

                        <div class="schedule-main-info">
                            <h4 class="schedule-item-title"><?= htmlspecialchars((string)$item['title']) ?></h4>
                            <span class="schedule-item-loc">📍 <?= htmlspecialchars((string)$item['location']) ?> • <?= htmlspecialchars((string)$item['date_badge']) ?> • <?= htmlspecialchars((string)$item['time_text']) ?></span>
                        </div>

                        <div class="schedule-quota-info">
                            <span><?= htmlspecialchars((string)$item['capacity']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</div>


<!-- TIKLAYINCA BÜYÜYEN LIGHTBOX MODAL -->
<div class="fzy-lightbox-modal" id="fzyLightbox" onclick="window.closeFzyLightbox()">
    <div class="fzy-lightbox-content" onclick="event.stopPropagation();">
        <button type="button" class="fzy-lightbox-close-btn" onclick="window.closeFzyLightbox()" aria-label="Kapat">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
        <img src="" alt="Etkinlik Fotoğrafı" class="fzy-lightbox-img" id="fzyLightboxImg">
        <div class="fzy-lightbox-caption" id="fzyLightboxCaption"></div>
    </div>
</div>


<!-- JAVASCRIPT: BUTTERY-SMOOTH INFINITE LOOP 3D CAROUSEL & REAL-TIME STORY SYNC & LIGHTBOX -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewport = document.getElementById('filmstripViewport');
    const track = document.getElementById('filmstripTrack');
    const items = Array.from(document.querySelectorAll('.fzy-film-item'));
    const prevBtn = document.getElementById('filmPrevBtn');
    const nextBtn = document.getElementById('filmNextBtn');
    const storyPrevBtn = document.getElementById('storyPrevBtn');
    const storyNextBtn = document.getElementById('storyNextBtn');
    const counterEl = document.getElementById('heroEventCounter');

    // Kutusuz sade detay alanı elemanları
    const storyBadge = document.getElementById('storyBadge');
    const storyIndexTag = document.getElementById('storyIndexTag');
    const storyTitle = document.getElementById('storyTitle');
    const storySpot = document.getElementById('storySpot');
    const storyDate = document.getElementById('storyDate');
    const storyTime = document.getElementById('storyTime');
    const storyLocation = document.getElementById('storyLocation');
    const storyCapacity = document.getElementById('storyCapacity');
    const storyPrice = document.getElementById('storyPrice');
    const storyDesc = document.getElementById('storyDesc');
    const storyIncludesList = document.getElementById('storyIncludesList');
    const storySection = document.getElementById('activeEventStory');

    // Lightbox Elemanları
    const lightboxModal = document.getElementById('fzyLightbox');
    const lightboxImg = document.getElementById('fzyLightboxImg');
    const lightboxCaption = document.getElementById('fzyLightboxCaption');

    window.openFzyLightbox = function (imgSrc, captionText) {
        if (!lightboxModal || !lightboxImg) return;
        lightboxImg.src = imgSrc;
        if (lightboxCaption) lightboxCaption.textContent = captionText || '';
        lightboxModal.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    };

    window.closeFzyLightbox = function () {
        if (!lightboxModal) return;
        lightboxModal.classList.remove('is-open');
        document.body.style.overflow = '';
    };

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lightboxModal && lightboxModal.classList.contains('is-open')) {
            window.closeFzyLightbox();
        }
    });

    const totalUnique = <?= (int)$totalEvents ?>;

    // Başlangıç: Ortadaki setin (Set 1) ilk etkinliği (globalIndex = totalUnique = 7)
    let currentGlobalIndex = totalUnique;
    let isAnimating = false;

    // Hedef kartı viewport merkezine hizala
    function updateTrackPosition(animate = true) {
        if (!track || !viewport || items.length === 0) return;

        const activeItem = items[currentGlobalIndex];
        if (!activeItem) return;

        // Aktif kart sınıfını güncelle
        items.forEach((item, idx) => {
            if (idx === currentGlobalIndex) {
                item.classList.add('is-active');
            } else {
                item.classList.remove('is-active');
            }
        });

        const itemLeft = activeItem.offsetLeft;
        const itemWidth = activeItem.offsetWidth;
        const viewportWidth = viewport.offsetWidth;
        const targetTranslateX = - (itemLeft - (viewportWidth / 2) + (itemWidth / 2));

        if (animate) {
            track.style.transition = 'transform 0.65s cubic-bezier(0.16, 1, 0.3, 1)';
            isAnimating = true;
        } else {
            track.style.transition = 'none';
        }

        track.style.transform = `translate3d(${targetTranslateX}px, 0, 0)`;

        // Sayaç ve alt detayları güncelle
        const originIndex = parseInt(activeItem.dataset.eventIndex, 10);
        updateStoryAndCounter(originIndex, activeItem);
    }

    // Sayaç ve Detay Metnini Güncelle (Kısaltılmış Öz Metin)
    function updateStoryAndCounter(originIndex, activeItem) {
        const padNum = String(originIndex + 1).padStart(2, '0');
        const padTotal = String(totalUnique).padStart(2, '0');

        if (counterEl) {
            counterEl.textContent = `[ ${padNum} / ${padTotal} ]`;
        }

        if (storySection && activeItem) {
            storySection.style.opacity = '0.35';
            storySection.style.transform = 'translateY(6px)';

            setTimeout(() => {
                const title = activeItem.dataset.title || '';
                const spot = activeItem.dataset.spot || activeItem.dataset.subtitle || '';
                const badge = activeItem.dataset.badge || '';
                const date = activeItem.dataset.date || '';
                const time = activeItem.dataset.time || '';
                const location = activeItem.dataset.location || '';
                const capacity = activeItem.dataset.capacity || '';
                const price = activeItem.dataset.price || '';
                const desc = activeItem.dataset.desc || '';
                const waText = activeItem.dataset.watext || '';
                
                let includes = [];
                try {
                    includes = JSON.parse(activeItem.dataset.includes || '[]');
                } catch(e) {
                    includes = [];
                }

                // Metin alanlarını güncelle
                if (storyBadge) storyBadge.textContent = badge;
                if (storyIndexTag) storyIndexTag.textContent = `[ ${padNum} / SEÇİLİ ETKİNLİK BULUŞMASI ]`;
                if (storyTitle) storyTitle.textContent = title;
                if (storySpot) storySpot.textContent = spot;
                if (storyDate) storyDate.textContent = date;
                if (storyTime) storyTime.textContent = time;
                if (storyLocation) storyLocation.textContent = location;
                if (storyCapacity) storyCapacity.textContent = capacity;
                if (storyPrice) storyPrice.textContent = price;
                if (storyDesc) storyDesc.textContent = desc;

                if (storyIncludesList) {
                    storyIncludesList.innerHTML = '';
                    includes.forEach(inc => {
                        const li = document.createElement('li');
                        li.textContent = inc;
                        storyIncludesList.appendChild(li);
                    });
                }

                storySection.style.opacity = '1';
                storySection.style.transform = 'translateY(0)';
            }, 140);
        }
    }

    // Dikişsiz Sonsuz Döngü Reset Mekanizması
    track.addEventListener('transitionend', function (e) {
        if (e.target !== track) return;
        isAnimating = false;

        if (currentGlobalIndex >= totalUnique * 2) {
            currentGlobalIndex -= totalUnique;
            updateTrackPosition(false);
        } else if (currentGlobalIndex < totalUnique) {
            currentGlobalIndex += totalUnique;
            updateTrackPosition(false);
        }
    });

    function nextSlide() {
        if (isAnimating) return;
        currentGlobalIndex++;
        updateTrackPosition(true);
    }

    function prevSlide() {
        if (isAnimating) return;
        currentGlobalIndex--;
        updateTrackPosition(true);
    }

    function scrollToStoryHead() {
        const storyEl = document.getElementById('activeEventStory');
        if (storyEl) {
            const header = document.getElementById('siteHeader');
            const headerHeight = header ? header.offsetHeight : 70;
            const targetY = storyEl.getBoundingClientRect().top + window.pageYOffset - headerHeight - 15;
            window.scrollTo({
                top: Math.max(0, targetY),
                behavior: 'smooth'
            });
        }
    }

    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    if (storyNextBtn) {
        storyNextBtn.addEventListener('click', function () {
            nextSlide();
            scrollToStoryHead();
        });
    }
    if (storyPrevBtn) {
        storyPrevBtn.addEventListener('click', function () {
            prevSlide();
            scrollToStoryHead();
        });
    }

    // Karta Tıklayınca Sadece Seçip Detayı Gösterme
    items.forEach((item, index) => {
        item.addEventListener('click', function () {
            if (isAnimating && currentGlobalIndex === index) return;
            currentGlobalIndex = index;
            updateTrackPosition(true);
        });

        item.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                currentGlobalIndex = index;
                updateTrackPosition(true);
            }
        });
    });

    window.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight') nextSlide();
        else if (e.key === 'ArrowLeft') prevSlide();
    });

    window.selectEventByOriginIndex = function (originIndex) {
        currentGlobalIndex = totalUnique + originIndex;
        updateTrackPosition(true);
    };

    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            updateTrackPosition(false);
        }, 100);
    });

    requestAnimationFrame(() => {
        setTimeout(() => {
            updateTrackPosition(false);
        }, 80);
    });
});
</script>
