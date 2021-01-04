<?= $this->extend('admin/layout/adminLayout') ?>

<?= $this->section('content') ?>
<div class="container pt-5">
    <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php } ?>
    <div class="card text-center">
        <div class="card-body">
            <h1 class="card-title">Selamat datang di Halaman Admin</h1>
            <p class="text-secondary">Silahkan pilih halaman yang ingin anda kunjungi</p>
            <div class="row">
                <div class="col-6 mb-4">
                    <a href="/admin/servis" class="text-white" style="text-decoration: none;">
                        <div class="card bg-info">
                            <div class="card-body">
                                <h1>Servis</h1>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 mb-4">
                    <a href="/admin/user" class="text-white" style="text-decoration: none;">
                        <div class="card bg-success">
                            <div class="card-body">
                                <h1>User</h1>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 mb-4">
                    <a href="/admin/profile" class="text-white" style="text-decoration: none;">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <h1>My Profile</h1>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 mb-4">
                    <a href="/admin/laporan" class="text-white" style="text-decoration: none;">
                        <div class="card bg-dark">
                            <div class="card-body">
                                <h1>Laporan</h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <div class="card-footer text-muted">
            <a class="btn btn-danger" href="/logout">logout</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>