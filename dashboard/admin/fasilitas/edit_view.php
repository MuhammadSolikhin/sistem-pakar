<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Form Edit Fasilitas</h3>
    </div>
    <div class="card-body">
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= (int) $fasilitas['id'] ?>">
            <div class="form-group">
                <label for="nama_fasilitas">Nama Fasilitas</label>
                <input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas" value="<?= htmlspecialchars($fasilitas['nama_fasilitas']) ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= htmlspecialchars($fasilitas['deskripsi']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>