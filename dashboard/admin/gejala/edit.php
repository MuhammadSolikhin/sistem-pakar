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

$sql = "SELECT * FROM gejala WHERE kode_gejala = ?";
$stmt = $koneksidb->prepare($sql);
$stmt->bind_param("s", $kode);
$stmt->execute();
$result = $stmt->get_result();
$gejala = $result->fetch_assoc();

if (!$gejala) {
    set_flash_message('error', 'Data gejala tidak ditemukan.');
    header('Location: index.php');
    exit;
}

$page_title = 'Edit Gejala';
$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => base_url('dashboard/admin')],
    ['title' => 'Manajemen Gejala', 'link' => 'index.php'],
    ['title' => 'Edit Gejala']
];

$content = base_path('dashboard/admin/gejala/edit_view.php');
include base_path('layout/main.php');
?>