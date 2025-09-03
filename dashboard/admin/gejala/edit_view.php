<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Form Edit Gejala</h3>
    </div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="kode_gejala_lama" value="<?= htmlspecialchars($gejala['kode_gejala']) ?>">
            <div class="form-group">
                <label for="kode_gejala">Kode Gejala</label>
                <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" value="<?= htmlspecialchars($gejala['kode_gejala']) ?>" readonly>
                <small class="form-text text-muted">Kode gejala tidak dapat diubah.</small>
            </div>
            <div class="form-group">
                <label for="nama_gejala">Nama Gejala (Berbentuk Pertanyaan)</label>
                <textarea class="form-control" id="nama_gejala" name="nama_gejala" rows="3" required><?= htmlspecialchars($gejala['nama_gejala']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>