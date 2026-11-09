<?php
declare(strict_types=1);
/**
 * @var array $course
 * @var array $currentLesson
 * @var array $lessons
 * @var array|null $prevLesson
 * @var array|null $nextLesson
 * @var int $progressPercent
 * @var int $completedCount
 * @var int $totalCount
 * @var array $user
 */
?>

<!-- ==============================================================================
     FİZYOBAR WORKOUT PLAYER (KİŞİSEL ANTRENMAN VE VİDEO ODASI)
     ============================================================================== -->
<div class="workout-player-page">
    <!-- Üst Bar & Gezinme -->
    <header class="player-top-header">
        <div class="container player-header-container">
            <div class="player-header-left">
                <a href="<?= url('/movement-space') ?>" class="player-back-link">
                    &larr; HAREKET ALANIMA DÖN
                </a>
                <h1 class="player-workout-title">
                    <span class="workout-order-prefix"><?= $currentLesson['workout_number'] ?> &mdash;</span> 
                    <?= e($currentLesson['title'] ?? '') ?>
                </h1>
            </div>

            <div class="player-header-right">
                <div class="player-progress-info">
                    <span class="progress-info-label">İlerleme:</span>
                    <strong class="progress-info-val" id="playerProgressPercent">%<?= $progressPercent ?></strong>
                    <span class="progress-info-sub">(<span id="playerCompletedCount"><?= $completedCount ?></span>/<?= $totalCount ?>)</span>
                </div>
                <div class="player-progress-bar-wrap">
                    <div class="player-progress-fill" id="playerProgressBar" style="width: <?= $progressPercent ?>%;"></div>
                </div>
            </div>
        </div>
    </header>

    <div class="container player-main-container">
        <div class="player-grid-layout">
            <!-- Sol: Video Ekranı & Antrenman Detayları -->
            <main class="player-stage-area">
                <!-- Video Kutusu -->
                <div class="player-video-viewport">
                    <iframe 
                        src="<?= youtube_embed_url($currentLesson['youtube_video_id'] ?? '') ?>" 
                        title="<?= e($currentLesson['title'] ?? '') ?>"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen
                        class="player-iframe">
                    </iframe>
                </div>

                <!-- Kontrol Barı & Tamamlama Butonu -->
                <div class="player-actions-toolbar">
                    <div class="toolbar-left-meta">
                        <span class="toolbar-pill-badge">PROGRAM GÜNÜ: <?= $currentLesson['day_number'] ?></span>
                        <span class="toolbar-pill-badge"><?= (int)$currentLesson['duration_minutes'] ?> DAKİKA</span>
                        <?php if (!empty($currentLesson['equipment'])): ?>
                            <span class="toolbar-pill-badge">EKİPMAN: <?= e($currentLesson['equipment']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="toolbar-right-btn">
                        <button type="button" id="btnCompleteWorkout" 
                                class="btn-complete-workout <?= !empty($currentLesson['is_completed']) ? 'is-completed' : '' ?>"
                                data-lesson-id="<?= (int)$currentLesson['id'] ?>"
                                data-course-id="<?= (int)$course['id'] ?>">
                            <?= !empty($currentLesson['is_completed']) ? '✓ ANTRENMAN TAMAMLANDI' : 'ANTRENMANI TAMAMLADIM &rarr;' ?>
                        </button>
                    </div>
                </div>

                <!-- Biyomekanik Odak & Seans Açıklaması -->
                <section class="player-briefing-box">
                    <div class="briefing-header">
                        <span class="briefing-kicker">KLİNİK ODAK ALANI</span>
                        <h2 class="briefing-title"><?= e($currentLesson['focus_area'] ?? 'Tüm Beden Hizalanma') ?></h2>
                    </div>

                    <div class="briefing-text-content">
                        <p><?= nl2br(e($currentLesson['description'] ?? 'Bu seansı uygularken bedeninizin sinyallerini dinleyin. Zorlayıcı ağrı durumunda dinlenmeye geçin.')) ?></p>
                    </div>

                    <!-- Eğitmen Notları & Öneriler -->
                    <div class="player-trainer-notes">
                        <div class="trainer-avatar-mini">
                            <span class="trainer-icon">🧘‍♀️</span>
                        </div>
                        <div class="trainer-note-text">
                            <strong>Fzt. Betina Tansuğ'un Notu:</strong>
                            <p>"Hareketleri yaparken derin diyafram solunumunu asla tutmayın. Her nefes verişte eklem kapsülünün rahatladığını ve omurganın uzadığını hissedin."</p>
                        </div>
                    </div>

                    <!-- Önceki / Sonraki Seans Gezinmesi -->
                    <div class="player-nav-bottom">
                        <?php if ($prevLesson && empty($prevLesson['is_locked'])): ?>
                            <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $prevLesson['id']) ?>" class="player-nav-arrow-btn prev">
                                &larr; Önceki Seans: <?= e($prevLesson['workout_number']) ?>
                            </a>
                        <?php else: ?>
                            <div></div>
                        <?php endif; ?>

                        <?php if ($nextLesson && empty($nextLesson['is_locked'])): ?>
                            <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $nextLesson['id']) ?>" class="player-nav-arrow-btn next">
                                Sonraki Seans: <?= e($nextLesson['workout_number']) ?> &rarr;
                            </a>
                        <?php elseif ($nextLesson): ?>
                            <span class="player-nav-arrow-btn next disabled" title="<?= e($nextLesson['unlock_date'] ?? '') ?> tarihinde açılacak">
                                🔒 Sonraki Seans <?= !empty($nextLesson['unlock_date']) ? '(' . e($nextLesson['unlock_date']) . ')' : '' ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </section>
            </main>

            <!-- Sağ: 12 Antrenman Çalma Listesi -->
            <aside class="player-playlist-sidebar">
                <div class="playlist-card">
                    <div class="playlist-header">
                        <span class="playlist-kicker">4 HAFTALIK DÖNGÜ</span>
                        <h3 class="playlist-title">Program Seansları</h3>
                    </div>

                    <div class="playlist-items-scroll">
                        <?php foreach ($lessons as $i => $l): ?>
                            <?php 
                                $isActive = ($l['id'] == $currentLesson['id']);
                                $isComp = !empty($l['is_completed']);
                                $isLocked = !empty($l['is_locked']);
                            ?>
                            <div class="playlist-item <?= $isActive ? 'active' : '' ?> <?= $isComp ? 'completed' : '' ?> <?= $isLocked ? 'locked' : '' ?>">
                                <div class="item-left-num">
                                    <?php if ($isComp): ?>
                                        <span class="item-icon-check">✓</span>
                                    <?php elseif ($isLocked): ?>
                                        <span class="item-icon-lock">🔒</span>
                                    <?php else: ?>
                                        <span class="item-icon-num"><?= $l['workout_number'] ?></span>
                                    <?php endif; ?>
                                </div>

                                <div class="item-content-body">
                                    <div class="item-day-meta">GÜN <?= $l['day_number'] ?> &bull; <?= (int)$l['duration_minutes'] ?> Dk</div>
                                    <h4 class="item-title"><?= e($l['title']) ?></h4>
                                </div>

                                <?php if (!$isLocked): ?>
                                    <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $l['id']) ?>" class="playlist-item-link" title="<?= e($l['title']) ?>"></a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- ==============================================================================
     ANTRENMAN TAMAMLAMA AJAX SCRİPTİ
     ============================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const completeBtn = document.getElementById('btnCompleteWorkout');
    const percentEl = document.getElementById('playerProgressPercent');
    const countEl = document.getElementById('playerCompletedCount');
    const progressBar = document.getElementById('playerProgressBar');

    if (completeBtn) {
        completeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const lessonId = this.getAttribute('data-lesson-id');
            const courseId = this.getAttribute('data-course-id');
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '<?= csrf_token() ?>';

            completeBtn.disabled = true;
            completeBtn.style.opacity = '0.6';

            fetch('<?= url('/api/lesson/complete') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    lesson_id: lessonId,
                    course_id: courseId,
                    _csrf_token: csrfToken,
                    toggle: true
                })
            })
            .then(res => {
                if (!res.ok) {
                    throw new Error('HTTP Status: ' + res.status);
                }
                return res.json();
            })
            .then(data => {
                completeBtn.disabled = false;
                completeBtn.style.opacity = '1';

                if (data.success) {
                    // Sayfayı yenileyerek sonraki açılan dersin kilidini ve listeyi anında güncelle
                    window.location.reload();
                } else {
                    alert('İşlem sırasında bir hata oluştu: ' + (data.error || 'Bilinmeyen hata'));
                }
            })
            .catch(err => {
                completeBtn.disabled = false;
                completeBtn.style.opacity = '1';
                console.error(err);
                alert('İşlem tamamlanırken bir bağlantı hatası oluştu. Lütfen tekrar deneyin.');
            });
        });
    }
});
</script>
