<?php
declare(strict_types=1);

/**
 * Fizyobar Yaşam Rehberi - Globe Express / Awwwards Cinematic Carousel
 */
$guides = [
    [
        'id' => 1,
        'number' => '01',
        'subtitle' => '01 • GUT-BRAIN CONNECTION',
        'title' => 'GUT-BRAIN<br>CONNECTION',
        'quote' => 'Psikolojime iyi bakmak için bağırsak mikrobiyotama bol lifli, fermente bir tabak ısmarlıyorum.',
        'desc' => 'Bağırsak mikrobiyotası, zihinsel dinginlik ve vagus regülasyonunun ilk basamağıdır. Bedeninizi hücresel düzeyde besleyin.',
        'image' => asset('assets/images/guides/guide-01.jpg'),
        'wa_text' => 'Merhaba Betina Hocam! Yaşam Rehberi 01: Gut-Brain Connection hakkında bilgi almak istiyorum.'
    ],
    [
        'id' => 2,
        'number' => '02',
        'subtitle' => '02 • MOVEMENT LONGEVITY',
        'title' => 'MOVEMENT<br>LONGEVITY',
        'quote' => '30 sene sonraya şuanki ortopedik sağlığımı taşımak için yoga & postür çalışmaları yapıyorum.',
        'desc' => 'Hareketi anlık bir spor değil, gelecekteki bağımsız bedenimiz ve omurga sağlığımızın en güçlü yatırımı olarak görüyorum.',
        'image' => asset('assets/images/guides/guide-02.jpg'),
        'wa_text' => 'Merhaba Betina Hocam! Yaşam Rehberi 02: Movement Longevity hakkında bilgi almak istiyorum.'
    ],
    [
        'id' => 3,
        'number' => '03',
        'subtitle' => '03 • BIOLOGICAL AGE',
        'title' => 'BIOLOGICAL<br>AGE',
        'quote' => 'Epigenetik saatimi yavaşlatmak için hücrelerimi besliyorum.',
        'desc' => 'Omega-3, NAD+ ve güçlü antioksidanlar ile hücresel yaşlanmayı yavaşlatan longevity beslenme disiplini.',
        'image' => asset('assets/images/guides/guide-03.jpg'),
        'wa_text' => 'Merhaba Betina Hocam! Yaşam Rehberi 03: Biological Age hakkında bilgi almak istiyorum.'
    ],
    [
        'id' => 4,
        'number' => '04',
        'subtitle' => '04 • MIND-BODY CONNECTION',
        'title' => 'MIND-BODY<br>CONNECTION',
        'quote' => 'Yaşam bir ilişkiler bütünüdür. Kendimle bağ kuramadığımda, yaşamı tam olarak hissedemem.',
        'desc' => 'Benden daha büyük bir akla teslim olmak beni en çok rahatlatan şey. Her gün sadece 10 dakika gözlerimi kapatıyor ve vagus sinirimi regüle ediyorum.',
        'image' => asset('assets/images/guides/guide-04.jpg'),
        'wa_text' => 'Merhaba Betina Hocam! Yaşam Rehberi 04: Mind-Body Connection hakkında bilgi almak istiyorum.'
    ],
];
?>

<div class="fzy-globe-slider" id="fzyGlobeSlider">
    
    <!-- Büyük Arka Plan ve Ana İçerik Listesi -->
    <div class="slider-list" id="sliderList">
        <?php foreach ($guides as $g): ?>
            <div class="slider-item" data-number="<?= $g['number'] ?>">
                <img src="<?= $g['image'] ?>" alt="<?= strip_tags($g['title']) ?>" class="slider-bg-img">
                <div class="slider-scrim"></div>
                
                <div class="slider-content">
                    <div class="slider-subtitle">
                        <span class="sub-line"></span>
                        <span><?= $g['subtitle'] ?></span>
                    </div>
                    
                    <h1 class="slider-title"><?= $g['title'] ?></h1>
                    
                    <p class="slider-quote">"<?= $g['quote'] ?>"</p>
                    
                    <p class="slider-desc"><?= $g['desc'] ?></p>
                    
                    <div class="slider-buttons">
                        <a href="<?= url('/programini-bul') ?>" class="slider-btn slider-btn-primary">
                            <span>PROGRAMINI BUL</span>
                            <span class="spark-icon">✨</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Sağ Tarafta Duran Sıradaki Kartlar (Thumbnails) -->
    <div class="slider-thumbnail" id="sliderThumbnail">
        <?php 
        // İlk slayt arkada büyük olduğu için thumbnail'ler 2. elemandan başlar
        $thumbList = array_merge(array_slice($guides, 1), array_slice($guides, 0, 1));
        foreach ($thumbList as $t): 
        ?>
            <div class="thumb-item" data-number="<?= $t['number'] ?>">
                <img src="<?= $t['image'] ?>" alt="<?= strip_tags($t['title']) ?>">
                <div class="thumb-scrim"></div>
                <div class="thumb-content">
                    <span class="thumb-num"><?= $t['number'] ?></span>
                    <span class="thumb-title"><?= $t['subtitle'] ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Alt Navigasyon & Kontroller -->
    <div class="slider-nav-bar">
        <div class="slider-arrows">
            <button type="button" class="arrow-btn" id="btnPrev" aria-label="Önceki">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button type="button" class="arrow-btn" id="btnNext" aria-label="Sonraki">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

        <div class="slider-progress-track">
            <div class="slider-progress-bar" id="sliderProgressBar"></div>
        </div>

        <div class="slider-counter">
            <span class="counter-num" id="counterNum">01</span>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const slider = document.getElementById('fzyGlobeSlider');
    const list = document.getElementById('sliderList');
    const thumbnail = document.getElementById('sliderThumbnail');
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');
    const progressBar = document.getElementById('sliderProgressBar');
    const counterNum = document.getElementById('counterNum');

    if (!slider || !list || !thumbnail) return;

    let autoTimer = null;
    let animTimeout = null;
    const duration = 7000; // 7 saniye

    function updateCounter() {
        const firstItem = list.querySelector('.slider-item');
        if (firstItem && counterNum) {
            const num = firstItem.getAttribute('data-number') || '01';
            counterNum.textContent = num;
        }
    }

    function resetProgressBar() {
        if (!progressBar) return;
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';
        void progressBar.offsetWidth; // reflow
        progressBar.style.transition = 'width ' + duration + 'ms linear';
        progressBar.style.width = '100%';
    }

    function showSlider(type) {
        const itemSlider = list.querySelectorAll('.slider-item');
        const itemThumbnail = thumbnail.querySelectorAll('.thumb-item');

        if (type === 'next') {
            list.appendChild(itemSlider[0]);
            thumbnail.appendChild(itemThumbnail[0]);
            slider.classList.add('next');
        } else {
            list.prepend(itemSlider[itemSlider.length - 1]);
            thumbnail.prepend(itemThumbnail[itemThumbnail.length - 1]);
            slider.classList.add('prev');
        }

        updateCounter();

        clearTimeout(animTimeout);
        animTimeout = setTimeout(() => {
            slider.classList.remove('next');
            slider.classList.remove('prev');
        }, 600);

        restartAutoPlay();
    }

    // Küçük kartlara tıklayınca o karta doğrudan geçiş
    thumbnail.addEventListener('click', (e) => {
        const clickedThumb = e.target.closest('.thumb-item');
        if (!clickedThumb) return;
        
        const targetNumber = clickedThumb.getAttribute('data-number');
        if (!targetNumber) return;

        let count = 0;
        const maxTries = list.querySelectorAll('.slider-item').length;
        
        while (count < maxTries) {
            const currentFirst = list.querySelector('.slider-item').getAttribute('data-number');
            if (currentFirst === targetNumber) break;
            showSlider('next');
            count++;
        }
    });

    if (btnNext) btnNext.addEventListener('click', () => showSlider('next'));
    if (btnPrev) btnPrev.addEventListener('click', () => showSlider('prev'));

    function restartAutoPlay() {
        clearInterval(autoTimer);
        resetProgressBar();
        autoTimer = setInterval(() => {
            showSlider('next');
        }, duration);
    }

    // Klavye yön tuşları
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight' || e.key === ' ') {
            showSlider('next');
        } else if (e.key === 'ArrowLeft') {
            showSlider('prev');
        }
    });

    // Mobil Swipe
    let touchStartX = 0;
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
    }, { passive: true });

    slider.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].clientX;
        const diffX = touchEndX - touchStartX;
        if (Math.abs(diffX) > 40) {
            if (diffX < 0) showSlider('next');
            else showSlider('prev');
        }
    }, { passive: true });

    // Başlat
    updateCounter();
    restartAutoPlay();
});
</script>
