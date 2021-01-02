<?= $this->extend('admin/layout/adminLayout') ?>

<?= $this->section('content') ?>
<div class="container pt-5">
    <?php if (session('errors')) { ?>
        <?= $this->include("components/alert_error.php") ?>
    <?php } ?>

    <?php if (session('success')) { ?>
        <?= $this->include("components/alert_success.php") ?>
    <?php } ?>

    <div class="card mb-3">
        <div class="card-header">
            Action
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah servis</button>

            <!-- Modal Tambah Servis -->
            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahLabel">Tambah servis</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/servis/create" method="POST">
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Masuk</label>
                                    <input type="date" autofocus name="tgl_masuk" class="form-control" id="tgl_masuk" required value="<?= date('Y-m-d', strtotime("now")) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kerusakan">Kerusakan</label>
                                    <input type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" required placeholder="contoh : layar mati">
                                </div>
                                <div class="form-group">
                                    <label for="pemilik">Pemilik</label>
                                    <input type="text" name="pemilik" class="form-control" id="pemilik" required placeholder="contoh : hahan">
                                </div>
                                <div class="form-group">
                                    <label for="seri_laptop">Seri Laptop</label>
                                    <input type="text" name="seri_laptop" class="form-control" id="seri_laptop" required placeholder="contoh : lenovo G40-45">
                                </div>
                                <div class="form-group">
                                    <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                    <textarea class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"></textarea>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Daftar servis
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="antrian-tab" data-toggle="tab" href="#antrian" role="tab" aria-controls="antrian" aria-selected="true">Antrian</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="proses-tab" data-toggle="tab" href="#proses" role="tab" aria-controls="proses" aria-selected="false">Proses</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="diambil-tab" data-toggle="tab" href="#diambil" role="tab" aria-controls="diambil" aria-selected="false">diambil</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="antrian" role="tabpanel" aria-labelledby="antrian-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Servis</th>
                                <th scope="col">Tgl Masuk</th>
                                <th scope="col">Kerusakan</th>
                                <th scope="col">Seri Laptop</th>
                                <th scope="col">Kelengkapan_unit</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php if (empty($antrian)) { ?>
                            <tr>
                                <td colspan="8" class="text-center text-secondary">Maaf, Data belum tersedia!</td>
                            <tr>
                            <?php } else { ?>
                                <tbody>
                                    <?php foreach ($antrian as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value['no_servis'] ?></td>
                                            <td><?= $value['tgl_masuk'] ?></td>
                                            <td><?= $value['jenis_kerusakan'] ?></td>
                                            <td><?= $value['seri_laptop'] ?></td>
                                            <td><?= $value['kelengkapan_unit'] ?></td>
                                            <td><?= $value['pemilik'] ?></td>
                                            <td>
                                                <a href="/admin/servis/updateStatus/<?= $value["no_servis"] ?>/proses" class="btn btn-success">diproses -></a>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#editAkun<?= $value['no_servis'] ?>">Edit</button>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusAkun<?= $value['no_servis'] ?>">Hapus</button>
                                                <!-- Modal Edit User-->
                                                <div class="modal fade" id="editAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="editAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex">
                                                                <h5 class="modal-title" id="editAkunLabel">Edit Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="/admin/servis/update/<?= $value["no_servis"] ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="no_servis">No Servis</label>
                                                                        <input required type="text" class="form-control" id="no_servis" disabled value="<?= $value["no_servis"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_masuk">Tgl Masuk</label>
                                                                        <input required type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= $value["tgl_masuk"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kerusakan">Kerusakan</label>
                                                                        <input required type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" value="<?= $value["jenis_kerusakan"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="seri_laptop">Seri Laptop</label>
                                                                        <input required type="text" name="seri_laptop" class="form-control" id="seri_laptop" value="<?= $value["seri_laptop"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pemilik">Pemilik</label>
                                                                        <input required type="text" name="pemilik" class="form-control" id="pemilik" value="<?= $value["pemilik"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                                                        <textarea class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["kelengkapan_unit"] ?></textarea>
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
                                                <div class="modal fade" id="hapusAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusAkunLabel">Konfirmasi</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/admin/servis/delete/<?= $value["no_servis"] ?>" class="btn btn-danger">Hapus</a>
                                                                <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal hapus user -->
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="proses" role="tabpanel" aria-labelledby="proses-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Servis</th>
                                <th scope="col">Tgl Masuk</th>
                                <th scope="col">Kerusakan</th>
                                <th scope="col">Seri Laptop</th>
                                <th scope="col">Kelengkapan_unit</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php if (empty($proses)) { ?>
                            <tr>
                                <td colspan="8" class="text-center text-secondary">Maaf, Data belum tersedia!</td>
                            <tr>
                            <?php } else { ?>
                                <tbody>
                                    <?php foreach ($proses as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value['no_servis'] ?></td>
                                            <td><?= $value['tgl_masuk'] ?></td>
                                            <td><?= $value['jenis_kerusakan'] ?></td>
                                            <td><?= $value['seri_laptop'] ?></td>
                                            <td><?= $value['kelengkapan_unit'] ?></td>
                                            <td><?= $value['pemilik'] ?></td>
                                            <td>
                                            <a href="/admin/servis/updateStatus/<?= $value["no_servis"] ?>/antrian" class="btn btn-success"><- antrian</a>
                                            <a href="/admin/servis/updateStatus/<?= $value["no_servis"] ?>/selesai" class="btn btn-success">selesai -></a>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#editAkun<?= $value['no_servis'] ?>">Edit</button>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusAkun<?= $value['no_servis'] ?>">Hapus</button>
                                                <!-- Modal Edit User-->
                                                <div class="modal fade" id="editAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="editAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex">
                                                                <h5 class="modal-title" id="editAkunLabel">Edit Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="/admin/servis/update/<?= $value["no_servis"] ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="no_servis">No Servis</label>
                                                                        <input required type="text" class="form-control" id="no_servis" disabled value="<?= $value["no_servis"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_masuk">Tgl Masuk</label>
                                                                        <input required type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= $value["tgl_masuk"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kerusakan">Kerusakan</label>
                                                                        <input required type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" value="<?= $value["jenis_kerusakan"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="seri_laptop">Seri Laptop</label>
                                                                        <input required type="text" name="seri_laptop" class="form-control" id="seri_laptop" value="<?= $value["seri_laptop"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pemilik">Pemilik</label>
                                                                        <input required type="text" name="pemilik" class="form-control" id="pemilik" value="<?= $value["pemilik"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                                                        <textarea class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["kelengkapan_unit"] ?></textarea>
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
                                                <div class="modal fade" id="hapusAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusAkunLabel">Konfirmasi</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/admin/servis/delete/<?= $value["no_servis"] ?>" class="btn btn-danger">Hapus</a>
                                                                <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal hapus user -->
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Servis</th>
                                <th scope="col">Tgl Masuk</th>
                                <th scope="col">Kerusakan</th>
                                <th scope="col">Seri Laptop</th>
                                <th scope="col">Kelengkapan_unit</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php if (empty($selesai)) { ?>
                            <tr>
                                <td colspan="8" class="text-center text-secondary">Maaf, Data belum tersedia!</td>
                            <tr>
                            <?php } else { ?>
                                <tbody>
                                    <?php foreach ($selesai as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value['no_servis'] ?></td>
                                            <td><?= $value['tgl_masuk'] ?></td>
                                            <td><?= $value['jenis_kerusakan'] ?></td>
                                            <td><?= $value['seri_laptop'] ?></td>
                                            <td><?= $value['kelengkapan_unit'] ?></td>
                                            <td><?= $value['pemilik'] ?></td>
                                            <td>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#editAkun<?= $value['no_servis'] ?>">Edit</button>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusAkun<?= $value['no_servis'] ?>">Hapus</button>
                                                <!-- Modal Edit User-->
                                                <div class="modal fade" id="editAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="editAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex">
                                                                <h5 class="modal-title" id="editAkunLabel">Edit Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="/admin/servis/update/<?= $value["no_servis"] ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="no_servis">No Servis</label>
                                                                        <input required type="text" class="form-control" id="no_servis" disabled value="<?= $value["no_servis"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_masuk">Tgl Masuk</label>
                                                                        <input required type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= $value["tgl_masuk"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kerusakan">Kerusakan</label>
                                                                        <input required type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" value="<?= $value["jenis_kerusakan"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="seri_laptop">Seri Laptop</label>
                                                                        <input required type="text" name="seri_laptop" class="form-control" id="seri_laptop" value="<?= $value["seri_laptop"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pemilik">Pemilik</label>
                                                                        <input required type="text" name="pemilik" class="form-control" id="pemilik" value="<?= $value["pemilik"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                                                        <textarea class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["kelengkapan_unit"] ?></textarea>
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
                                                <div class="modal fade" id="hapusAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusAkunLabel">Konfirmasi</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/admin/servis/delete/<?= $value["no_servis"] ?>" class="btn btn-danger">Hapus</a>
                                                                <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal hapus user -->
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            <?php } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="diambil" role="tabpanel" aria-labelledby="diambil-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Servis</th>
                                <th scope="col">Tgl Masuk</th>
                                <th scope="col">Kerusakan</th>
                                <th scope="col">Seri Laptop</th>
                                <th scope="col">Kelengkapan_unit</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php if (empty($diambil)) { ?>
                            <tr>
                                <td colspan="8" class="text-center text-secondary">Maaf, Data belum tersedia!</td>
                            <tr>
                            <?php } else { ?>
                                <tbody>
                                    <?php foreach ($diambil as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value['no_servis'] ?></td>
                                            <td><?= $value['tgl_masuk'] ?></td>
                                            <td><?= $value['jenis_kerusakan'] ?></td>
                                            <td><?= $value['seri_laptop'] ?></td>
                                            <td><?= $value['kelengkapan_unit'] ?></td>
                                            <td><?= $value['pemilik'] ?></td>
                                            <td>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#editAkun<?= $value['no_servis'] ?>">Edit</button>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusAkun<?= $value['no_servis'] ?>">Hapus</button>
                                                <!-- Modal Edit User-->
                                                <div class="modal fade" id="editAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="editAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex">
                                                                <h5 class="modal-title" id="editAkunLabel">Edit Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="/admin/servis/update/<?= $value["no_servis"] ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="no_servis">No Servis</label>
                                                                        <input required type="text" class="form-control" id="no_servis" disabled value="<?= $value["no_servis"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_masuk">Tgl Masuk</label>
                                                                        <input required type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" value="<?= $value["tgl_masuk"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kerusakan">Kerusakan</label>
                                                                        <input required type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" value="<?= $value["jenis_kerusakan"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="seri_laptop">Seri Laptop</label>
                                                                        <input required type="text" name="seri_laptop" class="form-control" id="seri_laptop" value="<?= $value["seri_laptop"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pemilik">Pemilik</label>
                                                                        <input required type="text" name="pemilik" class="form-control" id="pemilik" value="<?= $value["pemilik"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                                                        <textarea class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["kelengkapan_unit"] ?></textarea>
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
                                                <div class="modal fade" id="hapusAkun<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusAkunLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusAkunLabel">Konfirmasi</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="/admin/servis/delete/<?= $value["no_servis"] ?>" class="btn btn-danger">Hapus</a>
                                                                <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal hapus user -->
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
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