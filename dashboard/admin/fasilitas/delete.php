<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

$id = $_GET['id'] ?? 0;
if (!$id) {
    set_flash_message('error', 'ID fasilitas tidak valid.');
    header('Location: index.php');
    exit;
}

$sql = "DELETE FROM fasilitas_wisata WHERE id = ?";
$stmt = $koneksidb->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    set_flash_message('success', 'Data fasilitas berhasil dihapus.');
} else {
    set_flash_message('error', 'Gagal menghapus fasilitas.');
}

header('Location: index.php');
exit;
?>