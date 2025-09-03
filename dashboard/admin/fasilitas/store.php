<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_fasilitas = trim($_POST['nama_fasilitas']);
    $deskripsi = trim($_POST['deskripsi']);
    if (empty($nama_fasilitas) || empty($deskripsi)) {
        set_flash_message('error', 'Semua kolom wajib diisi!');
        header('Location: create.php');
        exit;
    }

    $sql = "INSERT INTO fasilitas (nama_fasilitas, deskripsi) VALUES (?,?)";
    $stmt = $koneksidb->prepare($sql);
    $stmt->bind_param("ss", $nama_fasilitas, $deskripsi);

    if ($stmt->execute()) {
        set_flash_message('success', 'Fasilitas baru berhasil ditambahkan.');
    } else {
        set_flash_message('error', 'Gagal menambahkan fasilitas.');
    }
    
    header('Location: index.php');
    exit;
}
?>