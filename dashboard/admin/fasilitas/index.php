<?php
include '../../../config/config.php';
include '../../../config/koneksi.php';
include '../../../config/functions.php'; // Pastikan ada file ini
session_start();
cek_admin();

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

$page_title = 'Manajemen Fasilitas';
$breadcrumbs = [
    ['title' => 'Dashboard', 'link' => base_url('dashboard/admin')],
    ['title' => 'Manajemen Fasilitas']
];

$delete_url = base_url('dashboard/admin/fasilitas/delete.php');
$page_specific_js = <<<HTML
<script>
    function confirmDelete(id) {
        const baseUrl = "{$delete_url}";
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data fasilitas ini tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = baseUrl + '?id=' + id;
            }
        });
    }

    $(document).ready(function() {
        $('#fasilitasTable').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "columnDefs": [
                { "targets": -1, "className": "text-nowrap", "orderable": false }
            ]
        });
        {$alert_script}
    });
</script>
HTML;

$content = base_path('dashboard/admin/fasilitas/home.php');
include base_path('layout/main.php');
?>