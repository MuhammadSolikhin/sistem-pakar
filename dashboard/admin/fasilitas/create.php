<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

$page_title = 'Tambah Fasilitas Baru';
$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => base_url('dashboard/admin')],
    ['title' => 'Manajemen Fasilitas', 'link' => 'index.php'],
    ['title' => 'Tambah Fasilitas']
];

$content = base_path('dashboard/admin/fasilitas/create_view.php');
include base_path('layout/main.php');
?>