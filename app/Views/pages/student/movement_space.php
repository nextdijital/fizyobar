<?php
declare(strict_types=1);
/**
 * @var array $user
 * @var array $course
 * @var array $enrollment
 * @var array $lessons
 * @var array $lessonsByDay
 * @var int $completedCount
 * @var int $totalWorkouts
 * @var int $progressPercent
 * @var array $progressBlocks
 * @var int $currentProgramDay
 * @var int $currentWeekNumber
 * @var array $thisWeekWorkouts
 * @var array $calendarWeeks
 * @var bool $unlockAll
 * @var string $monthTitle
 * @var array $recipes
 * @var array $tips
 * @var array $routines
 * @var array $badges
 * @var string|null $successMsg
 * @var string|null $errorMsg
 */
?>

<!-- ==============================================================================
     FİZYOBAR KİŞİSEL HAREKET ALANI (İNTERAKTİF TAKVİM & ANTRENMAN PLATFORMU)
     ============================================================================== -->
<div class="movement-space-wrapper">
    <!-- 1. Üst Navigasyon & Hoş Geldin Şeridi -->
    <div class="movement-subnav-bar">
        <div class="container movement-subnav-container">
            <div class="movement-user-welcome">
                <span class="user-avatar-badge"><?= mb_strtoupper(mb_substr($user['full_name'], 0, 1, 'UTF-8'), 'UTF-8') ?></span>
                <div>
                    <h2 class="welcome-user-name"><?= e($user['full_name']) ?></h2>
                    <span class="welcome-program-tag"><?= e($course['title']) ?> &bull; <strong><?= $currentProgramDay ?>. Gün</strong></span>
                </div>
            </div>

            <!-- Tab Butonları -->
            <nav class="movement-tabs-nav" id="movementTabsNav">
                <button type="button" class="movement-tab-btn active" data-tab="tab-overview">Hareket Alanım</button>
                <button type="button" class="movement-tab-btn" data-tab="tab-calendar">Program Takvimim</button>
                <button type="button" class="movement-tab-btn" data-tab="tab-workouts">Antrenmanlarım</button>
                <button type="button" class="movement-tab-btn" data-tab="tab-nutrition">Beslenme Köşesi</button>
                <button type="button" class="movement-tab-btn" data-tab="tab-progress">İlerlemem</button>
                <button type="button" class="movement-tab-btn" data-tab="tab-profile">Profil &amp; Ayarlar</button>
            </nav>
        </div>
    </div>

    <div class="container movement-main-container">
        <!-- Bildirimler -->
        <?php if (!empty($successMsg)): ?>
            <div class="movement-alert movement-alert-success">
                <?= e($successMsg) ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($errorMsg)): ?>
            <div class="movement-alert movement-alert-error">
                <?= e($errorMsg) ?>
            </div>
        <?php endif; ?>

        <!-- ======================================================================
             SEKME 1: HAREKET ALANIM (ANA SAYFA - REFERANS GÖRSEL 1:1 TÜRKÇE)
             ====================================================================== -->
        <div class="movement-tab-content active" id="tab-overview">
            
            <!-- A. HAREKET YOLCULUĞUM (REFERANS GÖRSEL) -->
            <section class="movement-journey-hero">
                <div class="journey-header-flex">
                    <div>
                        <span class="journey-kicker">KİŞİSEL GELİŞİM PANELİ</span>
                        <h1 class="journey-main-title">HAREKET YOLCULUĞUM</h1>
                        <p class="journey-meta-specs">28 Gün &bull; 12 Antrenman &bull; 40 Dakika</p>
                    </div>

                    <!-- Kilit / Önizleme Modu Butonu -->
                    <div class="journey-actions-right">
                        <form action="<?= url('/api/movement/toggle-mode') ?>" method="POST" style="margin: 0;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-lock-toggle <?= $unlockAll ? 'unlocked-active' : '' ?>" title="Eğitmen & Önizleme Modu">
                                <?= $unlockAll ? '🔓 Tüm Kilitler Açık (Önizleme)' : '🔒 Günlük Kilit Modu (Aktif)' ?>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- İlerleme Çubuğu (12 Bloklu Görsel Segment Bar) -->
                <div class="journey-progress-block">
                    <div class="progress-label-row">
                        <span class="progress-title-text">İlerleme Durumunuz:</span>
                        <!-- 12 Bloklu Görsel Parçalı İlerleme Çubuğu -->
                        <div class="progress-blocks-track" id="progressBlocksTrack">
                            <?php foreach ($progressBlocks as $bIdx => $isDone): ?>
                                <span class="progress-segment <?= $isDone ? 'filled' : 'empty' ?>" title="<?= ($bIdx + 1) ?>. Antrenman <?= $isDone ? '(Tamamlandı)' : '' ?>"></span>
                            <?php endforeach; ?>
                        </div>
                        <span class="progress-percent-number" id="progressPercentNumber">%<?= $progressPercent ?></span>
                    </div>

                    <div class="progress-counter-text" id="progressCounterText">
                        <?= $completedCount ?>/<?= $totalWorkouts ?> Antrenman Tamamlandı
                    </div>
                </div>
            </section>

            <!-- B. HAREKET TAKVİMİM (28 GÜNLÜK İNTERAKTİF TAKVİM) -->
            <section class="movement-calendar-section">
                <div class="calendar-title-wrap">
                    <span class="calendar-kicker">AYLIK PLAN</span>
                    <h2 class="calendar-main-title">HAREKET TAKVİMİM</h2>
                    <h3 class="calendar-month-heading"><?= e($monthTitle) ?></h3>
                </div>

                <!-- Takvim Tablosu (Pzt - Paz) -->
                <div class="movement-calendar-card">
                    <!-- Gün Başlıkları (Sadece Türkçe) -->
                    <div class="calendar-weekdays-row">
                        <div><span>PZT</span></div>
                        <div><span>SAL</span></div>
                        <div><span>ÇAR</span></div>
                        <div><span>PER</span></div>
                        <div><span>CUM</span></div>
                        <div><span>CTS</span></div>
                        <div><span>PAZ</span></div>
                    </div>

                    <!-- 4 Hafta Grid -->
                    <div class="calendar-days-grid">
                        <?php foreach ($calendarWeeks as $week): ?>
                            <?php foreach ($week['days'] as $d): ?>
                                <?php 
                                    $hasW = $d['has_workout'];
                                    $w = $d['workout'];
                                    $isComp = $d['is_completed'];
                                    $isLocked = $d['is_locked'];
                                    $isCurrent = $d['is_current_day'];
                                ?>
                                <div class="calendar-cell <?= $hasW ? 'workout-day' : 'rest-day' ?> <?= $isComp ? 'cell-completed' : '' ?> <?= $isLocked ? 'cell-locked' : '' ?> <?= $isCurrent ? 'cell-today' : '' ?>">
                                    <div class="cell-top-bar">
                                        <span class="cell-day-num"><?= $d['day_number'] ?></span>
                                        <?php if ($hasW): ?>
                                            <?php if ($isComp): ?>
                                                <span class="cell-status-icon icon-check" title="Antrenman Tamamlandı">✓</span>
                                            <?php elseif ($isLocked): ?>
                                                <span class="cell-status-icon icon-lock" title="<?= $w['unlock_date'] ?> tarihinde açılacaktır">🔒</span>
                                            <?php else: ?>
                                                <span class="cell-status-icon icon-ready" title="Antrenmanı Başlat">▶</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if ($hasW): ?>
                                        <div class="cell-workout-info">
                                            <span class="cell-workout-name"><?= e(explode(':', $w['title'])[0]) ?></span>
                                            <span class="cell-workout-dur">40 Dk</span>
                                        </div>

                                        <?php if (!$isLocked): ?>
                                            <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $w['id']) ?>" class="cell-click-overlay" title="<?= e($w['title']) ?>"></a>
                                        <?php else: ?>
                                            <button type="button" class="cell-click-overlay cell-locked-btn" onclick="alert('🔒 Bu antrenman programınızın <?= $w['day_number'] ?>. gününde (<?= $w['unlock_date'] ?>) erişime açılacaktır.')"></button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="cell-rest-info">
                                            <span class="cell-rest-label">Dinlenme / Toparlanma</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- C. BU HAFTANIN ANTRENMANLARI -->
            <section class="this-weeks-movement-section">
                <div class="section-heading-clean">
                    <span class="section-kicker">GÜNCEL AKIŞ</span>
                    <h2 class="section-title-clean">BU HAFTANIN ANTRENMANLARI (<?= $currentWeekNumber ?>. HAFTA)</h2>
                </div>

                <div class="this-week-grid">
                    <?php foreach ($thisWeekWorkouts as $wItem): ?>
                        <?php 
                            $isComp = !empty($wItem['is_completed']);
                            $isLocked = !empty($wItem['is_locked']);
                        ?>
                        <article class="workout-feature-card <?= $isComp ? 'card-completed' : '' ?> <?= $isLocked ? 'card-locked' : '' ?>">
                            <div class="workout-card-badge-row">
                                <span class="workout-order-badge">GÜN <?= $wItem['day_number'] ?></span>
                                <?php if ($isComp): ?>
                                    <span class="workout-status-badge badge-green">✓ Tamamlandı</span>
                                <?php elseif ($isLocked): ?>
                                    <span class="workout-status-badge badge-locked">🔒 <?= $wItem['days_left'] ?> Gün Sonra</span>
                                <?php else: ?>
                                    <span class="workout-status-badge badge-ready">Hazır &bull; Başla</span>
                                <?php endif; ?>
                            </div>

                            <h3 class="workout-feature-title">
                                <?= $wItem['workout_number'] ?> &mdash; <?= e($wItem['title']) ?> <?= $isComp ? '✓' : '' ?>
                            </h3>

                            <p class="workout-feature-focus">
                                <?= e($wItem['focus_area'] ?? 'Biyomekanik & Kuvvet') ?> &bull; <?= (int)$wItem['duration_minutes'] ?> DAKİKA
                            </p>

                            <p class="workout-feature-desc">
                                <?= e($wItem['description']) ?>
                            </p>

                            <div class="workout-card-footer">
                                <?php if ($isLocked): ?>
                                    <button type="button" class="btn-workout-action disabled" disabled>
                                        🔒 <?= $wItem['unlock_date'] ?> Tarihinde Açılacaktır
                                    </button>
                                <?php else: ?>
                                    <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $wItem['id']) ?>" class="btn-workout-action <?= $isComp ? 'action-replay' : 'action-start' ?>">
                                        <?= $isComp ? 'Yeniden İzle &rarr;' : 'Antrenmana Başla &rarr;' ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

        <!-- ======================================================================
             SEKME 2: PROGRAM TAKVİMİM (28 GÜNLÜK DETAYLI LİSTE)
             ====================================================================== -->
        <div class="movement-tab-content" id="tab-calendar">
            <div class="tab-header-box">
                <span class="tab-kicker">4 HAFTALIK DÖNGÜ</span>
                <h2 class="tab-title">28 Günlük İnteraktif Antrenman Takvimi</h2>
                <p class="tab-subtitle">Haftanın 3 günü (Pazartesi, Çarşamba, Cuma) 40 dakikalık bilimsel seanslar yer alır. Diğer günler sinir sistemi toparlanması, vagus nefesi ve dinlenmeye ayrılmıştır.</p>
            </div>

            <div class="weeks-breakdown-list">
                <?php foreach ($calendarWeeks as $w): ?>
                    <div class="week-container-card">
                        <div class="week-card-header">
                            <h3 class="week-title-text"><?= $w['week_number'] ?>. HAFTA PROGRAMI</h3>
                            <span class="week-days-range">Gün <?= (($w['week_number'] - 1) * 7 + 1) ?> &mdash; <?= ($w['week_number'] * 7) ?></span>
                        </div>

                        <div class="week-days-row-cards">
                            <?php foreach ($w['days'] as $day): ?>
                                <?php 
                                    $hasW = $day['has_workout'];
                                    $wObj = $day['workout'];
                                    $isComp = $day['is_completed'];
                                    $isLocked = $day['is_locked'];
                                ?>
                                <div class="day-micro-card <?= $hasW ? 'has-workout' : 'is-rest' ?> <?= $isComp ? 'is-completed' : '' ?> <?= $isLocked ? 'is-locked' : '' ?>">
                                    <div class="micro-card-top">
                                        <span class="micro-day-name"><?= $day['day_label'] ?></span>
                                        <span class="micro-day-num"><?= $day['day_number'] ?>. Gün</span>
                                    </div>

                                    <?php if ($hasW): ?>
                                        <h4 class="micro-workout-title"><?= e($wObj['title']) ?></h4>
                                        <span class="micro-workout-meta"><?= (int)$wObj['duration_minutes'] ?> Dk &bull; <?= e($wObj['equipment']) ?></span>

                                        <div class="micro-card-action">
                                            <?php if ($isComp): ?>
                                                <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $wObj['id']) ?>" class="micro-link completed">
                                                    ✓ Tamamlandı
                                                </a>
                                            <?php elseif ($isLocked): ?>
                                                <span class="micro-link locked">
                                                    🔒 <?= $wObj['unlock_date'] ?>
                                                </span>
                                            <?php else: ?>
                                                <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $wObj['id']) ?>" class="micro-link ready">
                                                    Seansı Aç &rarr;
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="micro-rest-content">
                                            <span class="micro-rest-icon">🌿</span>
                                            <span class="micro-rest-text">Dinlenme &amp; Toparlanma</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ======================================================================
             SEKME 3: ANTRENMANLARIM (TÜM 12 DERS LİSTESİ)
             ====================================================================== -->
        <div class="movement-tab-content" id="tab-workouts">
            <div class="tab-header-box">
                <span class="tab-kicker">MÜFREDAT &amp; SEANSLAR</span>
                <h2 class="tab-title">Tüm 12 Antrenman Kütüphanesi</h2>
                <p class="tab-subtitle">Klinik biyomekanik ve yoga akışlarıyla bedeninizi dönüştüren tüm antrenmanlar sırayla aşağıda listelenmiştir.</p>
            </div>

            <div class="all-workouts-grid">
                <?php foreach ($lessons as $idx => $les): ?>
                    <?php 
                        $isComp = !empty($les['is_completed']);
                        $isLocked = !empty($les['is_locked']);
                    ?>
                    <div class="workout-archive-item <?= $isComp ? 'item-completed' : '' ?> <?= $isLocked ? 'item-locked' : '' ?>">
                        <div class="workout-item-left">
                            <span class="workout-num-pill"><?= $les['workout_number'] ?></span>
                            <div>
                                <span class="workout-day-tag">Program Günü: <?= $les['day_number'] ?></span>
                                <h3 class="workout-item-title"><?= e($les['title']) ?></h3>
                                <p class="workout-item-sub"><?= e($les['focus_area']) ?> &bull; <strong>Ekipman:</strong> <?= e($les['equipment'] ?: 'Mat') ?></p>
                            </div>
                        </div>

                        <div class="workout-item-right">
                            <span class="workout-item-duration"><?= (int)$les['duration_minutes'] ?> Dk</span>
                            <?php if ($isComp): ?>
                                <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $les['id']) ?>" class="btn-item-action btn-replay">
                                    ✓ Tekrar İzle
                                </a>
                            <?php elseif ($isLocked): ?>
                                <span class="btn-item-action btn-locked-tag">
                                    🔒 <?= $les['unlock_date'] ?>
                                </span>
                            <?php else: ?>
                                <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $les['id']) ?>" class="btn-item-action btn-start">
                                    Antrenmana Başla &rarr;
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ======================================================================
             SEKME 4: BESLENME KÖŞESİ & EKSTRA MİKRO RUTİNLER
             ====================================================================== -->
        <div class="movement-tab-content" id="tab-nutrition">
            <div class="tab-header-box">
                <span class="tab-kicker">FONKSİYONEL BESLENME &amp; LONGEVITY</span>
                <h2 class="tab-title">Beslenme Köşesi &amp; Ekstra Mikro Rutinler</h2>
                <p class="tab-subtitle">Antrenman etkisini katlayan fonksiyonel, anti-enflamatuar tarifler ve gün içi mikro mobilite egzersizleri.</p>
            </div>

            <!-- Günlük Fonksiyonel Tarifler -->
            <div class="nutrition-block-section">
                <h3 class="nutrition-block-title">Anti-Enflamatuar &amp; GLP-1 Destekleyici Tarifler</h3>
                <div class="nutrition-cards-grid">
                    <?php foreach ($recipes as $rec): ?>
                        <div class="nutrition-card">
                            <div class="nutrition-card-header">
                                <span class="nutrition-badge"><?= e($rec['badge']) ?></span>
                                <span class="nutrition-time"><?= e($rec['time_needed']) ?></span>
                            </div>
                            <h4 class="nutrition-card-title"><?= e($rec['title']) ?></h4>
                            <p class="nutrition-card-subtitle"><?= e($rec['subtitle']) ?></p>

                            <?php if (!empty($rec['ingredients'])): ?>
                                <div class="nutrition-ingredients-box">
                                    <span class="box-heading">Malzemeler:</span>
                                    <p><?= nl2br(e($rec['ingredients'])) ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="nutrition-content-body">
                                <p><?= nl2br(e($rec['content'])) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Ekstra Mikro-Rutinler (Nefes, Esneme, Masa Başı) -->
            <div class="nutrition-block-section" style="margin-top: 3rem;">
                <h3 class="nutrition-block-title">Kısa Mobilite, Vagus &amp; Esneme Mikro Rutinleri</h3>
                <div class="nutrition-cards-grid">
                    <?php foreach ($routines as $rt): ?>
                        <div class="nutrition-card routine-card">
                            <div class="nutrition-card-header">
                                <span class="nutrition-badge routine-badge"><?= e($rt['badge']) ?></span>
                                <span class="nutrition-time"><?= e($rt['time_needed']) ?></span>
                            </div>
                            <h4 class="nutrition-card-title"><?= e($rt['title']) ?></h4>
                            <p class="nutrition-card-subtitle"><?= e($rt['subtitle']) ?></p>

                            <?php if (!empty($rt['ingredients'])): ?>
                                <div class="nutrition-ingredients-box">
                                    <span class="box-heading">Uygulama Adımları:</span>
                                    <p><?= nl2br(e($rt['ingredients'])) ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="nutrition-content-body">
                                <p><?= nl2br(e($rt['content'])) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($tips as $tp): ?>
                        <div class="nutrition-card tip-card">
                            <div class="nutrition-card-header">
                                <span class="nutrition-badge tip-badge"><?= e($tp['badge']) ?></span>
                                <span class="nutrition-time"><?= e($tp['time_needed']) ?></span>
                            </div>
                            <h4 class="nutrition-card-title"><?= e($tp['title']) ?></h4>
                            <p class="nutrition-card-subtitle"><?= e($tp['subtitle']) ?></p>

                            <div class="nutrition-content-body">
                                <p><?= nl2br(e($tp['content'])) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- ======================================================================
             SEKME 5: İLERLEMEM & ROZETLERİM
             ====================================================================== -->
        <div class="movement-tab-content" id="tab-progress">
            <div class="tab-header-box">
                <span class="tab-kicker">KİŞİSEL GELİŞİM</span>
                <h2 class="tab-title">İlerlemem &amp; Kazanılan Başarılar</h2>
                <p class="tab-subtitle">28 günlük kamp sürecinde tamamladığınız antrenmanlar ve bedeninize kazandırdığınız rozetler.</p>
            </div>

            <!-- İstatistik Kartları -->
            <div class="progress-stats-row">
                <div class="stat-mini-card">
                    <span class="stat-value-big"><?= $completedCount ?> / <?= $totalWorkouts ?></span>
                    <span class="stat-desc-label">Tamamlanan Antrenman</span>
                </div>
                <div class="stat-mini-card">
                    <span class="stat-value-big">%<?= $progressPercent ?></span>
                    <span class="stat-desc-label">Genel Program İlerlemesi</span>
                </div>
                <div class="stat-mini-card">
                    <span class="stat-value-big"><?= $completedCount * 40 ?> dk</span>
                    <span class="stat-desc-label">Toplam Hareket Süresi</span>
                </div>
                <div class="stat-mini-card">
                    <span class="stat-value-big"><?= count($badges) ?></span>
                    <span class="stat-desc-label">Kazanılan Rozetler</span>
                </div>
            </div>

            <!-- Rozetler Bölümü -->
            <div class="badges-showcase-section">
                <h3 class="badges-title">Kazanılan Başarı Rozetleri</h3>
                <div class="badges-grid-list">
                    <div class="badge-item-card <?= ($completedCount >= 1) ? 'badge-earned' : 'badge-locked' ?>">
                        <div class="badge-icon-box">🌱</div>
                        <h4 class="badge-name">İlk Adım Rozeti</h4>
                        <p class="badge-desc">1. Antrenmanı tamamlayarak hareket yolculuğuna başlayanlara verilir.</p>
                        <span class="badge-tag"><?= ($completedCount >= 1) ? '✓ KAZANILDI' : '🔒 Kilitli' ?></span>
                    </div>

                    <div class="badge-item-card <?= ($progressPercent >= 50) ? 'badge-earned' : 'badge-locked' ?>">
                        <div class="badge-icon-box">⚡</div>
                        <h4 class="badge-name">Yolun Yarısı Rozeti</h4>
                        <p class="badge-desc">Kampın ilk 2 haftasını (6 antrenman) başarıyla geride bırakanlara verilir.</p>
                        <span class="badge-tag"><?= ($progressPercent >= 50) ? '✓ KAZANILDI' : '🔒 Kilitli' ?></span>
                    </div>

                    <div class="badge-item-card <?= ($progressPercent >= 100) ? 'badge-earned' : 'badge-locked' ?>">
                        <div class="badge-icon-box">🏆</div>
                        <h4 class="badge-name">28 Günlük Kamp Şampiyonu</h4>
                        <p class="badge-desc">Tüm 12 antrenmanı ve 28 günlük döngüyü tamamlayan Longevity Master'lara verilir.</p>
                        <span class="badge-tag"><?= ($progressPercent >= 100) ? '✓ KAZANILDI' : '🔒 Kilitli' ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================================================================
             SEKME 6: PROFİLİM & HESAP AYARLARI
             ====================================================================== -->
        <div class="movement-tab-content" id="tab-profile">
            <div class="tab-header-box">
                <span class="tab-kicker">HESAP GÜVENLİĞİ &amp; ÜYELİK</span>
                <h2 class="tab-title">Profil &amp; Hesap Ayarlarım</h2>
                <p class="tab-subtitle">Kayıtlı programlarınızı görüntüleyin, kişisel bilgilerinizi ve şifrenizi güncelleyin.</p>
            </div>

            <!-- Aktif Programlarım & Abonelik Durumu Kartı -->
            <div class="profile-subscriptions-block" style="background: #ffffff; border: 1px solid #e5e5e5; border-radius: 12px; padding: clamp(1.25rem, 2.5vw, 1.75rem); margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem; border-bottom: 1px solid #f0f0f0; padding-bottom: 0.85rem;">
                    <div>
                        <h3 style="font-size: 1.15rem; font-weight: 700; margin: 0; color: #111111;">Kayıtlı Programlarım &amp; Paketlerim</h3>
                        <p style="font-size: 0.84rem; color: #666666; margin: 0.25rem 0 0 0;">Satın aldığınız veya tanımlanan aktif antrenman paketleriniz.</p>
                    </div>
                    <span style="display: inline-flex; align-items: center; gap: 0.35rem; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 999px; padding: 0.35rem 0.85rem; font-size: 0.78rem; font-weight: 600;">
                        <span style="width: 7px; height: 7px; border-radius: 50%; background: #10b981; display: inline-block;"></span>
                        Üyelik Durumu: Aktif
                    </span>
                </div>

                <?php if (!empty($userEnrollments)): ?>
                    <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                        <?php foreach ($userEnrollments as $uEnr): ?>
                            <?php 
                                $isThisActive = ((int)$uEnr['course_id'] === (int)$course['id']);
                                $isApproved = ($uEnr['payment_status'] === 'approved');
                            ?>
                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.25rem; border-radius: 8px; border: 1px solid <?= $isThisActive ? '#111111' : '#e5e5e5' ?>; background: <?= $isThisActive ? '#fafafa' : '#ffffff' ?>; flex-wrap: wrap; gap: 1rem;">
                                <div>
                                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                                        <h4 style="font-size: 0.98rem; font-weight: 700; color: #111111; margin: 0;"><?= e($uEnr['course_title']) ?></h4>
                                        <?php if ($isThisActive): ?>
                                            <span style="background: #111111; color: #ffffff; font-size: 0.68rem; font-weight: 700; padding: 0.2rem 0.55rem; border-radius: 4px; letter-spacing: 0.05em;">SEÇİLİ ALAN</span>
                                        <?php endif; ?>
                                    </div>
                                    <div style="font-size: 0.8rem; color: #71717a; margin-top: 0.35rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                                        <span><strong>Kayıt:</strong> <?= date('d.m.Y', strtotime($uEnr['created_at'])) ?></span>
                                        <?php if (!empty($uEnr['expires_at'])): ?>
                                            <span><strong>Geçerlilik:</strong> <?= date('d.m.Y', strtotime($uEnr['expires_at'])) ?></span>
                                        <?php endif; ?>
                                        <span><strong>Erişim:</strong> <?= $isApproved ? '<span style="color: #059669; font-weight: 600;">Tüm Videolar Açık</span>' : '<span style="color: #d97706;">Onay Bekleniyor</span>' ?></span>
                                    </div>
                                </div>

                                <div>
                                    <?php if ($isThisActive): ?>
                                        <button type="button" class="btn-clean-plan" onclick="document.querySelector('[data-tab=\'tab-overview\']').click()" style="padding: 0.45rem 1.1rem; font-size: 0.82rem; background: #000000; color: #ffffff; border-radius: 999px; text-decoration: none; display: inline-block;">
                                            Antrenmanlara Devam Et &rarr;
                                        </button>
                                    <?php else: ?>
                                        <a href="<?= url('/movement-space?course=' . $uEnr['course_id']) ?>" style="padding: 0.45rem 1.1rem; font-size: 0.82rem; background: #ffffff; color: #111111; border: 1px solid #111111; border-radius: 999px; text-decoration: none; display: inline-block; font-weight: 600;">
                                            Bu Programa Geç &rarr;
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p style="color: #71717a; font-size: 0.88rem; margin: 0;">Henüz kayıtlı bir programınız bulunmamaktadır. <a href="<?= url('/programs') ?>" style="color: #111111; font-weight: 600;">Programlar sayfamızdan</a> dilediğiniz eğitime katılabilirsiniz.</p>
                <?php endif; ?>
            </div>

            <div class="profile-settings-grid">
                <!-- Sol Form: Profil Bilgileri -->
                <div class="profile-card-form" style="border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h3 class="profile-card-title">Kişisel Bilgiler</h3>
                    <form action="<?= url('/api/profile/update') ?>" method="POST" class="auth-form">
                        <?= csrf_field() ?>

                        <div class="auth-form-group">
                            <label class="auth-form-label" for="full_name">ADINIZ SOYADINIZ</label>
                            <input type="text" id="full_name" name="full_name" class="auth-form-input" value="<?= e($user['full_name']) ?>" required style="border-radius: 999px; padding: 11px 18px;">
                        </div>

                        <div class="auth-form-group">
                            <label class="auth-form-label" for="prof_email">E-POSTA ADRESİ (DEĞİŞTİRİLEMEZ)</label>
                            <input type="email" id="prof_email" class="auth-form-input" value="<?= e($user['email']) ?>" disabled style="opacity: 0.65; border-radius: 999px; padding: 11px 18px; background: #f4f4f6;">
                        </div>

                        <div class="auth-form-group">
                            <label class="auth-form-label" for="phone">TELEFON / WHATSAPP</label>
                            <input type="tel" id="phone" name="phone" class="auth-form-input" value="<?= e($user['phone'] ?? '') ?>" placeholder="05XX XXX XX XX" style="border-radius: 999px; padding: 11px 18px;">
                        </div>

                        <button type="submit" class="btn-pill-solid" style="background: #111111; color: #ffffff; margin-top: 1.25rem; width: 100%; border-radius: 999px; padding: 12px; font-weight: 600;">
                            BİLGİLERİ GÜNCELLE &rarr;
                        </button>
                    </form>
                </div>

                <!-- Sağ Form: Şifre Değiştirme -->
                <div class="profile-card-form" style="border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h3 class="profile-card-title">Şifre Değiştir</h3>
                    <form action="<?= url('/api/profile/password') ?>" method="POST" class="auth-form">
                        <?= csrf_field() ?>

                        <div class="auth-form-group">
                            <label class="auth-form-label" for="current_password">MEVCUT ŞİFRENİZ</label>
                            <input type="password" id="current_password" name="current_password" class="auth-form-input" required autocomplete="current-password" placeholder="Mevcut şifreniz" style="border-radius: 999px; padding: 11px 18px;">
                        </div>

                        <div class="auth-form-group">
                            <label class="auth-form-label" for="new_password">YENİ ŞİFRE (EN AZ 6 KARAKTER)</label>
                            <input type="password" id="new_password" name="new_password" class="auth-form-input" required autocomplete="new-password" placeholder="Yeni şifreniz" style="border-radius: 999px; padding: 11px 18px;">
                        </div>

                        <div class="auth-form-group">
                            <label class="auth-form-label" for="new_password_confirm">YENİ ŞİFRE TEKRARI</label>
                            <input type="password" id="new_password_confirm" name="new_password_confirm" class="auth-form-input" required autocomplete="new-password" placeholder="Yeni şifrenizi tekrar girin" style="border-radius: 999px; padding: 11px 18px;">
                        </div>

                        <button type="submit" class="btn-pill-solid" style="background: #111111; color: #ffffff; margin-top: 1.25rem; width: 100%; border-radius: 999px; padding: 12px; font-weight: 600;">
                            ŞİFREYİ GÜNCELLE &rarr;
                        </button>
                    </form>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e4e4e7; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <span style="font-size: 0.82rem; color: #71717a;">Giriş Yapılan Hesap: <strong><?= e($user['email']) ?></strong></span>
                <a href="<?= url('/logout') ?>" class="btn-workout-action" style="display: inline-block; width: auto; background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; border-radius: 999px; padding: 0.5rem 1.25rem; font-weight: 600; text-decoration: none;">
                    Güvenli Çıkış Yap &rarr;
                </a>
            </div>
        </div>

    </div>
</div>

<!-- ==============================================================================
     TAB GEÇİŞLERİ VE İNTERAKTİF SCRİPT
     ============================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('#movementTabsNav .movement-tab-btn');
    const tabContents = document.querySelectorAll('.movement-tab-content');

    function switchTab(targetId) {
        tabButtons.forEach(btn => {
            if (btn.getAttribute('data-tab') === targetId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        tabContents.forEach(content => {
            if (content.id === targetId) {
                content.classList.add('active');
            } else {
                content.classList.remove('active');
            }
        });

        if (window.location.hash !== '#' + targetId.replace('tab-', '')) {
            window.location.hash = targetId.replace('tab-', '');
        }
    }

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const target = this.getAttribute('data-tab');
            switchTab(target);
        });
    });

    const currentHash = window.location.hash.replace('#', '');
    if (currentHash) {
        const matchingBtn = document.querySelector(`[data-tab="tab-${currentHash}"]`);
        if (matchingBtn) {
            switchTab(`tab-${currentHash}`);
        }
    }
});
</script>
