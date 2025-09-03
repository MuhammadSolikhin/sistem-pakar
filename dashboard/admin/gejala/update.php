<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_gejala = trim($_POST['kode_gejala_lama']);
    $nama_gejala = trim($_POST['nama_gejala']);

    if (empty($kode_gejala) || empty($nama_gejala)) {
        set_flash_message('error', 'Data tidak lengkap!');
        header('Location: edit.php?kode=' . $kode_gejala);
        exit;
    }

    $sql = "UPDATE gejala SET nama_gejala = ? WHERE kode_gejala = ?";
    $stmt = $koneksidb->prepare($sql);
    $stmt->bind_param("ss", $nama_gejala, $kode_gejala);

    if ($stmt->execute()) {
        set_flash_message('success', 'Data gejala berhasil diperbarui.');
    } else {
        set_flash_message('error', 'Gagal memperbarui gejala.');
    }
    
    header('Location: index.php');
    exit;
}
?>