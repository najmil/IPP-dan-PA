<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <link rel="stylesheet" href="<?=base_url()?>css/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?=base_url()?>css/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=base_url()?>css/adminlte.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="<?=base_url()?>plugins/toastr/toastr.min.css">
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
        <script src="<?=base_url()?>plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url()?>js/adminlte.min.js"></script>
        <!-- Toastr -->
        <script src="<?=base_url()?>plugins/toastr/toastr.min.js"></script>

        <script>
            $(document).ready(function () {
                // Add input event listeners to dynamically clear 'is-invalid' class and feedback messages
                $('#username').on('input', function () {
                    $(this).removeClass('is-invalid');
                    $('#username-feedback').html('');
                });

                $('#password').on('input', function () {
                    $(this).removeClass('is-invalid');
                    $('#password-feedback').html('');
                });

                $('form').on('submit', function (event) {
                    event.preventDefault();

                    // Serialize form data
                    var formData = $(this).serialize();

                    // Check if username and password are empty
                    var username = $('#username').val().trim();
                    var password = $('#password').val().trim();

                    // Remove 'is-invalid' class and clear feedback messages
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').html('');

                    // Check for empty values and display error messages
                    if (username === '') {
                        $('#username').addClass('is-invalid');
                        $('#username-feedback').html('Username is required.');
                    }

                    if (password === '') {
                        $('#password').addClass('is-invalid');
                        $('#password-feedback').html('Password is required.');
                    }

                    // If either username or password is empty, return without submitting the form
                    if (username === '' || password === '') {
                        return;
                    }

                    // Perform AJAX request
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        beforeSend: function () {
                            $('.btn-block').html('<i class="fas fa-spinner fa-spin"></i>');
                        },
                        complete: function () {
                            $('.btn-block').html('Sign In');
                        },
                        statusCode: {
                            400: function (error) {
                                if (error.responseJSON) {
                                    $.each(error.responseJSON, function (field, params) {
                                        $('#' + field).addClass('is-invalid');
                                        $('#' + field + '-feedback').html(params);
                                    });
                                } else {
                                    toastr.error('Validation failed. Please check your input.');
                                }
                            },
                            404: function (error) {
                                if (error.responseJSON && error.responseJSON.error) {
                                    toastr.error(error.responseJSON.error);
                                } else {
                                    toastr.error('Authentication failed');
                                }
                            }
                        },
                        success: function (response) {
                            console.log(response);
                            toastr.success('Log In Successful!');
                            // Redirect to the desired page
                            window.location = '<?= base_url('home/index'); ?>';
                        }
                    });
                });
            });
        </script>
    </body>
</html>
