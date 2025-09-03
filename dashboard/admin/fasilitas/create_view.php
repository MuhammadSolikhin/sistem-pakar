<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Fasilitas</h3>
    </div>
    <div class="card-body">
        <form action="store.php" method="POST">
            <div class="form-group">
                <label for="nama_fasilitas">Nama Fasilitas</label>
                <input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas" placeholder="Contoh: Toilet Umum" required>
            </div>
            <div class="form-group">
                <label for="nama_fasilitas">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Contoh: Fasilitas kamar mandi" required>
            </div>
          
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>