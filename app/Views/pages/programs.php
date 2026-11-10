<?php
declare(strict_types=1);
?>

<!-- Programlar Sayfası: 3 Ana Eğitim Paketi & Betella Stili Minimal Mimari -->
<section class="programs-clean-section">
    <div class="container">
        <!-- 1. Sade ve Güçlü Başlık -->
        <div class="programs-hero-clean text-center">
            <span class="programs-kicker-pill">KLİNİK FİZYOTERAPİ &amp; ANATOMİK GÜÇ</span>
            <h1 class="programs-headline">EĞİTİM PROGRAMLARI</h1>
            <p class="programs-subheadline">Fizyoterapist Betina Tansuğ metodolojisiyle bedeninize kalıcı fonksiyon ve denge kazandıran 3 ana eğitim:</p>
            
            <!-- Canlı Kamp Ayrı Sayfa Duyurusu -->
            <div class="programs-detox-callout">
                <div class="detox-callout-inner">
                    <span class="detox-callout-badge">CANLI KAMP</span>
                    <span class="detox-callout-text">Birebir WhatsApp takipli ve beslenmeli 4 haftalık dönem:</span>
                    <a href="<?= url('/detox') ?>" class="detox-callout-link">
                        4 Haftalık Online Detox &amp; Yoga Kampı Sayfası &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- 2. Üçlü Eğitim Paketleri Grid (Sadece 3 Eğitim) -->
        <div class="programs-clean-grid" id="programsGrid">
            <!-- Eğitim 1: Warrior Yoga Planı -->
            <article class="clean-plan-card" id="warrior">
                <div class="plan-card-top">
                    <div class="plan-category-tag">EĞİTİM I</div>
                    <h2 class="clean-plan-title">WARRIOR YOGA<br>PLANI</h2>
                    <p class="clean-plan-subtitle">3 Haftalık Dinamik Akış, Güç &amp; Omurga Stabilitesi</p>
                    <div class="clean-plan-price">
                        <span class="price-val">1.250 TL</span>
                        <span class="price-note">3 haftalık canlı eğitim programı</span>
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
                        <span class="feature-text">Aligned Lines &amp; Fonksiyonel Beden Gücü</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#111111"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Omurga &amp; Eklem Biyomekaniği Akışları</span>
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
                        <span class="feature-text">Evde Uygulanabilir Günlük Güç Rutinleri</span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= url('/checkout/2') ?>" class="btn-clean-plan">
                        PROGRAMA KATIL
                    </a>
                </div>
            </article>

            <!-- Eğitim 2: Omurga & Postür Biyomekaniği -->
            <article class="clean-plan-card is-featured" id="posture">
                <div class="featured-badge-pill">ÖNE ÇIKAN KLİNİK EĞİTİM</div>
                <div class="plan-card-top">
                    <div class="plan-category-tag">EĞİTİM II</div>
                    <h2 class="clean-plan-title">OMURGA &amp; POSTÜR<br>BİYOMEKANİĞİ</h2>
                    <p class="clean-plan-subtitle">4 Haftalık Klinik Hizalanma, Dekompresyon &amp; Duruş</p>
                    <div class="clean-plan-price">
                        <span class="price-val">1.850 TL</span>
                        <span class="price-note">4 haftalık modüler eğitim protokolü</span>
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
                        <span class="feature-text">Servikal (Boyun) &amp; Torakal Dekompresyon</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">İleri Baş &amp; Kifoz (Kamburluk) Düzeltme</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Fasya Ağı Rahatlatma &amp; Sinir Germeleri</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Masa Başı Çalışanlar İçin Günlük 15 Dk Seanslar</span>
                    </div>
                    <div class="clean-feature-item">
                        <span class="betella-check" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="10" r="10" fill="#391214"/>
                                <path d="M6 10.2L8.8 13L14 7.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="feature-text">Ömür Boyu Sınırsız Video Paneli Erişimi</span>
                    </div>
                </div>

                <div class="plan-card-bottom">
                    <a href="<?= url('/checkout/3') ?>" class="btn-clean-plan btn-featured">
                        PROGRAMA KATIL
                    </a>
                </div>
            </article>

            <!-- Eğitim 3: Platform & SUP Yoga -->
            <article class="clean-plan-card" id="sup">
                <div class="plan-card-top">
                    <div class="plan-category-tag">EĞİTİM III</div>
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

        <!-- 3. Alt Destek & AI Test Yönlendirmesi -->
        <div class="programs-minimal-footer text-center">
            <p>
                Bedeninize en uygun eğitimi belirlemekte kararsız mısınız? 
                <a href="<?= url('/programini-bul') ?>" class="footer-finder-link">Yapay Zeka ile Programınızı Bulun &rarr;</a>
                veya 
                <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer">WhatsApp'tan Danışın &rarr;</a>
            </p>
        </div>
    </div>
</section>
