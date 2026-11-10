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

    // Sayfa kaydırma efekti (Sticky & Solid Header)
    const header = document.getElementById('siteHeader');
    if (header) {
        const checkScroll = function() {
            if (window.scrollY > 40) {
                header.classList.add('scrolled');
                header.classList.add('scrolled-solid');
            } else {
                header.classList.remove('scrolled');
                header.classList.remove('scrolled-solid');
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
    // 3 ADIMDA BAŞLA - STICKY ORGANİK AKIŞ & SCROLL ÇİZİMİ
    // ==============================================================================
    const stickyWrap = document.getElementById('flowStickyWrap');
    const flowSection = document.getElementById('metodoloji-akisi');
    const animatedLine = document.getElementById('organicAnimatedLine');
    const organicNodes = document.querySelectorAll('.organic-node');
    const flowCtaGroup = document.getElementById('flowCtaGroup');

    if (flowSection && animatedLine) {
        let pathLength = 0;
        try {
            pathLength = animatedLine.getTotalLength();
        } catch (e) {
            pathLength = 1800;
        }

        // Başlangıçta çizgiyi gizle (stroke-dasharray ve stroke-dashoffset)
        animatedLine.style.strokeDasharray = pathLength + ' ' + pathLength;
        animatedLine.style.strokeDashoffset = pathLength;

        let ticking = false;

        function updateScrollLine() {
            let progress = 0;

            if (stickyWrap && window.innerWidth > 820) {
                const wrapRect = stickyWrap.getBoundingClientRect();
                const headerHeight = 88;
                const totalScroll = stickyWrap.offsetHeight - (window.innerHeight - headerHeight);
                const currentScroll = headerHeight - wrapRect.top;

                if (totalScroll > 0) {
                    // Kullanıcı %85 kaydırdığında çizgi %100 tamamlansın,
                    // böylece sonunu (DÖNÜŞÜM noktasını) sayfa devam etmeden önce rahatça görsün!
                    const rawRatio = Math.min(1, Math.max(0, currentScroll / totalScroll));
                    progress = Math.min(1, rawRatio / 0.85);
                }
            } else {
                // Mobil veya dar ekran modunda yumuşak görünüm
                const rect = flowSection.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;
                const startOffset = windowHeight * 0.85;
                const scrollDistance = rect.height * 0.85;
                const currentY = startOffset - rect.top;
                if (currentY > 0) {
                    progress = Math.min(1, Math.max(0, currentY / scrollDistance));
                }
            }

            // Çizgiyi kaydırma oranına göre çiz
            const newOffset = pathLength * (1 - progress);
            animatedLine.style.strokeDashoffset = newOffset;

            // Düğümleri (Nodes) çizgi onlara ulaştıkça aktif et
            organicNodes.forEach(node => {
                const threshold = parseFloat(node.getAttribute('data-threshold') || '0.2');
                if (progress >= threshold) {
                    node.classList.add('is-active');
                } else {
                    node.classList.remove('is-active');
                }
            });

            // Sona ulaşıldığında sağdaki Programa Katıl butonunu aktifleştir / parlat
            if (flowCtaGroup) {
                if (progress >= 0.85) {
                    flowCtaGroup.classList.add('is-active');
                } else {
                    flowCtaGroup.classList.remove('is-active');
                }
            }

            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(updateScrollLine);
                ticking = true;
            }
        }, { passive: true });

        window.addEventListener('resize', function() {
            try {
                pathLength = animatedLine.getTotalLength();
                animatedLine.style.strokeDasharray = pathLength + ' ' + pathLength;
            } catch (e) {}
            updateScrollLine();
        }, { passive: true });

        // İlk yüklemede çalıştır
        updateScrollLine();
    }

    // ==============================================================================
    // GERÇEK DÖNÜŞÜMLER: YATAY KAYDIRMALI & SONSUZ DÖNGÜLÜ (INFINITE) BEFORE/AFTER SLIDER
    // ==============================================================================
    const transViewport = document.getElementById('transSliderViewport');
    const transTrack = document.getElementById('transTrack');
    const transPrevBtn = document.getElementById('transPrevBtn');
    const transNextBtn = document.getElementById('transNextBtn');
    const transDots = document.querySelectorAll('.trans-dot');

    if (transViewport && transTrack) {
        const originalCards = Array.from(transTrack.querySelectorAll('.trans-card'));
        const totalOriginal = originalCards.length;

        if (totalOriginal > 0) {
            // Sol ve sağ tarafın ASLA boş kalmaması için başa ve sona tam set klonlar ekliyoruz
            // Set 1 (Clone Before), Set 2 (Orijinal), Set 3 (Clone After)
            const clonesBefore = originalCards.map(c => {
                const clone = c.cloneNode(true);
                clone.classList.remove('is-active', 'is-flipped');
                clone.setAttribute('data-clone', 'before');
                return clone;
            });

            const clonesAfter = originalCards.map(c => {
                const clone = c.cloneNode(true);
                clone.classList.remove('is-active', 'is-flipped');
                clone.setAttribute('data-clone', 'after');
                return clone;
            });

            // Track içine yerleştir
            clonesBefore.forEach(clone => transTrack.insertBefore(clone, originalCards[0]));
            clonesAfter.forEach(clone => transTrack.appendChild(clone));

            // Artık tüm kartlar (toplam 3 * totalOriginal = 18 kart)
            let allCards = Array.from(transTrack.querySelectorAll('.trans-card'));

            // Başlangıç indeksi: Ortadaki setin ilk kartı (indeks 6 = Kart 0)
            let currentIndex = totalOriginal;
            let isDragging = false;
            let startX = 0;
            let currentTranslate = 0;
            let prevTranslate = 0;
            let dragDistance = 0;

            function updateSliderPosition(animate = true) {
                if (allCards.length === 0) return;

                const viewportWidth = transViewport.offsetWidth;
                const targetCard = allCards[currentIndex];
                if (!targetCard) return;

                const cardWidth = targetCard.offsetWidth;
                const cardOffsetLeft = targetCard.offsetLeft;

                // Aktif kartı viewport'un tam merkezine oturtan X ofseti
                const targetX = (viewportWidth / 2) - (cardWidth / 2) - cardOffsetLeft;

                currentTranslate = targetX;
                prevTranslate = targetX;

                if (animate) {
                    transTrack.style.transition = 'transform 0.55s cubic-bezier(0.2, 0.8, 0.2, 1)';
                } else {
                    transTrack.style.transition = 'none';
                }
                transTrack.style.transform = `translateX(${targetX}px)`;

                // Netlik ve sis sınıflarını güncelle
                allCards.forEach((card, idx) => {
                    if (idx === currentIndex) {
                        card.classList.add('is-active');
                    } else {
                        card.classList.remove('is-active');
                    }
                });

                // Dot göstergelerini güncelle (0..5 modunda)
                const realIndex = ((currentIndex % totalOriginal) + totalOriginal) % totalOriginal;
                transDots.forEach((dot, idx) => {
                    dot.classList.toggle('active', idx === realIndex);
                });
            }

            // Sonsuz döngü wrap-around denetimi (seamless loop)
            function checkLoopBounds() {
                if (currentIndex < totalOriginal) {
                    currentIndex += totalOriginal;
                    updateSliderPosition(false);
                } else if (currentIndex >= totalOriginal * 2) {
                    currentIndex -= totalOriginal;
                    updateSliderPosition(false);
                }
            }

            transTrack.addEventListener('transitionend', function(e) {
                if (e.target === transTrack) {
                    checkLoopBounds();
                }
            });

            function goToCard(index, animate = true) {
                currentIndex = index;
                updateSliderPosition(animate);
            }

            // Butonlar
            if (transPrevBtn) {
                transPrevBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    goToCard(currentIndex - 1, true);
                });
            }

            if (transNextBtn) {
                transNextBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    goToCard(currentIndex + 1, true);
                });
            }

            // Dot tıklamaları (orta sete doğrudan yönlendirme)
            transDots.forEach(function(dot) {
                dot.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetIdx = parseInt(this.getAttribute('data-index'), 10);
                    if (!isNaN(targetIdx)) {
                        goToCard(totalOriginal + targetIdx, true);
                    }
                });
            });

            // Kart tıklamaları:
            // - Ortadaki aktif karta tıklanırsa -> Before / After çevir (flip)
            // - Yanlardaki sisli karta tıklanırsa -> o kartı merkeze getir ve netleştir
            allCards.forEach(function(card, idx) {
                card.addEventListener('click', function() {
                    if (dragDistance > 10) return;
                    if (idx !== currentIndex) {
                        goToCard(idx, true);
                    } else {
                        this.classList.toggle('is-flipped');
                    }
                });
            });

            // Sürükleme (Drag & Swipe)
            function getPointerX(e) {
                return e.type.includes('mouse') ? e.pageX : (e.touches && e.touches[0] ? e.touches[0].clientX : 0);
            }

            function onDragStart(e) {
                isDragging = true;
                dragDistance = 0;
                startX = getPointerX(e);
                transTrack.style.transition = 'none';
                transTrack.style.cursor = 'grabbing';
            }

            function onDragMove(e) {
                if (!isDragging) return;
                const currentX = getPointerX(e);
                const deltaX = currentX - startX;
                dragDistance = Math.abs(deltaX);
                transTrack.style.transform = `translateX(${prevTranslate + deltaX}px)`;
            }

            function onDragEnd() {
                if (!isDragging) return;
                isDragging = false;
                transTrack.style.cursor = 'grab';

                if (dragDistance > 40) {
                    const matrix = window.getComputedStyle(transTrack).transform;
                    let actualX = prevTranslate;
                    if (matrix && matrix !== 'none') {
                        const parts = matrix.split(',');
                        actualX = parseFloat(parts[4]) || prevTranslate;
                    }
                    const movedAmount = actualX - prevTranslate;

                    if (movedAmount < -40) {
                        currentIndex += 1;
                    } else if (movedAmount > 40) {
                        currentIndex -= 1;
                    }
                }

                updateSliderPosition(true);
            }

            transViewport.addEventListener('mousedown', onDragStart);
            window.addEventListener('mousemove', onDragMove);
            window.addEventListener('mouseup', onDragEnd);

            transViewport.addEventListener('touchstart', onDragStart, { passive: true });
            window.addEventListener('touchmove', onDragMove, { passive: true });
            window.addEventListener('touchend', onDragEnd);

            // Resize durumunda tam ortalamayı koru
            let resizeTimer = null;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    updateSliderPosition(false);
                }, 80);
            });

            // İlk açılışta pozisyonla (Sol taraf dolu, sağ taraf dolu, ortadaki net)
            requestAnimationFrame(function() {
                updateSliderPosition(false);
            });
            setTimeout(function() {
                updateSliderPosition(false);
            }, 100);
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

