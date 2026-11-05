<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.45rem; font-weight: 400; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em;">
            Eğitim & Program Paketleri
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm);">
            Online kampları, video kursları ve stüdyo programlarını yönetin.
        </p>
    </div>

    <button type="button" onclick="document.getElementById('newCourseFormModal').style.display='flex';" class="btn btn-primary btn-sm">
        + YENİ PROGRAM EKLE
    </button>
</div>

<div class="xpanel-card">
    <div style="overflow-x: auto;">
        <table class="xpanel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Program Adı</th>
                    <th>Kategori</th>
                    <th>Fiyat</th>
                    <th>Süre</th>
                    <th>Ders Sayısı</th>
                    <th>Rozet</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td>#<?= $c['id'] ?></td>
                        <td>
                            <strong><?= e($c['title']) ?></strong>
                            <div style="font-size: 0.72rem; color: var(--text-muted);"><?= e($c['slug']) ?></div>
                        </td>
                        <td><span style="text-transform: uppercase; font-size: 0.75rem;"><?= e($c['category']) ?></span></td>
                        <td><strong>₺<?= number_format((float)$c['price'], 2, ',', '.') ?></strong></td>
                        <td><?= (int)$c['duration_weeks'] ?> Hafta</td>
                        <td>
                            <a href="<?= url('/xpanel/courses/' . $c['id'] . '/lessons') ?>" class="btn btn-outline btn-xs" style="color: var(--primary); border-color: var(--primary);">
                                🎬 <?= (int)$c['lesson_count'] ?> Video Ders
                            </a>
                        </td>
                        <td><?= e($c['badge_icon']) ?> <?= e($c['badge_title']) ?></td>
                        <td>
                            <?= $c['is_active'] ? '<span style="color:#065f46; background:#ecfdf5; padding:2px 6px; font-size:0.75rem; border-radius:3px;">Yayında</span>' : '<span style="color:#666;">Pasif</span>' ?>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.4rem;">
                                <a href="<?= url('/xpanel/courses/' . $c['id'] . '/lessons') ?>" class="btn btn-primary btn-xs" title="Video Dersleri Yönet">
                                    Dersler
                                </a>
                                <form action="<?= url('/xpanel/courses/delete') ?>" method="POST" onsubmit="return confirm('Bu programı silmek istediğinize emin misiniz?');" style="display:inline;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                    <button type="submit" class="btn btn-outline btn-xs" style="color:#b91c1c; border-color:#fca5a5;">Sil</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Yeni Program Ekleme Modalı -->
<div id="newCourseFormModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: var(--radius-sm); max-width: 650px; width: 100%; max-height: 90vh; overflow-y: auto; padding: 2rem; box-shadow: var(--shadow-lg);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h3 style="font-size: 1.2rem; font-weight: 500; color: var(--black); text-transform: uppercase;">Yeni Eğitim Programı Ekle</h3>
            <button type="button" onclick="document.getElementById('newCourseFormModal').style.display='none';" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/courses/save') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label class="form-label">Program Başlığı *</label>
                <input type="text" name="title" class="form-input" required placeholder="Örn: 4 Haftalık Online Detox & Yoga Kampı">
            </div>

            <div class="form-group">
                <label class="form-label">SEO URL (Slug) - Boş bırakılırsa otomatik üretilir</label>
                <input type="text" name="slug" class="form-input" placeholder="online-detox-yoga-kampi">
            </div>

            <div class="form-group">
                <label class="form-label">Kısa Açıklama (Spot) *</label>
                <input type="text" name="subtitle" class="form-input" required placeholder="Ev konforunda canlı seanslar...">
            </div>

            <div class="form-group">
                <label class="form-label">Detaylı Açıklama</label>
                <textarea name="description" class="form-textarea" placeholder="Program müfredatı ve içerik detayları..."></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-input">
                        <option value="online">Online Kamp</option>
                        <option value="studio">Stüdyo & Birebir</option>
                        <option value="workshop">Workshop & Atölye</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Fiyat (TL) *</label>
                    <input type="number" step="0.01" name="price" class="form-input" required value="1450.00">
                </div>
                <div class="form-group">
                    <label class="form-label">Süre (Hafta)</label>
                    <input type="number" name="duration_weeks" class="form-input" required value="4">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">Kazanılacak Rozet Adı</label>
                    <input type="text" name="badge_title" class="form-input" value="Detox Master">
                </div>
                <div class="form-group">
                    <label class="form-label">Rozet İkonu (Emoji)</label>
                    <input type="text" name="badge_icon" class="form-input" value="🌿">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('newCourseFormModal').style.display='none';" class="btn btn-outline btn-sm">İptal</button>
                <button type="submit" class="btn btn-primary btn-sm">KAYDET & EKLE</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>

