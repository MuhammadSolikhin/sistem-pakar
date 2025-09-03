<?php
include '../../config/config.php';
include '../../config/koneksi.php';
include '../../config/functions.php';
session_start();
cek_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);

    // Validasi dasar
    if (empty($nama_lengkap) || empty($email)) {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Nama dan Email tidak boleh kosong!'];
        header('Location: profil.php');
        exit;
    }

    // Cek apakah email sudah digunakan oleh user lain
    $stmt_check = mysqli_prepare($koneksidb, "SELECT id FROM users WHERE email = ? AND id != ?");
    mysqli_stmt_bind_param($stmt_check, 'si', $email, $user_id);
    mysqli_stmt_execute($stmt_check);
    if (mysqli_stmt_get_result($stmt_check)->num_rows > 0) {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Email sudah terdaftar untuk akun lain!'];
        header('Location: profil.php');
        exit;
    }

    // Update data di database
    $stmt_update = mysqli_prepare($koneksidb, "UPDATE users SET nama_lengkap = ?, email = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt_update, 'ssi', $nama_lengkap, $email, $user_id);

    if (mysqli_stmt_execute($stmt_update)) {
        // Update juga data di session jika ada
        $_SESSION['user']['nama_lengkap'] = $nama_lengkap;
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Profil berhasil diperbarui.'];
    } else {
        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Gagal memperbarui profil.'];
    }
    
    header('Location: profil.php');
    exit;
}
?>