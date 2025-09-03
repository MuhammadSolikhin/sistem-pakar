<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama_fasilitas = trim($_POST['nama_fasilitas']);
    $deskripsi = trim($_POST['deskripsi']);

    if (empty($id) || empty($nama_fasilitas || empty($deskripsi))) {
        set_flash_message('error', 'Data tidak lengkap!');
        header('Location: edit.php?id=' . $id);
        exit;
    }

    $sql = "UPDATE fasilitas SET nama_fasilitas = ?, deskripsi = ? WHERE id = ?";
    $stmt = $koneksidb->prepare($sql);
    $stmt->bind_param("ssi", $nama_fasilitas, $deskripsi, $id);

    if ($stmt->execute()) {
        set_flash_message('success', 'Data fasilitas berhasil diperbarui.');
    } else {
        set_flash_message('error', 'Gagal memperbarui fasilitas.');
    }
    
    header('Location: index.php');
    exit;
}
?>