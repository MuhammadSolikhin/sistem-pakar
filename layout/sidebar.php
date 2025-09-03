<?php
$current_path = $_SERVER['REQUEST_URI'];
?>
<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="<?= base_url('dashboard/admin/index.php') ?>">
      <span class="align-middle">Sistem Pakar</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-header">
        Navigasi
      </li>

      <li
        class="sidebar-item <?= (strpos($current_path, 'dashboard') !== false || substr($current_path, -1) === '/') ? 'active' : '' ?>">
        <a class="sidebar-link" href="<?= base_url('dashboard/admin/index.php') ?>">
          <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
        </a>
      </li>

      <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role'] == 'admin')): ?>
        <li class="sidebar-header">
          Manajemen Data Pakar
        </li>
        <li class="sidebar-item <?= strpos($current_path, 'gejala') !== false ? 'active' : '' ?>">
          <a class="sidebar-link" href="<?= base_url('dashboard/admin/gejala/') ?>">
            <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Data Gejala</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="#">
            <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Tingkat Kecanduan</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="#">
            <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Basis Pengetahuan</span>
          </a>
        </li>
        <li class="sidebar-header">
          Laporan
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="#">
            <i class="align-middle" data-feather="clipboard"></i> <span class="align-middle">Riwayat Konsultasi</span>
          </a>
        </li>
      <?php endif; ?>

      <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'siswa'): ?>
        <li class="sidebar-header">
          Menu Siswa
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="#">
            <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Mulai Konsultasi</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="#">
            <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Riwayat Saya</span>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>