<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <a href="<?= url('/xpanel/courses') ?>" style="font-size: var(--font-xs); color: var(--text-muted); text-transform: uppercase;">&larr; Programlar Listesine Dön</a>
        <h1 style="font-size: 1.45rem; font-weight: 400; color: var(--black); text-transform: uppercase; margin-top: 2px;">
            <?= e($course['title']) ?> — Video Dersleri
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm);">
            YouTube üzerinden liste dışı / gizli video linklerini ekleyerek ders müfredatını oluşturun.
        </p>
    </div>

    <button type="button" onclick="document.getElementById('newLessonModal').style.display='flex';" class="btn btn-primary btn-sm">
        + YENİ VİDEO DERS EKLE
    </button>
</div>

<div class="xpanel-card">
    <?php if (empty($lessons)): ?>
        <p style="color: var(--text-muted); font-size: var(--font-sm); text-align: center; padding: 2rem;">
            Bu programa ait henüz video ders eklenmemiş. Yukarıdaki '+ Yeni Video Ders Ekle' butonundan YouTube linki ile ekleyebilirsiniz.
        </p>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table class="xpanel-table">
                <thead>
                    <tr>
                        <th>Sıra</th>
                        <th>Ders Başlığı</th>
                        <th>YouTube Video ID / URL</th>
                        <th>Süre</th>
                        <th>Önizleme</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lessons as $l): ?>
                        <tr>
                            <td><strong><?= (int)$l['sort_order'] ?></strong></td>
                            <td>
                                <strong><?= e($l['title']) ?></strong>
                                <?php if (!empty($l['description'])): ?>
                                    <div style="font-size: 0.72rem; color: var(--text-muted);"><?= e(substr($l['description'], 0, 70)) ?>...</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <code style="font-size: 0.8rem; background: #f1f5f9; padding: 2px 6px; border-radius: 3px;"><?= e($l['youtube_video_id']) ?></code>
                            </td>
                            <td><?= (int)$l['duration_minutes'] ?> Dakika</td>
                            <td>
                                <a href="https://www.youtube.com/watch?v=<?= urlencode($l['youtube_video_id']) ?>" target="_blank" style="color: var(--primary); font-size: var(--font-xs); text-decoration: underline;">
                                    YT Aç ↗
                                </a>
                            </td>
                            <td>
                                <form action="<?= url('/xpanel/lessons/delete') ?>" method="POST" onsubmit="return confirm('Bu video dersi silmek istediğinize emin misiniz?');" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                    <input type="hidden" name="id" value="<?= $l['id'] ?>">
                                    <button type="submit" class="btn btn-outline btn-xs" style="color:#b91c1c; border-color:#fca5a5;">Sil</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Yeni Ders Ekleme Modalı -->
<div id="newLessonModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: var(--radius-sm); max-width: 580px; width: 100%; max-height: 90vh; overflow-y: auto; padding: 2rem; box-shadow: var(--shadow-lg);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h3 style="font-size: 1.15rem; font-weight: 500; color: var(--black); text-transform: uppercase;">Yeni YouTube Video Dersi Ekle</h3>
            <button type="button" onclick="document.getElementById('newLessonModal').style.display='none';" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/lessons/save') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

            <div class="form-group">
                <label class="form-label">Ders Başlığı *</label>
                <input type="text" name="title" class="form-input" required placeholder="Örn: Hafta 1: Metabolik Uyanış & Diyafram Nefesi">
            </div>

            <div class="form-group">
                <label class="form-label">YouTube Video Linki veya Video ID *</label>
                <input type="text" name="youtube_url" class="form-input" required placeholder="https://www.youtube.com/watch?v=... veya video ID">
                <small style="color: var(--text-muted); font-size: 0.72rem; margin-top: 3px; display: block;">
                    YouTube linkini tam yapıştırabilirsiniz; sistem video ID'sini otomatik ayıklar.
                </small>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Ders Süresi (Dakika)</label>
                    <input type="number" name="duration_minutes" class="form-input" required value="25">
                </div>
                <div class="form-group">
                    <label class="form-label">Sıra Numarası</label>
                    <input type="number" name="sort_order" class="form-input" required value="<?= count($lessons) + 1 ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Ders Açıklaması ve Öğrenci Notları</label>
                <textarea name="description" class="form-textarea" placeholder="Bu derste dikkat edilecek anatomik noktalar..."></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('newLessonModal').style.display='none';" class="btn btn-outline btn-sm">İptal</button>
                <button type="submit" class="btn btn-primary btn-sm">VİDEO DERSİ KAYDET</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>

