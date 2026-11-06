<?php
declare(strict_types=1);
?>

<!-- Programlar Sayfası: Sade, Ferah & Betella Stili Minimal Mimari -->
<section class="programs-clean-section">
    <div class="container">
        <!-- 1. Sade ve Güçlü Betella Stili Başlık -->
        <div class="programs-hero-clean text-center">
            <h1 class="programs-headline">DEĞİŞİME KATILIN</h1>
            
            <!-- Betella Kapsül Toggle Seçici -->
            <div class="betella-toggle-wrap">
                <div class="betella-toggle-pill" role="tablist">
                    <button type="button" class="betella-toggle-btn active" data-filter="all" role="tab" aria-selected="true">
                        Tüm Programlar
                    </button>
                    <button type="button" class="betella-toggle-btn" data-filter="camp" role="tab" aria-selected="false">
                        Canlı Kamplar
                    </button>
                </div>
            </div>
        </div>

        <!-- 2. Üçlü Sade ve Net Program Kartları -->
        <div class="programs-clean-grid" id="programsGrid">
            <!-- Kart 1: Warrior Yoga Plani -->
            <article class="clean-plan-card" data-category="program">
                <div class="plan-card-top">
                    <h2 class="clean-plan-title">WARRIOR YOGA<br>PLANI</h2>
                    <p class="clean-plan-subtitle">3 Haftalık Dinamik Akış &amp; Omurga Gücü</p>
                    <div class="clean-plan-price">
                        <span class="price-val">1.250 TL</span>
                        <span class="price-note">3 haftalık canlı program bedeli</span>
                    </div>
                </div>

                <div class="clean-features-list">
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Aligned Lines &amp; Fonksiyonel Güç</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Omurga &amp; Eklem Biyomekaniği</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Haftada 3 Canlı Akış &amp; Düzeltmeler</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">3 Ay Boyunca Sınırsız Kayıt Erişimi</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Evde Uygulanabilir Günlük Sonuç Rutinleri</span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= url('/checkout/2') ?>" class="btn-clean-plan">
                        PROGRAMA KATIL
                    </a>
                </div>
            </article>

            <!-- Kart 2: 4 Haftalık Online Detox & Yoga Kampı (Merkez / Öne Çıkan) -->
            <article class="clean-plan-card is-featured" data-category="camp">
                <div class="featured-badge-pill">EN ÇOK TERCİH EDİLEN</div>
                <div class="plan-card-top">
                    <h2 class="clean-plan-title">ONLINE DETOX &amp;<br>YOGA KAMPI</h2>
                    <p class="clean-plan-subtitle">4 Haftalık Bütünsel Yenilenme ve Birebir Takip</p>
                    <div class="clean-plan-price">
                        <span class="price-val">4.500 TL</span>
                        <span class="price-note">4 haftalık tam kamp ve eğitmen desteği</span>
                    </div>
                </div>

                <div class="clean-features-list">
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Fizyoterapist ile Birebir WhatsApp Takibi</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">16+ Canlı Seans &amp; Özel Atölyeler</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Diyafram Nefesi &amp; Vagus Sinir Regülasyonu</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Rafine Şekersiz &amp; Glisemik Beslenme Rehberi</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Ömür Boyu Sınırsız Video Kütüphanesi</span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= url('/checkout/1') ?>" class="btn-clean-plan btn-featured">
                        KAMPA KATIL
                    </a>
                </div>
            </article>

            <!-- Kart 3: Platform & SUP Yoga -->
            <article class="clean-plan-card" data-category="program">
                <div class="plan-card-top">
                    <h2 class="clean-plan-title">PLATFORM &amp;<br>SUP YOGA</h2>
                    <p class="clean-plan-subtitle">Seyhan Baraj Gölü Üzerinde Açık Hava Pratiği</p>
                    <div class="clean-plan-price">
                        <span class="price-val">ÖZEL SEANS</span>
                        <span class="price-note">Bireysel veya butik grup randevusu</span>
                    </div>
                </div>

                <div class="clean-features-list">
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Su Üzerinde Özel Denge Platformları</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Maksimum Merkez (Core) Gücü &amp; Denge</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Doğayla Bütünleşen Zihinsel Dinginlik</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Tüm Güvenli SUP Ekipmanları Dahil</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Bireysel veya Butik Grup Rezervasyonu</span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= __('brand.whatsapp_url') ?>?text=Merhaba,%20Platform%20ve%20SUP%20Yoga%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum." target="_blank" rel="noopener noreferrer" class="btn-clean-plan">
                        WHATSAPP'TAN BİLGİ AL
                    </a>
                </div>
            </article>
        </div>

        <!-- 3. Alt Destek Notu -->
        <div class="programs-minimal-footer text-center">
            <p>Hangi programın bedeninize uygun olduğundan emin değil misiniz? <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer">WhatsApp üzerinden doğrudan danışın &rarr;</a></p>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtns = document.querySelectorAll('.betella-toggle-btn');
    const cards = document.querySelectorAll('.clean-plan-card');

    toggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            toggleBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');

            const filter = this.dataset.filter;
            cards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'flex';
                } else if (filter === 'camp') {
                    if (card.dataset.category === 'camp') {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>
