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

<div class="xpanel-card">
    <div style="overflow-x: auto;">
        <table class="xpanel-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Öğrenci / Kullanıcı</th>
                    <th>Rol</th>
                    <th>Durum</th>
                    <th>Satın Alınan Paketler &amp; Alışveriş</th>
                    <th>İlerleme Durumu</th>
                    <th>Kayıt Tarihi</th>
                    <th style="text-align: right;">Yönetim &amp; İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <?php 
                        $userEnrollments = $u['enrollments'] ?? [];
                        $completedCount = (int)($u['completed_workouts'] ?? 0);
                        $hasCourses = !empty($userEnrollments);
                    ?>
                    <tr>
                        <td>#<?= $u['id'] ?></td>
                        <td>
                            <strong style="color: #111; font-size: 0.95rem;"><?= e($u['full_name']) ?></strong>
                            <div style="font-size: 0.78rem; color: #64748b; margin-top: 2px;">
                                ✉ <?= e($u['email']) ?>
                            </div>
                            <?php if (!empty($u['phone'])): ?>
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 1px;">
                                    📞 <?= e($u['phone']) ?>
                                </div>
                            <?php endif; ?>
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
                            <?php if (!empty($userEnrollments)): ?>
                                <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                    <?php foreach ($userEnrollments as $enr): ?>
                                        <div style="font-size: 0.78rem; line-height: 1.3;">
                                            <strong><?= e($enr['course_title']) ?></strong>
                                            <?php if ($enr['payment_status'] === 'approved'): ?>
                                                <span style="color: #16a34a; font-weight: 600;">(₺<?= number_format((float)$enr['amount'], 0) ?> • Onaylı)</span>
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
                                <strong><?= $completedCount ?></strong> Seans Tamamlandı
                            </div>
                            <div style="background: #e2e8f0; border-radius: 99px; height: 6px; width: 110px; overflow: hidden;">
                                <?php 
                                    $pct = min(100, (int)round(($completedCount / 12) * 100));
                                ?>
                                <div style="background: <?= $pct > 0 ? '#10b981' : '#cbd5e1' ?>; height: 100%; width: <?= $pct ?>%;"></div>
                            </div>
                        </td>
                        <td style="font-size: 0.75rem; color: var(--text-muted);"><?= substr($u['created_at'], 0, 10) ?></td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 0.35rem; align-items: center; justify-content: flex-end; flex-wrap: wrap;">
                                <!-- Paket Tanımla Butonu -->
                                <button type="button" 
                                        onclick="openEnrollModal(<?= $u['id'] ?>, '<?= e(addslashes($u['full_name'])) ?>')" 
                                        class="xp-btn-action-pill xp-btn-action-edit">
                                    + Paket Tanımla
                                </button>

                                <!-- Şifre Sıfırla Butonu -->
                                <button type="button" 
                                        onclick="openPasswordModal(<?= $u['id'] ?>, '<?= e(addslashes($u['full_name'])) ?>')" 
                                        class="xp-btn-action-pill xp-btn-action-edit">
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
<div id="enrollUserModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: 12px; max-width: 480px; width: 100%; padding: 1.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
            <h3 style="font-size: 1.15rem; font-weight: 700; color: #111; margin: 0;">Öğrenciye Eğitim Paketi Tanımla</h3>
            <button type="button" onclick="document.getElementById('enrollUserModal').style.display='none';" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #64748b;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/users/enroll') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" id="enrollModalUserId" name="user_id" value="">

            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.8rem; font-weight: 600; color: #334155; display: block; margin-bottom: 0.35rem;">Seçilen Öğrenci:</label>
                <div id="enrollModalUserName" style="font-size: 0.95rem; font-weight: 700; color: #0f172a; background: #f8fafc; padding: 0.5rem 0.75rem; border-radius: 999px; border: 1px solid #e2e8f0;"></div>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label class="form-label" for="enroll_course_id" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Tanımlanacak Eğitim Paketi *</label>
                <select id="enroll_course_id" name="course_id" class="form-input" required style="width: 100%; padding: 0.6rem; border-radius: 999px; border: 1px solid #cbd5e1;">
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
<div id="passwordUserModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); z-index: 10000; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: var(--white); border-radius: 12px; max-width: 440px; width: 100%; padding: 1.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 0.75rem;">
            <h3 style="font-size: 1.15rem; font-weight: 700; color: #111; margin: 0;">Kullanıcı Şifresini Sıfırla</h3>
            <button type="button" onclick="document.getElementById('passwordUserModal').style.display='none';" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #64748b;">&times;</button>
        </div>

        <form action="<?= url('/xpanel/users/password') ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" id="pwdModalUserId" name="user_id" value="">

            <div style="margin-bottom: 1rem;">
                <label style="font-size: 0.8rem; font-weight: 600; color: #334155; display: block; margin-bottom: 0.35rem;">Kullanıcı:</label>
                <div id="pwdModalUserName" style="font-size: 0.95rem; font-weight: 700; color: #0f172a; background: #f8fafc; padding: 0.5rem 0.75rem; border-radius: 999px; border: 1px solid #e2e8f0;"></div>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label class="form-label" for="new_user_pwd" style="font-size: 0.8rem; font-weight: 600; color: #334155;">Yeni Şifre (En az 6 karakter) *</label>
                <input type="text" id="new_user_pwd" name="new_password" class="form-input" required minlength="6" placeholder="Yeni şifreyi girin" style="width: 100%; padding: 0.6rem; border-radius: 999px; border: 1px solid #cbd5e1;">
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
