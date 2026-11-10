<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <a href="<?= url('/xpanel/courses') ?>" style="font-size: var(--font-xs); color: var(--text-muted); text-transform: uppercase;">&larr; Programlar Listesine Dön</a>
        <h1 style="font-size: 1.45rem; font-weight: 500; color: var(--black); text-transform: uppercase; margin: 4px 0 0 0;">
            <?= e($course['title']) ?> &mdash; Video Müfredatı (<?= count($lessons) ?> Antrenman)
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm); margin: 0.25rem 0 0 0;">
            Öğrencilerin Movement Space takviminde izleyeceği YouTube liste dışı seanslarını, odak alanlarını ve ekipmanları yönetin.
        </p>
    </div>

    <button type="button" onclick="openNewLessonModal()" class="xp-btn-pill-primary">
        + YENİ VİDEO SEANS EKLE &rarr;
    </button>
</div>

<div class="xpanel-card">
    <?php if (empty($lessons)): ?>
        <p style="color: var(--text-muted); font-size: var(--font-sm); text-align: center; padding: 2.5rem;">
            Bu programa ait henüz video seans eklenmemiş. Yukarıdaki '+ Yeni Video Seans Ekle' butonundan YouTube linki ile ekleyebilirsiniz.
        </p>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table class="xpanel-table">
                <thead>
                    <tr>
                        <th>GÜN</th>
                        <th>SIRA</th>
                        <th>Antrenman Başlığı &amp; Detayı</th>
                        <th>Klinik Odak &amp; Ekipman</th>
                        <th>YouTube Video ID</th>
                        <th>Süre</th>
                        <th style="text-align: right;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lessons as $l): ?>
                        <tr>
                            <td>
                                <span style="background: #0f172a; color: #fff; padding: 3px 8px; border-radius: 4px; font-weight: 700; font-size: 0.72rem;">
                                    GÜN <?= (int)($l['day_number'] ?? 1) ?>
                                </span>
                            </td>
                            <td><strong>#<?= (int)$l['sort_order'] ?></strong></td>
                            <td>
                                <strong style="font-size: 0.95rem; color: #111;"><?= e($l['title']) ?></strong>
                                <?php if (!empty($l['description'])): ?>
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                        <?= e(mb_substr($l['description'], 0, 75)) ?>...
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div style="font-size: 0.82rem; font-weight: 600; color: #334155;"><?= e($l['focus_area'] ?? 'Tüm Beden') ?></div>
                                <div style="font-size: 0.72rem; color: #64748b;">Ekipman: <?= e($l['equipment'] ?? 'Mat') ?></div>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.4rem;">
                                    <code style="font-size: 0.8rem; background: #f1f5f9; padding: 2px 6px; border-radius: 3px;"><?= e($l['youtube_video_id']) ?></code>
                                    <a href="https://www.youtube.com/watch?v=<?= urlencode($l['youtube_video_id']) ?>" target="_blank" style="color: #ef4444; font-size: 0.75rem;" title="YouTube'da Aç">▶</a>
                                </div>
                            </td>
                            <td><strong><?= (int)$l['duration_minutes'] ?></strong> Dk</td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end;">
                                    <!-- Düzenle Butonu -->
                                    <button type="button" 
                                            class="xp-btn-action-pill xp-btn-action-edit"
                                            onclick='openEditLessonModal(<?= json_encode($l, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                        Düzenle
                                    </button>

                                    <!-- Sil Butonu -->
                                    <form action="<?= url('/xpanel/lessons/delete') ?>" method="POST" onsubmit="return confirm('<?= e(addslashes($l['title'])) ?> seansını silmek istediğinize emin misiniz?');" style="display:inline; margin: 0;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                        <input type="hidden" name="id" value="<?= $l['id'] ?>">
                                        <button type="submit" class="xp-btn-action-pill xp-btn-action-danger">Sil</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Video Seans Ekleme / Düzenleme Modalı -->
<div id="lessonModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: 8px; max-width: 620px; width: 100%; max-height: 90vh; overflow-y: auto; padding: 2rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
            <h3 id="lessonModalTitle" style="font-size: 1.15rem; font-weight: 600; color: var(--black); margin: 0;">Video Seansı Ekle / Düzenle</h3>
            <button type="button" onclick="document.getElementById('lessonModal').style.display='none';" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #64748b;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/lessons/save') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
            <input type="hidden" id="lesson_id" name="id" value="0">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label" for="lesson_day" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Program Günü (1-28) *</label>
                    <input type="number" id="lesson_day" name="day_number" class="form-input" required min="1" max="28" value="1" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label class="form-label" for="lesson_sort" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Görüntüleme Sırası *</label>
                    <input type="number" id="lesson_sort" name="sort_order" class="form-input" required min="1" value="1" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label" for="lesson_title" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Seans Başlığı *</label>
                <input type="text" id="lesson_title" name="title" class="form-input" required placeholder="Örn: Foundation: Tüm Beden Hizalanma & Kuvvet" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label" for="lesson_focus" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Klinik Odak Alanı</label>
                    <input type="text" id="lesson_focus" name="focus_area" class="form-input" placeholder="Örn: Omurga & Kalça Açıcı" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label class="form-label" for="lesson_equipment" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Gerekli Ekipman</label>
                    <input type="text" id="lesson_equipment" name="equipment" class="form-input" placeholder="Örn: Mat, Yoga Bloğu" value="Mat" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label" for="lesson_youtube" style="font-size: 0.8rem; font-weight: 600; color: #334155;">YouTube Linki veya Video ID *</label>
                    <input type="text" id="lesson_youtube" name="youtube_url" class="form-input" required placeholder="https://www.youtube.com/watch?v=sTANio_2E0Q veya Video ID" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label class="form-label" for="lesson_duration" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Süre (Dakika)</label>
                    <input type="number" id="lesson_duration" name="duration_minutes" class="form-input" value="40" min="5" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" for="lesson_desc" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Egzersiz Açıklaması &amp; Biyomekanik Notlar</label>
                <textarea id="lesson_desc" name="description" rows="3" class="form-input" placeholder="Bu antrenmanda odaklanılacak anatomik noktalar ve nefes talimatları..." style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;"></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" onclick="document.getElementById('lessonModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    ✓ Seansı Kaydet &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openNewLessonModal() {
    document.getElementById('lessonModalTitle').innerText = 'Yeni YouTube Video Seansı Ekle';
    document.getElementById('lesson_id').value = '0';
    document.getElementById('lesson_day').value = '1';
    document.getElementById('lesson_sort').value = '<?= count($lessons) + 1 ?>';
    document.getElementById('lesson_title').value = '';
    document.getElementById('lesson_focus').value = '';
    document.getElementById('lesson_equipment').value = 'Mat';
    document.getElementById('lesson_youtube').value = '';
    document.getElementById('lesson_duration').value = '40';
    document.getElementById('lesson_desc').value = '';
    document.getElementById('lessonModal').style.display = 'flex';
}

function openEditLessonModal(lesson) {
    document.getElementById('lessonModalTitle').innerText = 'Video Seansını Düzenle: ' + lesson.title;
    document.getElementById('lesson_id').value = lesson.id;
    document.getElementById('lesson_day').value = lesson.day_number || 1;
    document.getElementById('lesson_sort').value = lesson.sort_order || 1;
    document.getElementById('lesson_title').value = lesson.title || '';
    document.getElementById('lesson_focus').value = lesson.focus_area || '';
    document.getElementById('lesson_equipment').value = lesson.equipment || 'Mat';
    document.getElementById('lesson_youtube').value = lesson.youtube_url || lesson.youtube_video_id || '';
    document.getElementById('lesson_duration').value = lesson.duration_minutes || 40;
    document.getElementById('lesson_desc').value = lesson.description || '';
    document.getElementById('lessonModal').style.display = 'flex';
}
</script>

<?php require __DIR__ . '/layout_bottom.php'; ?>
