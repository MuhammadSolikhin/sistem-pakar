<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <strong class="text-muted">Sistem Pakar</strong> &copy; <?= date('Y') ?>
                </p>
            </div>
        </div>
    </div>
</footer>
</main>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="<?= base_url('config/assets/adminkit/js/app.js') ?>"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<?php if (isset($page_specific_js)): ?>
    <?= $page_specific_js ?>
<?php endif; ?>

</body>

</html>