<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <div class="background-login">
        <div class="login-wrapper">
            <div class="card">
                <div class="card-body">
                    <a class="navbar-brand mb-2" href="/">
                        <h5>Clinic Laptop Jombang</h5>
                        <!-- <img class="img-fluid" src="/gambar/pertamini.png" alt="logo_pertaminiinaja"> -->
                    </a>
                    <!-- <h5 class="text-center text-color">Login</h5> -->
                    <form action="/login" method="post">
                        <?= csrf_field() ?>
                        <?php if (session()->getFlashdata('errors')) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('errors') ?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script src="/js/jquery-3.5.1.slim.min.js" ></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>