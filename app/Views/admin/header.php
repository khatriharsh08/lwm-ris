<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LWM-RIS</title>

    <!-- Custom fonts for this template-->

    <link href="front\bootstrap\css\bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('admin/assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('admin/assets/css/main.css') ?>" rel="stylesheet">
    
    <!-- Responsive Admin Styles -->
    <style>
        /* ============================================
           ADMIN RESPONSIVE STYLES
        ============================================ */
        
        /* Mobile Flash Messages */
        @media (max-width: 576px) {
            #flash-message-container {
                width: calc(100% - 20px) !important;
                right: 10px !important;
                left: 10px !important;
                top: 70px !important;
            }
            .flash-message {
                font-size: 0.85rem;
            }
        }
        
        /* Sidebar Mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 0 !important;
            }
            .sidebar.toggled {
                width: 6.5rem !important;
            }
        }
        
        /* Content Area Mobile */
        @media (max-width: 768px) {
            #content-wrapper {
                padding: 0 !important;
            }
            .container-fluid {
                padding: 0.75rem !important;
            }
        }
        
        /* Cards Responsive */
        @media (max-width: 576px) {
            .card {
                margin-bottom: 1rem;
            }
            .card-header {
                padding: 0.75rem;
            }
            .card-body {
                padding: 0.75rem;
            }
            .card-header h6 {
                font-size: 0.9rem;
            }
        }
        
        /* Stats Cards Mobile */
        @media (max-width: 576px) {
            .h5.mb-0.font-weight-bold {
                font-size: 1.1rem;
            }
            .text-xs {
                font-size: 0.65rem;
            }
            .fa-2x {
                font-size: 1.5rem !important;
            }
        }
        
        /* Table Responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        @media (max-width: 768px) {
            table.dataTable {
                font-size: 0.8rem;
            }
            table th, table td {
                padding: 0.4rem !important;
                white-space: nowrap;
            }
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                text-align: left !important;
                margin-bottom: 0.5rem;
            }
            .dataTables_wrapper .dataTables_filter input {
                width: 100% !important;
            }
        }
        
        /* Modal Responsive */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }
            .modal-header {
                padding: 0.75rem;
            }
            .modal-body {
                padding: 0.75rem;
            }
            .modal-footer {
                padding: 0.5rem;
            }
            .modal-title {
                font-size: 1rem;
            }
        }
        
        /* Form Controls Mobile */
        @media (max-width: 576px) {
            .form-control {
                font-size: 0.9rem;
            }
            .form-group label {
                font-size: 0.85rem;
            }
            .btn {
                padding: 0.4rem 0.75rem;
                font-size: 0.85rem;
            }
        }
        
        /* Page Heading Mobile */
        @media (max-width: 576px) {
            .h3.mb-0 {
                font-size: 1.25rem;
            }
            .d-sm-inline-block {
                display: block !important;
                width: 100%;
                margin-top: 0.5rem;
            }
        }
        
        /* Topbar Mobile */
        @media (max-width: 576px) {
            .topbar {
                height: auto;
                padding: 0.5rem;
            }
            .topbar .nav-item .nav-link {
                padding: 0.5rem;
            }
            .dropdown-menu {
                min-width: 100%;
            }
        }
        
        /* Search Form Mobile */
        @media (max-width: 768px) {
            .card-header .row {
                flex-direction: column;
            }
            .card-header .col-md-4,
            .card-header .col-md-3 {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
        
        /* Action Buttons Mobile */
        @media (max-width: 576px) {
            .btn-group .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
            .btn i {
                font-size: 0.8rem;
            }
        }
    </style>

</head>

<body id="page-top">

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('admin/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('admin/assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="sidebar-brand-text mx-3">LWM-RIS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('wastecategory') ?>">
                <i class="fas fa-trash-alt"></i>   
                <span>Waste Category</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('recyclingcenter') ?>">
                <i class="fas fa-recycle"></i> 
                <span>Recycling Centers</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('eventsseminar') ?>">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Events/Seminars</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('contactmessage') ?>">
                    <i class="fas fa-comments"></i>
                    <span>Contact Messages</span></a>
            </li>

            <?php if (session()->get('is_master')): ?>
            <!-- Master Admin Only -->
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('admins') ?>">
                    <i class="fas fa-users-cog"></i>
                    <span>Manage Admins</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('activitylog') ?>">
                    <i class="fas fa-history"></i>
                    <span>Activity Logs</span></a>
            </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Dropdown -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url('uploads/users/'.session()->get('user_photo')) ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('user/profile')?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('logout');?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">