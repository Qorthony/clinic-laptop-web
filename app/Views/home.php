<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Clinic Laptop Jombang</title>
    <meta name="description" content="Clini Laptop Jombang">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/">Clinic Laptop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <?php if (session('logged_in')) { ?>
                    <a class="nav-link active" href="/admin">Go to Admin <span class="sr-only">(current)</span></a>
                <?php } else { ?>
                    <a class="nav-link active" href="/login">Login <span class="sr-only">(current)</span></a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- Alert -->
    <?php if (session('errors')) { ?>
        <?= $this->include("components/alert_error.php") ?>
    <?php } ?>

    <?php if (session('success')) { ?>
        <?= $this->include("components/alert_success.php") ?>
    <?php } ?>
    <!-- Alert -->
    <div id="home-content" class="container-fluid">
        <div class="container text-center d-flex justify-content-center align-items-center">
            <div class="row flex-grow-1">
                <div class="col-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h1>Cek Servis</h1>
                            <form action="/cek" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nomor" name="nomor" placeholder="No Servis">
                                </div>
                                <button type="submit" class="btn btn-primary form-control">Cek Status</button>
                                <?php if (!empty($servis)) { ?>
                                    <!-- Modal Status Servis -->
                                    <div class="modal fade" id="statusServis" tabindex="-1" aria-labelledby="statusServisLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                    <h5 class="modal-title" id="statusServisLabel">Status Servis</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table text-left">
                                                        <tr>
                                                            <td>No Servis</td>
                                                            <td>: <?= $servis['no_servis'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Seri Laptop</td>
                                                            <td>: <?= $servis['seri_laptop'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kerusakan</td>
                                                            <td>: <?= $servis['jenis_kerusakan'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Perbaikan</td>
                                                            <td>: <?= $servis['ket_perbaikan'] ? $servis['ket_perbaikan'] : '-' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Biaya</td>
                                                            <td>: Rp. <?= $servis['biaya_servis'] ? $servis['biaya_servis'] : '-' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>: <?= $servis['status_servis'] ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Oke</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Status Servis -->
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/jquery-3.5.1.slim.min.js" ></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <?php if (!empty($servis)) { ?>
        <script>
            jQuery('#statusServis').modal('show')
        </script>
    <?php } ?>
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
</body>

</html>