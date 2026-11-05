<?php
declare(strict_types=1);
?>

<div style="background-color: var(--black); color: var(--white); padding: 1.25rem 0; border-bottom: 1px solid #222;">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
        <div>
            <a href="<?= url('/dashboard') ?>" style="color: #a1a1aa; font-size: var(--font-xs); letter-spacing: 0.1em; text-transform: uppercase;">
                &larr; Öğrenci Paneline Dön
            </a>
            <h1 style="font-size: 1.25rem; font-weight: 400; color: var(--white); margin-top: 2px;">
                <?= e($course['title']) ?>
            </h1>
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="text-align: right; font-size: var(--font-xs); color: #a1a1aa;">
                <span>İlerleme: </span>
                <strong id="progressText" style="color: var(--white); font-weight: 500;">%<?= $progressPercent ?></strong>
            </div>
            <div style="width: 120px; height: 6px; background-color: #333; border-radius: 3px; overflow: hidden;">
                <div id="progressBar" style="width: <?= $progressPercent ?>%; height: 100%; background-color: #ef4444; transition: width 0.3s ease;"></div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding-top: var(--space-md); padding-bottom: var(--space-xl);">
    <div style="display: grid; grid-template-columns: 1fr 340px; gap: var(--space-md);" class="classroom-layout">
        
        <!-- Sol Alan: YouTube Video Player & Ders Detayı -->
        <div>
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; background-color: #000; border-radius: var(--radius-sm); box-shadow: var(--shadow-md);">
                <iframe 
                    src="<?= youtube_embed_url($currentLesson['youtube_video_id'] ?? '') ?>" 
                    title="<?= e($currentLesson['title'] ?? '') ?>"
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                </iframe>
            </div>

            <div style="background-color: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: clamp(1.5rem, 3vw, 2rem); margin-top: 1rem; box-shadow: var(--shadow-subtle);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <span class="badge-pill" style="font-size: 0.65rem;">
                            <?= (int)($currentLesson['duration_minutes'] ?? 20) ?> Dakika Seans
                        </span>
                        <h2 style="font-size: 1.35rem; font-weight: 400; color: var(--black); margin-top: 0.4rem;">
                            <?= e($currentLesson['title'] ?? '') ?>
                        </h2>
                    </div>

                    <div>
                        <button type="button" id="btnCompleteLesson" 
                                class="btn <?= !empty($currentLesson['is_completed']) ? 'btn-outline' : 'btn-primary' ?>" 
                                data-lesson-id="<?= (int)$currentLesson['id'] ?>"
                                data-course-id="<?= (int)$course['id'] ?>"
                                <?= !empty($currentLesson['is_completed']) ? 'disabled' : '' ?>>
                            <?= !empty($currentLesson['is_completed']) ? '✓ DERS TAMAMLANDI' : 'DERSI TAMAMLA & İLERLE' ?>
                        </button>
                    </div>
                </div>

                <div style="color: var(--text-muted); font-size: var(--font-sm); font-weight: 300; line-height: 1.7; border-top: 1px solid var(--border-light); padding-top: 1rem;">
                    <p><?= nl2br(e($currentLesson['description'] ?? 'Bu seansı uygularken bedeninizin sinyallerini dinleyin. Zorlayıcı ağrı durumunda dinlenmeye geçin.')) ?></p>
                </div>
            </div>
        </div>

        <!-- Sağ Alan: Ders Çalma Listesi -->
        <div style="background-color: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 1.25rem; height: fit-content; box-shadow: var(--shadow-subtle);">
            <h3 style="font-size: 0.95rem; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase; color: var(--black); margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--border-color);">
                Müfredat & Seanslar
            </h3>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <?php foreach ($lessons as $idx => $l): ?>
                    <?php 
                        $isActive = ($l['id'] == $currentLesson['id']);
                        $isComp = !empty($l['is_completed']);
                    ?>
                    <a href="<?= url('/course/' . $course['slug'] . '/lesson/' . $l['id']) ?>" 
                       style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 0.85rem; border-radius: var(--radius-sm); border: 1px solid <?= $isActive ? 'var(--primary)' : 'var(--border-light)' ?>; background-color: <?= $isActive ? 'var(--primary-light)' : 'var(--off-white)' ?>; text-decoration: none;">
                        <div style="display: flex; align-items: center; gap: 0.6rem;">
                            <span style="font-size: 0.75rem; color: <?= $isComp ? '#10b981' : 'var(--text-light)' ?>;">
                                <?= $isComp ? '✓' : ($idx + 1) ?>
                            </span>
                            <span style="font-size: 0.85rem; font-weight: <?= $isActive ? '500' : '300' ?>; color: var(--black);">
                                <?= e($l['title']) ?>
                            </span>
                        </div>
                        <span style="font-size: 0.72rem; color: var(--text-muted);">
                            <?= (int)$l['duration_minutes'] ?> dk
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<!-- Rozet Kazanım Pop-up Bildirimi -->
<div id="badgeCelebrationModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: var(--radius-sm); max-width: 420px; width: 100%; padding: 2.5rem; text-align: center; box-shadow: var(--shadow-lg);">
        <div id="badgeModalIcon" style="font-size: 4rem; margin-bottom: 0.5rem;">🏆</div>
        <span class="badge-pill" style="margin-bottom: 0.75rem;">TEBRİKLER! YENİ ROZET KAZANDINIZ</span>
        <h3 id="badgeModalName" style="font-size: 1.4rem; font-weight: 500; color: var(--black); margin-bottom: 0.5rem;">Longevity Master</h3>
        <p style="font-size: var(--font-sm); color: var(--text-muted); font-weight: 300; margin-bottom: 1.5rem;">
            Seansı başarıyla tamamlayarak ilerleme rozetini profilinize eklediniz!
        </p>
        <button type="button" id="badgeModalClose" class="btn btn-primary btn-sm" style="width: 100%;">
            DEVAM ET
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnComplete = document.getElementById('btnCompleteLesson');
    const badgeModal = document.getElementById('badgeCelebrationModal');
    const badgeModalClose = document.getElementById('badgeModalClose');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');

    if (btnComplete) {
        btnComplete.addEventListener('click', function() {
            const lessonId = this.getAttribute('data-lesson-id');
            const courseId = this.getAttribute('data-course-id');
            btnComplete.disabled = true;
            btnComplete.innerText = 'KAYDEDILIYOR...';

            fetch('<?= url('/api/lesson/complete') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= e($csrfToken) ?>'
                },
                body: JSON.stringify({ lesson_id: lessonId, course_id: courseId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    btnComplete.innerText = '✓ DERS TAMAMLANDI';
                    btnComplete.classList.remove('btn-primary');
                    btnComplete.classList.add('btn-outline');

                    if (progressBar) progressBar.style.width = data.progress + '%';
                    if (progressText) progressText.innerText = '%' + data.progress;

                    if (data.newBadge) {
                        document.getElementById('badgeModalIcon').innerText = data.newBadge.icon;
                        document.getElementById('badgeModalName').innerText = data.newBadge.name;
                        badgeModal.style.display = 'flex';
                    }
                }
            })
            .catch(() => {
                btnComplete.disabled = false;
                btnComplete.innerText = 'DERSI TAMAMLA & İLERLE';
            });
        });
    }

    if (badgeModalClose) {
        badgeModalClose.addEventListener('click', function() {
            badgeModal.style.display = 'none';
        });
    }
});
</script>

<style>
@media (max-width: 900px) {
    .classroom-layout {
        grid-template-columns: 1fr !important;
    }
}
</style>

