<?php
include '../../config/config.php';
include '../../config/koneksi.php';
session_start();

// Ambil ID user dari sesi
$user_id = $_SESSION['user']['id'];

// Ambil data user dari database
$stmt = mysqli_prepare($koneksidb, "SELECT nama_lengkap, email FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user_data = mysqli_fetch_assoc($result);

if (!$user_data) {
    // Jika data tidak ditemukan (kasus langka), logout saja
    header('Location: ' . base_url('login/logout.php'));
    exit;
}

// Setup Halaman
$page_title = 'Profil Saya';
$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => base_url('dashboard/' . $_SESSION['user']['role'] . '/')],
    ['title' => 'Profil Saya']
];

// Siapkan script untuk notifikasi
$alert_script = '';
if (isset($_SESSION['flash_message'])) {
    $flash = $_SESSION['flash_message'];
    $type = htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8');
    $alert_script = "Swal.fire({icon: '{$type}', title: '{$message}', showConfirmButton: false, timer: 3000});";
    unset($_SESSION['flash_message']);
}
$page_specific_js = "<script>{$alert_script}</script>";

// Tentukan file view
$content = base_path('dashboard/user/profil_view.php');

// Panggil layout utama
include base_path('layout/main.php');
?>