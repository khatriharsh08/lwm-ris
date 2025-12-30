<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Password - LWM-RIS</title>

    <link href="<?= base_url('admin/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('admin/assets/css/main.css') ?>" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image" style="background-image: url('<?= base_url('admin/assets/img/login_bg.jpg') ?>'); background-size: cover; background-position: center;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">Enter your email address and we'll send you a link to reset your password.</p>
                                    </div>

                                    <?php if (session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger flash-message"><i class="fas fa-exclamation-circle mr-2"></i><?= session()->getFlashdata('error') ?></div>
                                    <?php endif; ?>

                                    <?php if (session()->getFlashdata('success')): ?>
                                        <div class="alert alert-success flash-message"><i class="fas fa-check-circle mr-2"></i><?= session()->getFlashdata('success') ?></div>
                                    <?php endif; ?>

                                    <?php if (isset($validation)): ?>
                                        <div class="alert alert-danger flash-message">
                                            <?= $validation->listErrors() ?>
                                        </div>
                                    <?php endif; ?>

                                    <form class="user" id="forgotPasswordForm" action="<?= site_url('forgot-password') ?>" method="post" novalidate>
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" 
                                                placeholder="Enter Email Address..." required>
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    
                                    <hr>
                                    
                                    <div class="text-center">
                                        <a class="small" href="<?= site_url('login') ?>">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('admin/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('admin/assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('admin/assets/js/sb-admin-2.min.js') ?>"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        function validateEmail(email) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        $('#email').on('blur', function() {
            var value = $(this).val().trim();
            if (value === '' || !validateEmail(value)) {
                $(this).addClass('is-invalid').removeClass('is-valid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        $('#email').on('focus', function() {
            $(this).removeClass('is-invalid is-valid');
        });

        $('#forgotPasswordForm').on('submit', function(e) {
            var email = $('#email').val().trim();
            if (email === '' || !validateEmail(email)) {
                $('#email').addClass('is-invalid');
                e.preventDefault();
            }
        });

        // Auto-hide flash messages after 5 seconds
        $('.flash-message').each(function() {
            var msg = $(this);
            setTimeout(function() {
                msg.fadeOut(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    });
    </script>

</body>

</html>
