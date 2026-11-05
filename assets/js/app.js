/**
 * Fizyobar - Platform Ana JS Motoru
 * Akıcı menü, pencere yeniden boyutlandırma uyumu ve genel kullanıcı etkileşimleri.
 */
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // Mobil Menü Aç/Kapat
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function() {
            const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';
            mobileToggle.setAttribute('aria-expanded', !isExpanded);
            navMenu.classList.toggle('open');
        });

        // Sayfa dışına tıklandığında menüyü kapat
        document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target) && navMenu.classList.contains('open')) {
                navMenu.classList.remove('open');
                mobileToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Pencere yeniden boyutlandırma gözlemcisi (Window resize handling)
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 768 && navMenu && navMenu.classList.contains('open')) {
                navMenu.classList.remove('open');
                if (mobileToggle) mobileToggle.setAttribute('aria-expanded', 'false');
            }
        }, 150);
    });

    // Sayfa kaydırma efekti (Sticky & Frosted Glass Header)
    const header = document.getElementById('siteHeader');
    if (header) {
        const checkScroll = function() {
            if (window.scrollY > 30) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', checkScroll, { passive: true });
        checkScroll();
    }

    // Programlar Sayfası Kategori Filtreleme (Client-side interactive filter)
    const filterButtons = document.querySelectorAll('.filter-btn');
    const programCards = document.querySelectorAll('.program-item-card');

    if (filterButtons.length > 0 && programCards.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                filterButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const targetCategory = this.getAttribute('data-filter');

                programCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (targetCategory === 'all' || cardCategory === targetCategory) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // ==============================================================================
    // BAR SYSTEM METODOLOJİ DÖNGÜSÜ (SCROLL DRIVEN DIAGRAM FLOW)
    // ==============================================================================
    const flowSection = document.getElementById('metodoloji-akisi');
    const flowVectorStage = document.getElementById('flowVectorStage') || document.getElementById('flowStageWrapper');
    const flowProgressLine = document.getElementById('flowSvgProgressLine');
    const flowProgressBar = document.getElementById('flowProgressBar');
    const flowSummaries = document.querySelectorAll('.flow-summary-col');
    const flowSvgNodes = document.querySelectorAll('.flow-svg-node');

    if (flowSection && (flowVectorStage || flowProgressBar)) {
        const updateFlowProgress = function() {
            const rect = flowSection.getBoundingClientRect();
            const windowHeight = window.innerHeight || document.documentElement.clientHeight;
            
            // Bölüm ekranda görünür olduğunda ilerleme oranı hesapla
            const startY = rect.top - windowHeight * 0.65;
            const totalDistance = rect.height * 0.85;
            
            let progress = 0;
            if (startY < 0) {
                progress = Math.min(1, Math.max(0, -startY / totalDistance));
            }

            // 1. Yatay SVG Çizgi İlerlemesi (X1 = 40'tan X2 = 960'a kadar)
            if (flowProgressLine) {
                const currentX2 = 40 + (progress * (960 - 40));
                flowProgressLine.setAttribute('x2', currentX2.toFixed(1));
            }
            if (flowProgressBar) {
                flowProgressBar.style.width = (progress * 100) + '%';
            }

            // 2. Aşamalı Yay ve Özet Aktivasyonu
            if (flowVectorStage) {
                if (progress >= 0.35) {
                    flowVectorStage.classList.add('step-2-active');
                    flowSummaries[1]?.classList.add('is-active');
                } else {
                    flowVectorStage.classList.remove('step-2-active');
                    flowSummaries[1]?.classList.remove('is-active');
                }

                if (progress >= 0.70) {
                    flowVectorStage.classList.add('step-3-active');
                    flowSummaries[2]?.classList.add('is-active');
                } else {
                    flowVectorStage.classList.remove('step-3-active');
                    flowSummaries[2]?.classList.remove('is-active');
                }
            }
        };

        window.addEventListener('scroll', updateFlowProgress, { passive: true });
        updateFlowProgress();

        // Düğümlere tıklayarak ilgili aşamaya yumuşak kaydırma
        flowSvgNodes.forEach((node, index) => {
            node.addEventListener('click', function() {
                const targetRatio = (index === 0) ? 0.15 : (index === 1 ? 0.45 : 0.78);
                const rect = flowSection.getBoundingClientRect();
                const targetScrollY = window.scrollY + rect.top - (window.innerHeight * 0.65) + (rect.height * 0.85 * targetRatio);
                window.scrollTo({ top: targetScrollY, behavior: 'smooth' });
            });
        });
    }

    // ==============================================================================
    // 3D DÖNEN BEFORE / AFTER SİLİNDİRİK CAROUSEL (DÖNDÜRME VE KART ÇEVİRME)
    // ==============================================================================
    const carouselScene = document.querySelector('.carousel-3d-scene');
    const ring = document.getElementById('carousel3dRing');
    const cards = document.querySelectorAll('.carousel-3d-card');
    const prevBtn = document.getElementById('carouselPrevBtn');
    const nextBtn = document.getElementById('carouselNextBtn');

    if (ring && cards.length > 0) {
        let currentAngle = 0;
        let targetAngle = 0;
        let isPointerDown = false;
        let startX = 0;
        let startAngle = 0;
        let hasMoved = false;
        let moveDistance = 0;
        const cardAngleStep = 60; // 360 / 6 kart

        // Yumuşak İnterpolasyon Döngüsü (Smooth animation loop)
        function updateCarousel() {
            const diff = targetAngle - currentAngle;
            if (Math.abs(diff) > 0.05) {
                currentAngle += diff * 0.12;
            } else {
                currentAngle = targetAngle;
            }
            ring.style.transform = `rotateY(${currentAngle}deg)`;
            requestAnimationFrame(updateCarousel);
        }
        requestAnimationFrame(updateCarousel);

        // Pointer / Touch / Mouse Başlangıcı
        function handlePointerDown(e) {
            isPointerDown = true;
            hasMoved = false;
            moveDistance = 0;
            startX = e.clientX || (e.touches && e.touches[0].clientX) || 0;
            startAngle = targetAngle;
            ring.style.cursor = 'grabbing';
        }

        // Pointer / Touch / Mouse Hareketi (Sürükleme)
        function handlePointerMove(e) {
            if (!isPointerDown) return;
            const currentX = e.clientX || (e.touches && e.touches[0].clientX) || 0;
            const deltaX = currentX - startX;
            moveDistance = Math.abs(deltaX);

            if (moveDistance > 6) {
                hasMoved = true;
            }

            // Açı hassasiyeti (drag sensitivity)
            targetAngle = startAngle + (deltaX * 0.35);
        }

        // Pointer / Touch / Mouse Bitişi
        function handlePointerUp() {
            if (!isPointerDown) return;
            isPointerDown = false;
            ring.style.cursor = 'grab';

            // Eğer sürükleme yapıldıysa en yakın 60 dereceye yuvarla (Snap)
            if (hasMoved) {
                targetAngle = Math.round(targetAngle / cardAngleStep) * cardAngleStep;
            }
        }

        if (carouselScene) {
            // Fare etkileşimleri
            carouselScene.addEventListener('mousedown', handlePointerDown);
            window.addEventListener('mousemove', handlePointerMove);
            window.addEventListener('mouseup', handlePointerUp);

            // Dokunmatik (Mobil) etkileşimleri
            carouselScene.addEventListener('touchstart', handlePointerDown, { passive: true });
            window.addEventListener('touchmove', handlePointerMove, { passive: true });
            window.addEventListener('touchend', handlePointerUp);
        }

        // Kart Tıklama: Eğer sürüklenmediyse (sadece tıklandıysa) kartı 3D olarak Before/After çevir
        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Eğer kullanıcı kartı sürüklediyse çevirme
                if (hasMoved && moveDistance > 8) return;

                // Tıklanan kartı çevir (Before <-> After flip)
                this.classList.toggle('is-flipped');
            });
        });

        // Butonlarla Döndürme
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                targetAngle += cardAngleStep;
                targetAngle = Math.round(targetAngle / cardAngleStep) * cardAngleStep;
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                targetAngle -= cardAngleStep;
                targetAngle = Math.round(targetAngle / cardAngleStep) * cardAngleStep;
            });
        }
    }

    // ==============================================================================
    // PROGRAMLAR SAYFASI KATEGORİ FİLTRELEME (PROGRAMS FILTER)
    // ==============================================================================
    const progFilterBtns = document.querySelectorAll('.prog-filter-btn');
    const progCards = document.querySelectorAll('.prog-card');

    if (progFilterBtns.length > 0 && progCards.length > 0) {
        progFilterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                progFilterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                progCards.forEach(card => {
                    const cardCat = card.getAttribute('data-category');
                    if (filter === 'all' || filter === cardCat) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }
});

