<?php
// Definisikan judul halaman
$page_title = "Kelola Profil Saya";

// Muat file layout utama
// Kita tidak perlu mengambil data user di sini karena sudah ada di session
// Tapi jika ingin data paling update, bisa query ulang dari DB
$content = __DIR__ . '/content.php';
include_once '../layout/main.php';
?>