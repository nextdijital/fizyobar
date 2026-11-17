<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';

$points = (int)($loyalty['points'] ?? 100);
$tier = (string)($loyalty['tier'] ?? 'starter');
$streak = (int)($loyalty['streak_days'] ?? 0);
$completedWorkoutCount = count($completedLessons);
$pendingTasksCount = count(array_filter($tasks, fn($t) => in_array($t['status'], ['pending', 'in_progress'], true)));
$completedTasksCount = count(array_filter($tasks, fn($t) => $t['status'] === 'completed'));
$giftCount = count(array_filter($enrollments, fn($e) => (int)($e['is_gift'] ?? 0) === 1));

// Tier renk ve etiketleri
$tierColors = [
    'starter' => ['bg' => '#f1f5f9', 'text' => '#475569', 'border' => '#cbd5e1', 'label' => 'Başlangıç (Starter)'],
    'bronze'  => ['bg' => '#fef3c7', 'text' => '#92400e', 'border' => '#fde68a', 'label' => 'Bronz Üye'],
    'silver'  => ['bg' => '#f8fafc', 'text' => '#334155', 'border' => '#94a3b8', 'label' => 'Gümüş Üye'],
    'gold'    => ['bg' => '#fefce8', 'text' => '#a16207', 'border' => '#fef08a', 'label' => 'Altın Üye (Gold)'],
    'master'  => ['bg' => '#faf5ff', 'text' => '#6b21a8', 'border' => '#d8b4fe', 'label' => 'Master Beden Elçisi']
];
$currentTierInfo = $tierColors[$tier] ?? $tierColors['starter'];

$userStatus = (string)($user['status'] ?? 'active');
$userRole = (string)($user['role'] ?? 'student');
$totalSpentVal = isset($totalSpent) ? (float)$totalSpent : 0.0;
$activePackagesVal = isset($activePackagesCount) ? (int)$activePackagesCount : count($enrollments);
$totalMinutesVal = isset($totalMinutesWatched) ? (int)$totalMinutesWatched : 0;
?>

<!-- =========================================================================
     1. ÜST GEZİNİM & KULLANICI HERO BAŞLIĞI (ORIPIOFIN STYLE)
     ========================================================================= -->
<div style="margin-bottom: 1.5rem;">
    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; margin-bottom: 0.85rem;">
        <a href="<?= url('/xpanel/users') ?>" style="display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.84rem; font-weight: 700; color: var(--xp-text-muted); text-decoration: none; padding: 0.35rem 0.75rem; background: #ffffff; border: 1px solid var(--xp-border); border-radius: var(--xp-radius-pill); transition: all 0.2s ease;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Tüm Öğrenci &amp; Kullanıcı Listesi
        </a>
        <div style="font-size: 0.8rem; color: var(--xp-text-muted);">
            Kayıt: <strong><?= date('d.m.Y H:i', strtotime($user['created_at'])) ?></strong> &bull; Son Güncelleme: <strong><?= date('d.m.Y H:i', strtotime($user['updated_at'] ?? $user['created_at'])) ?></strong>
        </div>
    </div>

    <!-- Hero Kullanıcı Kartı -->
    <div class="xp-oripio-card-white" style="padding: 1.5rem 1.75rem; border-radius: var(--xp-radius-lg); box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.25rem;">
            <div style="display: flex; align-items: center; gap: 1.25rem;">
                <div class="xp-avatar-circle" style="width: 58px; height: 58px; font-size: 1.5rem; background: linear-gradient(135deg, #0b0c10, #22c55e); color: #fff; box-shadow: 0 6px 14px rgba(0,0,0,0.12);">
                    <?= mb_substr($user['full_name'], 0, 1) ?>
                </div>
                <div>
                    <div style="display: flex; align-items: center; gap: 0.65rem; flex-wrap: wrap;">
                        <h1 style="font-size: 1.45rem; font-weight: 800; color: #0b0c10; margin: 0; letter-spacing: -0.02em;">
                            <?= e($user['full_name']) ?>
                        </h1>
                        
                        <?php if ($userStatus === 'active'): ?>
                            <span class="xp-status-dot-pill xp-status-dot-pill-green">● Aktif Hesap</span>
                        <?php elseif ($userStatus === 'suspended'): ?>
                            <span class="xp-status-dot-pill xp-status-dot-pill-amber">● Askıya Alındı</span>
                        <?php else: ?>
                            <span class="xp-status-dot-pill xp-status-dot-pill-red">● Pasif Hesap</span>
                        <?php endif; ?>

                        <span style="background: <?= $currentTierInfo['bg'] ?>; color: <?= $currentTierInfo['text'] ?>; border: 1px solid <?= $currentTierInfo['border'] ?>; padding: 3px 10px; border-radius: var(--xp-radius-pill); font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">
                            ★ <?= $currentTierInfo['label'] ?>
                        </span>

                        <?php if ($userRole === 'admin'): ?>
                            <span style="background: #0b0c10; color: #fff; padding: 3px 9px; border-radius: var(--xp-radius-pill); font-size: 0.7rem; font-weight: 800; letter-spacing: 0.04em;">YÖNETİCİ</span>
                        <?php else: ?>
                            <span style="background: #f1f5f9; color: #475569; padding: 3px 9px; border-radius: var(--xp-radius-pill); font-size: 0.7rem; font-weight: 700;">ÖĞRENCİ</span>
                        <?php endif; ?>
                    </div>

                    <div style="font-size: 0.86rem; color: #64748b; margin-top: 0.45rem; display: flex; gap: 1.25rem; flex-wrap: wrap; align-items: center;">
                        <span style="display: inline-flex; align-items: center; gap: 0.3rem;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <?= e($user['email']) ?>
                        </span>
                        <?php if (!empty($user['phone'])): ?>
                            <span style="display: inline-flex; align-items: center; gap: 0.3rem;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <?= e($user['phone']) ?>
                            </span>
                        <?php endif; ?>
                        <span style="display: inline-flex; align-items: center; gap: 0.3rem;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            Kayıt: <?= date('d.m.Y', strtotime($user['created_at'])) ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Aksiyon Butonları -->
            <div style="display: flex; gap: 0.6rem; flex-wrap: wrap;">
                <button type="button" onclick="document.getElementById('grantGiftModal').style.display='flex';" class="xp-btn-pill-primary" style="background: #be185d; border-color: #be185d;">
                    🎁 Hediye Paket Tanımla &rarr;
                </button>
                <button type="button" onclick="document.getElementById('assignTaskModal').style.display='flex';" class="xp-btn-pill-primary">
                    + Yeni Görev Ata &rarr;
                </button>
                <button type="button" onclick="document.getElementById('adjustLoyaltyModal').style.display='flex';" class="xp-btn-pill-outline">
                    ★ Puan Ekle / Düşür
                </button>
                <button type="button" onclick="switchUserTab('tab-profile')" class="xp-btn-pill-outline">
                    ✏️ Kayıt Bilgilerini Düzenle
                </button>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     2. ORIPIOFIN 4 İSTATİSTİK SAYAÇ KARTI
     ========================================================================= -->
<div class="xp-oripio-grid" style="margin-bottom: 1.75rem;">
    <!-- 1. Koyu Yeşil Hero Kart: Toplam Ödeme -->
    <div class="xp-oripio-card-dark">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap">₺</div>
                <div>
                    <div class="xp-oripio-label">Toplam Yatırım &amp; Harcama</div>
                    <div class="xp-oripio-sublabel">Onaylanan tüm siparişler</div>
                </div>
            </div>
            <div class="xp-oripio-dots">•••</div>
        </div>
        <div class="xp-oripio-body">
            <div class="xp-oripio-metric">₺<?= number_format($totalSpentVal, 2, ',', '.') ?></div>
            <div class="xp-oripio-badge xp-oripio-badge-green">✓ %100 Onaylı</div>
        </div>
        <div class="xp-oripio-footer-link" onclick="switchUserTab('tab-packages')">
            <span><?= count($enrollments) ?> Toplam Paket Geçmişi</span>
            <span class="xp-oripio-arrow">&rarr;</span>
        </div>
    </div>

    <!-- 2. Beyaz Kart: Tanımlı ve Aktif Paketler -->
    <div class="xp-oripio-card-white">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #fdf2f8; color: #be185d;">🎁</div>
                <div>
                    <div class="xp-oripio-label">Aktif &amp; Tanımlı Paketler</div>
                    <div class="xp-oripio-sublabel">Açık eğitim erişimleri</div>
                </div>
            </div>
            <div class="xp-oripio-dots">•••</div>
        </div>
        <div class="xp-oripio-body">
            <div class="xp-oripio-metric" style="color: #be185d;"><?= $activePackagesVal ?> Paket</div>
            <div class="xp-oripio-badge" style="background: #fdf2f8; color: #be185d;"><?= $giftCount ?> Hediye Dahil</div>
        </div>
        <div class="xp-oripio-footer-link" onclick="switchUserTab('tab-packages')">
            <span>Paket Geçmişini İncele</span>
            <span class="xp-oripio-arrow">&rarr;</span>
        </div>
    </div>

    <!-- 3. Beyaz Kart: Tamamlanan Eğitim & Seanslar -->
    <div class="xp-oripio-card-white">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #eff6ff; color: #2563eb;">🎬</div>
                <div>
                    <div class="xp-oripio-label">Tamamlanan Seanslar</div>
                    <div class="xp-oripio-sublabel">İzlenen video antrenmanlar</div>
                </div>
            </div>
            <div class="xp-oripio-dots">•••</div>
        </div>
        <div class="xp-oripio-body">
            <div class="xp-oripio-metric" style="color: #2563eb;"><?= $completedWorkoutCount ?> Seans</div>
            <div class="xp-oripio-badge xp-oripio-badge-blue"><?= $totalMinutesVal ?> Dk Toplam</div>
        </div>
        <div class="xp-oripio-footer-link" onclick="switchUserTab('tab-workouts')">
            <span>Antrenman Kayıtlarını Gör</span>
            <span class="xp-oripio-arrow">&rarr;</span>
        </div>
    </div>

    <!-- 4. Beyaz Kart: Sadakat Puanı & Gamification -->
    <div class="xp-oripio-card-white">
        <div class="xp-oripio-card-top">
            <div class="xp-oripio-card-top-left">
                <div class="xp-oripio-icon-wrap" style="background: #fefce8; color: #ca8a04;">★</div>
                <div>
                    <div class="xp-oripio-label">Sadakat &amp; Disiplin</div>
                    <div class="xp-oripio-sublabel"><?= strtoupper($tier) ?> Kademe</div>
                </div>
            </div>
            <div class="xp-oripio-dots">•••</div>
        </div>
        <div class="xp-oripio-body">
            <div class="xp-oripio-metric" style="color: #b45309;"><?= $points ?> Puan</div>
            <div class="xp-oripio-badge xp-oripio-badge-amber"><?= $streak ?> Gün Streak</div>
        </div>
        <div class="xp-oripio-footer-link" onclick="switchUserTab('tab-notes')">
            <span>Rozetler &amp; Notlar</span>
            <span class="xp-oripio-arrow">&rarr;</span>
        </div>
    </div>
</div>

<!-- =========================================================================
     3. SEKMELİ KULLANICI YÖNETİM ALANI (TABS)
     ========================================================================= -->
<div class="xp-tabs-bar" id="userTabsBar">
    <button type="button" class="xp-tab-btn active" onclick="switchUserTab('tab-profile')" id="btn-tab-profile">
        <span>📌</span> Kayıt &amp; Profil Bilgileri
    </button>
    <button type="button" class="xp-tab-btn" onclick="switchUserTab('tab-packages')" id="btn-tab-packages">
        <span>🎁</span> Önceki &amp; Aktif Paketler (<?= count($enrollments) ?>)
    </button>
    <button type="button" class="xp-tab-btn" onclick="switchUserTab('tab-workouts')" id="btn-tab-workouts">
        <span>🎬</span> Eğitim &amp; Seans Geçmişi (<?= $completedWorkoutCount ?>)
    </button>
    <button type="button" class="xp-tab-btn" onclick="switchUserTab('tab-tasks')" id="btn-tab-tasks">
        <span>📋</span> Görevler &amp; Rutinler (<?= count($tasks) ?>)
    </button>
    <button type="button" class="xp-tab-btn" onclick="switchUserTab('tab-notes')" id="btn-tab-notes">
        <span>📝</span> Notlar, Sadakat &amp; İşlem Günlüğü
    </button>
</div>

<!-- =========================================================================
     SEKME 1: KAYIT İŞLEMLERİ & DETAYLI KULLANICI BİLGİLERİ DÜZENLEME ALANI
     ========================================================================= -->
<div id="tab-profile" class="xp-user-tab-pane" style="display: block;">
    <div style="display: grid; grid-template-columns: 1.1fr 1.4fr; gap: 1.5rem; align-items: start;">
        
        <!-- Sol: Detaylı Bilgiler Kartı -->
        <div class="xp-table-card" style="padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid var(--xp-border); margin-bottom: 1.25rem;">
                <div>
                    <h3 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                        📋 Kayıt Kimlik &amp; Durum Kartı
                    </h3>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Sistemde kayıtlı orijinal öğrenci kimlik ve erişim bilgileri.</span>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1.1rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px dashed var(--xp-border);">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">Ad Soyad:</span>
                    <strong style="font-size: 0.92rem; color: #0b0c10;"><?= e($user['full_name']) ?></strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px dashed var(--xp-border);">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">E-Posta Adresi:</span>
                    <strong style="font-size: 0.92rem; color: #0b0c10;"><?= e($user['email']) ?></strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px dashed var(--xp-border);">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">Telefon Numarası:</span>
                    <strong style="font-size: 0.92rem; color: #0b0c10;"><?= !empty($user['phone']) ? e($user['phone']) : '<span style="color:#94a3b8; font-weight:normal;">Belirtilmemiş</span>' ?></strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px dashed var(--xp-border);">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">Sistem Rolü:</span>
                    <div>
                        <?php if ($userRole === 'admin'): ?>
                            <span style="background: #0b0c10; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 700;">YÖNETİCİ</span>
                        <?php else: ?>
                            <span style="background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 4px; font-size: 0.72rem; font-weight: 700;">ÖĞRENCİ</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px dashed var(--xp-border);">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">Hesap Durumu:</span>
                    <div>
                        <?php if ($userStatus === 'active'): ?>
                            <span class="xp-status-dot-pill xp-status-dot-pill-green">● Aktif</span>
                        <?php elseif ($userStatus === 'suspended'): ?>
                            <span class="xp-status-dot-pill xp-status-dot-pill-amber">● Askıda</span>
                        <?php else: ?>
                            <span class="xp-status-dot-pill xp-status-dot-pill-red">● Pasif</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px dashed var(--xp-border);">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">Kayıt Tarihi:</span>
                    <strong style="font-size: 0.86rem; color: #0b0c10;"><?= date('d.m.Y H:i', strtotime($user['created_at'])) ?></strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px dashed var(--xp-border);">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">Son Güncelleme:</span>
                    <strong style="font-size: 0.86rem; color: #0b0c10;"><?= date('d.m.Y H:i', strtotime($user['updated_at'] ?? $user['created_at'])) ?></strong>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.84rem; font-weight: 600; color: var(--xp-text-muted);">Sadakat Kademesi:</span>
                    <span style="background: <?= $currentTierInfo['bg'] ?>; color: <?= $currentTierInfo['text'] ?>; border: 1px solid <?= $currentTierInfo['border'] ?>; padding: 2px 8px; border-radius: var(--xp-radius-pill); font-size: 0.72rem; font-weight: 800;">
                        ★ <?= $currentTierInfo['label'] ?> (<?= $points ?> Puan)
                    </span>
                </div>
            </div>

            <!-- Hızlı Durum Butonları -->
            <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid var(--xp-border); display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <?php if ($userStatus !== 'active'): ?>
                    <form action="<?= url('/xpanel/users/status') ?>" method="POST" style="margin: 0; flex: 1;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="status" value="active">
                        <input type="hidden" name="redirect_to" value="<?= url('/xpanel/users/' . $user['id']) ?>">
                        <button type="submit" class="xp-btn-action-pill xp-btn-action-approve" style="width: 100%; text-align: center; padding: 0.5rem;">
                            ✓ Hesabı Aktif Yap
                        </button>
                    </form>
                <?php endif; ?>

                <?php if ($userStatus !== 'suspended'): ?>
                    <form action="<?= url('/xpanel/users/status') ?>" method="POST" style="margin: 0; flex: 1;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="status" value="suspended">
                        <input type="hidden" name="redirect_to" value="<?= url('/xpanel/users/' . $user['id']) ?>">
                        <button type="submit" class="xp-btn-action-pill xp-btn-action-pending" style="width: 100%; text-align: center; padding: 0.5rem;">
                            ⏸ Hesabı Askıya Al
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sağ: Kullanıcı Kayıt Bilgilerini Düzenleme & Şifre Güncelleme Formu -->
        <div class="xp-table-card" style="padding: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid var(--xp-border); margin-bottom: 1.25rem;">
                <div>
                    <h3 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                        ✏️ Kullanıcı Bilgilerini Düzenle &amp; Güncelle
                    </h3>
                    <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Öğrencinin profilini, iletişim bilgilerini, yetkisini ve şifresini güncelleyin.</span>
                </div>
            </div>

            <form action="<?= url('/xpanel/users/update') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                <input type="hidden" name="redirect_to" value="<?= url('/xpanel/users/' . $user['id']) ?>">

                <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="xp-form-group">
                        <label class="xp-form-label" for="edit_full_name">Ad Soyad *</label>
                        <input type="text" id="edit_full_name" name="full_name" class="xp-form-input" required value="<?= e($user['full_name']) ?>" placeholder="Örn: Ayşe Yılmaz">
                    </div>

                    <div class="xp-form-group">
                        <label class="xp-form-label" for="edit_email">E-Posta Adresi *</label>
                        <input type="email" id="edit_email" name="email" class="xp-form-input" required value="<?= e($user['email']) ?>" placeholder="ornek@fizyobar.com">
                    </div>
                </div>

                <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="xp-form-group">
                        <label class="xp-form-label" for="edit_phone">Telefon Numarası</label>
                        <input type="text" id="edit_phone" name="phone" class="xp-form-input" value="<?= e($user['phone'] ?? '') ?>" placeholder="0532 000 00 00">
                    </div>

                    <div class="xp-form-group">
                        <label class="xp-form-label" for="edit_role">Sistem Yetkisi (Rol)</label>
                        <select id="edit_role" name="role" class="xp-form-select">
                            <option value="student" <?= $userRole === 'student' ? 'selected' : '' ?>>Öğrenci (Standart Portal Erişimi)</option>
                            <option value="admin" <?= $userRole === 'admin' ? 'selected' : '' ?>>Yönetici (Yönetim Paneli Erişimi)</option>
                        </select>
                    </div>
                </div>

                <div class="xp-form-grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                    <div class="xp-form-group">
                        <label class="xp-form-label" for="edit_status">Hesap Durumu</label>
                        <select id="edit_status" name="status" class="xp-form-select">
                            <option value="active" <?= $userStatus === 'active' ? 'selected' : '' ?>>● Aktif (Giriş Yapabilir)</option>
                            <option value="suspended" <?= $userStatus === 'suspended' ? 'selected' : '' ?>>● Askıda (Giriş Kısıtlı)</option>
                            <option value="inactive" <?= $userStatus === 'inactive' ? 'selected' : '' ?>>● Pasif (Devre Dışı)</option>
                        </select>
                    </div>

                    <div class="xp-form-group">
                        <label class="xp-form-label" for="edit_new_password">Yeni Şifre Belirle <span style="font-weight: normal; color: var(--xp-text-muted);">(Opsiyonel)</span></label>
                        <input type="password" id="edit_new_password" name="new_password" class="xp-form-input" placeholder="Değiştirmek istemiyorsanız boş bırakın" minlength="6">
                    </div>
                </div>

                <div style="background: #f8fafc; border: 1px solid var(--xp-border); border-radius: var(--xp-radius-sm); padding: 0.85rem 1rem; font-size: 0.8rem; color: var(--xp-text-muted); margin-bottom: 1.25rem;">
                    ℹ Yapılan tüm kimlik ve şifre güncellemeleri otomatik olarak kullanıcının kronolojik <strong>İşlem Günlüğü (Audit Log)</strong> dökümüne işlenir.
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="submit" class="xp-btn-pill-primary" style="padding: 0.65rem 1.6rem; font-size: 0.88rem;">
                        ✓ Değişiklikleri Kaydet &amp; Güncelle
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- =========================================================================
     SEKME 2: ÖNCEKİ GEÇMİŞ PAKETLER, ABONELİKLER & SİPARİŞLER
     ========================================================================= -->
<div id="tab-packages" class="xp-user-tab-pane" style="display: none;">
    <div class="xp-table-card">
        <div class="xp-table-header-bar">
            <div>
                <h2 style="font-size: 1.15rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.25rem 0;">
                    🎁 Önceki &amp; Aktif Paketler, Abonelikler ve Siparişler (<?= count($enrollments) ?>)
                </h2>
                <span style="font-size: 0.8rem; color: #64748b;">Kullanıcının satın aldığı veya hediye edilen tüm programların tam geçmişi.</span>
            </div>
            
            <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                <div class="xp-table-search-box">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="packageFilterInput" placeholder="Paket veya ref kodu ara..." onkeyup="filterUserPackages()">
                </div>
                <button type="button" onclick="document.getElementById('grantGiftModal').style.display='flex';" class="xp-btn-pill-primary" style="background: #be185d; border-color: #be185d; padding: 0.5rem 1.15rem; font-size: 0.82rem;">
                    + Hediye Paket Tanımla
                </button>
            </div>
        </div>

        <?php if (empty($enrollments)): ?>
            <div style="text-align: center; padding: 3rem 1.5rem; color: var(--xp-text-muted);">
                <div style="font-size: 2.2rem; margin-bottom: 0.5rem;">📦</div>
                <strong style="font-size: 1rem; color: #0b0c10; display: block; margin-bottom: 0.35rem;">Kullanıcıya Tanımlı Paket Bulunmuyor</strong>
                <p style="font-size: 0.84rem; margin: 0 0 1.25rem 0;">Bu kullanıcı henüz bir program satın almamış veya hediye paket tanımlanmamış.</p>
                <button type="button" onclick="document.getElementById('grantGiftModal').style.display='flex';" class="xp-btn-pill-primary" style="background: #be185d; border-color: #be185d;">
                    🎁 Şimdi İlk Hediye Paketi Tanımla &rarr;
                </button>
            </div>
        <?php else: ?>
            <div class="xpanel-table-wrap" style="overflow-x: auto;">
                <table class="xpanel-table" id="userPackagesTable">
                    <thead>
                        <tr>
                            <th>Program Adı &amp; Süre</th>
                            <th>Paket Türü</th>
                            <th>Ödeme &amp; Ref Kodu</th>
                            <th>Tutar</th>
                            <th>Kayıt / Satın Alma</th>
                            <th>Erişim Geçerliliği</th>
                            <th>Durum</th>
                            <th>Eğitim İlerlemesi</th>
                            <th>Not / Mesaj</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($enrollments as $enr): ?>
                            <?php
                                $isGift = ((int)($enr['is_gift'] ?? 0) === 1);
                                $isApproved = ($enr['payment_status'] === 'approved');
                                $isPending = ($enr['payment_status'] === 'pending');
                                $isExpired = !empty($enr['is_expired']);
                                $progressPct = (int)($enr['progress_pct'] ?? 0);
                            ?>
                            <tr>
                                <td>
                                    <strong style="color: #0b0c10; font-size: 0.92rem; display: block;"><?= e($enr['course_title']) ?></strong>
                                    <span style="font-size: 0.74rem; color: var(--xp-text-muted);">
                                        <?= (int)$enr['duration_weeks'] ?> Haftalık Program &bull; <?= (int)($enr['total_lessons'] ?? 0) ?> Seans
                                    </span>
                                </td>

                                <td>
                                    <?php if ($isGift): ?>
                                        <span style="background: #fdf2f8; color: #be185d; border: 1px solid #fbcfe8; padding: 3px 9px; border-radius: var(--xp-radius-pill); font-size: 0.72rem; font-weight: 800; display: inline-flex; align-items: center; gap: 0.25rem;">
                                            🎁 HEDİYE
                                        </span>
                                    <?php else: ?>
                                        <span style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 3px 9px; border-radius: var(--xp-radius-pill); font-size: 0.72rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.25rem;">
                                            💳 SİPARİŞ
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <strong style="font-size: 0.84rem; color: #0b0c10; text-transform: uppercase;">
                                        <?= e($enr['payment_method'] ?? 'iban') ?>
                                    </strong>
                                    <?php if (!empty($enr['receipt_ref'])): ?>
                                        <div style="font-size: 0.72rem; color: var(--xp-text-muted); font-family: monospace;">
                                            Ref: <?= e($enr['receipt_ref']) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ((float)$enr['amount'] == 0): ?>
                                        <strong style="color: #16a34a; font-size: 0.88rem;">Ücretsiz</strong>
                                    <?php else: ?>
                                        <strong style="color: #0b0c10; font-size: 0.92rem;">₺<?= number_format((float)$enr['amount'], 2, ',', '.') ?></strong>
                                    <?php endif; ?>
                                </td>

                                <td style="font-size: 0.82rem; color: var(--xp-text-muted);">
                                    <?= date('d.m.Y', strtotime($enr['created_at'])) ?>
                                    <div style="font-size: 0.72rem; color: #94a3b8;"><?= date('H:i', strtotime($enr['created_at'])) ?></div>
                                </td>

                                <td style="font-size: 0.82rem;">
                                    <?php if (!empty($enr['expires_at'])): ?>
                                        <div style="color: #0b0c10; font-weight: 600;">
                                            <?= date('d.m.Y', strtotime($enr['expires_at'])) ?>
                                        </div>
                                        <?php if ($isExpired): ?>
                                            <span style="color: #ef4444; font-size: 0.72rem; font-weight: 700;">(Süresi Doldu)</span>
                                        <?php else: ?>
                                            <span style="color: #16a34a; font-size: 0.72rem; font-weight: 700;">(<?= (int)$enr['days_left'] ?> gün kaldı)</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span style="color: #16a34a; font-weight: 600;">Süresiz Erişim</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($isApproved): ?>
                                        <?php if ($isExpired): ?>
                                            <span class="xp-status-dot-pill xp-status-dot-pill-red">● Süresi Doldu</span>
                                        <?php else: ?>
                                            <span class="xp-status-dot-pill xp-status-dot-pill-green">● Onaylandı (Aktif)</span>
                                        <?php endif; ?>
                                    <?php elseif ($isPending): ?>
                                        <span class="xp-status-dot-pill xp-status-dot-pill-amber">⏳ Onay Bekliyor</span>
                                    <?php else: ?>
                                        <span class="xp-status-dot-pill xp-status-dot-pill-red">✕ Reddedildi</span>
                                    <?php endif; ?>
                                </td>

                                <td style="min-width: 140px;">
                                    <div style="display: flex; justify-content: space-between; font-size: 0.72rem; font-weight: 700; color: var(--xp-text-muted); margin-bottom: 0.25rem;">
                                        <span><?= (int)($enr['completed_lessons'] ?? 0) ?> / <?= (int)($enr['total_lessons'] ?? 0) ?></span>
                                        <span>%<?= $progressPct ?></span>
                                    </div>
                                    <div style="background: #e2e8f0; border-radius: var(--xp-radius-pill); height: 6px; width: 100%; overflow: hidden;">
                                        <div style="background: linear-gradient(90deg, #10b981, #059669); height: 100%; width: <?= $progressPct ?>%;"></div>
                                    </div>
                                </td>

                                <td style="font-size: 0.78rem; color: var(--xp-text-muted); max-width: 200px; white-space: normal;">
                                    <?= e($enr['gift_message'] ?? $enr['admin_notes'] ?? '-') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- =========================================================================
     SEKME 3: EĞİTİM & SEANS GEÇMİŞİ (ANTRENMAN VE VİDEO DERSLER)
     ========================================================================= -->
<div id="tab-workouts" class="xp-user-tab-pane" style="display: none;">
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        
        <!-- Bölüm 1: Program Bazlı İlerleme Özeti Kartları -->
        <div class="xp-table-card" style="padding: 1.5rem;">
            <div style="margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--xp-border);">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                    🎯 Kayıtlı Program İlerleme Oranları
                </h3>
                <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Öğrencinin her eğitim programında tamamladığı video seans oranı ve güncel durumu.</span>
            </div>

            <?php if (empty($enrollments)): ?>
                <p style="font-size: 0.84rem; color: var(--xp-text-muted); margin: 0;">Henüz kayıtlı bir program bulunmuyor.</p>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
                    <?php foreach ($enrollments as $enr): ?>
                        <?php 
                            $pct = (int)($enr['progress_pct'] ?? 0);
                            $done = (int)($enr['completed_lessons'] ?? 0);
                            $tot = (int)($enr['total_lessons'] ?? 0);
                        ?>
                        <div style="background: #ffffff; border: 1px solid var(--xp-border); border-radius: var(--xp-radius-md); padding: 1.15rem; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.65rem;">
                                <div>
                                    <strong style="font-size: 0.95rem; color: #0b0c10; display: block;"><?= e($enr['course_title']) ?></strong>
                                    <span style="font-size: 0.74rem; color: var(--xp-text-muted);"><?= (int)$enr['duration_weeks'] ?> Haftalık Metod</span>
                                </div>
                                <span style="background: <?= $pct === 100 ? '#ecfdf5' : '#eff6ff' ?>; color: <?= $pct === 100 ? '#059669' : '#2563eb' ?>; font-size: 0.76rem; font-weight: 800; padding: 2px 8px; border-radius: var(--xp-radius-pill);">
                                    %<?= $pct ?> Tamamlandı
                                </span>
                            </div>

                            <div style="background: #f1f5f9; border-radius: var(--xp-radius-pill); height: 8px; width: 100%; overflow: hidden; margin-bottom: 0.6rem;">
                                <div style="background: linear-gradient(90deg, #10b981, #059669); height: 100%; width: <?= $pct ?>%;"></div>
                            </div>

                            <div style="display: flex; justify-content: space-between; font-size: 0.76rem; color: var(--xp-text-muted);">
                                <span>Tamamlanan: <strong><?= $done ?> / <?= $tot ?> Seans</strong></span>
                                <span>Kalan: <strong><?= max(0, $tot - $done) ?> Seans</strong></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bölüm 2: Tamamlanan Video Seanslar Kronolojik Tablosu -->
        <div class="xp-table-card">
            <div class="xp-table-header-bar">
                <div>
                    <h2 style="font-size: 1.15rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.25rem 0;">
                        🎬 Tamamlanan Video Seanslar &amp; Antrenman Kayıtları (<?= count($completedLessons) ?>)
                    </h2>
                    <span style="font-size: 0.8rem; color: #64748b;">Öğrencinin Movement Space üzerinden izleyip bitirdiği derslerin tam kronolojik listesi.</span>
                </div>

                <div class="xp-table-search-box">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="lessonFilterInput" placeholder="Seans veya program ara..." onkeyup="filterUserLessons()">
                </div>
            </div>

            <?php if (empty($completedLessons)): ?>
                <div style="text-align: center; padding: 3rem 1.5rem; color: var(--xp-text-muted);">
                    <div style="font-size: 2.2rem; margin-bottom: 0.5rem;">🧘</div>
                    <strong style="font-size: 1rem; color: #0b0c10; display: block; margin-bottom: 0.35rem;">Henüz Tamamlanan Video Seans Yok</strong>
                    <p style="font-size: 0.84rem; margin: 0;">Öğrenci eğitim videolarını izleyip seansı bitirdikçe burada tarih ve saat bazlı kayıtları listelenecektir.</p>
                </div>
            <?php else: ?>
                <div class="xpanel-table-wrap" style="overflow-x: auto;">
                    <table class="xpanel-table" id="userLessonsTable">
                        <thead>
                            <tr>
                                <th>GÜN</th>
                                <th>Seans &amp; Ders Adı</th>
                                <th>Ait Olduğu Eğitim Programı</th>
                                <th>Süre</th>
                                <th>Tamamlanma Tarihi &amp; Saati</th>
                                <th>Durum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($completedLessons as $cl): ?>
                                <tr>
                                    <td>
                                        <span style="background: #0b0c10; color: #fff; padding: 3px 9px; border-radius: 4px; font-weight: 800; font-size: 0.72rem; letter-spacing: 0.04em;">
                                            GÜN <?= (int)$cl['day_number'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <strong style="color: #0b0c10; font-size: 0.92rem;"><?= e($cl['lesson_title']) ?></strong>
                                    </td>
                                    <td>
                                        <span style="font-size: 0.82rem; color: var(--xp-text-muted); font-weight: 600;">
                                            <?= e($cl['course_title'] ?? 'Eğitim Programı') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <strong style="color: #0b0c10; font-size: 0.88rem;"><?= (int)$cl['duration_minutes'] ?></strong> Dk
                                    </td>
                                    <td style="font-size: 0.82rem; color: var(--xp-text-muted);">
                                        <strong><?= date('d.m.Y', strtotime($cl['completed_at'])) ?></strong>
                                        <span style="color: #94a3b8; font-size: 0.74rem;">(<?= date('H:i', strtotime($cl['completed_at'])) ?>)</span>
                                    </td>
                                    <td>
                                        <span class="xp-status-dot-pill xp-status-dot-pill-green">✓ Tamamlandı</span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- =========================================================================
     SEKME 4: KİŞİYE ÖZEL GÖREVLER & KLİNİK RUTİNLER
     ========================================================================= -->
<div id="tab-tasks" class="xp-user-tab-pane" style="display: none;">
    <div class="xp-table-card">
        <div class="xp-table-header-bar">
            <div>
                <h2 style="font-size: 1.15rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.25rem 0;">
                    📋 Atanan Özel Klinik Görevler &amp; Rutinler (<?= count($tasks) ?>)
                </h2>
                <span style="font-size: 0.8rem; color: #64748b;">Öğrenciye tanımlanan fasya, mobilite, beslenme veya longevity ödevleri.</span>
            </div>

            <button type="button" onclick="document.getElementById('assignTaskModal').style.display='flex';" class="xp-btn-pill-primary">
                + Yeni Görev Ata &rarr;
            </button>
        </div>

        <div style="padding: 1.25rem 1.5rem;">
            <?php if (empty($tasks)): ?>
                <div style="text-align: center; padding: 2.5rem 1rem; color: var(--xp-text-muted);">
                    <div style="font-size: 2.2rem; margin-bottom: 0.5rem;">📋</div>
                    <strong style="font-size: 1rem; color: #0b0c10; display: block; margin-bottom: 0.35rem;">Henüz Atanmış Özel Bir Görev Yok</strong>
                    <p style="font-size: 0.84rem; margin: 0 0 1.25rem 0;">Öğrencinin klinik gelişimini desteklemek için egzersiz veya beslenme hedefi atayabilirsiniz.</p>
                    <button type="button" onclick="document.getElementById('assignTaskModal').style.display='flex';" class="xp-btn-pill-primary">
                        + İlk Görevi Ata &rarr;
                    </button>
                </div>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                    <?php foreach ($tasks as $t): ?>
                        <?php
                            $isDone = ($t['status'] === 'completed');
                            $catIcons = [
                                'exercise' => '🧘 Egzersiz & Mobilite',
                                'nutrition' => '🥗 Beslenme & Hidrasyon',
                                'longevity' => '⚡ Sağlıklı Yaşam (Longevity) Protokolü',
                                'habit' => '🎯 Günlük Alışkanlık & Disiplin'
                            ];
                        ?>
                        <div style="background: <?= $isDone ? '#f8fafc' : '#ffffff' ?>; border: 1px solid <?= $isDone ? '#e2e8f0' : '#cbd5e1' ?>; border-radius: var(--xp-radius-md); padding: 1.15rem 1.25rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 260px;">
                                <div style="display: flex; align-items: center; gap: 0.55rem; margin-bottom: 0.4rem; flex-wrap: wrap;">
                                    <span style="font-size: 0.72rem; font-weight: 700; background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: var(--xp-radius-pill);">
                                        <?= $catIcons[$t['category']] ?? 'Görev' ?>
                                    </span>
                                    <span style="font-size: 0.74rem; font-weight: 800; color: #b45309; background: #fefce8; border: 1px solid #fef08a; padding: 2px 8px; border-radius: var(--xp-radius-pill);">
                                        +<?= (int)$t['points'] ?> Sadakat Puanı
                                    </span>
                                    <?php if (!empty($t['due_date'])): ?>
                                        <span style="font-size: 0.74rem; color: var(--xp-text-muted);">
                                            Bitiş Tarihi: <strong><?= date('d.m.Y', strtotime($t['due_date'])) ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <h3 style="font-size: 0.98rem; font-weight: 700; color: <?= $isDone ? '#64748b' : '#0b0c10' ?>; margin: 0 0 0.3rem 0; <?= $isDone ? 'text-decoration: line-through;' : '' ?>">
                                    <?= e($t['title']) ?>
                                </h3>
                                <?php if (!empty($t['description'])): ?>
                                    <p style="font-size: 0.82rem; color: var(--xp-text-muted); margin: 0; line-height: 1.45;">
                                        <?= e($t['description']) ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <?php if ($isDone): ?>
                                    <span class="xp-status-dot-pill xp-status-dot-pill-green">✓ Tamamlandı</span>
                                <?php else: ?>
                                    <form action="<?= url('/xpanel/users/task/status') ?>" method="POST" style="margin: 0;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="task_id" value="<?= $t['id'] ?>">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="xp-btn-action-pill xp-btn-action-approve" title="Tamamlandı olarak onayla ve puan ver">
                                            ✓ Onayla &amp; Puan Ver
                                        </button>
                                    </form>
                                <?php endif; ?>

                                <form action="<?= url('/xpanel/users/task/delete') ?>" method="POST" onsubmit="return confirm('Bu görevi silmek istediğinize emin misiniz?');" style="margin: 0;">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="task_id" value="<?= $t['id'] ?>">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <button type="submit" class="xp-btn-action-pill xp-btn-action-danger">Sil</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- =========================================================================
     SEKME 5: NOTLAR, SADAKAT VE İŞLEM GÜNLÜĞÜ (AUDIT LOG / TIMELINE)
     ========================================================================= -->
<div id="tab-notes" class="xp-user-tab-pane" style="display: none;">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start;">

        <!-- Sol: Sadakat & Rozetler Kartı -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div class="xp-table-card" style="padding: 1.5rem; border-top: 4px solid var(--xp-gold);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <div>
                        <h3 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                            ★ Sadakat Kademesi &amp; Puanı
                        </h3>
                        <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Öğrencinin motivasyon ve gamification seviyesi.</span>
                    </div>
                    <button type="button" onclick="document.getElementById('adjustLoyaltyModal').style.display='flex';" class="xp-btn-action-pill xp-btn-action-edit">
                        +/- Puan Ekle / Düşür
                    </button>
                </div>

                <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 0.75rem;">
                    <span style="font-size: 0.84rem; font-weight: 700; color: var(--xp-text-muted); text-transform: uppercase;">Mevcut Sadakat</span>
                    <strong style="font-size: 1.85rem; font-weight: 800; color: #b45309;"><?= $points ?> Puan</strong>
                </div>

                <div style="background: #e2e8f0; border-radius: var(--xp-radius-pill); height: 8px; width: 100%; overflow: hidden; margin-bottom: 0.85rem;">
                    <?php 
                        $tierTarget = 1000;
                        $tierPct = min(100, (int)round(($points / $tierTarget) * 100));
                    ?>
                    <div style="background: linear-gradient(90deg, var(--xp-gold), #b45309); height: 100%; width: <?= $tierPct ?>%;"></div>
                </div>

                <div style="display: flex; justify-content: space-between; font-size: 0.74rem; color: var(--xp-text-muted); margin-bottom: 1.25rem;">
                    <span>Başlangıç (0)</span>
                    <span>Bronz (100)</span>
                    <span>Gümüş (250)</span>
                    <span>Altın (500)</span>
                    <span>Usta (1000)</span>
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid var(--xp-border);">
                    <h4 style="font-size: 0.82rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.04em; color: #0b0c10; margin: 0 0 0.75rem 0;">
                        Kazanılan Rozetler (<?= count($badges) ?>)
                    </h4>
                    <?php if (empty($badges)): ?>
                        <p style="font-size: 0.8rem; color: var(--xp-text-muted); margin: 0;">Henüz rozet kazanılmamış.</p>
                    <?php else: ?>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                            <?php foreach ($badges as $b): ?>
                                <span style="background: #ffffff; border: 1px solid var(--xp-border); padding: 5px 10px; border-radius: var(--xp-radius-pill); font-size: 0.78rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.35rem;" title="Kazanılma: <?= date('d.m.Y', strtotime($b['awarded_at'])) ?>">
                                    <span><?= e($b['badge_icon']) ?></span>
                                    <span style="color: #0b0c10;"><?= e($b['badge_name']) ?></span>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Özel Yönetici Notları -->
            <div class="xp-table-card" style="padding: 1.5rem;">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.3rem 0;">
                    📝 Özel Yönetici / Klinik Notları
                </h3>
                <span style="font-size: 0.78rem; color: var(--xp-text-muted); display: block; margin-bottom: 1rem;">Bu öğrenciye özel klinik bulgular veya omurga notları.</span>

                <form action="<?= url('/xpanel/users/note/save') ?>" method="POST" style="margin-bottom: 1.25rem;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <textarea name="note" rows="3" class="xp-form-textarea" required placeholder="Bu öğrenci hakkında omurga durumu, hedefleri veya özel talepleriyle ilgili yönetici notu yazın..." style="margin-bottom: 0.65rem; font-size: 0.84rem;"></textarea>
                    <div style="text-align: right;">
                        <button type="submit" class="xp-btn-pill-primary" style="padding: 0.45rem 1.25rem; font-size: 0.8rem;">
                            + Notu Kaydet
                        </button>
                    </div>
                </form>

                <?php if (empty($notes)): ?>
                    <p style="font-size: 0.82rem; color: var(--xp-text-muted); text-align: center; margin: 0; padding: 1rem 0;">Henüz özel not girilmemiş.</p>
                <?php else: ?>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem; max-height: 280px; overflow-y: auto;">
                        <?php foreach ($notes as $n): ?>
                            <div style="background: #f8fafc; border: 1px solid var(--xp-border); border-radius: var(--xp-radius-sm); padding: 0.85rem 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
                                    <strong style="font-size: 0.76rem; color: #0b0c10;"><?= e($n['admin_name'] ?? 'Yönetici') ?></strong>
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <span style="font-size: 0.7rem; color: var(--xp-text-muted);"><?= date('d.m.Y H:i', strtotime($n['created_at'])) ?></span>
                                        <form action="<?= url('/xpanel/users/note/delete') ?>" method="POST" onsubmit="return confirm('Bu notu silmek istediğinize emin misiniz?');" style="margin: 0;">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="note_id" value="<?= $n['id'] ?>">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <button type="submit" style="background: none; border: none; color: #ef4444; font-size: 0.95rem; cursor: pointer; padding: 0;" title="Notu sil">&times;</button>
                                        </form>
                                    </div>
                                </div>
                                <p style="font-size: 0.84rem; color: #0b0c10; margin: 0; line-height: 1.45; white-space: pre-wrap;"><?= e($n['note']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Sağ: Kullanıcı Kronolojik İşlem Günlüğü (Audit Log / Timeline) -->
        <div class="xp-table-card" style="padding: 1.5rem;">
            <div style="margin-bottom: 1.25rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--xp-border);">
                <h3 style="font-size: 1.05rem; font-weight: 800; color: #0b0c10; margin: 0 0 0.2rem 0;">
                    ⚡ Kullanıcı İşlem Günlüğü &amp; Timeline
                </h3>
                <span style="font-size: 0.78rem; color: var(--xp-text-muted);">Kayıt, paket aktivasyonu, görev ve puan hareketlerinin tam kronolojisi.</span>
            </div>

            <?php if (empty($activities)): ?>
                <div style="text-align: center; padding: 2.5rem 1rem; color: var(--xp-text-muted); font-size: 0.86rem;">
                    Henüz kaydedilmiş bir işlem veya hareket bulunmuyor.
                </div>
            <?php else: ?>
                <div style="position: relative; padding-left: 1.5rem; border-left: 2px solid var(--xp-border); display: flex; flex-direction: column; gap: 1.25rem; max-height: 580px; overflow-y: auto;">
                    <?php foreach ($activities as $act): ?>
                        <div style="position: relative;">
                            <div style="position: absolute; left: -1.88rem; top: 0.2rem; width: 11px; height: 11px; border-radius: 50%; background: #22c55e; border: 2px solid #fff; box-shadow: 0 0 0 2px #22c55e;"></div>
                            <div style="font-size: 0.72rem; color: var(--xp-text-muted); margin-bottom: 0.2rem;">
                                <strong><?= date('d.m.Y H:i', strtotime($act['created_at'])) ?></strong> &bull; <?= e($act['admin_name'] ?? 'Sistem') ?>
                            </div>
                            <div style="font-size: 0.84rem; color: #0b0c10; font-weight: 500; line-height: 1.4;">
                                <?= e($act['description']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- =========================================================================
     MODAL 1: YENİ GÖREV / HEDEF ATAMA MODALI
     ========================================================================= -->
<div id="assignTaskModal" class="xp-modal-backdrop">
    <div class="xp-modal-window">
        <div class="xp-modal-header">
            <h3 class="xp-modal-title">Öğrenciye Özel Görev &amp; Hedef Ata</h3>
            <button type="button" onclick="document.getElementById('assignTaskModal').style.display='none';" class="xp-modal-close-btn">&times;</button>
        </div>

        <form action="<?= url('/xpanel/users/task/create') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

            <div class="xp-form-group">
                <span class="xp-form-label">Öğrenci</span>
                <strong style="font-size: 0.95rem; color: #0b0c10;"><?= e($user['full_name']) ?> (<?= e($user['email']) ?>)</strong>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="task_title">Görev Başlığı *</label>
                <input type="text" id="task_title" name="title" class="xp-form-input" required placeholder="Örn: Bu hafta 3 gün sabah fasya esnemesi seansını tamamla">
            </div>

            <div class="xp-form-grid-2">
                <div class="xp-form-group">
                    <label class="xp-form-label" for="task_category">Kategori</label>
                    <select id="task_category" name="category" class="xp-form-select">
                        <option value="exercise">🧘 Egzersiz &amp; Mobilite Seansı</option>
                        <option value="nutrition">🥗 Beslenme &amp; Hidrasyon Hedefi</option>
                        <option value="longevity">⚡ Longevity / Sirkadiyen Rutini</option>
                        <option value="habit">🎯 Günlük Alışkanlık &amp; Disiplin</option>
                    </select>
                </div>
                <div class="xp-form-group">
                    <label class="xp-form-label" for="task_points">Kazanılacak Sadakat Puanı</label>
                    <input type="number" id="task_points" name="points" class="xp-form-input" value="25" min="5" max="500">
                </div>
            </div>

            <div class="xp-form-grid-2">
                <div class="xp-form-group">
                    <label class="xp-form-label" for="task_due">Hedef Bitiş Tarihi</label>
                    <input type="date" id="task_due" name="due_date" class="xp-form-input" value="<?= date('Y-m-d', strtotime('+7 days')) ?>">
                </div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="task_desc">Klinik Notlar &amp; Görev Talimatı</label>
                <textarea id="task_desc" name="description" rows="3" class="xp-form-textarea" placeholder="Öğrencinin dikkat etmesi gereken nefes ve omurga hizalanma detayları..."></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--xp-border);">
                <button type="button" onclick="document.getElementById('assignTaskModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    ✓ Görevi Ata &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL 2: HEDİYE PAKET TANIMLAMA MODALI
     ========================================================================= -->
<div id="grantGiftModal" class="xp-modal-backdrop">
    <div class="xp-modal-window">
        <div class="xp-modal-header" style="background: linear-gradient(135deg, #be185d, #9d174d); color: #fff;">
            <h3 class="xp-modal-title" style="color: #fff;">🎁 Kullanıcıya Hediye Paket Tanımla</h3>
            <button type="button" onclick="document.getElementById('grantGiftModal').style.display='none';" class="xp-modal-close-btn" style="color: #fff;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/users/gift/grant') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

            <div class="xp-form-group">
                <span class="xp-form-label">Hediye Verilecek Öğrenci</span>
                <strong style="font-size: 0.95rem; color: #0b0c10;"><?= e($user['full_name']) ?> (<?= e($user['email']) ?>)</strong>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="gift_course_id">Hediye Edilecek Eğitim Programı *</label>
                <select id="gift_course_id" name="course_id" class="xp-form-select" required>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= e($c['title']) ?> (Normal Değer: ₺<?= number_format((float)$c['price'], 2) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="gift_message">Kişiye Özel Tebrik / Hediye Mesajı</label>
                <textarea id="gift_message" name="gift_message" rows="3" class="xp-form-textarea" placeholder="Tebrikler! Fizyobar ailesi olarak bu programı motivasyonunuzu desteklemek için size hediye ediyoruz."></textarea>
            </div>

            <div style="background: #fdf2f8; border: 1px solid #fbcfe8; border-radius: var(--xp-radius-sm); padding: 0.85rem; font-size: 0.8rem; color: #9d174d; margin-bottom: 1.25rem;">
                ℹ Hediye paket tanımlandığında ücret <strong>0.00 TL</strong> olarak işlenir, öğrencinin hesabına anında <strong>+100 Bonus Sadakat Puanı</strong> eklenir ve panelinde "Size Özel Hediye" olarak listelenir.
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="button" onclick="document.getElementById('grantGiftModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary" style="background: #be185d; border-color: #be185d;">
                    🎁 Hediyeyi Tanımla &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- =========================================================================
     MODAL 3: SADAKAT PUANI GÜNCELLEME MODALI
     ========================================================================= -->
<div id="adjustLoyaltyModal" class="xp-modal-backdrop">
    <div class="xp-modal-window" style="max-width: 480px;">
        <div class="xp-modal-header">
            <h3 class="xp-modal-title">Sadakat Puanını Güncelle</h3>
            <button type="button" onclick="document.getElementById('adjustLoyaltyModal').style.display='none';" class="xp-modal-close-btn">&times;</button>
        </div>

        <form action="<?= url('/xpanel/users/loyalty/adjust') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

            <div class="xp-form-group">
                <span class="xp-form-label">Mevcut Durum</span>
                <strong style="font-size: 1.1rem; color: #b45309;"><?= $points ?> Puan &bull; <?= strtoupper($tier) ?> Kademe</strong>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="delta_points">Eklenecek / Çıkarılacak Puan Değişimi (+ veya -) *</label>
                <input type="number" id="delta_points" name="delta_points" class="xp-form-input" required value="50" step="5" placeholder="Örn: 50 veya -25">
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="adjust_reason">Gerekçe / Açıklama Notu *</label>
                <input type="text" id="adjust_reason" name="reason" class="xp-form-input" required placeholder="Örn: Hafta sonu kampı katılım ödülü">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('adjustLoyaltyModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    Puanı Güncelle &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function switchUserTab(tabId) {
    document.querySelectorAll('.xp-user-tab-pane').forEach(function(pane) {
        pane.style.display = 'none';
    });
    document.querySelectorAll('.xp-tab-btn').forEach(function(btn) {
        btn.classList.remove('active');
    });

    var targetPane = document.getElementById(tabId);
    if (targetPane) {
        targetPane.style.display = 'block';
    }
    var targetBtn = document.getElementById('btn-' + tabId);
    if (targetBtn) {
        targetBtn.classList.add('active');
    }
    
    // Hash güncelle (sayfa yenilendiğinde sekme korunsun)
    if (history.pushState) {
        history.pushState(null, null, '#' + tabId);
    } else {
        location.hash = '#' + tabId;
    }
}

// URL hash kontrolü ile başlangıç sekmesini açma
window.addEventListener('DOMContentLoaded', function() {
    var hash = window.location.hash ? window.location.hash.substring(1) : '';
    if (hash && document.getElementById(hash)) {
        switchUserTab(hash);
    }
});

function filterUserPackages() {
    var input = document.getElementById('packageFilterInput');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('userPackagesTable');
    if (!table) return;
    var trs = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (var i = 0; i < trs.length; i++) {
        var text = trs[i].textContent || trs[i].innerText;
        trs[i].style.display = text.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
    }
}

function filterUserLessons() {
    var input = document.getElementById('lessonFilterInput');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('userLessonsTable');
    if (!table) return;
    var trs = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (var i = 0; i < trs.length; i++) {
        var text = trs[i].textContent || trs[i].innerText;
        trs[i].style.display = text.toLowerCase().indexOf(filter) > -1 ? '' : 'none';
    }
}
</script>

<?php require __DIR__ . '/layout_bottom.php'; ?>
