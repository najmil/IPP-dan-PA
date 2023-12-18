<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?= base_url('/img/icon-cbi.png') ?>" type="image/x-icon">
        <title>Individual Performance Planning</title>
        <style>
            @font-face {
                font-family: 'sourcesans';
                src: url('/font/static/SourceSans3-Regular.ttf') format('truetype');
            }

            .custom-font {
                font-family: 'source-sans-regular', sans-serif;
                color: #333;
            }
        </style>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/css/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="/css/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/css/adminlte.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
    </head>

    <body class="hold-transition login-page">
        <?php
        // $db = db_connect();

        // $query = $db->query("SELECT * FROM periode");

        // foreach($query->getResult() as $row){
        //     echo $row->name;
        // }
        ?>
        <div class="login-box">
        <div class="card custom-font">
            <div class="card-body login-card-body">
                <div class="text-center mb-4">
                    <h1 class="align-center">SIGN IN</h1>
                    <p>Individual Performnce Planning</p>
                </div>

            <form action="<?= base_url("/login/loginToExternalApi") ?>" method="post">
                <?= csrf_field(); ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <div id="username-feedback" class="invalid-feedback"></div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <div id="password-feedback" class="invalid-feedback"></div>
                </div>

                <div class="row">
                <div class="col-8"></div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block" id="tombolMasuk">Sign In</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
            
            </div>
            <!-- /.login-card-body -->
        </div>
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/js/adminlte.min.js"></script>
        <!-- Toastr -->
        <script src="/plugins/toastr/toastr.min.js"></script>

        
    </body>
</html>
