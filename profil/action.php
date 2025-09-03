<?php
session_start();
include_once '../config/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // --- Bagian 1: Update Informasi Dasar ---
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Validasi duplikasi username/email untuk user lain
    $sql_check = "SELECT user_id FROM users WHERE (username = ? OR email = ?) AND user_id != ?";
    $stmt_check = $koneksidb->prepare($sql_check);
    $stmt_check->bind_param("ssi", $username, $email, $user_id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Username atau Email sudah digunakan oleh pengguna lain.'];
        header('Location: index.php');
        exit;
    }

    // Lakukan update informasi dasar
    $sql_update_info = "UPDATE users SET full_name = ?, username = ?, email = ? WHERE user_id = ?";
    $stmt_update_info = $koneksidb->prepare($sql_update_info);
    $stmt_update_info->bind_param("sssi", $full_name, $username, $email, $user_id);
    $stmt_update_info->execute();

    // --- Bagian 2: Update Password (Jika Diisi) ---
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $password_baru_konfirmasi = $_POST['password_baru_konfirmasi'];

    if (!empty($password_lama) || !empty($password_baru) || !empty($password_baru_konfirmasi)) {
        // Jika salah satu diisi, semua wajib diisi
        if (empty($password_lama) || empty($password_baru) || empty($password_baru_konfirmasi)) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Untuk mengubah password, semua field password wajib diisi.'];
            header('Location: index.php');
            exit;
        }

        // Cek apakah password baru cocok dengan konfirmasi
        if ($password_baru !== $password_baru_konfirmasi) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Password baru dan konfirmasi tidak cocok.'];
            header('Location: index.php');
            exit;
        }

        // Verifikasi password lama
        $sql_pass = "SELECT password FROM users WHERE user_id = ?";
        $stmt_pass = $koneksidb->prepare($sql_pass);
        $stmt_pass->bind_param("i", $user_id);
        $stmt_pass->execute();
        $user_data = $stmt_pass->get_result()->fetch_assoc();
        
        if (password_verify($password_lama, $user_data['password'])) {
            // Jika password lama benar, hash dan update password baru
            $hashed_new_password = password_hash($password_baru, PASSWORD_DEFAULT);
            $sql_update_pass = "UPDATE users SET password = ? WHERE user_id = ?";
            $stmt_update_pass = $koneksidb->prepare($sql_update_pass);
            $stmt_update_pass->bind_param("si", $hashed_new_password, $user_id);
            $stmt_update_pass->execute();
        } else {
            // Jika password lama salah
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Password lama yang Anda masukkan salah.'];
            header('Location: index.php');
            exit;
        }
    }

    // --- Bagian 3: Update Session & Redirect ---
    // Perbarui data di session agar langsung tampil di navbar
    $_SESSION['user']['full_name'] = $full_name;
    $_SESSION['user']['username'] = $username;
    // Tambahkan email ke session jika belum ada
    // $_SESSION['user']['email'] = $email; 

    $_SESSION['message'] = ['type' => 'success', 'text' => 'Profil berhasil diperbarui!'];
    header('Location: index.php');
    exit;

} else {
    header('Location: index.php');
    exit;
}
?>