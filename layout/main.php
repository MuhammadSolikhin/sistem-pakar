<?php
// Pastikan sesi dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek jika pengguna belum login, arahkan ke halaman login
if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= isset($page_title) ? $page_title . ' | ' : '' ?>Sistem Pakar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    {{-- bootsrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?= base_url('config/assets/layout/') ?>css/style.css">
</head>

<body>

    <?php
    include 'header.php';
    include 'sidebar.php';
    ?>

    <?php
    if (isset($content)) {
        include $content;
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($page_specific_js)): ?>
        <?= $page_specific_js ?>
    <?php endif; ?>
</body>

</html>