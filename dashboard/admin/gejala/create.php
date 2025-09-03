<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

$page_title = 'Tambah Gejala Baru';
$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => base_url('dashboard/admin')],
    ['title' => 'Manajemen Gejala', 'link' => 'index.php'],
    ['title' => 'Tambah Gejala']
];

$content = base_path('dashboard/admin/gejala/create_view.php');
include base_path('layout/main.php');
?>