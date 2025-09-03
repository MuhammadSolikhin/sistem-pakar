<?php
// Pastikan session sudah dimulai di file header atau di file ini
// session_start(); 

// Dapatkan path URL saat ini untuk menandai menu aktif
$current_path = $_SERVER['REQUEST_URI'];
?>

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= strpos($current_path, 'dashboard') === false && strpos($current_path, 'index.php') === false ? 'collapsed' : '' ?>" href="<?= base_url('dashboard/admin/index.php') // Ganti ke dashboard user jika perlu ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><?php // Tampilkan Menu ini HANYA untuk Admin dan Pakar ?>
    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role'] == 'admin' )) : ?>
      
      <li class="nav-heading">Manajemen Data Pakar</li>

      <li class="nav-item">
        <a class="nav-link <?= strpos($current_path, 'gejala') === false ? 'collapsed' : '' ?>" href="<?= base_url('dashboard/admin/gejala.php') ?>">
          <i class="bi bi-activity"></i>
          <span>Data Gejala</span>
        </a>
      </li><li class="nav-item">
        <a class="nav-link <?= strpos($current_path, 'kecanduan') === false ? 'collapsed' : '' ?>" href="<?= base_url('dashboard/admin/tingkat_kecanduan.php') ?>">
          <i class="bi bi-patch-question"></i>
          <span>Data Tingkat Kecanduan</span>
        </a>
      </li><li class="nav-item">
        <a class="nav-link <?= strpos($current_path, 'pengetahuan') === false ? 'collapsed' : '' ?>" href="<?= base_url('dashboard/admin/basis_pengetahuan.php') ?>">
          <i class="bi bi-journal-rules"></i>
          <span>Basis Pengetahuan (Aturan)</span>
        </a>
      </li><li class="nav-heading">Laporan</li>

       <li class="nav-item">
        <a class="nav-link <?= strpos($current_path, 'riwayat') === false ? 'collapsed' : '' ?>" href="<?= base_url('dashboard/admin/riwayat_konsultasi.php') ?>">
          <i class="bi bi-clipboard2-data"></i>
          <span>Riwayat Konsultasi Siswa</span>
        </a>
      </li><?php endif; ?>


    <?php // Tampilkan Menu ini HANYA untuk Siswa ?>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'siswa') : ?>

      <li class="nav-heading">Menu Siswa</li>

      <li class="nav-item">
        <a class="nav-link <?= strpos($current_path, 'konsultasi.php') === false ? 'collapsed' : '' ?>" href="<?= base_url('dashboard/user/konsultasi.php') ?>">
          <i class="bi bi-clipboard-check"></i>
          <span>Mulai Konsultasi</span>
        </a>
      </li><li class="nav-item">
        <a class="nav-link <?= strpos($current_path, 'riwayat.php') === false ? 'collapsed' : '' ?>" href="<?= base_url('dashboard/user/riwayat.php') ?>">
          <i class="bi bi-clock-history"></i>
          <span>Riwayat Konsultasi Saya</span>
        </a>
      </li><?php endif; ?>


    <li class="nav-heading">Akun</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('auth/logout.php') ?>">
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
      </a>
    </li></ul>

</aside>