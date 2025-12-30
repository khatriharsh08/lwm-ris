<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LWM-RIS Login</title>

    <link href="<?= base_url('admin/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('admin/assets/css/main.css') ?>" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('admin/assets/img/login_bg.jpg')"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to LWM-RIS Admin Panel</h1>
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

                                    <form class="user" id="loginForm" action="<?= site_url('login'); ?>" method="post" novalidate>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" 
                                                placeholder="Enter Email Address..." required>
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password" required minlength="6">
                                            <div class="invalid-feedback">Password must be at least 6 characters.</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    
                                    <hr>
                                    
                                    <div class="text-center">
                                        <a class="small" href="<?= site_url('forgot-password') ?>">Forgot Password?</a>
                                    </div>
                                    <div class="text-center" style="display:none;">
                                        <a class="small" href="">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('admin/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('admin/assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('admin/assets/js/sb-admin-2.min.js') ?>"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        function validateEmail(email) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // Real-time validation on blur
        $('#email').on('blur', function() {
            var value = $(this).val().trim();
            if (value === '') {
                $(this).addClass('is-invalid').removeClass('is-valid');
            } else if (!validateEmail(value)) {
                $(this).addClass('is-invalid').removeClass('is-valid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        $('#password').on('blur', function() {
            var value = $(this).val();
            if (value.length < 6) {
                $(this).addClass('is-invalid').removeClass('is-valid');
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        // Clear validation on focus
        $('#email, #password').on('focus', function() {
            $(this).removeClass('is-invalid is-valid');
        });

        // Form submission validation
        $('#loginForm').on('submit', function(e) {
            var email = $('#email').val().trim();
            var password = $('#password').val();
            var isValid = true;

            if (email === '' || !validateEmail(email)) {
                $('#email').addClass('is-invalid');
                isValid = false;
            }

            if (password.length < 6) {
                $('#password').addClass('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Auto-hide flash messages after 5 seconds
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function(message) {
            setTimeout(function() {
                $(message).fadeOut(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    });
    </script>

</body>

</html>