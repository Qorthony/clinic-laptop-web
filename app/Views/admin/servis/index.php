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
        <div class="card-body d-flex justify-content-between align-items-baseline">
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#tambah">Tambah servis</button>
            <form class="form-inline" action="/admin/servis/search" method="GET">
                <label class="sr-only" for="cari">Cari</label>
                <input type="text" name="keyword" required class="form-control mb-2 mr-sm-2" id="cari" placeholder="contoh : asus (Tipe Laptop)">
                <select required name="field" id="field" class="form-control mb-2 mr-sm-2">
                    <option value="no_servis">No Servis</option>
                    <option value="tgl_masuk">Tgl Masuk</option>
                    <option value="jenis_kerusakan">Kerusakan</option>
                    <option value="pemilik">Pemilik</option>
                    <option value="tipe_laptop">Tipe Laptop</option>
                    <option value="serial_number">Serial Number</option>
                </select>
                <button type="submit" class="btn btn-primary mb-2">Cari</button>
            </form>
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
                                    <label for="keluhan">Keluhan</label>
                                    <textarea class="form-control" name="keluhan" id="keluhan" cols="30" rows="5"></textarea>
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
                                    <label for="kontak">Kontak</label>
                                    <input type="text" name="kontak" class="form-control" id="kontak" required placeholder="contoh : hahan">
                                </div>
                                <div class="form-group">
                                    <label for="tipe_laptop">Tipe Laptop</label>
                                    <input type="text" name="tipe_laptop" class="form-control" id="tipe_laptop" required placeholder="contoh : lenovo G40-45">
                                </div>
                                <div class="form-group">
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" name="serial_number" class="form-control" id="serial_number" required placeholder="contoh : lenovo G40-45">
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
        <div class="card-header d-flex justify-content-between align-items-baseline">
            <div>Daftar Servis</div>
            <div>
                <?php if (isset($_REQUEST['keyword'])) { ?>
                    <a href="/admin/servis" class="btn btn-dark">Tampilkan Semua</a>
                <?php } ?>
            </div>
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
                    <a class="nav-link" id="batal-tab" data-toggle="tab" href="#batal" role="tab" aria-controls="batal" aria-selected="false">Batal</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="diambil-tab" data-toggle="tab" href="#diambil" role="tab" aria-controls="diambil" aria-selected="false">Diambil</a>
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
                                <th scope="col">Tipe Laptop</th>
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
                                            <td><?= $value['tipe_laptop'] ?></td>
                                            <td><?= $value['pemilik'] ?></td>
                                            <td>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#editServis<?= $value['no_servis'] ?>"> <img src="/images/icons/jam-icon/delete.svg" alt=""> </button>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusServis<?= $value['no_servis'] ?>"><img src="/images/icons/jam-icon/pencil.svg" alt=""></button>
                                                <a href="/admin/servis/updateStatus/<?= $value["no_servis"] ?>/proses" class="btn btn-success">diproses <img src="/images/icons/jam-icon/arrow-right.svg" alt=""></a>
                                                <!-- Modal Edit Servis-->
                                                <div class="modal fade" id="editServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="editServisLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex">
                                                                <h5 class="modal-title" id="editServisLabel">Edit Data</h5>
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
                                                                        <label for="keluhan">Keluhan</label>
                                                                        <textarea required class="form-control" name="keluhan" id="keluhan" cols="30" rows="5"><?= $value["keluhan"] ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kerusakan">Kerusakan</label>
                                                                        <input required type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" value="<?= $value["jenis_kerusakan"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tipe_laptop">Tipe Laptop</label>
                                                                        <input required type="text" name="tipe_laptop" class="form-control" id="tipe_laptop" value="<?= $value["tipe_laptop"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="serial_number">Serial Number</label>
                                                                        <input required type="text" name="serial_number" class="form-control" id="serial_number" value="<?= $value["serial_number"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pemilik">Pemilik</label>
                                                                        <input required type="text" name="pemilik" class="form-control" id="pemilik" value="<?= $value["pemilik"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kontak">Kontak</label>
                                                                        <input required type="text" name="kontak" class="form-control" id="kontak" value="<?= $value["kontak"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                                                        <textarea required class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["kelengkapan_unit"] ?></textarea>
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
                                                <div class="modal fade" id="hapusServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusServisLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusServisLabel">Konfirmasi</h5>
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
                                <th scope="col">Tipe Laptop</th>
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
                                            <td><?= $value['tipe_laptop'] ?></td>
                                            <td><?= $value['kelengkapan_unit'] ?></td>
                                            <td><?= $value['pemilik'] ?></td>
                                            <td>
                                                <a href="/admin/servis/updateStatus/<?= $value["no_servis"] ?>/antrian" class="btn btn-warning">
                                                    <img src="/images/icons/jam-icon/arrow-left.svg" alt="">
                                                </a>
                                                <a href="/admin/servis/updateStatus/<?= $value["no_servis"] ?>/batal" class="btn btn-danger">
                                                    <img src="/images/icons/jam-icon/close-circle.svg" alt="">
                                                </a>
                                                        <button class="btn btn-success" data-toggle="modal" data-target="#updateToSelesai<?= $value['no_servis'] ?>"> <img src="/images/icons/jam-icon/arrow-right.svg" alt=""> </button> <br />
                                                        <button class="btn btn-light" data-toggle="modal" data-target="#editServis<?= $value['no_servis'] ?>"> <img src="/images/icons/jam-icon/pencil.svg" alt=""></button>
                                                        <button class="btn btn-light" data-toggle="modal" data-target="#hapusServis<?= $value['no_servis'] ?>"><img src="/images/icons/jam-icon/delete.svg" alt=""></button>
                                                        <!-- Modal update to selesai-->
                                                        <div class="modal fade" id="updateToSelesai<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="updateToSelesaiLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-flex">
                                                                        <h5 class="modal-title" id="updateToSelesaiLabel">Update Status</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="/admin/servis/updateToSelesai/<?= $value["no_servis"] ?>" method="POST">
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="no_servis">No Servis</label>
                                                                                <input required type="text" class="form-control" id="no_servis" disabled value="<?= $value["no_servis"] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="biaya">biaya</label>
                                                                                <input required type="number" name="biaya" class="form-control" id="biaya">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="ket_perbaikan">Perbaikan</label>
                                                                                <textarea class="form-control" name="ket_perbaikan" id="ket_perbaikan" cols="30" rows="5" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success">Update</button>
                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Keluar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Modal update to selesai -->
                                                        <!-- Modal Edit Servis<proses>-->
                                                        <div class="modal fade" id="editServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="editServisLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-flex">
                                                                        <h5 class="modal-title" id="editServisLabel">Edit Data</h5>
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
                                                                                <label for="keluhan">Keluhan</label>
                                                                                <textarea required class="form-control" name="keluhan" id="keluhan" cols="30" rows="5"><?= $value["keluhan"] ?></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="jenis_kerusakan">Kerusakan</label>
                                                                                <input required type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" value="<?= $value["jenis_kerusakan"] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="tipe_laptop">Tipe Laptop</label>
                                                                                <input required type="text" name="tipe_laptop" class="form-control" id="tipe_laptop" value="<?= $value["tipe_laptop"] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="serial_number">Serial Number</label>
                                                                                <input required type="text" name="serial_number" class="form-control" id="serial_number" value="<?= $value["serial_number"] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="pemilik">Pemilik</label>
                                                                                <input required type="text" name="pemilik" class="form-control" id="pemilik" value="<?= $value["pemilik"] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="kontak">Kontak</label>
                                                                                <input required type="text" name="kontak" class="form-control" id="kontak" value="<?= $value["kontak"] ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                                                                <textarea required class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["kelengkapan_unit"] ?></textarea>
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
                                                        <!-- End Modal Edit servis<proses> -->
                                                        <!-- Modal Hapus User -->
                                                        <div class="modal fade" id="hapusServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusServisLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                        <h5 class="modal-title" id="hapusServisLabel">Konfirmasi</h5>
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
                <div class="tab-pane fade" id="batal" role="tabpanel" aria-labelledby="batal-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Servis</th>
                                <th scope="col">Tgl Masuk</th>
                                <th scope="col">Kerusakan</th>
                                <th scope="col">Tipe Laptop</th>
                                <th scope="col">Kelengkapan_unit</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <?php if (empty($batal)) { ?>
                            <tr>
                                <td colspan="8" class="text-center text-secondary">Maaf, Data belum tersedia!</td>
                            <tr>
                            <?php } else { ?>
                                <tbody>
                                    <?php foreach ($batal as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value['no_servis'] ?></td>
                                            <td><?= $value['tgl_masuk'] ?></td>
                                            <td><?= $value['jenis_kerusakan'] ?></td>
                                            <td><?= $value['tipe_laptop'] ?></td>
                                            <td><?= $value['kelengkapan_unit'] ?></td>
                                            <td><?= $value['pemilik'] ?></td>
                                            <td>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusBatal<?= $value['no_servis'] ?>"><img src="/images/icons/jam-icon/delete.svg" alt=""></button>

                                                <!-- Modal Hapus User -->
                                                <div class="modal fade" id="hapusBatal<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusBatalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusServisLabel">Konfirmasi</h5>
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
                                <th scope="col" colspan="2">Keterangan Servis</th>
                                <th scope="col" colspan="2">Keterangan Laptop</th>
                                <th scope="col" colspan="2">Keterangan Perbaikan</th>
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
                                            <td rowspan="3"><?= $key + 1 ?></td>
                                            <td>No Servis</td>
                                            <td>: <?= $value['no_servis'] ?></td>
                                            <td>Seri</td>
                                            <td>: <?= $value['tipe_laptop'] ?></td>
                                            <td>Biaya</td>
                                            <td>: <?= $value['biaya_servis'] ?></td>
                                            <td rowspan="3">
                                                <button class="btn btn-secondary" data-toggle="modal" data-target="#notaServis<?= $value['no_servis'] ?>"><img src="/images/icons/jam-icon/printer.svg" alt=""></button>
                                                <a href="/admin/servis/updateToDiambil/<?= $value["no_servis"] ?>" class="btn btn-warning">
                                                    <img src="/images/icons/jam-icon/arrow-right.svg" alt="">
                                                </a> <br>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#editServis<?= $value['no_servis'] ?>"><img src="/images/icons/jam-icon/pencil.svg" alt=""></button>
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusServis<?= $value['no_servis'] ?>"><img src="/images/icons/jam-icon/delete.svg" alt=""></button>
                                                <!-- Modal print nota -->
                                                <div class="modal fade" id="notaServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="notaServisLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="notaServisLabel">Print Nota</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="nota">
                                                                    <div class="nota-header text-center">
                                                                        <h5>Clinic Laptop</h5>
                                                                    </div>
                                                                    <div class="nota-body">
                                                                        <table class="table">
                                                                            <tr>
                                                                                <td>Pemilik</td>
                                                                                <td>: <?= $value['pemilik'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tipe Laptop</td>
                                                                                <td>: <?= $value['tipe_laptop'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Perbaikan</td>
                                                                                <td>: <?= $value['ket_perbaikan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Biaya</td>
                                                                                <td>: Rp. <?= $value['biaya_servis'] ?></td>
                                                                            </tr>

                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-info" onclick="cetakNota(<?= $key ?>)">Cetak</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal print nota -->
                                                <!-- Modal Edit User-->
                                                <div class="modal fade" id="editServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="editServisLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex">
                                                                <h5 class="modal-title" id="editServisLabel">Edit Data</h5>
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
                                                                        <label for="keluhan">Keluhan</label>
                                                                        <textarea required class="form-control" name="keluhan" id="keluhan" cols="30" rows="5"><?= $value["keluhan"] ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jenis_kerusakan">Kerusakan</label>
                                                                        <input required type="text" name="jenis_kerusakan" class="form-control" id="jenis_kerusakan" value="<?= $value["jenis_kerusakan"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tipe_laptop">Tipe Laptop</label>
                                                                        <input required type="text" name="tipe_laptop" class="form-control" id="tipe_laptop" value="<?= $value["tipe_laptop"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="serial_number">Serial Number</label>
                                                                        <input required type="text" name="serial_number" class="form-control" id="serial_number" value="<?= $value["serial_number"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="pemilik">Pemilik</label>
                                                                        <input required type="text" name="pemilik" class="form-control" id="pemilik" value="<?= $value["pemilik"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kontak">Kontak</label>
                                                                        <input required type="text" name="kontak" class="form-control" id="kontak" value="<?= $value["kontak"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="kelengkapan_unit">Kelengkapan Unit</label>
                                                                        <textarea required class="form-control" name="kelengkapan_unit" id="kelengkapan_unit" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["kelengkapan_unit"] ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="biaya_servis">Biaya</label>
                                                                        <input required type="number" name="biaya_servis" class="form-control" id="biaya_servis" value="<?= $value["biaya_servis"] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ket_perbaikan">Perbaikan</label>
                                                                        <textarea class="form-control" name="ket_perbaikan" id="ket_perbaikan" cols="30" rows="5" placeholder="contoh : ram 4gb, harddisk 500gb"><?= $value["ket_perbaikan"] ?></textarea>
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
                                                <div class="modal fade" id="hapusServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusServisLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusServisLabel">Konfirmasi</h5>
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
                                        <tr>
                                            <td>Tgl_masuk</td>
                                            <td>: <?= $value['tgl_masuk'] ?></td>
                                            <td>Kelengkapan Unit</td>
                                            <td>: <?= $value['kelengkapan_unit'] ?></td>
                                            <td>Perbaikan</td>
                                            <td rowspan="2">: <?= $value['ket_perbaikan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kerusakan</td>
                                            <td>: <?= $value['jenis_kerusakan'] ?></td>
                                            <td>Pemilik</td>
                                            <td>: <?= $value['pemilik'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-info" colspan="8"></td>
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
                                <th scope="col" colspan="2">Keterangan Servis</th>
                                <th scope="col" colspan="2">Keterangan Laptop</th>
                                <th scope="col" colspan="2">Keterangan Perbaikan</th>
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
                                            <td rowspan="4"><?= $key + 1 ?></td>
                                            <td>No Servis</td>
                                            <td>: <?= $value['no_servis'] ?></td>
                                            <td>Seri</td>
                                            <td>: <?= $value['tipe_laptop'] ?></td>
                                            <td>Biaya</td>
                                            <td>: <?= $value['biaya_servis'] ?></td>
                                            <td rowspan="3">
                                                <button class="btn btn-light" data-toggle="modal" data-target="#hapusServis<?= $value['no_servis'] ?>"><img src="/images/icons/jam-icon/delete.svg" alt=""></button>

                                                <!-- Modal Hapus User -->
                                                <div class="modal fade" id="hapusServis<?= $value['no_servis'] ?>" tabindex="-1" aria-labelledby="hapusServisLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                                <h5 class="modal-title" id="hapusServisLabel">Konfirmasi</h5>
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
                                        <tr>
                                            <td>Tgl_masuk</td>
                                            <td>: <?= $value['tgl_masuk'] ?></td>
                                            <td>Kelengkapan Unit</td>
                                            <td>: <?= $value['kelengkapan_unit'] ?></td>
                                            <td>Perbaikan</td>
                                            <td rowspan="2">: <?= $value['ket_perbaikan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kerusakan</td>
                                            <td>: <?= $value['jenis_kerusakan'] ?></td>
                                            <td>Pemilik</td>
                                            <td>: <?= $value['pemilik'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-dark text-white text-center font-weight-bold" colspan="7">Tanggal Diambil : <?= $value['tgl_diambil'] ?></td>
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
<script>
    function cetakNota(index) {
        const printArea = document.getElementsByClassName("nota")[index];
        const initPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0')
        initPrint.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">')
        initPrint.document.write(printArea.innerHTML)
        initPrint.document.close()
        initPrint.focus()
        initPrint.print()
    }
</script>

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