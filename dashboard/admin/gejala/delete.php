<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

$kode = $_GET['kode'] ?? '';
if (!$kode) {
    set_flash_message('error', 'Kode gejala tidak valid.');
    header('Location: index.php');
    exit;
}

$sql = "DELETE FROM gejala WHERE kode_gejala = ?";
$stmt = $koneksidb->prepare($sql);
// "s" untuk tipe data string
$stmt->bind_param("s", $kode);

if ($stmt->execute()) {
    set_flash_message('success', 'Data gejala berhasil dihapus.');
} else {
    if ($koneksidb->errno == 1451) { 
        set_flash_message('error', 'Gagal menghapus! Gejala ini masih digunakan dalam Basis Pengetahuan.');
    } else {
        set_flash_message('error', 'Gagal menghapus gejala.');
    }
}

header('Location: index.php');
exit;
?>