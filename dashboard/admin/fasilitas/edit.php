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

$sql = "SELECT * FROM fasilitas_wisata WHERE id = ?";
$stmt = $koneksidb->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$fasilitas = $result->fetch_assoc();

if (!$fasilitas) {
    set_flash_message('error', 'Data fasilitas tidak ditemukan.');
    header('Location: index.php');
    exit;
}

$page_title = 'Edit Fasilitas';
$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => base_url('dashboard/admin')],
    ['title' => 'Manajemen Fasilitas', 'link' => 'index.php'],
    ['title' => 'Edit Fasilitas']
];

$content = base_path('dashboard/admin/fasilitas/edit_view.php');
include base_path('layout/main.php');
?>