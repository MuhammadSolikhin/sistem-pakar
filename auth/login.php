<?php
include '../config/config.php';
session_start();
// Jika user sudah login, arahkan ke halaman utama sesuai rolenya
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] == 'admin') {
        header("Location: ../dashboard/admin/index.php"); 
    } else {
        header("Location: ../dashboard/siswa/index.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Sistem Pakar Kecanduan Game Online</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            /* Ganti 'landing/img/full-1.jpg' dengan path gambar background Anda */
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
            background-color: rgba(255, 255, 255, 0.9); /* Sedikit lebih tebal agar lebih terbaca */
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

        .register-link {
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
        
        <h1>Login Sistem</h1>

        <form method="POST" action="action_login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" class="form-control" name="username" required autofocus placeholder="Masukkan username Anda">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required placeholder="Masukkan password">
            </div>

            <button type="submit" class="btn btn-login btn-block">LOGIN</button>

            <div class="register-link">
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>
        </form>
    </div>

    <?php if (isset($_SESSION['login_error'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?php echo addslashes($_SESSION["login_error"]); ?>',
                confirmButtonColor: '#d33',
            });
        </script>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['register_success'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: '<?php echo addslashes($_SESSION["register_success"]); ?>',
                confirmButtonColor: '#3085d6',
            });
        </script>
        <?php unset($_SESSION['register_success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['logout_success'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Logout Berhasil',
                text: '<?php echo addslashes($_SESSION["logout_success"]); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php unset($_SESSION['logout_success']); ?>
    <?php endif; ?>

</body>

</html>