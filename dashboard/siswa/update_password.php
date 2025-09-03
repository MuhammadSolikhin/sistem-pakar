<?php
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../config/functions.php';
session_start();
cek_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // 1. Validasi input
    if (empty($password_lama) || empty($password_baru) || empty($konfirmasi_password)) {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Semua kolom password wajib diisi!'];
        header('Location: profil.php');
        exit;
    }

    if ($password_baru !== $konfirmasi_password) {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Password baru dan konfirmasi tidak cocok!'];
        header('Location: profil.php');
        exit;
    }
    
    // 2. Verifikasi password lama
    $stmt_pass = mysqli_prepare($koneksidb, "SELECT password FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt_pass, 'i', $user_id);
    mysqli_stmt_execute($stmt_pass);
    $result_pass = mysqli_stmt_get_result($stmt_pass);
    $user_pass = mysqli_fetch_assoc($result_pass);

    if (!$user_pass || !password_verify($password_lama, $user_pass['password'])) {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Password lama yang Anda masukkan salah!'];
        header('Location: profil.php');
        exit;
    }

    // 3. Hash password baru dan update ke database
    $hashed_password_baru = password_hash($password_baru, PASSWORD_BCRYPT);
    $stmt_update = mysqli_prepare($koneksidb, "UPDATE users SET password = ? WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt_update, 'si', $hashed_password_baru, $user_id);

    if (mysqli_stmt_execute($stmt_update)) {
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Password berhasil diubah. Silakan gunakan password baru Anda saat login berikutnya.'];
    } else {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Gagal mengubah password.'];
    }

    header('Location: profil.php');
    exit;
}
?>