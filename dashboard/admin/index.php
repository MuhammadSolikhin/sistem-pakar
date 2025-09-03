<?php
session_start();
include '../../config/config.php';
include '../../config/koneksi.php';
cek_admin();
$page_title = 'Dashboard Admin';
$breadcrumbs = [
    ['title' => 'Dashboard']
];

// --- MEMUAT VIEW DAN LAYOUT ---
$content = 'home.php'; // Langsung load file di folder yang sama
include '../../layout/main.php';
?>

<?php if (isset($_SESSION['login_success'])): ?>
    <script>
        // SweetAlert untuk notifikasi login berhasil
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: '<?= addslashes($_SESSION["login_success"]); ?>',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    <?php unset($_SESSION['login_success']); ?>
<?php endif; ?>