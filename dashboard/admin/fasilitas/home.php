<?php
// Ambil data fasilitas dari database
$sql = "SELECT id, nama_fasilitas, deskripsi FROM fasilitas_wisata ORDER BY id DESC";
$result = $koneksidb->query($sql);
?>
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Daftar Fasilitas</h3>
        <div class="card-tools">
            <a href="create.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Fasilitas</a>
        </div>
    </div>
    <div class="card-body">
        <table id="fasilitasTable" class="table table-bordered table-hover" style="width:100%">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Fasilitas</th>
                    <th>Deskripsi</th>
                    <th class="text-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_fasilitas'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['deskripsi'] ?? '-') ?></td>
                            <td class="text-nowrap">
                                <a href="edit.php?id=<?= (int) $row['id'] ?>" class="btn btn-sm btn-warning mr-1"><i
                                        class="fas fa-edit"></i> Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= (int) $row['id'] ?>)"><i
                                        class="fas fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>