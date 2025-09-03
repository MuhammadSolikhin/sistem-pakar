<?php
session_start();
// Memuat file konfigurasi dan koneksi database
include '../config/config.php';
include '../config/koneksi.php';


// Pastikan request adalah metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi dasar agar tidak ada input kosong
    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = 'username dan password tidak boleh kosong!';
        header("Location: login.php");
        exit;
    }

    // Ambil data user berdasarkan username
    // Menggunakan kolom yang sesuai dengan skema database: id, nama_lengkap, username, password, role
    $sql = "SELECT id_user, nama_lengkap, username, password, role FROM users WHERE username = ?";
    $stmt = $koneksidb->prepare($sql);
    
    // Periksa jika statement gagal dipersiapkan
    if ($stmt === false) {
        // Sebaiknya log error ini untuk debugging
        // error_log("Prepare failed: (" . $koneksidb->errno . ") " . $koneksidb->error);
        $_SESSION['login_error'] = 'Terjadi kesalahan pada server.';
        header("Location: login.php");
        exit;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah user dengan username tersebut ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password yang diinput dengan hash di database
        if (password_verify($password, $user['password'])) {
            // Jika password cocok, regenerate session ID untuk keamanan
            session_regenerate_id(true);

            // Simpan data user yang relevan ke dalam session
            $_SESSION['user'] = [
                'id'           => $user['id_user'],
                'nama_lengkap' => $user['nama_lengkap'],
                'username'        => $user['username'],
                'role'         => $user['role']
            ];

            // Redirect pengguna berdasarkan rolenya
            if ($user['role'] == 'admin') {
                header("Location: " . base_url('dashboard/admin/'));
                exit;
            } else { // Asumsi role lainnya adalah 'user'
                header("Location: " . base_url('dashboard/siswa/'));
                exit;
            }
        } else {
            // Jika password salah
            $_SESSION['login_error'] = 'Kombinasi username dan password salah!';
            header("Location: login.php");
            exit;
        }
    } else {
        // Jika username tidak ditemukan
        $_SESSION['login_error'] = 'Kombinasi username dan password salah!';
        header("Location: login.php");
        exit;
    }

} else {
    // Jika halaman diakses langsung (bukan via POST), kembalikan ke halaman login
    header("Location: login.php");
    exit;
}
?>