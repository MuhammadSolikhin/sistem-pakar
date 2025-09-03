<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_gejala = trim(strtoupper($_POST['kode_gejala']));
    $nama_gejala = trim($_POST['nama_gejala']);

    if (empty($kode_gejala) || empty($nama_gejala)) {
        set_flash_message('error', 'Semua kolom wajib diisi!');
        header('Location: create.php');
        exit;
    }

    // Cek apakah kode gejala sudah ada
    $check_sql = "SELECT COUNT(*) as total FROM gejala WHERE kode_gejala = ?";
    $check_stmt = $koneksidb->prepare($check_sql);
    $check_stmt->bind_param("s", $kode_gejala);
    $check_stmt->execute();
    $result = $check_stmt->get_result()->fetch_assoc();
    if ($result['total'] > 0) {
        set_flash_message('error', 'Kode Gejala ' . htmlspecialchars($kode_gejala) . ' sudah digunakan!');
        header('Location: create.php');
        exit;
    }

    $sql = "INSERT INTO gejala (kode_gejala, nama_gejala) VALUES (?,?)";
    $stmt = $koneksidb->prepare($sql);
    $stmt->bind_param("ss", $kode_gejala, $nama_gejala);

    if ($stmt->execute()) {
        set_flash_message('success', 'Gejala baru berhasil ditambahkan.');
    } else {
        set_flash_message('error', 'Gagal menambahkan gejala.');
    }
    
    header('Location: index.php');
    exit;
}
?>