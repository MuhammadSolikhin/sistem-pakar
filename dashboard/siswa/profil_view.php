<div class="row">
    <div class="col-md-6">
        <div class="card card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Ubah Informasi Profil</h3>
            </div>
            <div class="card-body">
                <form action="update_profil.php" method="POST">
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($user_data['nama_lengkap']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user_data['email']) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan Profil</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-danger shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
            </div>
            <div class="card-body">
                <form action="update_password.php" method="POST">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" id="password_lama" name="password_lama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password Baru</label>
                        <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>