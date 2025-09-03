<?php

require_once '../config/koneksi.php';

session_start();

// Hanya proses jika request method adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Ambil data dari form, sesuaikan dengan atribut 'name' pada input
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // 2. Validasi input
    if (empty($nama_lengkap) || empty($username) || empty($password) || empty($password_confirm)) {
        $_SESSION['register_error'] = 'Semua field wajib diisi!';
        header("Location: register.php");
        exit;
    }

    if (strlen($password) < 6) {
        $_SESSION['register_error'] = 'Password minimal harus 6 karakter!';
        header("Location: register.php");
        exit;
    }

    if ($password !== $password_confirm) {
        $_SESSION['register_error'] = 'Password dan konfirmasi password tidak cocok!';
        header("Location: register.php");
        exit;
    }

    // 3. Cek apakah username sudah ada di database
    // Kueri disederhanakan karena tidak ada email
    $sql_check = "SELECT id_user FROM users WHERE username = ?";
    $stmt_check = $koneksidb->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $_SESSION['register_error'] = 'Username sudah digunakan, silakan pilih yang lain!';
        header("Location: register.php");
        exit;
    }
    $stmt_check->close();

    // 4. Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 5. Masukkan data user baru ke database
    // Kolom disesuaikan: nama_lengkap, dan role diisi 'siswa'
    $sql_insert = "INSERT INTO users (nama_lengkap, username, password, role) VALUES (?, ?, ?, 'siswa')";
    $stmt_insert = $koneksidb->prepare($sql_insert);
    // Binding disesuaikan, hanya 3 parameter string (sss)
    $stmt_insert->bind_param("sss", $nama_lengkap, $username, $hashed_password);

    if ($stmt_insert->execute()) {
        // Jika registrasi berhasil
        $_SESSION['register_success'] = 'Akun Anda berhasil dibuat. Silakan login.';
        $stmt_insert->close();
        $koneksidb->close();
        header("Location: login.php");
        exit;
    } else {
        // Jika terjadi error saat insert
        error_log("MySQLi execute failed: " . $stmt_insert->error);
        $_SESSION['register_error'] = 'Terjadi kesalahan pada server. Coba lagi nanti.';
        $stmt_insert->close();
        $koneksidb->close();
        header("Location: register.php");
        exit;
    }

} else {
    // Jika halaman diakses tanpa metode POST, redirect ke halaman registrasi
    header("Location: register.php");
    exit;
}
?>