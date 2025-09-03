<?php
// Notifikasi
$notification = null;
if (isset($_SESSION['message'])) {
    $notification = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Breadcrumbs
$breadcrumbs = [
    ['label' => 'Dashboard', 'url' => base_url('dashboard/' . $_SESSION['user']['role'] . '/')],
    ['label' => 'Kelola Profil']
];

// Ambil data user dari session untuk ditampilkan di form
$user = $_SESSION['user'];
?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-circle"></i>
        </span> Kelola Profil Saya
    </h3>
    <nav aria-label="breadcrumb">
        </nav>
</div>

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulir Edit Profil</h4>
                <form class="forms-sample" action="action.php" method="POST">
                    
                    <div class="form-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_SESSION['user_email_from_db'] ?? $user['username'].'@example.com'); ?>" required>
                    </div>

                    <hr>
                    <p class="card-description">Ubah Password (opsional)</p>
                    <small class="text-muted d-block mb-3">Kosongkan ketiga field di bawah ini jika Anda tidak ingin mengubah password.</small>

                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Masukkan password Anda saat ini">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Minimal 6 karakter">
                    </div>
                    <div class="form-group">
                        <label for="password_baru_konfirmasi">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_baru_konfirmasi" name="password_baru_konfirmasi">
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Update Profil</button>
                    <a href="<?= base_url('dashboard/' . $user['role'] . '/'); ?>" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
ob_start(); 
?>
<script>
$(document).ready(function() {
    // Script notifikasi
    <?php if ($notification): ?>
    Swal.fire({
        icon: '<?= $notification['type']; ?>',
        title: '<?= ucfirst($notification['type']); ?>!',
        text: '<?= addslashes($notification['text']); ?>',
    });
    <?php endif; ?>
});
</script>
<?php 
$page_scripts = ob_get_clean(); 
?>