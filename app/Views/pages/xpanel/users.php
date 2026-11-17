<?php
declare(strict_types=1);
require __DIR__ . '/layout_top.php';

$totalUsers = count($users);
$totalStudents = count(array_filter($users, fn($u) => $u['role'] === 'student'));
$totalRevenue = array_reduce($users, fn($acc, $u) => $acc + (float)($u['total_spent'] ?? 0), 0);
$totalCompletedWorkouts = array_reduce($users, fn($acc, $u) => $acc + (int)($u['completed_workouts'] ?? 0), 0);
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.45rem; font-weight: 500; color: var(--black); text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.25rem 0;">
            Kullanıcı &amp; Öğrenci Yönetim Merkezi
        </h1>
        <p style="color: var(--text-muted); font-size: var(--font-sm); margin: 0;">
            Kayıt olan tüm kullanıcıların detaylı profil bilgileri, paketleri, alışverişleri ve antrenman ilerleme durumları.
        </p>
    </div>
</div>

<!-- İstatistik Özet Kartları -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Toplam Kayıtlı Kullanıcı</span>
        <strong style="font-size: 1.6rem; color: var(--black);"><?= $totalUsers ?></strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Aktif Öğrenci Sayısı</span>
        <strong style="font-size: 1.6rem; color: #0284c7;"><?= $totalStudents ?></strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Toplam Onaylı Alışveriş Ciro</span>
        <strong style="font-size: 1.6rem; color: #16a34a;">₺<?= number_format($totalRevenue, 2, ',', '.') ?></strong>
    </div>
    <div class="xpanel-card" style="padding: 1.15rem;">
        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); display: block; margin-bottom: 0.35rem;">Tamamlanan Seans Sayısı</span>
        <strong style="font-size: 1.6rem; color: #7c3aed;"><?= $totalCompletedWorkouts ?> Seans</strong>
    </div>
</div>

<div class="xp-table-card">
    <div class="xp-table-header-bar">
        <div>
            <h2 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 0.2rem 0;">
                Kayıtlı Öğrenci &amp; Kullanıcı Listesi
            </h2>
            <span style="font-size: 0.8rem; color: #64748b;">
                Tüm öğrenci profilleri, sadakat puanları ve satın alınan paketler
            </span>
        </div>
        <div style="display: flex; align-items: center; gap: 0.65rem;">
            <div class="xp-table-search-box">
                <span style="font-size: 0.85rem; color: #94a3b8;">🔍</span>
                <input type="text" placeholder="Öğrenci veya e-posta ara..." onkeyup="const f=this.value.toLowerCase(); document.querySelectorAll('.xpanel-table tbody tr').forEach(r=>r.style.display=r.innerText.toLowerCase().includes(f)?'':'none');">
            </div>
        </div>
    </div>

    <div class="xpanel-table-wrap">
        <table class="xpanel-table">
            <thead>
                <tr>
                    <th style="width: 36px; text-align: center;">
                        <input type="checkbox" class="xp-check-cell">
                    </th>
                    <th style="min-width: 180px;">Öğrenci / Kullanıcı</th>
                    <th style="width: 100px;">Rol</th>
                    <th style="width: 110px;">Durum</th>
                    <th style="width: 110px;">Sadakat &amp; Puan</th>
                    <th style="width: 90px;">Görevler</th>
                    <th style="min-width: 170px;">Satın Alınan Paketler</th>
                    <th style="width: 100px;">İlerleme</th>
                    <th style="width: 110px; white-space: nowrap;">Kayıt Tarihi</th>
                    <th style="text-align: right; width: 110px;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <?php 
                        $userEnrollments = $u['enrollments'] ?? [];
                        $completedCount = (int)($u['completed_workouts'] ?? 0);
                        $hasCourses = !empty($userEnrollments);
                        $points = (int)($u['loyalty_points'] ?? 100);
                        $tier = (string)($u['loyalty_tier'] ?? 'starter');
                        $tierLabels = [
                            'starter' => 'Başlangıç',
                            'bronze'  => 'Bronz',
                            'silver'  => 'Gümüş',
                            'gold'    => 'Altın',
                            'master'  => 'Usta (Master)'
                        ];
                        $displayTier = $tierLabels[$tier] ?? ucfirst($tier);
                        $pendingTasks = (int)($u['pending_tasks'] ?? 0);
                        $completedTasks = (int)($u['completed_tasks'] ?? 0);
                        $initial = mb_strtoupper(mb_substr(trim($u['full_name'] ?? 'Ö'), 0, 1));
                    ?>
                    <tr>
                        <td style="text-align: center;">
                            <input type="checkbox" class="xp-check-cell">
                        </td>
                        <td>
                            <div class="xp-user-cell">
                                <div class="xp-avatar-circle <?= $u['role'] === 'admin' ? 'avatar-brand' : '' ?>">
                                    <?= e($initial) ?>
                                </div>
                                <div>
                                    <a href="<?= url('/xpanel/users/' . $u['id']) ?>" style="text-decoration: none; color: inherit;">
                                        <div class="xp-user-cell-name"><?= e($u['full_name']) ?> &rarr;</div>
                                    </a>
                                    <div class="xp-user-cell-meta">
                                        <?= e($u['email']) ?>
                                        <?php if (!empty($u['phone'])): ?>
                                            &bull; <?= e($u['phone']) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="<?= url('/xpanel/users/role') ?>" method="POST" style="margin: 0;">
                                <?= csrf_field() ?>
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <input type="hidden" name="role" value="<?= $u['role'] === 'admin' ? 'student' : 'admin' ?>">
                                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;" title="Rolü değiştirmek için tıklayın">
                                    <?php if ($u['role'] === 'admin'): ?>
                                        <span style="background-color: #0f172a; color: #ffffff; padding: 3px 8px; border-radius: 4px; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.05em; display: inline-block;">
                                            ★ YÖNETİCİ
                                        </span>
                                    <?php else: ?>
                                        <span style="background-color: #f1f5f9; color: #475569; padding: 3px 8px; border-radius: 4px; font-size: 0.7rem; font-weight: 600; display: inline-block;">
                                            ÖĞRENCİ
                                        </span>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= url('/xpanel/users/status') ?>" method="POST" style="margin: 0;">
                                <?= csrf_field() ?>
                                <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                <input type="hidden" name="status" value="<?= $u['status'] === 'active' ? 'suspended' : 'active' ?>">
                                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;" title="Durumu değiştirmek için tıklayın">
                                    <?php if ($u['status'] === 'active'): ?>
                                        <span style="color: #065f46; background: #ecfdf5; border: 1px solid #a7f3d0; padding: 2px 7px; border-radius: 99px; font-size: 0.72rem; font-weight: 600;">
                                            ● Aktif
                                        </span>
                                    <?php else: ?>
                                        <span style="color: #991b1b; background: #fee2e2; border: 1px solid #fecaca; padding: 2px 7px; border-radius: 99px; font-size: 0.72rem; font-weight: 600;">
                                            ● Askıda
                                        </span>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 0.2rem;">
                                <strong style="font-size: 0.92rem; color: #b45309;">★ <?= $points ?> Puan</strong>
                                <span style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.06em; font-weight: 700; color: #64748b;">
                                    Kademe: <?= e($displayTier) ?>
                                </span>
                            </div>
                        </td>
                        <td>
                            <?php if ($pendingTasks > 0): ?>
                                <span style="background: #fffbeb; color: #92400e; border: 1px solid #fde68a; padding: 2px 7px; border-radius: 99px; font-size: 0.72rem; font-weight: 700;">
                                    ⏳ <?= $pendingTasks ?> Bekleyen
                                </span>
                            <?php elseif ($completedTasks > 0): ?>
                                <span style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 2px 7px; border-radius: 99px; font-size: 0.72rem; font-weight: 700;">
                                    ✓ <?= $completedTasks ?> Tamamlandı
                                </span>
                            <?php else: ?>
                                <span style="font-size: 0.74rem; color: #94a3b8;">Görev yok</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($userEnrollments)): ?>
                                <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                    <?php foreach ($userEnrollments as $enr): ?>
                                        <div style="font-size: 0.78rem; line-height: 1.3;">
                                            <?php if ((int)($enr['is_gift'] ?? 0) === 1): ?>
                                                <span style="background: #fdf2f8; color: #be185d; border: 1px solid #fbcfe8; padding: 1px 5px; border-radius: 3px; font-size: 0.68rem; font-weight: 700;">🎁 HEDİYE</span>
                                            <?php endif; ?>
                                            <strong><?= e($enr['course_title']) ?></strong>
                                            <?php if ($enr['payment_status'] === 'approved'): ?>
                                                <span style="color: #16a34a; font-weight: 600;">(<?= (float)$enr['amount'] == 0 ? 'Ücretsiz/Hediye' : '₺' . number_format((float)$enr['amount'], 0) ?>)</span>
                                            <?php elseif ($enr['payment_status'] === 'pending'): ?>
                                                <span style="color: #d97706; font-weight: 600;">(Beklemede)</span>
                                            <?php else: ?>
                                                <span style="color: #dc2626;">(İptal)</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <span style="font-size: 0.78rem; color: #94a3b8;">Henüz kayıt yok</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="font-size: 0.8rem; margin-bottom: 0.25rem;">
                                <strong><?= $completedCount ?></strong> Seans
                            </div>
                            <div style="background: #e2e8f0; border-radius: 99px; height: 6px; width: 85px; overflow: hidden;">
                                <?php 
                                    $pct = min(100, (int)round(($completedCount / 12) * 100));
                                ?>
                                <div style="background: <?= $pct > 0 ? '#10b981' : '#cbd5e1' ?>; height: 100%; width: <?= $pct ?>%;"></div>
                            </div>
                        </td>
                        <td style="font-size: 0.75rem; color: var(--text-muted);"><?= substr($u['created_at'], 0, 10) ?></td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end; flex-wrap: wrap;">
                                <!-- Detay & CRM Butonu -->
                                <a href="<?= url('/xpanel/users/' . $u['id']) ?>" 
                                   class="xp-btn-action-pill" 
                                   style="background: #0b0c10; color: #ffffff !important; border-color: #0b0c10;" 
                                   title="Tüm detayları, görevleri ve sadakat durumunu incele">
                                    Yönet &amp; İncele &rarr;
                                </a>

                                <!-- Hızlı Paket Tanımla -->
                                <button type="button" 
                                        onclick="openEnrollModal(<?= $u['id'] ?>, '<?= e(addslashes($u['full_name'])) ?>')" 
                                        class="xp-btn-action-pill xp-btn-action-edit"
                                        title="Hızlı paket tanımla">
                                    + Paket
                                </button>

                                <!-- Şifre Sıfırla -->
                                <button type="button" 
                                        onclick="openPasswordModal(<?= $u['id'] ?>, '<?= e(addslashes($u['full_name'])) ?>')" 
                                        class="xp-btn-action-pill xp-btn-action-edit"
                                        title="Şifreyi sıfırla">
                                    Şifre
                                </button>

                                <!-- Kullanıcıyı Sil -->
                                <?php if ($u['id'] !== \Core\Auth::id()): ?>
                                    <form action="<?= url('/xpanel/users/delete') ?>" method="POST" onsubmit="return confirm('<?= e(addslashes($u['full_name'])) ?> adlı kullanıcıyı ve tüm verilerini silmek istediğinize emin misiniz?');" style="margin: 0; display: inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                        <button type="submit" class="xp-btn-action-pill xp-btn-action-danger">
                                            Sil
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal 1: Kullanıcıya Manuel Paket Tanımla -->
<div id="enrollUserModal" class="xp-modal-backdrop">
    <div class="xp-modal-window">
        <div class="xp-modal-header">
            <h3 class="xp-modal-title">Öğrenciye Eğitim Paketi Tanımla</h3>
            <button type="button" onclick="document.getElementById('enrollUserModal').style.display='none';" class="xp-modal-close-btn">&times;</button>
        </div>

        <form action="<?= url('/xpanel/users/enroll') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>
            <input type="hidden" id="enrollModalUserId" name="user_id" value="">

            <div class="xp-form-group">
                <span class="xp-form-label">Seçilen Öğrenci</span>
                <div id="enrollModalUserName" style="font-size: 0.95rem; font-weight: 700; color: #0f172a; background: #f8fafc; padding: 0.65rem 1rem; border-radius: var(--xp-radius-pill); border: 1px solid var(--xp-border);"></div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="enroll_course_id">Tanımlanacak Eğitim Paketi *</label>
                <select id="enroll_course_id" name="course_id" class="xp-form-select" required>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= e($c['title']) ?> (₺<?= number_format((float)$c['price'], 2) ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('enrollUserModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    ✓ Paketi Tanımla &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal 2: Şifre Sıfırlama -->
<div id="passwordUserModal" class="xp-modal-backdrop">
    <div class="xp-modal-window" style="max-width: 480px;">
        <div class="xp-modal-header">
            <h3 class="xp-modal-title">Kullanıcı Şifresini Sıfırla</h3>
            <button type="button" onclick="document.getElementById('passwordUserModal').style.display='none';" class="xp-modal-close-btn">&times;</button>
        </div>

        <form action="<?= url('/xpanel/users/password') ?>" method="POST" class="xp-modal-body">
            <?= csrf_field() ?>
            <input type="hidden" id="pwdModalUserId" name="user_id" value="">

            <div class="xp-form-group">
                <span class="xp-form-label">Kullanıcı</span>
                <div id="pwdModalUserName" style="font-size: 0.95rem; font-weight: 700; color: #0f172a; background: #f8fafc; padding: 0.65rem 1rem; border-radius: var(--xp-radius-pill); border: 1px solid var(--xp-border);"></div>
            </div>

            <div class="xp-form-group">
                <label class="xp-form-label" for="new_user_pwd">Yeni Şifre (En az 6 karakter) *</label>
                <input type="text" id="new_user_pwd" name="new_password" class="xp-form-input" required minlength="6" placeholder="Yeni şifreyi girin">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <button type="button" onclick="document.getElementById('passwordUserModal').style.display='none';" class="xp-btn-pill-outline">İptal</button>
                <button type="submit" class="xp-btn-pill-primary">
                    Şifreyi Güncelle &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEnrollModal(userId, userName) {
    document.getElementById('enrollModalUserId').value = userId;
    document.getElementById('enrollModalUserName').innerText = userName;
    document.getElementById('enrollUserModal').style.display = 'flex';
}

function openPasswordModal(userId, userName) {
    document.getElementById('pwdModalUserId').value = userId;
    document.getElementById('pwdModalUserName').innerText = userName;
    document.getElementById('passwordUserModal').style.display = 'flex';
}
</script>

<?php require __DIR__ . '/layout_bottom.php'; ?>
