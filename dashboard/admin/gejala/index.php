<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php';
session_start();
cek_admin();

// Menangani notifikasi flash message
$alert_script = '';
if (isset($_SESSION['flash_message'])) {
    $flash = $_SESSION['flash_message'];
    $type = htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8');
    $alert_script = "
        Swal.fire({
            icon: '{$type}',
            title: '{$message}',
            showConfirmButton: false,
            timer: 2500
        });
    ";
    unset($_SESSION['flash_message']);
}

// Konfigurasi Halaman
$page_title = 'Manajemen Gejala';
$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => base_url('dashboard/admin')],
    ['title' => 'Manajemen Gejala']
];

$delete_url = base_url('dashboard/admin/gejala/delete.php');

// JavaScript khusus untuk halaman ini (termasuk SweetAlert untuk notifikasi dan konfirmasi hapus)
$page_specific_js = <<<HTML
<script>
    function confirmDelete(kode) {
        const baseUrl = "{$delete_url}";
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Gejala ini mungkin terhubung dengan Basis Pengetahuan. Menghapusnya akan mempengaruhi aturan yang ada!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = baseUrl + '?kode=' + kode;
            }
        });
    }

    $(document).ready(function() {
        $('#gejalaTable').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "15%", "targets": 1 },
                { "targets": -1, "className": "text-nowrap", "orderable": false }
            ]
        });
        // Tampilkan notifikasi jika ada
        {$alert_script}
    });
</script>
HTML;

// Memuat konten view dan layout utama
$content = base_path('dashboard/admin/gejala/home.php');
include base_path('layout/main.php');
?>