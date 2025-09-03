<?php
// 1. Ambil jumlah ulasan yang belum dibaca
$query_new_reviews = "SELECT COUNT(id) as total FROM ulasan WHERE is_read = 0";
$result_new_reviews = $koneksidb->query($query_new_reviews);
$new_reviews_count = $result_new_reviews->fetch_assoc()['total'];

// 2. Ambil 4 ulasan terbaru yang belum dibaca untuk ditampilkan di dropdown
$new_reviews_list = [];
if ($new_reviews_count > 0) {
    $sql_get_reviews = "
        SELECT u.komentar, w.nama_tempat, us.nama_lengkap, u.created_at
        FROM ulasan u
        JOIN tempat_wisata w ON u.wisata_id = w.id
        JOIN users us ON u.user_id = us.id
        WHERE u.is_read = 0
        ORDER BY u.created_at DESC
        LIMIT 4";
    $result_get_reviews = $koneksidb->query($sql_get_reviews);
    if($result_get_reviews) {
        while($row = $result_get_reviews->fetch_assoc()) {
            $new_reviews_list[] = $row;
        }
    }
}
?>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="#">
                <h4 class="fw-bold m-0">Wisata TSM</h4>
            </a>
            <a class="navbar-brand brand-logo-mini" href="#">
                <img src="<?= base_url('config/assets/') ?>images/logo-mini.svg" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Selamat Datang, <span class="text-black fw-bold"><?= htmlspecialchars($_SESSION['user']['nama_lengkap'] ?? 'Pengguna') ?></span></h1>
                <h3 class="welcome-sub-text">Semoga harimu menyenangkan!</h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <?php if ($new_reviews_count > 0): ?>
                    <span class="count-symbol bg-danger"></span>
                <?php endif; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 fw-medium float-start">Anda memiliki <?= $new_reviews_count ?> ulasan baru</p>
                  <span class="badge badge-pill badge-primary float-end">Lihat Semua</span>
                </a>
                
                <?php if (empty($new_reviews_list)): ?>
                    <a class="dropdown-item preview-item py-3">
                        <div class="preview-item-content">
                            <p class="fw-light small-text mb-0">Tidak ada ulasan baru saat ini.</p>
                        </div>
                    </a>
                <?php else: ?>
                    <?php foreach($new_reviews_list as $review): ?>
                    <a class="dropdown-item preview-item py-3">
                      <div class="preview-thumbnail">
                        <i class="mdi mdi-star m-auto text-primary"></i>
                      </div>
                      <div class="preview-item-content">
                        <h6 class="preview-subject fw-normal text-dark mb-1"><?= htmlspecialchars($review['nama_lengkap']) ?></h6>
                        <p class="fw-light small-text mb-0">Memberi ulasan untuk <?= htmlspecialchars($review['nama_tempat']) ?></p>
                      </div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>

              </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="<?= base_url('config/assets/') ?>images/faces/face8.jpg" alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="<?= base_url('config/assets/') ?>images/faces/face8.jpg" alt="Profile image">
                        <p class="mb-1 mt-3 fw-semibold"><?= htmlspecialchars($_SESSION['user']['nama_lengkap'] ?? 'User') ?></p>
                        <p class="fw-light text-muted mb-0"><?= htmlspecialchars($_SESSION['user']['email'] ?? 'email@example.com') ?></p>
                    </div>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profil Saya</a>
                    <a class="dropdown-item" href="#" onclick="confirmLogout(event)"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>

<script>
  function confirmLogout(event) {
    event.preventDefault();
    Swal.fire({
      title: 'Yakin ingin logout?',
      text: "Sesi Anda akan diakhiri.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, logout',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '../login/logout.php';
      }
    });
  }
</script>