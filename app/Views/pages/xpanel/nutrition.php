<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';

$recipesCount = count(array_filter($items, fn($i) => $i['category'] === 'recipe'));
$guidesCount = count(array_filter($items, fn($i) => in_array($i['category'], ['guide', 'tip'], true)));
$routinesCount = count(array_filter($items, fn($i) => $i['category'] === 'routine'));
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.45rem; font-weight: 500; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.25rem 0;">
            Mutfak &amp; Beslenme İçerik Yönetimi
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm); margin: 0;">
            Öğrencilerin Mutfak ve Eğitim alanında gördüğü rafine şekersiz tarifleri, sağlıklı yaşam rehberlerini ve mikro rutinleri yönetin.
        </p>
    </div>

    <button type="button" onclick="openNewNutritionModal()" class="xp-btn-pill-primary">
        + YENİ İÇERİK EKLE &rarr;
    </button>
</div>

<!-- Özet Kartlar -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Toplam İçerik</span>
        <strong style="font-size: 1.6rem; color: var(--black);"><?= count($items) ?></strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Fonksiyonel Tarifler</span>
        <strong style="font-size: 1.6rem; color: #16a34a;"><?= $recipesCount ?> Tarif</strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Sağlıklı Yaşam Rehberleri</span>
        <strong style="font-size: 1.6rem; color: #0284c7;"><?= $guidesCount ?> Rehber</strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Mikro Rutinler</span>
        <strong style="font-size: 1.6rem; color: #7c3aed;"><?= $routinesCount ?> Rutin</strong>
    </div>
</div>

<div class="xp-table-card">
    <div class="xp-table-header-bar">
        <div>
            <h2 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 0.2rem 0;">
                Stüdyo &amp; Mutfak İçerikleri
            </h2>
            <span style="font-size: 0.8rem; color: #64748b;">
                Tüm fonksiyonel tarifler, longevity rehberleri ve günlük rutinler
            </span>
        </div>
    </div>

    <?php if (empty($items)): ?>
        <p style="color: #64748b; font-size: 0.9rem; text-align: center; padding: 2.5rem 0;">
            Henüz içerik eklenmemiş. Yukarıdaki '+ Yeni İçerik Ekle' butonundan ilk tarif veya rehberinizi oluşturabilirsiniz.
        </p>
    <?php else: ?>
        <div class="xpanel-table-wrap">
            <table class="xpanel-table">
                <thead>
                    <tr>
                        <th style="width: 130px;">Kategori</th>
                        <th style="min-width: 180px;">İçerik Başlığı &amp; Rozet</th>
                        <th style="width: 120px;">Süre / Ölçü</th>
                        <th style="min-width: 220px;">Malzemeler &amp; Özet</th>
                        <th style="text-align: right; width: 120px;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <?php if ($item['category'] === 'recipe'): ?>
                                    <span style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 2px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        🍏 TARİF
                                    </span>
                                <?php elseif (in_array($item['category'], ['guide', 'tip'], true)): ?>
                                    <span style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; padding: 2px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        📖 REHBER / İPUCU
                                    </span>
                                <?php else: ?>
                                    <span style="background: #f3e8ff; color: #6b21a8; border: 1px solid #e9d5ff; padding: 2px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 600;">
                                        ⚡ MİKRO RUTİN
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong style="font-size: 0.95rem; color: #111;"><?= e($item['title']) ?></strong>
                                <?php if (!empty($item['badge'])): ?>
                                    <span style="font-size: 0.68rem; background: #f1f5f9; color: #475569; padding: 1px 5px; border-radius: 3px; font-weight: 700; margin-left: 0.35rem;">
                                        <?= e($item['badge']) ?>
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($item['subtitle'])): ?>
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                        <?= e($item['subtitle']) ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="font-size: 0.82rem; font-weight: 600; color: #334155;">
                                    <?= e($item['time_needed'] ?: '-') ?>
                                </span>
                            </td>
                            <td>
                                <?php if (!empty($item['ingredients'])): ?>
                                    <div style="font-size: 0.72rem; color: #475569; max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <strong>Malzemeler:</strong> <?= e($item['ingredients']) ?>
                                    </div>
                                <?php endif; ?>
                                <div style="font-size: 0.72rem; color: #64748b; max-width: 280px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <?= e($item['content']) ?>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end;">
                                    <!-- Düzenle Butonu -->
                                    <button type="button" 
                                            class="xp-btn-action-pill xp-btn-action-edit"
                                            onclick='openEditNutritionModal(<?= json_encode($item, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                        Düzenle
                                    </button>

                                    <!-- Sil Butonu -->
                                    <form action="<?= url('/xpanel/nutrition/delete') ?>" method="POST" onsubmit="return confirm('<?= e(addslashes($item['title'])) ?> içeriğini silmek istediğinize emin misiniz?');" style="display:inline; margin: 0;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
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

<!-- İçerik Ekleme / Düzenleme Modalı -->
<div id="nutritionModal" class="xp-modal-backdrop">
    <div class="xp-modal-window">
        <div class="xp-modal-header">
            <h3 id="nutritionModalTitle" class="xp-modal-title">Studio İçeriği Ekle / Düzenle</h3>
            <button type="button" onclick="document.getElementById('nutritionModal').style.display='none';" class="xp-modal-close-btn">&times;</button>
        </div>

        <form action="<?= url('/xpanel/nutrition/save') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>
            <input type="hidden" id="nut_id" name="id" value="0">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                <div>
                    <label class="xp-form-label" for="nut_category">İçerik Kategorisi *</label>
                    <select id="nut_category" name="category" class="xp-form-select" required>
                        <option value="recipe">🍏 Fonksiyonel Tarif</option>
                        <option value="guide">📖 Longevity / Biyomekanik Rehberi</option>
                        <option value="routine">⚡ Ekstra Mikro Rutin (5-10 Dk)</option>
                        <option value="tip">💡 Longevity &amp; Sirkadiyen Kuralı</option>
                    </select>
                </div>
                <div>
                    <label class="xp-form-label" for="nut_sort">Sıralama Sırası</label>
                    <input type="number" id="nut_sort" name="sort_order" class="xp-form-input" value="1" min="0">
                </div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="nut_title">Başlık *</label>
                <input type="text" id="nut_title" name="title" class="xp-form-input" required placeholder="Örn: Anti-Enflamatuar Sabah Altın İksiri">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                <div>
                    <label class="xp-form-label" for="nut_badge">Rozet / Etiket</label>
                    <input type="text" id="nut_badge" name="badge" class="xp-form-input" placeholder="Örn: RAFİNE ŞEKERSİZ veya VAGUS DOSTU">
                </div>
                <div>
                    <label class="xp-form-label" for="nut_time">Süre / Kalori / Okuma</label>
                    <input type="text" id="nut_time" name="time_needed" class="xp-form-input" placeholder="Örn: 8 dk • 220 kcal veya 6 dk okuma">
                </div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="nut_subtitle">Kısa Açıklama / Alt Başlık</label>
                <input type="text" id="nut_subtitle" name="subtitle" class="xp-form-input" placeholder="Örn: Günlük metabolik iksir ve hücresel toparlanma protokolü.">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="nut_ingredients">Malzemeler / Öne Çıkan Maddeler (Virgülle veya satır satır)</label>
                <textarea id="nut_ingredients" name="ingredients" rows="3" class="xp-form-textarea" placeholder="1 bardak badem sütü, 1 tatlı kaşığı chia tohumu, yarım çay kaşığı zerdeçal..."></textarea>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="nut_content">Hazırlanış / Detaylı Rehber Metni *</label>
                <textarea id="nut_content" name="content" rows="4" class="xp-form-textarea" required placeholder="Hazırlanış adımları, kullanım talimatları veya rehberin detaylı içeriği..."></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('nutritionModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    ✓ İçeriği Kaydet &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openNewNutritionModal() {
    document.getElementById('nutritionModalTitle').innerText = 'Yeni Studio İçeriği Ekle (Tarif / Rehber)';
    document.getElementById('nut_id').value = '0';
    document.getElementById('nut_category').value = 'recipe';
    document.getElementById('nut_sort').value = '<?= count($items) + 1 ?>';
    document.getElementById('nut_title').value = '';
    document.getElementById('nut_badge').value = '';
    document.getElementById('nut_time').value = '';
    document.getElementById('nut_subtitle').value = '';
    document.getElementById('nut_ingredients').value = '';
    document.getElementById('nut_content').value = '';
    document.getElementById('nutritionModal').style.display = 'flex';
}

function openEditNutritionModal(item) {
    document.getElementById('nutritionModalTitle').innerText = 'İçeriği Düzenle: ' + item.title;
    document.getElementById('nut_id').value = item.id;
    document.getElementById('nut_category').value = item.category || 'recipe';
    document.getElementById('nut_sort').value = item.sort_order || 1;
    document.getElementById('nut_title').value = item.title || '';
    document.getElementById('nut_badge').value = item.badge || '';
    document.getElementById('nut_time').value = item.time_needed || '';
    document.getElementById('nut_subtitle').value = item.subtitle || '';
    document.getElementById('nut_ingredients').value = item.ingredients || '';
    document.getElementById('nut_content').value = item.content || '';
    document.getElementById('nutritionModal').style.display = 'flex';
}
</script>

<?php require __DIR__ . '/layout_bottom.php'; ?>

