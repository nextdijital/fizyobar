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

    <button type="button" onclick="document.getElementById('newCourseFormModal').style.display='flex';" class="xp-btn-pill-primary">
        + YENİ PROGRAM EKLE &rarr;
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
                    <th style="text-align: right;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td>#<?= $c['id'] ?></td>
                        <td>
                            <strong style="color: #111; font-size: 0.95rem;"><?= e($c['title']) ?></strong>
                            <div style="font-size: 0.72rem; color: var(--text-muted);"><?= e($c['slug']) ?></div>
                        </td>
                        <td><span style="text-transform: uppercase; font-size: 0.72rem; background: #f1f5f9; padding: 2px 7px; border-radius: 999px; font-weight: 600;"><?= e($c['category']) ?></span></td>
                        <td><strong>₺<?= number_format((float)$c['price'], 2, ',', '.') ?></strong></td>
                        <td><?= (int)$c['duration_weeks'] ?> Hafta</td>
                        <td>
                            <a href="<?= url('/xpanel/courses/' . $c['id'] . '/lessons') ?>" class="xp-btn-action-pill xp-btn-action-edit">
                                🎬 <?= (int)$c['lesson_count'] ?> Video Seans
                            </a>
                        </td>
                        <td><?= e($c['badge_icon']) ?> <?= e($c['badge_title']) ?></td>
                        <td>
                            <?= $c['is_active'] ? '<span style="color:#065f46; background:#ecfdf5; border: 1px solid #a7f3d0; padding:2px 8px; font-size:0.72rem; border-radius:999px; font-weight:600;">Yayında</span>' : '<span style="color:#64748b; background:#f1f5f9; padding:2px 8px; font-size:0.72rem; border-radius:999px;">Pasif</span>' ?>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end;">
                                <a href="<?= url('/xpanel/courses/' . $c['id'] . '/lessons') ?>" class="xp-btn-action-pill xp-btn-action-edit" title="Video Dersleri Yönet">
                                    Dersler &rarr;
                                </a>
                                <form action="<?= url('/xpanel/courses/delete') ?>" method="POST" onsubmit="return confirm('Bu programı silmek istediğinize emin misiniz?');" style="display:inline; margin: 0;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                    <button type="submit" class="xp-btn-action-pill xp-btn-action-danger">Sil</button>
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

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('newCourseFormModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">✓ Programı Kaydet &rarr;</button>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/layout_bottom.php'; ?>

