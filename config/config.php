<?php
function base_url($path = '') {
    $base = 'http://localhost/sistem_pakar_nayla'; // Sesuaikan dengan URL dasar aplikasi Anda
    return $base . '/' . ltrim($path, '/');
}

function base_path($path = '') {
    return $_SERVER['DOCUMENT_ROOT'] . '/sistem_pakar_nayla/' . $path;
}

function cek_admin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: ' . base_url('auth/login.php'));
        exit();
    }
}