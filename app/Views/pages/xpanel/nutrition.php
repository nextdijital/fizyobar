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
            Studio &amp; Beslenme İçerik Yönetimi
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm); margin: 0;">
            Öğrencilerin Studio ve Movement Space alanında gördüğü rafine şekersiz tarifleri, longevity rehberlerini ve mikro rutinleri yönetin.
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
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Longevity Rehberleri</span>
        <strong style="font-size: 1.6rem; color: #0284c7;"><?= $guidesCount ?> Rehber</strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Mikro Rutinler</span>
        <strong style="font-size: 1.6rem; color: #7c3aed;"><?= $routinesCount ?> Rutin</strong>
    </div>
</div>

<div class="xpanel-card">
    <?php if (empty($items)): ?>
        <p style="color: var(--text-muted); font-size: var(--font-sm); text-align: center; padding: 2.5rem;">
            Henüz içerik eklenmemiş. Yukarıdaki '+ Yeni İçerik Ekle' butonundan ilk tarif veya rehberinizi oluşturabilirsiniz.
        </p>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table class="xpanel-table">
                <thead>
                    <tr>
                        <th>SIRA</th>
                        <th>Kategori</th>
                        <th>İçerik Başlığı &amp; Rozet</th>
                        <th>Süre / Ölçü</th>
                        <th>Malzemeler &amp; Özet</th>
                        <th style="text-align: right;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><strong>#<?= (int)$item['sort_order'] ?></strong></td>
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
<div id="nutritionModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: 8px; max-width: 640px; width: 100%; max-height: 90vh; overflow-y: auto; padding: 2rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
            <h3 id="nutritionModalTitle" style="font-size: 1.15rem; font-weight: 600; color: var(--black); margin: 0;">Studio İçeriği Ekle / Düzenle</h3>
            <button type="button" onclick="document.getElementById('nutritionModal').style.display='none';" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #64748b;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/nutrition/save') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" id="nut_id" name="id" value="0">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label" for="nut_category" style="font-size: 0.8rem; font-weight: 600; color: #334155;">İçerik Kategorisi *</label>
                    <select id="nut_category" name="category" class="form-input" required style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                        <option value="recipe">🍏 Fonksiyonel Tarif</option>
                        <option value="guide">📖 Longevity / Biyomekanik Rehberi</option>
                        <option value="routine">⚡ Ekstra Mikro Rutin (5-10 Dk)</option>
                        <option value="tip">💡 Longevity &amp; Sirkadiyen Kuralı</option>
                    </select>
                </div>
                <div>
                    <label class="form-label" for="nut_sort" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Sıralama Sırası</label>
                    <input type="number" id="nut_sort" name="sort_order" class="form-input" value="1" min="0" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label" for="nut_title" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Başlık *</label>
                <input type="text" id="nut_title" name="title" class="form-input" required placeholder="Örn: Anti-Enflamatuar Sabah Altın İksiri" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="form-label" for="nut_badge" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Rozet / Etiket</label>
                    <input type="text" id="nut_badge" name="badge" class="form-input" placeholder="Örn: RAFİNE ŞEKERSİZ veya VAGUS DOSTU" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label class="form-label" for="nut_time" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Süre / Kalori / Okuma</label>
                    <input type="text" id="nut_time" name="time_needed" class="form-input" placeholder="Örn: 8 dk • 220 kcal veya 6 dk okuma" style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label" for="nut_subtitle" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Kısa Açıklama / Alt Başlık</label>
                <input type="text" id="nut_subtitle" name="subtitle" class="form-input" placeholder="Örn: Günlük metabolik iksir ve hücresel toparlanma protokolü." style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;">
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label" for="nut_ingredients" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Malzemeler / Öne Çıkan Maddeler (Virgülle veya satır satır)</label>
                <textarea id="nut_ingredients" name="ingredients" rows="3" class="form-input" placeholder="1 bardak badem sütü, 1 tatlı kaşığı chia tohumu, yarım çay kaşığı zerdeçal..." style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;"></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" for="nut_content" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Hazırlanış / Detaylı Rehber Metni *</label>
                <textarea id="nut_content" name="content" rows="4" class="form-input" required placeholder="Hazırlanış adımları, kullanım talimatları veya rehberin detaylı içeriği..." style="width: 100%; padding: 0.55rem; border-radius: 6px; border: 1px solid #cbd5e1;"></textarea>
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

