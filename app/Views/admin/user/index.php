<?= $this->extend('admin/layout/adminLayout') ?>

<?= $this->section('content') ?>
<?php if (session('errors')) { ?>
    <?= $this->include("components/alert_error.php") ?>
<?php } ?>

<?php if (session('success')) { ?>
    <?= $this->include("components/alert_success.php") ?>
<?php } ?>
<div class="container">
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <div class="row pb-3 pt-2">
                            <div class="col-3">
                                <form action="/admin/user/search" method="get">
                                    <input required name="keyword" type="text" class="form-control" placeholder="Cari User">
                                </form>
                            </div>
                            <div class="col text-right">
                                <?php if (isset($_REQUEST['keyword'])) { ?>
                                    <a href="/admin/user" class="btn btn-success">Tampilkan Semua</a>
                                <?php } ?>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUser"><i data-feather="plus-circle"></i> Tambah Data</button>
                            </div>
                            <?= $this->include("components/user/modal_tambah_user.php") ?>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">peran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <?php if (empty($data_users)) { ?>
                            <tr>
                                <td colspan="6" class="text-center text-secondary">Maaf, Data belum tersedia!</td>
                            <tr>
                            <?php } else { ?>
                                <tbody>
                                    <?php foreach ($data_users as $key => $x) : ?>
                                        <tr>
                                            <th scope="row"><?= $key + 1 ?></th>
                                            <td> <?= $x["nama_user"] ?> </td>
                                            <td><?= $x["email"] ?></td>
                                            <td><?= $x["peran"]==1?'admin':'pegawai' ?></td>
                                            <td>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#editUser<?= $key ?>">Edit</button>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusUser<?= $key ?>">Hapus</button>
                                                <!-- Modal Edit User-->
                                                <div class="modal fade" id="editUser<?= $key ?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex">
                                                                <h5 class="modal-title" id="editUserLabel">Edit Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="/admin/user/edit/<?= $x["id_user"] ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama</label>
                                                                        <input required type="text" name="nama" class="form-control" id="nama" value="<?= $x["nama_user"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">Email</label>
                                                                        <input required type="text" name="email" class="form-control" id="email" value="<?= $x["email"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="peran">Peran</label>
                                                                        <select name="peran" class="form-control" id="peran">
                                                                            <?php switch ($x["peran"]) {
                                                                                case 1: ?>
                                                                                    <option value="1" selected>Admin</option>
                                                                                    <option value="2">Pegawai</option>
                                                                                <?php
                                                                                    break;
                                                                                case 2: ?>
                                                                                    <option value="1">Admin</option>
                                                                                    <option value="2" selected>Pegawai</option>
                                                                                <?php
                                                                                    break;

                                                                                default:
                                                                                    # code...
                                                                                    break;
                                                                            } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password">Password</label>
                                                                        <div class="d-flex">
                                                                            <input type="text" name="password" class="form-control pw" id="password">
                                                                            <button type="button" class="btn btn-secondary ml-1 generate-pw" id="generate-pw">Generate</button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Ubah</button>
                                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Keluar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Edit User -->
                                                <!-- Modal Hapus User -->
                                                <div class="modal fade" id="hapusUser<?= $key ?>" tabindex="-1" aria-labelledby="hapusUserLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusUserLabel">Konfirmasi</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/admin/user/del/<?= $x["id_user"] ?>" class="btn btn-danger">Hapus</a>
                                                                <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal hapus user -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<?php if (session('errors')) { ?>
    <script>
        jQuery('#alertError').modal('show')
    </script>
<?php } ?>

<?php if (session('success')) { ?>
    <script>
        jQuery('#alertSuccess').modal('show')
    </script>
<?php } ?>
<?= $this->endSection('script') ?>