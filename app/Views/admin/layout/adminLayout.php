<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
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

    <script src="/js/jquery-3.5.1.slim.min.js" ></script>
    <script src="/js/bootstrap.bundle.min.js"></script>

    <?= $this->renderSection('script') ?>
</body>

</html>
