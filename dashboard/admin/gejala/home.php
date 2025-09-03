<?php
// Ambil data gejala dari database, diurutkan berdasarkan kode
$sql = "SELECT kode_gejala, nama_gejala FROM gejala ORDER BY kode_gejala ASC";
$result = $koneksidb->query($sql);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Daftar Gejala</h5>
                <a href="create.php" class="btn btn-success btn-sm" style="position: absolute; top: 10px; right: 10px;">
                    <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Tambah Gejala</span>
                </a>
            </div>
            <div class="card-body">
                <table id="gejalaTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Gejala</th>
                            <th>Nama Gejala (Pertanyaan)</th>
                            <th class="text-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['kode_gejala'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($row['nama_gejala'] ?? '-') ?></td>
                                    <td class="text-nowrap">
                                        <a href="edit.php?kode=<?= htmlspecialchars($row['kode_gejala']) ?>"
                                            class="btn btn-sm btn-warning">
                                            <i data-feather="edit-2"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="confirmDelete('<?= htmlspecialchars($row['kode_gejala']) ?>')">
                                            <i data-feather="trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>