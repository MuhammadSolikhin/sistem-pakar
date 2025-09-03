<?php

include base_path('layout/header.php');

// Memuat sidebar
include base_path('layout/sidebar.php');
?>

<div class="main">
    <?php
    // Memuat navbar (navigasi atas)
    include base_path('layout/navbar.php');
    ?>

    <main class="content">
        <div class="container-fluid p-0">
            
            <h1 class="h3 mb-3"><?= isset($page_title) ? htmlspecialchars($page_title) : 'Dashboard' ?></h1>
            
            <?php
            // Memuat file konten utama yang spesifik (misal: gejala/home.php)
            if (isset($content) && file_exists($content)) {
                include $content;
            } else {
                echo '<div class="alert alert-danger">Error: File konten tidak dapat ditemukan.</div>';
            }
            ?>

        </div>
    </main>

    <?php
    // Memuat footer (menutup semua tag)
    include base_path('layout/footer.php');
    ?>
</div>