<?php
declare(strict_types=1);
/**
 * @var array $courses
 */
?>

<!-- ==============================================================================
     FİZYOBAR "PROGRAMINI BUL" - SADE BEYAZ GEÇİŞLİ EKRAN & YAPAY ZEKA SİHİRBAZI
     ============================================================================== -->
<section class="find-program-clean-stage">
    <div class="finder-wizard-container">

        <!-- 1. Segmentli İlerleme Çubuğu & Adım Sayacı (Referans Görsel Birebir Uyumu) -->
        <div class="finder-segmented-progress" id="finderSegmentedProgress">
            <div class="finder-segments-row" id="segmentsRow">
                <span class="segment-pill is-active" data-step-pill="1"></span>
                <span class="segment-pill" data-step-pill="2"></span>
                <span class="segment-pill" data-step-pill="3"></span>
                <span class="segment-pill" data-step-pill="4"></span>
            </div>
            <div class="finder-step-meta-row">
                <span class="finder-step-counter-text" id="stepCounterText">1 of 4</span>
                <span class="finder-step-subtitle" id="stepNameText">Öncelikli Beden Hedefiniz</span>
            </div>
        </div>

        <!-- 2. Test Formu & Geçişli Adım Ekranları -->
        <div class="finder-screen-slider" id="finderScreenSlider">
            <form id="findProgramForm" onsubmit="return false;">

                <!-- ADIM 1: Beden Odak & Öncelikli Hedef -->
                <div class="finder-step-pane is-active" data-step="1" id="stepPane1">
                    <div class="finder-heading-block">
                        <h1 class="finder-main-question">Hangi hedefe odaklanmak istiyorsunuz?</h1>
                        <p class="finder-main-hint">Bedeninizin şu an en çok ihtiyaç duyduğu temel alanı seçin:</p>
                    </div>

                    <div class="finder-cards-carousel">
                        <!-- Kart 1: Omurga & Bel -->
                        <label class="finder-visual-card is-selected" onclick="FinderApp.selectCard(this, 'goal')">
                            <input type="radio" name="goal" value="spine_pain" checked>
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <ellipse cx="12" cy="5" rx="5" ry="2"></ellipse>
                                    <ellipse cx="12" cy="10" rx="6" ry="2.2"></ellipse>
                                    <ellipse cx="12" cy="15" rx="6.5" ry="2.2"></ellipse>
                                    <ellipse cx="12" cy="20" rx="5" ry="2"></ellipse>
                                    <line x1="12" y1="3" x2="12" y2="22"></line>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Omurga &amp; Bel Ağrıları</strong>
                                <span class="card-desc">Fıtık, tutulma ve mobilite kaybı</span>
                            </div>
                        </label>

                        <!-- Kart 2: Duruş & Postür -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'goal')">
                            <input type="radio" name="goal" value="posture">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="4" r="2.5"></circle>
                                    <path d="M12 7v7"></path>
                                    <path d="M8 10l4-1 4 1"></path>
                                    <path d="M9 21v-7h6v7"></path>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Duruş &amp; Postür</strong>
                                <span class="card-desc">Kamburluk, omuz asimetrisi</span>
                            </div>
                        </label>

                        <!-- Kart 3: Detoks & Beslenme -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'goal')">
                            <input type="radio" name="goal" value="detox_nutrition">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path>
                                    <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Ödem &amp; Şekersiz Detoks</strong>
                                <span class="card-desc">GLP-1 tokluk ve metabolik denge</span>
                            </div>
                        </label>

                        <!-- Kart 4: Warrior Flow -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'goal')">
                            <input type="radio" name="goal" value="flexibility_warrior">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Warrior &amp; Esneklik</strong>
                                <span class="card-desc">Derin mobilite, dinamik güç</span>
                            </div>
                        </label>

                        <!-- Kart 5: Stres & Vagus -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'goal')">
                            <input type="radio" name="goal" value="stress_vagus">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <path d="M12 3a9 9 0 0 0 0 18"></path>
                                    <circle cx="12" cy="7.5" r="1.5"></circle>
                                    <circle cx="12" cy="16.5" r="1.5"></circle>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Stres &amp; Vagus Siniri</strong>
                                <span class="card-desc">Sinir sistemi regülasyonu, uyku</span>
                            </div>
                        </label>
                    </div>

                    <!-- Alt Yönlendirme & Pagination Dots -->
                    <div class="finder-bottom-nav">
                        <div class="finder-dots-row">
                            <span class="finder-dot is-active"></span>
                            <span class="finder-dot"></span>
                            <span class="finder-dot"></span>
                            <span class="finder-dot"></span>
                        </div>
                        <button type="button" class="btn-finder-forward" onclick="FinderApp.nextStep()">
                            <span>DEVAM ET</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- ADIM 2: Günlük Rutin & Yaşam Tarzı -->
                <div class="finder-step-pane" data-step="2" id="stepPane2">
                    <div class="finder-heading-block">
                        <h2 class="finder-main-question">Günlük hareket düzeyiniz nedir?</h2>
                        <p class="finder-main-hint">Program yoğunluğunuzu fizyolojik kapasitenize göre kalibre edeceğiz:</p>
                    </div>

                    <div class="finder-cards-carousel">
                        <!-- Kart 1: Masa Başı -->
                        <label class="finder-visual-card is-selected" onclick="FinderApp.selectCard(this, 'lifestyle')">
                            <input type="radio" name="lifestyle" value="desk_heavy" checked>
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Masa Başı Yoğun</strong>
                                <span class="card-desc">Günde 6-8+ saat sabit oturma</span>
                            </div>
                        </label>

                        <!-- Kart 2: Zaman Zaman Hareketli -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'lifestyle')">
                            <input type="radio" name="lifestyle" value="intermittent_active">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="5" r="2"></circle>
                                    <path d="M10 22l2-7 3 3v4"></path>
                                    <path d="M8 12l3-3 3 1 2 4"></path>
                                    <path d="M14 10l2-4"></path>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Ara Sıra Hareketli</strong>
                                <span class="card-desc">Düzensiz yürüyüş veya hafif spor</span>
                            </div>
                        </label>

                        <!-- Kart 3: Yeniden Başlangıç -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'lifestyle')">
                            <input type="radio" name="lifestyle" value="inactive_restart">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2a10 10 0 0 1 10 10c0 4.5-3 8-7 9.5"></path>
                                    <path d="M12 2a10 10 0 0 0-10 10c0 4.5 3 8 7 9.5"></path>
                                    <path d="M12 7v10"></path>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Yeniden Başlangıç</strong>
                                <span class="card-desc">Sakatlanmadan güvenli adımlar</span>
                            </div>
                        </label>

                        <!-- Kart 4: Düzenli Sporcu -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'lifestyle')">
                            <input type="radio" name="lifestyle" value="active_mobility">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="6" y1="5" x2="6" y2="19"></line>
                                    <line x1="18" y1="5" x2="18" y2="19"></line>
                                    <line x1="2" y1="9" x2="22" y2="9"></line>
                                    <line x1="2" y1="15" x2="22" y2="15"></line>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Düzenli Sporcu</strong>
                                <span class="card-desc">Fitness, koşu, eklem toparlanması</span>
                            </div>
                        </label>
                    </div>

                    <!-- Alt Yönlendirme -->
                    <div class="finder-bottom-nav">
                        <button type="button" class="btn-finder-backward" onclick="FinderApp.prevStep()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            <span>GERİ</span>
                        </button>
                        <div class="finder-dots-row">
                            <span class="finder-dot"></span>
                            <span class="finder-dot is-active"></span>
                            <span class="finder-dot"></span>
                            <span class="finder-dot"></span>
                        </div>
                        <button type="button" class="btn-finder-forward" onclick="FinderApp.nextStep()">
                            <span>DEVAM ET</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- ADIM 3: Anatomik Belirtiler & Hassasiyetler (Çoklu Seçim) -->
                <div class="finder-step-pane" data-step="3" id="stepPane3">
                    <div class="finder-heading-block">
                        <h2 class="finder-main-question">Hissedilen anatomik belirtiler ve hassasiyetler?</h2>
                        <p class="finder-main-hint">Geçerli olan tüm seçenekleri işaretleyebilirsiniz (birden fazla seçilebilir):</p>
                    </div>

                    <div class="finder-cards-carousel">
                        <!-- Kart 1: Boyun & Omuz -->
                        <label class="finder-visual-card is-selected" onclick="FinderApp.toggleCheckCard(this)">
                            <input type="checkbox" name="symptoms[]" value="neck_shoulder" checked>
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2v6"></path>
                                    <path d="M7 8h10"></path>
                                    <path d="M5 13l4-2 3 3 3-3 4 2"></path>
                                    <circle cx="12" cy="18" r="3"></circle>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Boyun &amp; Omuz Kulunç</strong>
                                <span class="card-desc">Sıkışma, başa vuran gerilim</span>
                            </div>
                        </label>

                        <!-- Kart 2: Bel & Fıtık -->
                        <label class="finder-visual-card" onclick="FinderApp.toggleCheckCard(this)">
                            <input type="checkbox" name="symptoms[]" value="lower_back">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="8"></circle>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Bel &amp; Kuyruk Sokumu</strong>
                                <span class="card-desc">Fıtık hassasiyeti, batma</span>
                            </div>
                        </label>

                        <!-- Kart 3: Şeker & Ödem -->
                        <label class="finder-visual-card" onclick="FinderApp.toggleCheckCard(this)">
                            <input type="checkbox" name="symptoms[]" value="sugar_cravings">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Tatlı Krizi &amp; Şişkinlik</strong>
                                <span class="card-desc">Ödem, yemek sonrası ağırlık</span>
                            </div>
                        </label>

                        <!-- Kart 4: Sabah Tutukluğu -->
                        <label class="finder-visual-card" onclick="FinderApp.toggleCheckCard(this)">
                            <input type="checkbox" name="symptoms[]" value="morning_stiffness">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="7"></circle>
                                    <polyline points="12 9 12 12 14.5 13.5"></polyline>
                                    <path d="M16.51 17.35l-.85 2.12"></path>
                                    <path d="M7.49 17.35l.85 2.12"></path>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Sabah Tutukluğu</strong>
                                <span class="card-desc">Yorgun uyanma, eklem sertliği</span>
                            </div>
                        </label>

                        <!-- Kart 5: Longevity Koruma -->
                        <label class="finder-visual-card" onclick="FinderApp.toggleCheckCard(this)">
                            <input type="checkbox" name="symptoms[]" value="general_longevity">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Longevity &amp; Koruma</strong>
                                <span class="card-desc">Beden gençliği, proaktif sağlık</span>
                            </div>
                        </label>
                    </div>

                    <!-- Alt Yönlendirme -->
                    <div class="finder-bottom-nav">
                        <button type="button" class="btn-finder-backward" onclick="FinderApp.prevStep()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            <span>GERİ</span>
                        </button>
                        <div class="finder-dots-row">
                            <span class="finder-dot"></span>
                            <span class="finder-dot"></span>
                            <span class="finder-dot is-active"></span>
                            <span class="finder-dot"></span>
                        </div>
                        <button type="button" class="btn-finder-forward" onclick="FinderApp.nextStep()">
                            <span>DEVAM ET</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- ADIM 4: Katılım Şekli & Kişisel Not -->
                <div class="finder-step-pane" data-step="4" id="stepPane4">
                    <div class="finder-heading-block">
                        <h2 class="finder-main-question">Size en uygun katılım şekli nedir?</h2>
                        <p class="finder-main-hint">Son adım: Tercih ettiğiniz öğrenme ve rehberlik modelini seçin:</p>
                    </div>

                    <div class="finder-cards-carousel">
                        <!-- Kart 1: Online Canlı Kamp -->
                        <label class="finder-visual-card is-selected" onclick="FinderApp.selectCard(this, 'format')">
                            <input type="radio" name="format" value="online_camp" checked>
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                                    <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                                    <line x1="6" y1="6" x2="6.01" y2="6"></line>
                                    <line x1="6" y1="18" x2="6.01" y2="18"></line>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Online Canlı Kamp</strong>
                                <span class="card-desc">Birebir WhatsApp koçluğu &amp; canlı</span>
                            </div>
                        </label>

                        <!-- Kart 2: Kendi Hızımda Video -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'format')">
                            <input type="radio" name="format" value="self_paced">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Kendi Hızımda Arşiv</strong>
                                <span class="card-desc">Modüler video kütüphanesi &amp; kılavuzlar</span>
                            </div>
                        </label>

                        <!-- Kart 3: Adana Stüdyo & SUP -->
                        <label class="finder-visual-card" onclick="FinderApp.selectCard(this, 'format')">
                            <input type="radio" name="format" value="studio_adana">
                            <span class="card-check-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <div class="card-icon-area">
                                <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div class="card-label-area">
                                <strong class="card-title">Adana Stüdyo &amp; SUP</strong>
                                <span class="card-desc">Yüz yüze reformer ve göl üstü platform</span>
                            </div>
                        </label>
                    </div>

                    <!-- Özel Not Alanı (Minimal & Temiz) -->
                    <div class="finder-notes-minimal">
                        <label for="finderUserNotes" class="finder-notes-minimal-lbl">
                            Fizyoterapist Betina Tansuğ ve AI Motoruna Belirtmek İstediğiniz Bir Not Var mı? (Opsiyonel)
                        </label>
                        <textarea 
                            id="finderUserNotes" 
                            name="notes" 
                            class="finder-notes-minimal-input" 
                            rows="2" 
                            placeholder="Örn: 2 yıldır boyun düzleşmem var, sabahları belimde tutulma hissediyorum..."
                        ></textarea>
                    </div>

                    <!-- Alt Yönlendirme -->
                    <div class="finder-bottom-nav">
                        <button type="button" class="btn-finder-backward" onclick="FinderApp.prevStep()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            <span>GERİ</span>
                        </button>
                        <div class="finder-dots-row">
                            <span class="finder-dot"></span>
                            <span class="finder-dot"></span>
                            <span class="finder-dot"></span>
                            <span class="finder-dot is-active"></span>
                        </div>
                        <button type="button" class="btn-finder-launch-ai" onclick="FinderApp.submitAnalysis()">
                            <span>✨ ANALİZİ BAŞLAT</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>

            </form>

            <!-- ADIM 5: AI Tarama Ekranı (Minimal Temiz Beyaz Arka Plan) -->
            <div class="finder-ai-scanning-screen" id="finderAiScanning" style="display: none;">
                <div class="ai-scan-pulsar">
                    <div class="ai-pulsar-circle circle-1"></div>
                    <div class="ai-pulsar-circle circle-2"></div>
                    <div class="ai-pulsar-circle circle-3"></div>
                    <div class="ai-pulsar-core-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a10 10 0 1 0 10 10H12V2z"></path>
                            <path d="M12 12L2.5 7.5"></path>
                            <path d="M12 12v10"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="ai-scan-main-title">FİZYOBAR YAPAY ZEKA ANALİZ MOTORU ÇALIŞIYOR</h3>
                <p class="ai-scan-sub-status" id="aiScanStatus">Biyomekanik verileriniz ve omurga profiliniz taranıyor...</p>
                <div class="ai-scan-track-line">
                    <div class="ai-scan-track-fill" id="aiScanBarFill"></div>
                </div>
            </div>

            <!-- ADIM 6: Sonuç Raporu ve Eşleşen Program -->
            <div class="finder-results-clean" id="finderResultsView" style="display: none;">
                <div class="results-clean-header">
                    <span class="results-pill-match">YAPAY ZEKA EŞLEŞTİRME BAŞARILI</span>
                    <h2 class="results-clean-title">BEDENİNİZE EN UYGUN PROGRAM BELİRLENDİ</h2>
                    <div class="results-match-percent-box">
                        <span class="match-big-percent" id="resMatchScore">%98</span>
                        <span class="match-big-label">Biyomekanik &amp; Hedef Uyumu</span>
                    </div>
                </div>

                <!-- Öne Çıkan Program Kartı -->
                <div class="results-hero-card">
                    <div class="res-hero-badge" id="resCardBadge">ÖNE ÇIKAN DÖNÜŞÜM PROGRAMI</div>
                    <h3 class="res-hero-title" id="resProgramTitle">4 Haftalık Online Detox &amp; Yoga Kampı</h3>
                    <p class="res-hero-description" id="resProgramDesc">
                        Haftada 3 gün canlı yoga dersleri, Fizyoterapist Betina Tansuğ ile günlük birebir WhatsApp postür kontrolü ve aç kalmadan glisemik dengenizi sağlayan GLP-1 beslenme rehberi.
                    </p>
                    <div class="res-hero-investment" id="resInvestment">
                        4.500 ₺ (Tüm Süreç ve Birebir Koçluk Dahil)
                    </div>
                    <div class="res-hero-buttons">
                        <a href="<?= url('/programs') ?>" class="btn-res-action-primary" id="btnResEnroll">
                            PROGRAMI İNCELE &amp; KATIL &rarr;
                        </a>
                        <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="btn-res-action-secondary" id="btnResWhatsapp">
                            SONUÇLARIMI WHATSAPP İLE GÖNDER &rarr;
                        </a>
                    </div>
                </div>

                <!-- Biyomekanik Değerlendirme & Klinik Analiz -->
                <div class="results-detail-panel">
                    <h4 class="results-panel-heading">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        <span>BİYOMEKANİK &amp; KLİNİK ANALİZ RAPORUNUZ</span>
                    </h4>
                    <div class="results-points-grid" id="resAnalysisPoints">
                        <!-- Dinamik doldurulur -->
                    </div>
                </div>

                <!-- Mikro Rutinler -->
                <div class="results-detail-panel">
                    <h4 class="results-panel-heading">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 14 14"></polyline>
                        </svg>
                        <span>BUGÜN BAŞLAYABİLECEĞİNİZ 3 MİKRO RUTİN</span>
                    </h4>
                    <div class="results-routines-flex" id="resMicroRoutines">
                        <!-- Dinamik doldurulur -->
                    </div>
                </div>

                <!-- Alt Aksiyon -->
                <div class="results-footer-actions">
                    <button type="button" class="btn-clean-outline" onclick="FinderApp.openAiDrawer()">
                        🤖 AI ASİSTAN İLE SOHBET ET
                    </button>
                    <button type="button" class="btn-clean-outline" onclick="FinderApp.restart()">
                        🔄 TESTİ YENİDEN BAŞLAT
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==============================================================================
     PROGRAMINI BUL İNTERAKTİF SİHİRBAZ MOTORU (JAVASCRIPT)
     ============================================================================== -->
<script>
const FinderApp = (function() {
    let currentStep = 1;
    const totalSteps = 4;
    const stepNames = {
        1: 'Öncelikli Beden Hedefiniz',
        2: 'Günlük Rutin & Yaşam Tarzı',
        3: 'Anatomik Belirtiler & Hassasiyetler',
        4: 'Katılım Tercihi & Kişisel Not'
    };

    function selectCard(cardElement, groupName) {
        const carousel = cardElement.closest('.finder-cards-carousel');
        if (!carousel) return;

        carousel.querySelectorAll('.finder-visual-card').forEach(c => {
            c.classList.remove('is-selected');
        });

        cardElement.classList.add('is-selected');
        const radio = cardElement.querySelector('input[type="radio"]');
        if (radio) {
            radio.checked = true;
        }
    }

    function toggleCheckCard(cardElement) {
        const checkbox = cardElement.querySelector('input[type="checkbox"]');
        if (!checkbox) return;

        // Tıklama input'un durumunu tersine çevirir
        checkbox.checked = !checkbox.checked;
        if (checkbox.checked) {
            cardElement.classList.add('is-selected');
        } else {
            cardElement.classList.remove('is-selected');
        }
    }

    function updateUi(direction = 'next') {
        const panes = document.querySelectorAll('.finder-step-pane');
        panes.forEach(p => {
            const stepNum = parseInt(p.getAttribute('data-step') || '0', 10);
            if (stepNum === currentStep) {
                p.classList.remove('is-leaving-left', 'is-leaving-right');
                p.classList.add('is-active');
            } else {
                p.classList.remove('is-active');
            }
        });

        // Segmented pill barları güncelle
        const pills = document.querySelectorAll('.segment-pill');
        pills.forEach((pill, idx) => {
            const pStep = idx + 1;
            if (pStep <= currentStep) {
                pill.classList.add('is-active');
            } else {
                pill.classList.remove('is-active');
            }
        });

        // 1 of 4 metni güncelle
        const counter = document.getElementById('stepCounterText');
        if (counter) counter.textContent = currentStep + ' of ' + totalSteps;

        // Alt isim
        const nameText = document.getElementById('stepNameText');
        if (nameText && stepNames[currentStep]) {
            nameText.textContent = stepNames[currentStep];
        }

        // Segment barına doğru yumuşak kaydır
        const bar = document.getElementById('finderSegmentedProgress');
        if (bar && window.scrollY > 150) {
            bar.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            updateUi('next');
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateUi('prev');
        }
    }

    async function submitAnalysis() {
        const form = document.getElementById('findProgramForm');
        const scanning = document.getElementById('finderAiScanning');
        const results = document.getElementById('finderResultsView');
        const progBar = document.getElementById('finderSegmentedProgress');
        const statusText = document.getElementById('aiScanStatus');
        const barFill = document.getElementById('aiScanBarFill');

        form.style.display = 'none';
        if (progBar) progBar.style.display = 'none';
        scanning.style.display = 'block';

        const statuses = [
            'Biyomekanik verileriniz ve omurga profiliniz taranıyor...',
            'Kas-iskelet dengesi ve masa başı riskleri hesaplanıyor...',
            'Metabolik tokluk ve vagus siniri regülasyonu analiz ediliyor...',
            'En yüksek uyumlu Fizyobar dönüşüm programı eşleştiriliyor...'
        ];

        let sIdx = 0;
        const statusInterval = setInterval(() => {
            sIdx++;
            if (sIdx < statuses.length && statusText) {
                statusText.textContent = statuses[sIdx];
            }
        }, 650);

        if (barFill) {
            barFill.style.transition = 'width 2.6s cubic-bezier(0.16, 1, 0.3, 1)';
            setTimeout(() => { barFill.style.width = '100%'; }, 50);
        }

        const formData = new FormData(form);
        const goal = formData.get('goal') || 'spine_pain';
        const lifestyle = formData.get('lifestyle') || 'desk_heavy';
        const format = formData.get('format') || 'online_camp';
        const notes = formData.get('notes') || '';
        const symptoms = formData.getAll('symptoms[]');

        const payload = {
            goal: goal,
            lifestyle: lifestyle,
            format: format,
            notes: notes,
            symptoms: symptoms
        };

        try {
            const res = await fetch('<?= url('/api/find-program-ai') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();

            setTimeout(() => {
                clearInterval(statusInterval);
                scanning.style.display = 'none';
                results.style.display = 'block';
                populateResults(data.recommendation);
                results.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 2400);

        } catch (err) {
            console.error('Finder AI error:', err);
            setTimeout(() => {
                clearInterval(statusInterval);
                scanning.style.display = 'none';
                results.style.display = 'block';
                populateFallbackResults(goal);
                results.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 2000);
        }
    }

    function populateResults(rec) {
        if (!rec) return;

        const score = document.getElementById('resMatchScore');
        if (score) score.textContent = '%' + (rec.match_score || 98);

        const badge = document.getElementById('resCardBadge');
        if (badge) badge.textContent = rec.badge || 'ÖNE ÇIKAN DÖNÜŞÜM PROGRAMI';

        const title = document.getElementById('resProgramTitle');
        if (title) title.textContent = rec.program_title || '4 Haftalık Online Detox & Yoga Kampı';

        const desc = document.getElementById('resProgramDesc');
        if (desc) desc.textContent = rec.program_desc || '';

        const invest = document.getElementById('resInvestment');
        if (invest) invest.textContent = rec.investment || '4.500 ₺ (Tüm Süreç ve Birebir Koçluk Dahil)';

        const btnEnroll = document.getElementById('btnResEnroll');
        if (btnEnroll) btnEnroll.href = '<?= url('/programs') ?>';

        const btnWa = document.getElementById('btnResWhatsapp');
        if (btnWa && rec.whatsapp_url) btnWa.href = rec.whatsapp_url;

        // Analiz Maddeleri
        const pointsWrap = document.getElementById('resAnalysisPoints');
        if (pointsWrap && Array.isArray(rec.analysis_points)) {
            pointsWrap.innerHTML = rec.analysis_points.map(p => `
                <div class="point-clean-item">
                    <span class="point-clean-bullet">✓</span>
                    <div class="point-clean-body">${p}</div>
                </div>
            `).join('');
        }

        // Mikro Rutinler
        const routinesWrap = document.getElementById('resMicroRoutines');
        if (routinesWrap && Array.isArray(rec.micro_routines)) {
            routinesWrap.innerHTML = rec.micro_routines.map((r, i) => `
                <div class="clean-routine-card">
                    <span class="clean-routine-num">0${i + 1}</span>
                    <strong class="clean-routine-title">${r.title}</strong>
                    <p class="clean-routine-desc">${r.desc}</p>
                </div>
            `).join('');
        }
    }

    function populateFallbackResults(goal) {
        populateResults({
            program_title: '4 Haftalık Online Detox & Yoga Kampı',
            program_slug: 'online-detox-yoga-kampi',
            badge: 'EN ÇOK TERCİH EDİLEN BÜTÜNCÜL DÖNÜŞÜM',
            match_score: 98,
            program_desc: 'Haftada 3 gün canlı yoga dersleri, Fizyoterapist Betina Tansuğ ile günlük birebir WhatsApp postür kontrolü ve aç kalmadan glisemik dengenizi sağlayan GLP-1 beslenme rehberi.',
            investment: '4.500 ₺ (Tüm Ay Boyunca Birebir Eğitmen Takibi Dahil)',
            analysis_points: [
                '<strong>Omurga Hizalanması:</strong> Masa başı hareketsiz saatler boyun ve bel omurlarında sıkışma yaratır. Günlük mobilite seanslarıyla omurga ekseninizi yeniden kuracağız.',
                '<strong>Metabolik Tokluk:</strong> Rafine şeker krizlerini önleyen protein-lif dengesiyle hücresel enflamasyonu hızla dindiriyoruz.'
            ],
            micro_routines: [
                { title: 'Sabah 5 Dk Pelvik Tilt', desc: 'Güne omurgayı nazikçe sıvılandıran kedi-deve hareketleriyle başlayın.' },
                { title: 'Masa Başı Derin Diyafram Nefesi', desc: 'Her 90 dakikada göğüs kafesini açan 3 diyafram nefesi alın.' },
                { title: 'Akşam Tokluk Çayı', desc: 'Akşam tatlı isteğinde ılık seylan tarçını suyuyla kan şekerini sabitleyin.' }
            ],
            whatsapp_url: '<?= __('brand.whatsapp_url') ?>?text=' + encodeURIComponent('Merhaba Betina Hocam, Fizyobar Yapay Zeka Testini tamamladım. 4 Haftalık Online Kamp için bilgi almak istiyorum.')
        });
    }

    function openAiDrawer() {
        const balloon = document.getElementById('aiChatBalloon');
        if (balloon) {
            balloon.click();
            const chatInput = document.getElementById('aiChatInput');
            if (chatInput) {
                chatInput.value = 'Programını Bul testini tamamladım, bana en uygun egzersiz rutini hakkında soru sormak istiyorum.';
                chatInput.focus();
            }
        }
    }

    function restart() {
        currentStep = 1;
        const form = document.getElementById('findProgramForm');
        const results = document.getElementById('finderResultsView');
        const progBar = document.getElementById('finderSegmentedProgress');
        if (form) form.style.display = 'block';
        if (progBar) progBar.style.display = 'block';
        if (results) results.style.display = 'none';
        updateUi();
    }

    return {
        selectCard,
        toggleCheckCard,
        nextStep,
        prevStep,
        submitAnalysis,
        openAiDrawer,
        restart
    };
})();
</script>
