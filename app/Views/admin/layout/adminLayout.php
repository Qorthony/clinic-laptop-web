<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-blue">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">
            <h5>Clinic Laptop</h5>
            <!-- <img class="img-fluid" width="200" src="/gambar/pertamini.png" alt="logo_pertaminiinaja"> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php $uri = explode("/",uri_string());
                  $key = array_key_last($uri);
                  $hal = $uri[$key];
             ?>
            <ul class="navbar-nav">
                <li class="nav-item <?= $hal=='admin'?'active':'' ?>">
                    <a class="nav-link" href="/admin"> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?= $hal=='servis'?'active':'' ?>">
                    <a class="nav-link" href="/admin/servis">Servis</a>
                </li>
                <?php if ( session('user_role')==1 ) {?>
                    <li class="nav-item <?= $hal=='user'?'active':'' ?>">
                        <a class="nav-link" href="/admin/user">User</a>
                    </li>
                <?php } ?>
                <li class="nav-item <?= $hal=='profile'?'active':'' ?>">
                    <a class="nav-link" href="/admin/profile">My Profil</a>
                </li>
                <?php if ( session('user_role')==1 ) {?>
                    <li class="nav-item <?= $hal=='laporan'?'active':'' ?>">
                        <a class="nav-link" href="/admin/laporan">Laporan</a>
                    </li>
                <?php } ?>
            </ul>
            <a class="btn btn-danger d-flex ml-auto" href="/logout">logout</a>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>