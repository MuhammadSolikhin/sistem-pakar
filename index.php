<?php
session_start();
include 'config/config.php';
if (!isset($_SESSION['user'])) {
    header('Location: ' . base_url('auth/login.php'));
    exit();
} else if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') {
    header('Location: ' . base_url('dashboard/admin'));
    exit();
} else if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'user') {
    header('Location: ' . base_url('dashboard/user'));
    exit();
} else {
    echo "Role tidak dikenali.";
}
