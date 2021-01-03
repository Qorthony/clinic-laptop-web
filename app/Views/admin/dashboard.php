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
            <a href="/admin/servis" class="btn btn-primary">Pergi ke Halaman Atur Servis</a>
            <a href="/admin/profile" class="btn btn-success">Pergi ke Halaman Profil Anda</a>
        </div>
        <div class="card-footer text-muted">
            <a class="btn btn-danger" href="/logout">logout</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>