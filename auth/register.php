<?php
require_once '../config/config.php';
session_start();
// Jika user sudah login, arahkan ke halaman utama sesuai rolenya
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'pakar') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../siswa/dashboard.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrasi | Sistem Pakar Kecanduan Game Online</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("<?= base_url('config/assets/') ?>landing/img/full-1.jpg");
            background-size: cover;
            background-position: center;
            font-family: 'Lato', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }

        .login-card .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .login-card h1 {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            padding: 1.25rem 1rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #3498db;
            background-color: #fff;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .btn-login {
            border-radius: 10px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 12px 30px;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #2980b9;
            color: white;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="login-card animate__animated animate__fadeIn">
        <div class="text-center">
            <img src="<?= base_url('config/assets/') ?>landing/img/logo-dark.png" alt="Logo Sistem Pakar" class="logo">
        </div>

        <h1>Buat Akun Baru</h1>

        <form method="POST" action="action_register.php">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" required
                    placeholder="Masukkan nama lengkap Anda">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" class="form-control" name="username" required
                    placeholder="Buat username unik">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required
                    placeholder="Buat password">
            </div>

            <div class="form-group">
                <label for="password_confirm">Konfirmasi Password</label>
                <input id="password_confirm" type="password" class="form-control" name="password_confirm" required
                    placeholder="Ketik ulang password">
            </div>

            <button type="submit" class="btn btn-login btn-block">DAFTAR</button>

            <div class="login-link">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </form>
    </div>

    <?php if (isset($_SESSION['register_error'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal',
                html: '<?php echo addslashes($_SESSION["register_error"]); ?>',
                confirmButtonColor: '#d33',
            });
        </script>
        <?php unset($_SESSION['register_error']); ?>
    <?php endif; ?>

</body>

</html>