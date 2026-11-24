<?php
declare(strict_types=1);
/**
 * FİZYOBAR ÖĞRENCİ PORTALİ & KİŞİSEL HAREKET ALANI
 * Saf Beyaz Arkaplan, Coral Accent, Net Görsel Hiyerarşi
 * Kullanıcının sağladığı tam ekran tasarımı prototipine birebir uygun.
 *
 * @var array $user
 * @var array $course
 * @var array $enrollment
 * @var array $lessons
 * @var array $lessonsByDay
 * @var int $completedCount
 * @var int $totalWorkouts
 * @var int $progressPercent
 * @var int $currentProgramDay
 * @var int $currentWeekNumber
 * @var array $calendarWeeks
 * @var array $recipes
 * @var array $tips
 * @var array $routines
 * @var array $loyalty
 * @var array $giftEnrollments
 * @var string|null $successMsg
 * @var string|null $errorMsg
 */

// Sıradaki / Güncel Seansı Bul
$spotlightLesson = null;
if (!empty($lessons) && is_array($lessons)) {
    foreach ($lessons as $l) {
        if (empty($l['is_completed']) && empty($l['is_locked'])) {
            $spotlightLesson = $l;
            break;
        }
    }
    if (!$spotlightLesson) {
        foreach ($lessons as $l) {
            if (empty($l['is_completed'])) {
                $spotlightLesson = $l;
                break;
            }
        }
    }
    if (!$spotlightLesson) {
        $spotlightLesson = $lessons[0] ?? null;
    }
}

// ASLA NULL KALMAYACAK ŞEKİLDE DEFAULT GARANTİSİ
if (!$spotlightLesson || !is_array($spotlightLesson)) {
    $spotlightLesson = [
        'id' => 1,
        'day_number' => 1,
        'title' => 'Fascial Flow: Bütünsel Fasya Esnekliği',
        'focus_area' => 'Miyofasyal ağ ve elastik yaylanma',
        'youtube_video_id' => 'sTANio_2E0Q',
        'duration_minutes' => 40,
        'workout_number' => '01',
        'is_completed' => 0,
        'is_locked' => 0,
    ];
}

$spotCourseSlug = (string)($course['slug'] ?? 'online-detox-yoga-kampi');
$spotlightId = (int)($spotlightLesson['id'] ?? 1);
$spotlightUrl = url('/course/' . $spotCourseSlug . '/lesson/' . $spotlightId);

$spotYtId = trim((string)($spotlightLesson['youtube_video_id'] ?? 'sTANio_2E0Q'));
$spotThumb = !empty($spotYtId) ? "https://img.youtube.com/vi/{$spotYtId}/hqdefault.jpg" : asset('assets/images/betina-outdoor-stretch.jpg');
$spotTitle = preg_replace('/^(Ders|Seans)\s*\d+\s*:\s*/ui', '', (string)($spotlightLesson['title'] ?? 'Fascial Flow: Bütünsel Fasya Esnekliği'));
$spotDuration = (int)($spotlightLesson['duration_minutes'] ?? 40);
$spotWorkoutNum = (string)($spotlightLesson['workout_number'] ?? '01');

// Bugün antrenman günü mü dinlenme günü mü?
$isTodayWorkoutDay = isset($lessonsByDay[$currentProgramDay]);

// Hediye Paketi
$primaryGift = !empty($giftEnrollments) ? $giftEnrollments[0] : null;
?>

<link rel="stylesheet" href="<?= asset('assets/css/student-portal.css') ?>?v=<?= time() ?>">

<div class="portal-wrap">

  <!-- =========================================================================
       1. MASAÜSTÜ (PC) GÖRÜNÜMÜ (.pc)
       ========================================================================= -->
  <div class="pc">
    <!-- Sol Sabit Menü (.side) -->
    <aside class="side">
      <div class="side-logo-wrap">
        <a href="<?= url('/') ?>" class="portal-site-logo-link" aria-label="FİZYOBAR">
          <span class="logo-text-main">FİZYOBAR</span>
          <span class="logo-text-sub">BODY • ADAPT • REFRAME</span>
        </a>
      </div>
      <nav class="nav">
        <a class="nav-link on" data-tab="tab-today">🏠 Bugün</a>
        <a class="nav-link" data-tab="tab-program">🗓️ Programım</a>
        <a class="nav-link" data-tab="tab-nutrition">🥑 Beslenme</a>
        <a class="nav-link" data-tab="tab-profile">👤 Profil</a>
      </nav>

      <?php if ($primaryGift || true): ?>
      <div class="gift-side">
        <div class="label">🎁 Hediyen açıldı</div>
        <div class="title"><?= htmlspecialchars($primaryGift['course_title'] ?? '3\'lü Meditasyon Paketi', ENT_QUOTES, 'UTF-8') ?></div>
        <div class="muted" style="margin-bottom:12px"><?= htmlspecialchars($primaryGift['gift_message'] ?? 'Vagus sinir regülasyonu', ENT_QUOTES, 'UTF-8') ?></div>
        <a href="<?= url('/course/' . ($primaryGift['slug'] ?? '3lu-meditasyon-serisi')) ?>" class="btn" style="padding:10px; text-decoration:none;">Hediyeyi aç</a>
      </div>
      <?php endif; ?>
    </aside>

    <!-- Ana İçerik Alanı (.main) -->
    <div class="main">

      <!-- ==========================================
           PC SEKME 1: BUGÜN
           ========================================== -->
      <div class="portal-tab-content active" id="tab-today">
        <div class="topbar">
          <div class="hello">
            <div class="label"><?= $currentProgramDay ?>. Gün · <?= htmlspecialchars($course['title'] ?? '4 Haftalık Detox & Yoga Kampı', ENT_QUOTES, 'UTF-8') ?></div>
            <h2>Günaydın, <?= htmlspecialchars(explode(' ', trim($user['full_name'] ?? 'Öğrenci'))[0], ENT_QUOTES, 'UTF-8') ?> ✨</h2>
          </div>
          <div class="stats">
            <span class="pill gold">🔥 <?= (int)($loyalty['streak_days'] ?? 3) ?> gün</span>
            <span class="pill">⭐ <?= (int)($loyalty['points'] ?? 100) ?> puan</span>
          </div>
        </div>

        <div class="bar" style="height:10px; margin-top:14px;"><i style="width:<?= $progressPercent ?>%"></i></div>
        <div class="muted" style="margin-top:-12px; margin-bottom:10px;">Kamp ilerlemesi · <?= $completedCount ?> / <?= $totalWorkouts ?> seans tamamlandı (%<?= $progressPercent ?>)</div>

        <div class="grid">
          <!-- Hero Workout Card -->
          <div class="card hero">
            <div class="meta">
              <span class="pill accent">● Bugünün seansı · <?= $spotWorkoutNum ?></span>
              <span class="pill">⏱ <?= $spotDuration ?> dk</span>
            </div>
            <a href="<?= $spotlightUrl ?>" class="thumb" style="text-decoration:none;">
              <img src="<?= $spotThumb ?>" alt="<?= htmlspecialchars($spotTitle, ENT_QUOTES, 'UTF-8') ?>">
              <div class="play">▶</div>
            </a>
            <div class="info">
              <div>
                <div class="title" style="font-size:19px"><?= htmlspecialchars($spotTitle, ENT_QUOTES, 'UTF-8') ?></div>
                <div class="muted" style="margin-top:4px">Ekipmansız · <?= htmlspecialchars($spotlightLesson['focus_area'] ?? 'Miyofasyal ağ ve elastik yaylanma', ENT_QUOTES, 'UTF-8') ?></div>
              </div>
              <a href="<?= $spotlightUrl ?>" class="btn">▶ Seansı başlat</a>
            </div>
          </div>

          <!-- Roadmap Card (Kamp Yolculuğu) -->
          <div class="card roadmap">
            <div class="label" style="margin-bottom:6px">Kamp yolculuğu</div>
            <?php 
            $roadmapList = !empty($lessons) ? $lessons : [
              ['id' => 1, 'day_number' => 1, 'workout_number' => '01', 'title' => 'Foundation: Hizalanma & Kuvvet', 'is_completed' => 0, 'is_locked' => 0],
              ['id' => 2, 'day_number' => 3, 'workout_number' => '02', 'title' => 'Mobility Reset: Kalça Açıcı', 'is_completed' => 0, 'is_locked' => 1],
              ['id' => 3, 'day_number' => 5, 'workout_number' => '03', 'title' => 'Core Control: Derin Merkez', 'is_completed' => 0, 'is_locked' => 1],
              ['id' => 4, 'day_number' => 8, 'workout_number' => '04', 'title' => 'Fascial Flow: Bütünsel Fasya', 'is_completed' => 0, 'is_locked' => 1],
              ['id' => 5, 'day_number' => 10, 'workout_number' => '05', 'title' => 'Spine Alignment: Torakal Açılım', 'is_completed' => 0, 'is_locked' => 1],
              ['id' => 6, 'day_number' => 12, 'workout_number' => '06', 'title' => 'Lower Body Power: Glute Aktivasyonu', 'is_completed' => 0, 'is_locked' => 1],
            ];
            $shownSteps = 0;
            foreach ($roadmapList as $idx => $les):
              if ($shownSteps >= 6) break;
              $lesDay = (int)($les['day_number'] ?? ($idx + 1));
              $lesTitle = preg_replace('/^(Ders|Seans)\s*\d+\s*:\s*/ui', '', (string)($les['title'] ?? 'Seans'));
              $isDone = !empty($les['is_completed']);
              $isNow = ((int)($spotlightLesson['id'] ?? 0) === (int)($les['id'] ?? -1));
              $isLocked = !empty($les['is_locked']);
              $shownSteps++;
            ?>
              <div class="step <?= $isLocked ? 'locked' : '' ?>">
                <?php if ($isDone): ?>
                  <span class="dot done">✓</span>
                  <div><b><?= $lesDay ?>. Gün</b> · <?= htmlspecialchars($lesTitle, ENT_QUOTES, 'UTF-8') ?></div>
                <?php elseif ($isNow): ?>
                  <span class="dot now"><?= $lesDay ?></span>
                  <div><b>Bugün</b> · <?= $les['workout_number'] ?? '01' ?>. Seans <span style="font-size:13px; color:var(--text);">(<?= htmlspecialchars($lesTitle, ENT_QUOTES, 'UTF-8') ?>)</span></div>
                <?php elseif ($isLocked): ?>
                  <span class="dot">🔒</span>
                  <div>
                    <?= $lesDay ?>. Gün · <?= htmlspecialchars($lesTitle, ENT_QUOTES, 'UTF-8') ?><br>
                    <small class="muted"><?= max(1, $lesDay - $currentProgramDay) ?> gün sonra açılacak</small>
                  </div>
                <?php else: ?>
                  <span class="dot">🌿</span>
                  <div><?= $lesDay ?>. Gün · Dinlenme</div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Row 3 (3'lü Alt Kart Grubu) -->
        <div class="row3">
          <!-- 1. Su Takibi -->
          <div class="card">
            <div class="label">💧 Günlük su</div>
            <div class="big" id="waterTxt">1.0 / 3.0 L</div>
            <div class="drops" id="drops"></div>
          </div>

          <!-- 2. Günün Tarifi -->
          <div class="card">
            <div class="label">🍵 Günün tarifi</div>
            <div class="recipe-img" style="margin-top:12px; background-image: url('<?= asset('assets/images/kitchen-hero-plate.webp') ?>');"></div>
            <div class="title"><?= htmlspecialchars($recipes[0]['title'] ?? 'Sabah altın iksiri', ENT_QUOTES, 'UTF-8') ?></div>
            <div class="muted" style="margin:4px 0 14px"><?= htmlspecialchars($recipes[0]['subtitle'] ?? 'Zerdeçal, zencefil, badem sütü · 5 dk', ENT_QUOTES, 'UTF-8') ?></div>
            <button type="button" class="btn soft js-open-recipe" data-recipe-idx="0">Tarifi gör →</button>
          </div>

          <!-- 3. Bu Hafta İlerlemesi -->
          <div class="card">
            <div class="label">📈 Bu hafta</div>
            <div class="big"><?= min(5, max(1, $completedCount)) ?> / 5</div>
            <div class="muted" style="margin-bottom:14px">Seans hedefi tamamlandı</div>
            <div class="bar"><i style="width:<?= min(100, (int)round((min(5, max(1, $completedCount)) / 5) * 100)) ?>%"></i></div>
          </div>
        </div>
      </div>

      <!-- ==========================================
           PC SEKME 2: PROGRAMIM (12 SEANS & TAKVİM)
           ========================================== -->
      <div class="portal-tab-content" id="tab-program">
        <div class="topbar">
          <div class="hello">
            <div class="label">4 Haftalık Program Akışı</div>
            <h2>Tüm Seanslar &amp; Günlük Plan</h2>
          </div>
          <span class="pill accent"><?= $totalWorkouts ?> Seans</span>
        </div>

        <div class="seg" id="pcWeekSeg">
          <button type="button" class="week-tab-btn on" data-week="1">1. Hafta</button>
          <button type="button" class="week-tab-btn" data-week="2">2. Hafta</button>
          <button type="button" class="week-tab-btn" data-week="3">3. Hafta</button>
          <button type="button" class="week-tab-btn" data-week="4">4. Hafta</button>
        </div>

        <?php foreach ($calendarWeeks as $w): ?>
          <div class="card week-pane" id="pc-week-pane-<?= $w['week_number'] ?>" style="<?= $w['week_number'] === 1 ? '' : 'display:none;' ?> padding: 14px 20px;">
            <?php foreach ($w['days'] as $day): ?>
              <?php 
                $wo = $day['workout'];
                $isLocked = !empty($day['is_locked']);
                $isComp = !empty($day['is_completed']);
                $isToday = !empty($day['is_current_day']);
                $isRest = !empty($day['is_rest']);
              ?>
              <div class="day-row <?= $isLocked ? 'locked' : '' ?>">
                <?php if ($isComp): ?>
                  <span class="dot done">✓</span>
                  <div>
                    <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                    <small><?= $wo['workout_number'] ?>. Seans · <?= htmlspecialchars($wo['title'] ?? '', ENT_QUOTES, 'UTF-8') ?> · <?= (int)($wo['duration_minutes'] ?? 35) ?> dk</small>
                  </div>
                  <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $wo['id']) ?>" class="btn soft btn-sm">Tekrar İzle</a>
                <?php elseif ($isToday && $wo): ?>
                  <span class="dot now"><?= $day['day_number'] ?></span>
                  <div>
                    <b>Bugün (<?= $day['day_number'] ?>. Gün)</b><br>
                    <span style="color:var(--accent); font-weight:700"><?= $wo['workout_number'] ?>. Seans · <?= htmlspecialchars($wo['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                  </div>
                  <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $wo['id']) ?>" class="btn btn-sm">▶ Şimdi başla</a>
                <?php elseif ($isRest): ?>
                  <span class="dot">🌿</span>
                  <div>
                    <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                    <small>Dinlenme &amp; Fasya Toparlanma · Su &amp; Nefes Hedefi</small>
                  </div>
                <?php elseif ($isLocked): ?>
                  <span class="dot">🔒</span>
                  <div>
                    <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                    <small><?= $wo ? $wo['workout_number'] . '. Seans · ' : '' ?><?= max(1, $day['day_number'] - $currentProgramDay) ?> gün sonra açılacak</small>
                  </div>
                <?php else: ?>
                  <span class="dot"><?= $day['day_number'] ?></span>
                  <div>
                    <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                    <small><?= $wo ? $wo['workout_number'] . '. Seans · ' . htmlspecialchars($wo['title'] ?? '', ENT_QUOTES, 'UTF-8') : '' ?></small>
                  </div>
                  <?php if ($wo): ?>
                    <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $wo['id']) ?>" class="btn soft btn-sm">Başla</a>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- ==========================================
           PC SEKME 3: BESLENME
           ========================================== -->
      <div class="portal-tab-content" id="tab-nutrition">
        <div class="topbar">
          <div class="hello">
            <div class="label">Bar Kitchen &amp; Metabolik Detoks</div>
            <h2>Beslenme Rehberi &amp; Tarifler</h2>
          </div>
        </div>

        <div class="chips">
          <span class="pill accent">Tümü</span>
          <span class="pill">Sabah</span>
          <span class="pill">Öğle</span>
          <span class="pill">Akşam</span>
        </div>

        <div class="rec-grid">
          <?php foreach ($recipes as $rIdx => $rec): ?>
            <div class="rec-item js-open-recipe" data-recipe-idx="<?= $rIdx ?>">
              <div class="rec-thumb" style="background-image: url('<?= asset('assets/images/kitchen-hero-plate.webp') ?>');"></div>
              <div>
                <div class="label"><?= htmlspecialchars($rec['badge'] ?? 'Beslenme', ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars($rec['time_needed'] ?? '5 dk', ENT_QUOTES, 'UTF-8') ?></div>
                <div class="title" style="margin-top:2px"><?= htmlspecialchars($rec['title'], ENT_QUOTES, 'UTF-8') ?></div>
                <div class="muted" style="margin-top:4px"><?= htmlspecialchars($rec['subtitle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ==========================================
           PC SEKME 4: PROFİL
           ========================================== -->
      <div class="portal-tab-content" id="tab-profile">
        <div class="topbar">
          <div class="hello">
            <div class="label">Kişisel Bilgiler &amp; Destek</div>
            <h2>Öğrenci Profilim</h2>
          </div>
        </div>

        <div class="card">
          <div class="profile-grid">
            <div class="profile-field">
              <span class="label">AD SOYAD</span>
              <div class="profile-field-val"><?= htmlspecialchars($user['full_name'] ?? 'Öğrenci', ENT_QUOTES, 'UTF-8') ?></div>
            </div>
            <div class="profile-field">
              <span class="label">E-POSTA</span>
              <div class="profile-field-val"><?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            </div>
            <div class="profile-field">
              <span class="label">AKTİF PROGRAM</span>
              <div class="profile-field-val"><?= htmlspecialchars($course['title'] ?? '4 Haftalık Detoks & Yoga Kampı', ENT_QUOTES, 'UTF-8') ?></div>
            </div>
            <div class="profile-field">
              <span class="label">İLERLEME DURUMU</span>
              <div class="profile-field-val"><?= $currentProgramDay ?>. Gün · %<?= $progressPercent ?> Tamamlandı</div>
            </div>
          </div>

          <div style="margin-top: 24px; display: flex; gap: 12px; flex-wrap: wrap;">
            <a href="https://wa.me/905357056828?text=<?= urlencode('Merhaba Betina Hocam, Fizyobar platformu üzerinden ulaşıyorum.') ?>" target="_blank" rel="noopener" class="btn" style="width:auto; padding:12px 24px; background:#25d366; text-decoration:none;">
              💬 Eğitmen WhatsApp Destek
            </a>
            <a href="<?= url('/logout') ?>" class="btn soft" style="width:auto; padding:12px 24px; text-decoration:none;">
              Çıkış Yap
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- =========================================================================
       2. MOBİL UYGULAMA GÖRÜNÜMÜ (.mobile-app-container)
       ========================================================================= -->
  <div class="mobile-app-container">

    <!-- Mobil Üst Başlık (.mhead) -->
    <div class="mhead">
      <a href="<?= url('/') ?>" class="portal-site-logo-link" aria-label="FİZYOBAR" style="align-items:flex-start;">
        <span class="logo-text-main" style="font-size:22px;">FİZYOBAR</span>
        <span class="logo-text-sub" style="font-size:8px;">BODY • ADAPT • REFRAME</span>
      </a>
      <div style="display:flex; gap:6px">
        <span class="pill gold">🔥 <?= (int)($loyalty['streak_days'] ?? 3) ?></span>
        <span class="pill">⭐ <?= (int)($loyalty['points'] ?? 100) ?></span>
      </div>
    </div>

    <!-- MOBİL SEKME 1: BUGÜN -->
    <div class="portal-m-tab-content active" id="m-tab-today">
      <div>
        <div class="label">Günaydın · sabah iksirin hazır mı?</div>
        <div class="greet" style="margin-top:4px"><?= $currentProgramDay ?>. Gün 🌤️</div>
        <div class="bar" style="margin-top:12px"><i style="width:<?= $progressPercent ?>%"></i></div>
        <div class="muted" style="margin-top:6px; font-size:12px"><?= $completedCount ?> / <?= $totalWorkouts ?> seans · %<?= $progressPercent ?></div>
      </div>

      <!-- Dolu Gün: Antrenman Kartı -->
      <div class="card" style="padding:12px; margin-top:14px;">
        <a href="<?= $spotlightUrl ?>" class="thumb" style="text-decoration:none;">
          <img src="<?= $spotThumb ?>" alt="<?= htmlspecialchars($spotTitle, ENT_QUOTES, 'UTF-8') ?>">
          <div class="play" style="width:46px; height:46px">▶</div>
        </a>
        <div style="margin:12px 2px 0">
          <span class="pill accent"><?= $spotWorkoutNum ?>. Seans</span>
          <span class="muted" style="margin-left:6px"><?= $spotDuration ?> dk · Ekipmansız</span>
        </div>
        <div class="title" style="margin:8px 2px 12px; font-size:16px;"><?= htmlspecialchars($spotTitle, ENT_QUOTES, 'UTF-8') ?></div>
        <a href="<?= $spotlightUrl ?>" class="btn">▶ Seansı başlat</a>
      </div>

      <!-- Dinlenme Günü Kartı (Eğer Bugün Dinlenme İse veya Bilgilendirme Amaçlı) -->
      <?php if (!$isTodayWorkoutDay): ?>
      <div class="empty-card" style="margin-top:14px;">
        <div style="font-size:36px">🌿</div>
        <div class="title" style="margin-top:8px">Dinlenme &amp; toparlanma günü</div>
        <p class="muted" style="margin-top:6px">Dünkü seansın kaslarında ve fasyanda sindiriliyor. Yarın bir sonraki seans açılacak.</p>
        <div class="label" style="margin-top:14px">Sonraki seansa kalan</div>
        <div class="countdown" id="cd">14 sa 22 dk</div>
        <button type="button" class="btn">🎧 5 dk vagus nefesi · +10 ⭐</button>
      </div>
      <?php endif; ?>

      <!-- Mini 2-Kolon Kart Grubu (Su & Tarif) -->
      <div class="mini" style="margin-top:14px;">
        <div class="card">
          <div class="label">💧 Su</div>
          <div class="title" style="margin-top:6px; font-size:14px;" id="mWaterTxt">1.0 / 3.0 L</div>
          <div class="mwater" id="mDrops"></div>
        </div>
        <div class="card js-open-recipe" data-recipe-idx="0" style="cursor:pointer;">
          <div class="label">🍵 Tarif</div>
          <div class="recipe-img" style="aspect-ratio:auto; height:44px; margin:10px 0 8px; background-image: url('<?= asset('assets/images/kitchen-hero-plate.webp') ?>');"></div>
          <div class="title" style="font-size:13px"><?= htmlspecialchars($recipes[0]['title'] ?? 'Altın iksir', ENT_QUOTES, 'UTF-8') ?></div>
        </div>
      </div>
    </div>

    <!-- MOBİL SEKME 2: PROGRAMIM -->
    <div class="portal-m-tab-content" id="m-tab-program" style="display:none;">
      <div class="mhead" style="padding:0 0 10px;">
        <div class="logo">Programım</div>
        <span class="pill"><?= $totalWorkouts ?> Seans</span>
      </div>

      <div class="seg" id="mWeekSeg" style="margin-bottom:12px;">
        <button type="button" class="m-week-tab-btn on" data-week="1">1. Hafta</button>
        <button type="button" class="m-week-tab-btn" data-week="2">2. Hafta</button>
        <button type="button" class="m-week-tab-btn" data-week="3">3. Hafta</button>
        <button type="button" class="m-week-tab-btn" data-week="4">4. Hafta</button>
      </div>

      <?php foreach ($calendarWeeks as $w): ?>
        <div class="card m-week-pane" id="m-week-pane-<?= $w['week_number'] ?>" style="<?= $w['week_number'] === 1 ? '' : 'display:none;' ?> padding: 12px 14px;">
          <?php foreach ($w['days'] as $day): ?>
            <?php 
              $wo = $day['workout'];
              $isLocked = !empty($day['is_locked']);
              $isComp = !empty($day['is_completed']);
              $isToday = !empty($day['is_current_day']);
              $isRest = !empty($day['is_rest']);
            ?>
            <div class="day-row <?= $isLocked ? 'locked' : '' ?>">
              <?php if ($isComp): ?>
                <span class="dot done">✓</span>
                <div>
                  <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                  <small><?= $wo['workout_number'] ?>. Seans · <?= htmlspecialchars($wo['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></small>
                </div>
              <?php elseif ($isToday && $wo): ?>
                <span class="dot now"><?= $day['day_number'] ?></span>
                <div>
                  <b>Bugün (<?= $day['day_number'] ?>. Gün)</b><br>
                  <span style="color:var(--accent); font-weight:700"><?= $wo['workout_number'] ?>. Seans · <?= htmlspecialchars($wo['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></span><br>
                  <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $wo['id']) ?>" class="pill accent" style="margin-top:6px; text-decoration:none;">▶ Şimdi başla</a>
                </div>
              <?php elseif ($isRest): ?>
                <span class="dot">🌿</span>
                <div>
                  <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                  <small>Dinlenme · su hedefi</small>
                </div>
              <?php elseif ($isLocked): ?>
                <span class="dot">🔒</span>
                <div>
                  <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                  <small><?= $wo ? $wo['workout_number'] . '. Seans · ' : '' ?><?= max(1, $day['day_number'] - $currentProgramDay) ?> gün sonra açılacak</small>
                </div>
              <?php else: ?>
                <span class="dot"><?= $day['day_number'] ?></span>
                <div>
                  <b><?= $day['day_number'] ?>. Gün (<?= $day['day_label'] ?>)</b><br>
                  <small><?= $wo ? $wo['workout_number'] . '. Seans · ' . htmlspecialchars($wo['title'] ?? '', ENT_QUOTES, 'UTF-8') : '' ?></small><br>
                  <?php if ($wo): ?>
                    <a href="<?= url('/course/' . ($course['slug'] ?? 'detoks') . '/lesson/' . $wo['id']) ?>" class="pill accent" style="margin-top:6px; text-decoration:none;">Başla</a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- MOBİL SEKME 3: BESLENME -->
    <div class="portal-m-tab-content" id="m-tab-nutrition" style="display:none;">
      <div class="mhead" style="padding:0 0 10px;">
        <div class="logo">Beslenme &amp; Tarifler</div>
      </div>

      <div class="chips" style="margin-bottom:12px;">
        <span class="pill accent">Tümü</span>
        <span class="pill">Sabah</span>
        <span class="pill">Öğle</span>
        <span class="pill">Akşam</span>
      </div>

      <div style="display:flex; flex-direction:column; gap:10px;">
        <?php foreach ($recipes as $rIdx => $rec): ?>
          <div class="rec-item js-open-recipe" data-recipe-idx="<?= $rIdx ?>">
            <div class="rec-thumb" style="background-image: url('<?= asset('assets/images/kitchen-hero-plate.webp') ?>');"></div>
            <div>
              <div class="label"><?= htmlspecialchars($rec['badge'] ?? 'Tarif', ENT_QUOTES, 'UTF-8') ?> · <?= htmlspecialchars($rec['time_needed'] ?? '5 dk', ENT_QUOTES, 'UTF-8') ?></div>
              <div class="title" style="font-size:14px; margin-top:2px;"><?= htmlspecialchars($rec['title'], ENT_QUOTES, 'UTF-8') ?></div>
              <div class="muted" style="font-size:12px; margin-top:2px;"><?= htmlspecialchars($rec['subtitle'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- MOBİL SEKME 4: PROFİL -->
    <div class="portal-m-tab-content" id="m-tab-profile" style="display:none;">
      <div class="mhead" style="padding:0 0 10px;">
        <div class="logo">Profilim</div>
      </div>

      <div class="card" style="padding:16px;">
        <div class="profile-field">
          <span class="label">AD SOYAD</span>
          <div class="profile-field-val"><?= htmlspecialchars($user['full_name'] ?? 'Öğrenci', ENT_QUOTES, 'UTF-8') ?></div>
        </div>
        <div class="profile-field">
          <span class="label">E-POSTA</span>
          <div class="profile-field-val"><?= htmlspecialchars($user['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        </div>
        <div class="profile-field">
          <span class="label">KAMP İLERLEMESİ</span>
          <div class="profile-field-val"><?= $currentProgramDay ?>. Gün · %<?= $progressPercent ?> Tamamlandı</div>
        </div>

        <div style="margin-top:16px; display:flex; flex-direction:column; gap:10px;">
          <a href="https://wa.me/905357056828?text=<?= urlencode('Merhaba Betina Hocam, Fizyobar platformu üzerinden ulaşıyorum.') ?>" target="_blank" rel="noopener" class="btn" style="background:#25d366; text-decoration:none;">
            💬 Eğitmen WhatsApp Destek
          </a>
          <a href="<?= url('/logout') ?>" class="btn soft" style="text-decoration:none;">
            Çıkış Yap
          </a>
        </div>
      </div>
    </div>

    <!-- Alt Sabit Menü (.mnav) -->
    <nav class="mnav">
      <div class="m-nav-item on" data-tab="tab-today"><i>🏠</i>Bugün</div>
      <div class="m-nav-item" data-tab="tab-program"><i>🗓️</i>Program</div>
      <div class="m-nav-item" data-tab="tab-nutrition"><i>🥑</i>Beslenme</div>
      <div class="m-nav-item" data-tab="tab-profile"><i>👤</i>Profil</div>
    </nav>
  </div>

</div>

<!-- =========================================================================
     3. TARİF DETAY BOTTOM SHEET / MODAL
     ========================================================================= -->
<div class="sheet-backdrop" id="recipeSheetModal">
  <div class="sheet-modal">
    <div class="grab" id="closeRecipeGrab"></div>
    <div class="label" id="sheetCategory">🌅 Sabah · 5 dk</div>
    <div class="title" style="font-size:18px" id="sheetTitle">Anti-enflamatuar altın iksir</div>
    <div class="label" style="margin-top:4px">Malzemeler</div>
    <ul class="check" id="sheetIngredients" style="margin-top:0">
      <li class="ok"><b>✓</b>Zerdeçal · 1 tk</li>
      <li><b></b>Zencefil · 2 cm</li>
      <li><b></b>Badem sütü · 250 ml</li>
    </ul>
    <div class="label" style="margin-top:6px">Neden bu öğün?</div>
    <div class="muted" id="sheetDesc">Sabah saatinde anti-enflamatuar bileşenler, gün boyu toparlanma ritmini destekler.</div>
    <button type="button" class="btn" style="margin-top:auto" id="closeRecipeBtn">Kapat</button>
  </div>
</div>

<!-- =========================================================================
     4. JAVASCRIPT ETKİLEŞİMİ (SU DAMLALARI, SEKME DEĞİŞTİRME, MODAL)
     ========================================================================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // 1. Su Damlaları
  let n = 2;
  const TOTAL = 6, GOAL = 3.0;

  function renderDrops(el) {
    if (!el) return;
    el.innerHTML = '';
    for (let i = 0; i < TOTAL; i++) {
      const d = document.createElement('div');
      d.className = 'drop' + (i < n ? ' on' : '');
      d.onclick = () => { n = i + 1; updateAllDrops(); };
      el.appendChild(d);
    }
  }

  function updateAllDrops() {
    renderDrops(document.getElementById('drops'));
    renderDrops(document.getElementById('mDrops'));
    const l = (n * GOAL / TOTAL).toFixed(1);
    const txt = document.getElementById('waterTxt');
    const mTxt = document.getElementById('mWaterTxt');
    if (txt) txt.textContent = l + ' / 3.0 L';
    if (mTxt) mTxt.textContent = l + ' / 3.0 L';
  }
  updateAllDrops();

  // 2. Geri Sayım Sayacı (Dinlenme Günü)
  let s = 14 * 3600 + 22 * 60;
  setInterval(() => {
    s = Math.max(0, s - 1);
    const h = Math.floor(s / 3600), m = Math.floor((s % 3600) / 60), x = s % 60;
    const cdEl = document.getElementById('cd');
    if (cdEl) {
      cdEl.textContent = `${h} sa ${String(m).padStart(2, '0')} dk ${String(x).padStart(2, '0')} sn`;
    }
  }, 1000);

  // 3. Sekme Yönetimi (PC & Mobil Senkronize)
  function switchTab(tabId) {
    // PC Yan Menü
    document.querySelectorAll('.pc .nav-link').forEach(a => {
      a.classList.toggle('on', a.getAttribute('data-tab') === tabId);
    });
    // PC İçerik Panelleri
    document.querySelectorAll('.pc .portal-tab-content').forEach(pane => {
      pane.classList.toggle('active', pane.id === tabId);
    });

    // Mobil Alt Menü
    document.querySelectorAll('.mnav .m-nav-item').forEach(item => {
      item.classList.toggle('on', item.getAttribute('data-tab') === tabId);
    });
    // Mobil İçerik Panelleri
    const mTargetId = 'm-' + tabId;
    document.querySelectorAll('.mobile-app-container .portal-m-tab-content').forEach(pane => {
      if (pane.id === mTargetId) {
        pane.style.display = 'block';
        pane.classList.add('active');
      } else {
        pane.style.display = 'none';
        pane.classList.remove('active');
      }
    });

    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  document.querySelectorAll('.pc .nav-link').forEach(a => {
    a.addEventListener('click', function(e) {
      e.preventDefault();
      switchTab(this.getAttribute('data-tab'));
    });
  });

  document.querySelectorAll('.mnav .m-nav-item').forEach(item => {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      switchTab(this.getAttribute('data-tab'));
    });
  });

  // 4. Hafta Değiştirici (PC & Mobil)
  function setupWeekSwitch(btnSelector, panePrefix) {
    document.querySelectorAll(btnSelector).forEach(btn => {
      btn.addEventListener('click', function() {
        const week = this.getAttribute('data-week');
        document.querySelectorAll(btnSelector).forEach(b => b.classList.remove('on'));
        this.classList.add('on');
        document.querySelectorAll('.' + panePrefix).forEach(pane => {
          pane.style.display = 'none';
        });
        const target = document.getElementById(panePrefix + '-' + week);
        if (target) target.style.display = 'block';
      });
    });
  }
  setupWeekSwitch('#pcWeekSeg .week-tab-btn', 'pc-week-pane');
  setupWeekSwitch('#mWeekSeg .m-week-tab-btn', 'm-week-pane');

  // 5. Tarif Modal Sheet
  const recipesData = <?= json_encode($recipes, JSON_UNESCAPED_UNICODE) ?> || [];
  const modal = document.getElementById('recipeSheetModal');

  function openRecipe(idx) {
    const r = recipesData[idx];
    if (!r) return;

    document.getElementById('sheetCategory').textContent = (r.badge || 'Tarif') + ' · ' + (r.time_needed || '5 dk');
    document.getElementById('sheetTitle').textContent = r.title || '';
    document.getElementById('sheetDesc').textContent = r.content || r.subtitle || '';

    // Malzemeleri parse et
    const ingList = document.getElementById('sheetIngredients');
    ingList.innerHTML = '';
    const lines = (r.ingredients || '').split('\n').filter(l => l.trim().length > 0);
    if (lines.length > 0) {
      lines.forEach((line, i) => {
        const clean = line.replace(/^[•\-\*]\s*/, '').trim();
        const li = document.createElement('li');
        if (i === 0) li.className = 'ok';
        li.innerHTML = `<b>${i === 0 ? '✓' : ''}</b>${clean}`;
        ingList.appendChild(li);
      });
    } else {
      ingList.innerHTML = '<li class="ok"><b>✓</b>Organik taze malzemeler</li>';
    }

    modal.classList.add('active');
  }

  document.querySelectorAll('.js-open-recipe').forEach(el => {
    el.addEventListener('click', function(e) {
      e.preventDefault();
      const idx = parseInt(this.getAttribute('data-recipe-idx') || '0', 10);
      openRecipe(idx);
    });
  });

  document.getElementById('closeRecipeGrab')?.addEventListener('click', () => modal.classList.remove('active'));
  document.getElementById('closeRecipeBtn')?.addEventListener('click', () => modal.classList.remove('active'));
  modal?.addEventListener('click', (e) => {
    if (e.target === modal) modal.classList.remove('active');
  });
});
</script>
