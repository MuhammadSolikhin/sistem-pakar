<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Gejala</h3>
    </div>
    <div class="card-body">
        <form action="store.php" method="POST">
            <div class="form-group">
                <label for="kode_gejala">Kode Gejala</label>
                <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" placeholder="Contoh: G01, G02, dst." required>
            </div>
            <div class="form-group">
                <label for="nama_gejala">Nama Gejala (Berbentuk Pertanyaan)</label>
                <textarea class="form-control" id="nama_gejala" name="nama_gejala" rows="3" placeholder="Contoh: Apakah Anda menghabiskan waktu bermain game lebih lama dari yang direncanakan?" required></textarea>
            </div>
          
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>