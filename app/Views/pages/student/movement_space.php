<?php
declare(strict_types=1);
/**
 * FİZYOBAR ÖĞRENCİ PORTALİ & HAREKET ALANI (LIGHT LUXURY)
 * 
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
 * @var array $loyalty
 * @var array $tasks
 * @var array $giftEnrollments
 * @var string|null $successMsg
 * @var string|null $errorMsg
 */

// 12 Seans Görselleri
$workoutThumbnails = [
    1 => asset('assets/images/betina-outdoor-stretch.jpg'),
    2 => asset('assets/images/betina-studio-forward-fold.jpg'),
    3 => asset('assets/images/betina-outdoor-inversion.jpg'),
    4 => asset('assets/images/Gemini_Generated_Image_87r04087r04087r0.jpg'),
    5 => asset('assets/images/Gemini_Generated_Image_8n74ah8n74ah8n74.jpg'),
    6 => asset('assets/images/Gemini_Generated_Image_a776k4a776k4a776.jpg'),
    7 => asset('assets/images/Gemini_Generated_Image_dp2ahzdp2ahzdp2a.jpg'),
    8 => asset('assets/images/Gemini_Generated_Image_rj4gf2rj4gf2rj4g.jpg'),
    9 => asset('assets/images/Gemini_Generated_Image_zcs2kozcs2kozcs2.jpg'),
    10 => asset('assets/images/hero-poster.jpg'),
    11 => asset('assets/images/betina-outdoor-stretch.jpg'),
    12 => asset('assets/images/betina-outdoor-inversion.jpg'),
];

// Sıradaki / Güncel Seansı Bul
$spotlightLesson = null;
foreach ($lessons as $l) {
    if (empty($l['is_completed']) && empty($l['is_locked'])) {
        $spotlightLesson = $l;
        break;
    }
}
if (!$spotlightLesson && !empty($lessons)) {
    foreach ($lessons as $l) {
        if (empty($l['is_completed'])) {
            $spotlightLesson = $l;
            break;
        }
    }
    if (!$spotlightLesson) {
        $spotlightLesson = $lessons[0];
    }
}
?>

<link rel="stylesheet" href="<?= asset('assets/css/student-portal.css') ?>?v=<?= time() ?>">

<div class="portal-light-wrapper">

    <!-- =========================================================================
         1. ÜST HOŞ GELDİN & KULLANICI ŞERİDİ + ENTEGRE SEKMELER (SUB-HEADER)
         ========================================================================= -->
    <div class="portal-top-banner">
        <div class="portal-container">
            <div class="portal-top-banner-inner">
                
                <!-- Sol: Profil Karşılama & Program Künyesi -->
                <div class="portal-user-welcome">
                    <div class="portal-avatar-circle">
                        <?= mb_strtoupper(mb_substr($user['full_name'] ?? 'Ö', 0, 1, 'UTF-8'), 'UTF-8') ?>
                    </div>
                    <div class="portal-user-headings">
                        <h1 class="portal-user-name">
                            Hoş geldin, <?= e($user['full_name'] ?? 'Öğrenci') ?>
                        </h1>
                        <div class="portal-program-tag">
                            <span><?= e($course['title'] ?? '4 Haftalık Metabolik Detoks &amp; Yoga Kampı') ?></span>
                            <span>&bull;</span>
                            <span class="portal-program-day-badge"><?= $currentProgramDay ?>. GÜN</span>
                        </div>
                    </div>
                </div>

                <!-- Sağ: Canlı Sayaç Hapları -->
                <div class="portal-top-metrics">
                    <div class="portal-metric-pill pill-loyalty" title="Mevcut Sadakat Bakiyesi">
                        <span>★</span>
                        <span><?= (int)($loyalty['points'] ?? 100) ?> Puan</span>
                        <span style="font-size: 0.72rem; text-transform: uppercase; opacity: 0.8;">(<?= e($loyalty['tier'] ?? 'bronze') ?>)</span>
                    </div>

                    <div class="portal-metric-pill pill-streak" title="Kesintisiz Günlük Egzersiz Serisi">
                        <span>🔥</span>
                        <span><?= (int)($loyalty['streak_days'] ?? 3) ?> Günlük Seri</span>
                    </div>

                    <div class="portal-metric-pill pill-progress" title="Müfredat Tamamlanma Oranı">
                        <span>✓</span>
                        <span>%<?= $progressPercent ?> Tamamlandı (<?= $completedCount ?>/<?= $totalWorkouts ?>)</span>
                    </div>
                </div>

            </div>

            <!-- ENTEGRE YATAY SEKMELER -->
            <div class="portal-tabs-track-wrap" style="margin-top: 1.25rem; margin-bottom: 0; padding-bottom: 0; border-bottom: none;">
                <nav class="portal-tabs-track" role="tablist" aria-label="Portal Gezintisi">
                    <button type="button" class="portal-tab-pill-btn active" data-tab="sp-tab-overview" role="tab" aria-selected="true">
                        <span>✦</span>
                        <span>Genel Bakış</span>
                    </button>

                    <button type="button" class="portal-tab-pill-btn" data-tab="sp-tab-workouts" role="tab" aria-selected="false">
                        <span>🎬</span>
                        <span>Antrenmanlar</span>
                        <span class="tab-badge-num"><?= $totalWorkouts ?></span>
                    </button>

                    <button type="button" class="portal-tab-pill-btn" data-tab="sp-tab-calendar" role="tab" aria-selected="false">
                        <span>📅</span>
                        <span>28 Günlük Takvim</span>
                    </button>

                    <button type="button" class="portal-tab-pill-btn" data-tab="sp-tab-tasks" role="tab" aria-selected="false">
                        <span>✓</span>
                        <span>Görevlerim &amp; Sadakat</span>
                        <?php if (!empty($tasks)): ?>
                            <span class="tab-badge-num"><?= count($tasks) ?></span>
                        <?php endif; ?>
                    </button>

                    <button type="button" class="portal-tab-pill-btn" data-tab="sp-tab-nutrition" role="tab" aria-selected="false">
                        <span>🥗</span>
                        <span>Beslenme Köşesi</span>
                    </button>

                    <button type="button" class="portal-tab-pill-btn" data-tab="sp-tab-profile" role="tab" aria-selected="false">
                        <span>⚙️</span>
                        <span>Profil &amp; Ayarlar</span>
                    </button>
                </nav>
            </div>

        </div>
    </div>

    <div class="portal-container" style="padding-top: 1.5rem;">

        <!-- Başarı / Bilgi Mesajı -->
        <?php if (!empty($successMsg)): ?>
            <div style="background-color: var(--sp-green-light); border: 1px solid var(--sp-green-border); color: var(--sp-green); padding: 0.9rem 1.4rem; border-radius: var(--sp-radius-md); margin-bottom: 1.5rem; font-size: 0.88rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;">
                <span style="font-size: 1.1rem;">✓</span>
                <span><?= e($successMsg) ?></span>
            </div>
        <?php endif; ?>

        <!-- Eğitmen Hediye Paket Bildirimi (Varsa) -->
        <?php if (!empty($giftEnrollments)): ?>
            <?php foreach ($giftEnrollments as $gift): ?>
                <div style="background: linear-gradient(135deg, #fffbeb, #fef3c7); border: 1.5px solid #fde68a; border-radius: var(--sp-radius-md); padding: 1.25rem 1.5rem; margin-bottom: 1.75rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 0.85rem;">
                        <span style="font-size: 1.6rem;">🎁</span>
                        <div>
                            <span style="font-size: 0.72rem; font-weight: 800; color: #92400e; letter-spacing: 0.1em; text-transform: uppercase;">EĞİTMEN HEDİYESİ TANIMLANDI</span>
                            <h3 style="font-size: 1.05rem; font-weight: 800; color: #78350f; margin: 0.2rem 0;"><?= e($gift['course_title']) ?></h3>
                            <?php if (!empty($gift['gift_message'])): ?>
                                <p style="font-size: 0.84rem; color: #92400e; margin: 0; font-style: italic;">"<?= e($gift['gift_message']) ?>"</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="<?= url('/course/' . ($gift['slug'] ?? 'detoks')) ?>" class="btn-sp-primary" style="padding: 0.5rem 1.2rem; font-size: 0.82rem;">
                        Hediyeyi Aç &rarr;
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- =========================================================================
             SEKME 1: GENEL BAKIŞ (OVERVIEW)
             ========================================================================= -->
        <div class="portal-tab-pane active" id="sp-tab-overview">
            
            <!-- A. Günün Antrenmanı Spotlight Kartı -->
            <?php if ($spotlightLesson): ?>
                <?php 
                    $thumbImg = $workoutThumbnails[(int)$spotlightLesson['workout_number']] ?? $workoutThumbnails[1];
                ?>
                <div class="sp-spotlight-card">
                    <div class="sp-spotlight-media">
                        <img src="<?= $thumbImg ?>" alt="<?= e($spotlightLesson['title']) ?>" class="sp-spotlight-img">
                        <span class="sp-spotlight-badge">GÜNÜN ANTRENMANI &bull; GÜN <?= $spotlightLesson['day_number'] ?></span>
                    </div>

                    <div class="sp-spotlight-body">
                        <div>
                            <span class="sp-card-kicker">BUGÜNÜN HAREKET PRATİĞİ</span>
                            <h2 class="sp-spotlight-title" style="margin-bottom: 0.35rem;">
                                <?= $spotlightLesson['workout_number'] ?>. Seans: <?= e($spotlightLesson['title']) ?>
                            </h2>
                            <p class="sp-spotlight-desc">
                                <?= e($spotlightLesson['focus_area'] ?? 'Omurga mobilizasyonu, diyafram solunumu ve derin fasya rahatlaması.') ?>
                            </p>
                            
                            <div class="sp-spotlight-meta-row">
                                <span>⏱ <strong><?= (int)$spotlightLesson['duration_minutes'] ?> Dakika</strong></span>
                                <span>&bull;</span>
                                <span>🔥 <strong>280 Cal</strong></span>
                                <span>&bull;</span>
                                <span>🎯 <strong>Orta Seviye</strong></span>
                            </div>
                        </div>

                        <div class="sp-spotlight-action-row">
                            <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $spotlightLesson['id']) ?>" class="btn-sp-primary">
                                <span>▶</span>
                                <span>Antrenmana Başla</span>
                            </a>
                            <button type="button" class="btn-sp-outline js-switch-tab" data-target="sp-tab-workouts">
                                <span>Tüm Seansları Gör &rarr;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- B. Canlı İlerleme Sayaçları (3 Sayaç Kartı) -->
            <div class="sp-metrics-grid">
                <!-- 1. Aktif Kalori -->
                <div class="sp-metric-card">
                    <div class="sp-metric-card-top">
                        <span class="sp-metric-label">Aktif Kalori</span>
                        <span class="sp-metric-icon">🔥</span>
                    </div>
                    <div>
                        <div class="sp-metric-val">745 <span style="font-size: 1.1rem; font-weight: 600; color: var(--sp-text-muted);">Cal</span></div>
                        <div class="sp-metric-sub">Haftalık hedef: 1.200 Cal</div>
                    </div>
                    <div class="sp-metric-bar-wrap">
                        <div class="sp-metric-bar-fill" style="width: 62%; background: #ea580c;"></div>
                    </div>
                </div>

                <!-- 2. Pratik Süresi -->
                <div class="sp-metric-card">
                    <div class="sp-metric-card-top">
                        <span class="sp-metric-label">Haftalık Pratik</span>
                        <span class="sp-metric-icon">⏱</span>
                    </div>
                    <div>
                        <div class="sp-metric-val">45 <span style="font-size: 1.1rem; font-weight: 600; color: var(--sp-text-muted);">Dk</span></div>
                        <div class="sp-metric-sub">Bu hafta tamamlanan mat süresi</div>
                    </div>
                    <div class="sp-metric-bar-wrap">
                        <div class="sp-metric-bar-fill" style="width: 75%; background: var(--sp-bordo);"></div>
                    </div>
                </div>

                <!-- 3. Seans İlerlemesi -->
                <div class="sp-metric-card">
                    <div class="sp-metric-card-top">
                        <span class="sp-metric-label">Kamp Tamamlanma</span>
                        <span class="sp-metric-icon">🏆</span>
                    </div>
                    <div>
                        <div class="sp-metric-val">%<?= $progressPercent ?> <span style="font-size: 1.1rem; font-weight: 600; color: var(--sp-text-muted);">(<?= $completedCount ?>/<?= $totalWorkouts ?>)</span></div>
                        <div class="sp-metric-sub">12 Seanslık Bütünsel Dönüşüm</div>
                    </div>
                    <div class="sp-metric-bar-wrap">
                        <div class="sp-metric-bar-fill" style="width: <?= $progressPercent ?>%; background: var(--sp-green);"></div>
                    </div>
                </div>
            </div>

            <!-- C. İki Kolonlu Alt Panel: Günün Görevleri + Hidrasyon Takibi -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                
                <!-- Sol: Bugünün Görevleri -->
                <div class="sp-card" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <div>
                            <span class="sp-card-kicker">ÖDEVLER &amp; CHECKLIST</span>
                            <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--sp-text); margin: 0;">Günün Görevleri</h3>
                        </div>
                        <button type="button" class="btn-sp-outline js-switch-tab" data-target="sp-tab-tasks" style="padding: 0.35rem 0.85rem; font-size: 0.78rem;">
                            Tümü &rarr;
                        </button>
                    </div>

                    <?php if (empty($tasks)): ?>
                        <p style="color: var(--sp-text-muted); font-size: 0.88rem; padding: 1rem 0;">Bugün için bekleyen yeni bir görev bulunmuyor.</p>
                    <?php else: ?>
                        <div class="sp-tasks-list">
                            <?php foreach (array_slice($tasks, 0, 2) as $t): ?>
                                <div class="sp-task-card <?= $t['status'] === 'completed' ? 'is-completed' : '' ?>">
                                    <div class="sp-task-info">
                                        <h4 class="sp-task-title"><?= e($t['title']) ?></h4>
                                        <p class="sp-task-desc"><?= e($t['description']) ?></p>
                                        <span class="sp-task-reward">+<?= (int)$t['points'] ?> Puan</span>
                                    </div>

                                    <?php if ($t['status'] !== 'completed'): ?>
                                        <form action="<?= url('/student/task/complete') ?>" method="POST" class="task-complete-form" style="margin: 0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="task_id" value="<?= $t['id'] ?>">
                                            <button type="submit" class="btn-sp-primary" style="padding: 0.45rem 1rem; font-size: 0.78rem;">
                                                ✓ Tamamla
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span style="color: var(--sp-green); font-size: 0.82rem; font-weight: 700;">✓ Yapıldı</span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sağ: Su & Hidrasyon Takibi -->
                <div class="sp-card" style="margin-bottom: 0;">
                    <span class="sp-card-kicker">HİDRASYON PROTOKOLÜ</span>
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--sp-text); margin: 0 0 0.5rem 0;">Günlük Su Takibi (2.4L / 3.0L)</h3>
                    <p style="font-size: 0.85rem; color: var(--sp-text-muted); margin-bottom: 1.25rem;">
                        Her bardak için dokunarak hidrasyon hedefinizi doldurun.
                    </p>

                    <div id="hydrationGlasses" style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; flex-wrap: wrap;">
                        <?php for ($g = 1; $g <= 8; $g++): ?>
                            <?php $isFilled = ($g <= 6); ?>
                            <div class="glass-item" data-index="<?= $g ?>" style="flex: 1; min-width: 32px; height: 50px; border: 1.5px solid <?= $isFilled ? '#0284c7' : '#cbd5e1' ?>; background: <?= $isFilled ? '#e0f2fe' : '#ffffff' ?>; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease;">
                                <span style="font-size: 1rem; color: <?= $isFilled ? '#0284c7' : '#94a3b8' ?>;">💧</span>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

            </div>

        </div>

        <!-- =========================================================================
             SEKME 2: ANTRENMANLAR (12 SEANS LİSTESİ)
             ========================================================================= -->
        <div class="portal-tab-pane" id="sp-tab-workouts" style="display: none;">
            
            <div class="sp-card">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <span class="sp-card-kicker">MÜFREDAT &amp; ARŞİV</span>
                        <h2 class="sp-card-title">12 Antrenman Kütüphanesi</h2>
                        <p style="font-size: 0.88rem; color: var(--sp-text-muted); margin: 0;">
                            Haftada 3 gün klinik anatomi temelli video pratikleri.
                        </p>
                    </div>

                    <!-- Filtre Butonları -->
                    <div class="sp-workouts-filter-bar" style="margin-bottom: 0;">
                        <button type="button" class="sp-filter-chip active" data-filter="all">Tümü (<?= $totalWorkouts ?>)</button>
                        <button type="button" class="sp-filter-chip" data-filter="week">Bu Hafta</button>
                        <button type="button" class="sp-filter-chip" data-filter="completed">Tamamlananlar (<?= $completedCount ?>)</button>
                        <button type="button" class="sp-filter-chip" data-filter="ready">Açık Seanslar</button>
                    </div>
                </div>

                <div class="sp-workouts-grid">
                    <?php foreach ($lessons as $les): ?>
                        <?php 
                            $num = (int)$les['workout_number'];
                            $thumb = $workoutThumbnails[$num] ?? $workoutThumbnails[1];
                            $isComp = !empty($les['is_completed']);
                            $isLock = !empty($les['is_locked']);
                            $lesWeek = (int)ceil((int)$les['day_number'] / 7);
                            $isThisW = ($lesWeek === $currentWeekNumber);
                        ?>
                        <div class="sp-workout-card js-workout-card" 
                             data-completed="<?= $isComp ? '1' : '0' ?>"
                             data-locked="<?= $isLock ? '1' : '0' ?>"
                             data-thisweek="<?= $isThisW ? '1' : '0' ?>">
                            
                            <div class="sp-workout-thumb-wrap">
                                <img src="<?= $thumb ?>" alt="<?= e($les['title']) ?>" class="sp-workout-thumb">
                                <span class="sp-workout-day-tag">GÜN <?= $les['day_number'] ?></span>

                                <?php if ($isComp): ?>
                                    <span class="sp-workout-status-badge status-completed">✓ TAMAMLANDI</span>
                                <?php elseif ($isLock): ?>
                                    <span class="sp-workout-status-badge status-locked">🔒 KİLİTLİ</span>
                                <?php else: ?>
                                    <span class="sp-workout-status-badge status-ready">▶ ŞİMDİ İZLE</span>
                                <?php endif; ?>
                            </div>

                            <div class="sp-workout-content">
                                <div>
                                    <h3 class="sp-workout-title"><?= $les['workout_number'] ?> — <?= e($les['title']) ?></h3>
                                    <p class="sp-workout-focus"><?= e($les['focus_area'] ?? 'Klinik Hizalanma & Fasya') ?></p>
                                    
                                    <div class="sp-workout-info-row">
                                        <span>⏱ <?= (int)$les['duration_minutes'] ?> Dk</span>
                                        <span>&bull;</span>
                                        <span>🔥 260 Cal</span>
                                        <span>&bull;</span>
                                        <span>🎯 Orta</span>
                                    </div>
                                </div>

                                <div>
                                    <?php if ($isComp): ?>
                                        <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $les['id']) ?>" class="sp-workout-btn btn-completed">
                                            ✓ Tekrar İzle
                                        </a>
                                    <?php elseif (!$isLock): ?>
                                        <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $les['id']) ?>" class="sp-workout-btn btn-play">
                                            ▶ Antrenmana Başla &rarr;
                                        </a>
                                    <?php else: ?>
                                        <span class="sp-workout-btn btn-locked">
                                            🔒 <?= $les['day_number'] ?>. Günde Açılır
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

        </div>

        <!-- =========================================================================
             SEKME 3: 28 GÜNLÜK İNTERAKTİF TAKVİM
             ========================================================================= -->
        <div class="portal-tab-pane" id="sp-tab-calendar" style="display: none;">
            
            <div class="sp-calendar-wrap">
                <div class="sp-calendar-header">
                    <div>
                        <span class="sp-card-kicker">4 HAFTALIK DÖNGÜ</span>
                        <h2 class="sp-calendar-month-title"><?= e($monthTitle) ?></h2>
                    </div>

                    <div style="display: flex; gap: 0.75rem; font-size: 0.78rem; font-weight: 700;">
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem;">
                            <span style="width: 10px; height: 10px; border-radius: 2px; background: #f0fdf4; border: 1px solid #bbf7d0;"></span> Tamamlandı
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 0.35rem;">
                            <span style="width: 10px; height: 10px; border-radius: 2px; border: 2px solid var(--sp-bordo);"></span> Bugün
                        </span>
                    </div>
                </div>

                <table class="sp-calendar-table">
                    <thead>
                        <tr>
                            <th class="sp-calendar-th">Pzt</th>
                            <th class="sp-calendar-th">Sal</th>
                            <th class="sp-calendar-th">Çar</th>
                            <th class="sp-calendar-th">Per</th>
                            <th class="sp-calendar-th">Cum</th>
                            <th class="sp-calendar-th">Cts</th>
                            <th class="sp-calendar-th">Paz</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($calendarWeeks as $week): ?>
                            <tr>
                                <?php foreach ($week['days'] as $day): ?>
                                    <?php 
                                        $classes = ['sp-cal-day-cell'];
                                        if ($day['has_workout']) $classes[] = 'has-workout';
                                        if ($day['is_completed']) $classes[] = 'is-completed';
                                        if ($day['is_current_day']) $classes[] = 'is-current';
                                        if ($day['is_rest']) $classes[] = 'is-rest';
                                    ?>
                                    <td class="<?= implode(' ', $classes) ?>">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <span class="sp-cal-day-num"><?= $day['day_number'] ?></span>
                                            <?php if ($day['is_completed']): ?>
                                                <span style="color: var(--sp-green); font-size: 0.75rem; font-weight: 800;">✓</span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($day['has_workout'] && !empty($day['workout'])): ?>
                                            <span class="sp-cal-day-label">
                                                <?= $day['workout']['workout_number'] ?>. Seans
                                            </span>
                                        <?php else: ?>
                                            <span class="sp-cal-day-label">Dinlenme</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- =========================================================================
             SEKME 4: GÖREVLERİM & SADAKAT
             ========================================================================= -->
        <div class="portal-tab-pane" id="sp-tab-tasks" style="display: none;">
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem; margin-bottom: 2rem;">
                <!-- Sadakat Durumu -->
                <div class="sp-card" style="margin-bottom: 0;">
                    <span class="sp-card-kicker">KİŞİSEL KADEME &amp; PUAN</span>
                    <h3 style="font-size: 1.4rem; font-weight: 800; color: var(--sp-bordo); margin: 0 0 0.5rem 0;">
                        ★ <?= (int)($loyalty['points'] ?? 100) ?> Sadakat Puanı
                    </h3>
                    <p style="font-size: 0.88rem; color: var(--sp-text-muted); margin-bottom: 1.25rem;">
                        Tamamladığınız her pratik ve ödev puan kazandırır.
                    </p>

                    <div style="background: var(--sp-surface-subtle); border: 1px solid var(--sp-border); border-radius: var(--sp-radius-md); padding: 1rem;">
                        <div style="display: flex; justify-content: space-between; font-size: 0.82rem; font-weight: 700; margin-bottom: 0.4rem;">
                            <span>Mevcut Kademe: <strong><?= strtoupper(e($loyalty['tier'] ?? 'bronze')) ?></strong></span>
                            <span>Hedef: 250 Puan (Silver)</span>
                        </div>
                        <div class="sp-metric-bar-wrap" style="margin: 0;">
                            <div class="sp-metric-bar-fill" style="width: <?= min(100, (int)round((($loyalty['points'] ?? 100) / 250) * 100)) ?>%; background: var(--sp-gold);"></div>
                        </div>
                    </div>
                </div>

                <!-- Seri Kartı -->
                <div class="sp-card" style="margin-bottom: 0;">
                    <span class="sp-card-kicker">DİSİPLİN &amp; STREAK</span>
                    <h3 style="font-size: 1.4rem; font-weight: 800; color: #ea580c; margin: 0 0 0.5rem 0;">
                        🔥 <?= (int)($loyalty['streak_days'] ?? 3) ?> Günlük Seri
                    </h3>
                    <p style="font-size: 0.88rem; color: var(--sp-text-muted); margin: 0;">
                        Her gün matın üzerine çıkarak serinizi koruyun ve ekstra bonus sadakat puanı kazanın.
                    </p>
                </div>
            </div>

            <!-- Görevler Listesi -->
            <div class="sp-card">
                <span class="sp-card-kicker">EĞİTMENDEN ÖZEL GÖREVLER</span>
                <h2 class="sp-card-title">Aktif Görev Listesi</h2>
                <p style="font-size: 0.88rem; color: var(--sp-text-muted); margin-bottom: 1.5rem;">
                    Görevleri tamamlayarak bir tıkla puanınızı artırın.
                </p>

                <?php if (empty($tasks)): ?>
                    <p style="color: var(--sp-text-muted); padding: 2rem 0; text-align: center;">Henüz tanımlanmış bir görev bulunmuyor.</p>
                <?php else: ?>
                    <div class="sp-tasks-list">
                        <?php foreach ($tasks as $t): ?>
                            <div class="sp-task-card <?= $t['status'] === 'completed' ? 'is-completed' : '' ?>">
                                <div class="sp-task-info">
                                    <h4 class="sp-task-title"><?= e($t['title']) ?></h4>
                                    <p class="sp-task-desc"><?= e($t['description']) ?></p>
                                    <span class="sp-task-reward">+<?= (int)$t['points'] ?> Puan</span>
                                </div>

                                <div>
                                    <?php if ($t['status'] !== 'completed'): ?>
                                        <form action="<?= url('/student/task/complete') ?>" method="POST" class="task-complete-form" style="margin: 0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="task_id" value="<?= $t['id'] ?>">
                                            <button type="submit" class="btn-sp-primary" style="padding: 0.5rem 1.25rem; font-size: 0.82rem;">
                                                ✓ Tamamladım &rarr;
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span style="color: var(--sp-green); font-size: 0.84rem; font-weight: 700;">✓ Tamamlandı</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- =========================================================================
             SEKME 5: BESLENME KÖŞESİ & STUDIO
             ========================================================================= -->
        <div class="portal-tab-pane" id="sp-tab-nutrition" style="display: none;">
            
            <div class="sp-card">
                <span class="sp-card-kicker">GLİSEMİK DENGE &amp; ARINMA</span>
                <h2 class="sp-card-title">Metabolik Detoks Beslenme Rehberi</h2>
                <p style="font-size: 0.88rem; color: var(--sp-text-muted); margin-bottom: 2rem;">
                    Fasya ağını besleyen, kan şekerini dengeleyen ve hücresel arınmayı destekleyen özel tarifler.
                </p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <?php if (!empty($recipes)): ?>
                        <?php foreach ($recipes as $rec): ?>
                            <div style="background: var(--sp-surface-subtle); border: 1px solid var(--sp-border); border-radius: var(--sp-radius-md); padding: 1.5rem;">
                                <span style="background: var(--sp-bordo-light); color: var(--sp-bordo); font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 99px; text-transform: uppercase;">
                                    <?= e($rec['badge'] ?? 'TARİF') ?>
                                </span>
                                <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--sp-text); margin: 0.6rem 0 0.35rem 0;"><?= e($rec['title']) ?></h3>
                                <p style="font-size: 0.84rem; color: var(--sp-text-muted); line-height: 1.5; margin-bottom: 1rem;"><?= e($rec['subtitle']) ?></p>
                                <div style="font-size: 0.82rem; color: var(--sp-text); background: #ffffff; padding: 0.85rem; border-radius: 8px; border: 1px solid #ede8e3;">
                                    <?= nl2br(e($rec['content'])) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="background: var(--sp-surface-subtle); border: 1px solid var(--sp-border); border-radius: var(--sp-radius-md); padding: 1.5rem;">
                            <span style="background: var(--sp-bordo-light); color: var(--sp-bordo); font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 99px; text-transform: uppercase;">DETOKS İKSİRİ</span>
                            <h3 style="font-size: 1.1rem; font-weight: 800; color: var(--sp-text); margin: 0.6rem 0 0.35rem 0;">Yeşil Alkali Smoothie</h3>
                            <p style="font-size: 0.84rem; color: var(--sp-text-muted); line-height: 1.5; margin-bottom: 1rem;">Ispanak, yeşil elma, salatalık, taze zencefil ve limon ile vagus siniri regülasyonu.</p>
                            <div style="font-size: 0.82rem; color: var(--sp-text); background: #ffffff; padding: 0.85rem; border-radius: 8px; border: 1px solid #ede8e3;">
                                Sabah mat seansından hemen önce veya sonra 300ml soğuk sıkım olarak tüketin.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- =========================================================================
             SEKME 6: PROFİL & AYARLAR
             ========================================================================= -->
        <div class="portal-tab-pane" id="sp-tab-profile" style="display: none;">
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
                
                <!-- Sol: Üyelik Bilgileri -->
                <div class="sp-card">
                    <span class="sp-card-kicker">HESAP DETAYLARI</span>
                    <h2 class="sp-card-title">Kişisel Bilgiler</h2>

                    <div style="display: flex; flex-direction: column; gap: 0.85rem; margin-top: 1.25rem;">
                        <div>
                            <span style="font-size: 0.78rem; font-weight: 700; color: var(--sp-text-muted); text-transform: uppercase;">Ad Soyad</span>
                            <div style="font-size: 1rem; font-weight: 700; color: var(--sp-text);"><?= e($user['full_name']) ?></div>
                        </div>

                        <div>
                            <span style="font-size: 0.78rem; font-weight: 700; color: var(--sp-text-muted); text-transform: uppercase;">E-Posta</span>
                            <div style="font-size: 1rem; font-weight: 700; color: var(--sp-text);"><?= e($user['email']) ?></div>
                        </div>

                        <div>
                            <span style="font-size: 0.78rem; font-weight: 700; color: var(--sp-text-muted); text-transform: uppercase;">Telefon</span>
                            <div style="font-size: 1rem; font-weight: 700; color: var(--sp-text);"><?= e($user['phone'] ?? 'Belirtilmedi') ?></div>
                        </div>

                        <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--sp-border);">
                            <a href="<?= url('/logout') ?>" class="btn-sp-outline" style="width: 100%; text-align: center; justify-content: center;">
                                Güvenli Çıkış Yap
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sağ: Eğitmen & WhatsApp İletişim -->
                <div class="sp-card">
                    <span class="sp-card-kicker">EĞİTMENE DANIŞ</span>
                    <h2 class="sp-card-title">Klinik Destek &amp; Sorular</h2>
                    <p style="font-size: 0.88rem; color: var(--sp-text-muted); line-height: 1.6; margin-bottom: 1.5rem;">
                        Antrenman pratiğiniz veya beslenme planınızla ilgili aklınıza takılan her şeyi Betina Tansuğ ve ekibine doğrudan iletebilirsiniz.
                    </p>

                    <a href="<?= __('brand.whatsapp_url') ?>" target="_blank" rel="noopener noreferrer" class="btn-sp-primary" style="width: 100%; text-align: center; justify-content: center;">
                        <span>💬</span>
                        <span>WhatsApp ile Eğitmene Yaz &rarr;</span>
                    </a>
                </div>

            </div>

        </div>

    </div>

    <!-- =========================================================================
         8. MOBİL ALT SABİT APP NAVİGASYONU (STICKY BOTTOM APP BAR)
         ========================================================================= -->
    <nav class="portal-mobile-app-bar" aria-label="Mobil Uygulama Gezintisi">
        <button type="button" class="sp-mob-nav-btn active" data-tab="sp-tab-overview">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>Alanım</span>
        </button>

        <button type="button" class="sp-mob-nav-btn" data-tab="sp-tab-workouts">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polygon points="10 8 16 12 10 16 10 8"></polygon>
            </svg>
            <span>Seanslar</span>
        </button>

        <button type="button" class="sp-mob-nav-btn" data-tab="sp-tab-calendar">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span>Takvim</span>
        </button>

        <button type="button" class="sp-mob-nav-btn" data-tab="sp-tab-tasks">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 11l3 3L22 4"></path>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <span>Görevler</span>
        </button>

        <button type="button" class="sp-mob-nav-btn" data-tab="sp-tab-profile">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span>Profil</span>
        </button>
    </nav>

</div>

<!-- İNTERAKTİF İSTEMCİ SCRİPTİ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Sekme Değiştirme Fonksiyonu
    const tabButtons = document.querySelectorAll('.portal-tab-pill-btn, .sp-mob-nav-btn');
    const tabPanes = document.querySelectorAll('.portal-tab-pane');

    function switchSpTab(targetId) {
        tabButtons.forEach(btn => {
            if (btn.getAttribute('data-tab') === targetId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        tabPanes.forEach(pane => {
            if (pane.id === targetId) {
                pane.style.display = 'block';
                pane.classList.add('active');
            } else {
                pane.style.display = 'none';
                pane.classList.remove('active');
            }
        });

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-tab');
            switchSpTab(target);
        });
    });

    // Butonlardan başka sekmeye yönlendirme
    document.querySelectorAll('.js-switch-tab').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            if (target) switchSpTab(target);
        });
    });

    // 2. URL Parametresi veya Hash ile Sekme Başlatma (?tab=workouts veya #sp-tab-tasks)
    const urlParams = new URLSearchParams(window.location.search);
    let initialTab = urlParams.get('tab');
    if (!initialTab && window.location.hash) {
        initialTab = window.location.hash.replace('#', '');
    }
    if (initialTab) {
        if (!initialTab.startsWith('sp-tab-')) {
            initialTab = 'sp-tab-' + initialTab;
        }
        if (document.getElementById(initialTab)) {
            switchSpTab(initialTab);
        }
    }

    // 3. Antrenman Filtreleme
    const filterChips = document.querySelectorAll('.sp-filter-chip');
    const workoutCards = document.querySelectorAll('.js-workout-card');

    filterChips.forEach(chip => {
        chip.addEventListener('click', function() {
            filterChips.forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            workoutCards.forEach(card => {
                const isCompleted = card.getAttribute('data-completed') === '1';
                const isLocked = card.getAttribute('data-locked') === '1';
                const isThisWeek = card.getAttribute('data-thisweek') === '1';

                let show = false;
                if (filter === 'all') {
                    show = true;
                } else if (filter === 'week') {
                    show = isThisWeek;
                } else if (filter === 'completed') {
                    show = isCompleted;
                } else if (filter === 'ready') {
                    show = !isLocked && !isCompleted;
                }

                card.style.display = show ? 'flex' : 'none';
            });
        });
    });

    // 4. Su / Hidrasyon Takibi Tıklanabilir Bardaklar
    const glassItems = document.querySelectorAll('#hydrationGlasses .glass-item');
    glassItems.forEach((glass, idx) => {
        glass.addEventListener('click', function() {
            glassItems.forEach((g, i) => {
                if (i <= idx) {
                    g.style.backgroundColor = '#e0f2fe';
                    g.style.borderColor = '#0284c7';
                    const icon = g.querySelector('span');
                    if (icon) icon.style.color = '#0284c7';
                } else {
                    g.style.backgroundColor = '#ffffff';
                    g.style.borderColor = '#cbd5e1';
                    const icon = g.querySelector('span');
                    if (icon) icon.style.color = '#94a3b8';
                }
            });
        });
    });

    // 5. AJAX Görev Tamamlama
    const taskForms = document.querySelectorAll('.task-complete-form');
    taskForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('button[type="submit"]');
            if (btn) {
                btn.disabled = true;
                btn.textContent = 'İşleniyor...';
            }

            const formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const parent = form.parentElement;
                    parent.innerHTML = '<span style="color: var(--sp-green); font-size: 0.84rem; font-weight: 700;">✓ Tamamlandı! +' + (data.points_awarded || 50) + ' Puan</span>';
                } else {
                    form.submit();
                }
            })
            .catch(() => {
                form.submit();
            });
        });
    });
});
</script>
