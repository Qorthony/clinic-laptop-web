<?= $this->extend('admin/layout/adminLayout') ?>

<?= $this->section('content') ?>
<div class="container pt-5">
    <?php if (session('errors')) { ?>
        <?= $this->include("components/alert_error.php") ?>
    <?php } ?>

    <?php if (session('success')) { ?>
        <?= $this->include("components/alert_success.php") ?>
    <?php } ?>
    <div class="row mb-5 text-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Pendapatan Total</div>
                <div class="card-body">
                    <h1> Rp. <?= $pendapatan_total ? number_format($pendapatan_total) : 0  ?></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Pendapatan Tahun ini</div>
                <div class="card-body">
                    <h1> Rp. <?= $pendapatan_total ? number_format($pendapatan_tahun_ini) : 0  ?></h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Pendapatan Bulan ini</div>
                <div class="card-body">
                    <h1> Rp. <?= $pendapatan_bulan_ini ? number_format($pendapatan_bulan_ini) : 0  ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-dark" onclick="unduhLaporan()">Unduh sebagai Excel</button>
        </div>
        <div class="card-body">
            <table class="table" id="tabel-pendapatan">
                <thead>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kerusakan</th>
                    <th scope="col">Seri Laptop</th>
                    <th scope="col">Perbaikan</th>
                    <th scope="col">Pendapatan</th>
                </thead>
                <tbody>
                    <?php foreach ($data_pendapatan as $key => $value) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['tgl_diambil'] ?></td>
                            <td><?= $value['jenis_kerusakan'] ?></td>
                            <td><?= $value['seri_laptop'] ?></td>
                            <td><?= $value['ket_perbaikan'] ?></td>
                            <td>Rp. <?= $value['biaya_servis'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="/js/jquery.table2excel.min.js"></script>
<script>
    function unduhLaporan() {
        $("#tabel-pendapatan").table2excel({
            name: "Data_pendapatan",
    
            //  include extension also 
            filename: "Laporan_pendapatan.xls",
    
            // 'True' is set if background and font colors preserved 
            preserveColors: false
        });
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