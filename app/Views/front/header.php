<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LWM-RIS - Local Waste Management & Recycling Information System</title>
    
    <link href="<?= base_url('front/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">    
    <link rel="stylesheet" href="<?= base_url('front/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('front/swiper/swiper-bundle.min.css') ?>"> 
    <link href="<?= base_url('admin/assets/css/main.css') ?>" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hover-green{
            text-decoration: none;
            transition: color 0.3s ease;
       }
        .hover-green:hover {
            color: #006400;
        }
        .hero-section {
            background: url('front/assets/img/header.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 10rem 0;
            text-align: center;
        }
        .hero-section h1 {
            font-weight: 700;
            font-size: 3.5rem;
        }
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
            font-weight: 600;
            color: #333;
        }
        .card-icon {
            font-size: 3rem;
            color: #28a745;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .contact-section {
            background-color: #f8f9fa;
        }
        footer {
            background-color: #343a40;
            color: white;
        }
        .transition-hover:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 128, 0, 0.1);
            transform: translateY(-3px);
            transition: all 0.3s ease;
        }
        .green-input {
            border: 1px solid #2E7D32;
            color: #1B5E20;
        }
        .dropdown-menu-scrollable {
            max-height: 250px;
            overflow-y: auto;
        }
        .swiper-button-next::after,
        .swiper-button-prev::after {
            display: none; /* Hides the default Swiper arrow */
        }

        .swiper-button-next,
        .swiper-button-prev {
            background: transparent; /* Removes the white circle background */
        }

        /* ============================================
           RESPONSIVE STYLES FOR ALL DEVICES
        ============================================ */

        /* Mobile Flash Messages */
        @media (max-width: 576px) {
            #flash-message-container {
                width: calc(100% - 20px) !important;
                right: 10px !important;
                left: 10px !important;
                top: 70px !important;
            }
        }

        /* Hero Section Responsive */
        @media (max-width: 992px) {
            .hero-section {
                padding: 6rem 0;
            }
            .hero-section h1 {
                font-size: 2.5rem;
            }
            .hero-section p {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 4rem 0;
            }
            .hero-section h1 {
                font-size: 1.8rem;
                line-height: 1.3;
            }
            .hero-section p {
                font-size: 0.9rem;
            }
            .hero-section .btn-lg {
                padding: 0.5rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* Section Title Responsive */
        .section-title {
            font-size: 2rem;
        }
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.5rem;
                margin-bottom: 2rem;
            }
        }

        /* Cards Responsive */
        .card {
            margin-bottom: 1rem;
        }
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            .col-lg-4, .col-md-6 {
                margin-bottom: 1rem;
            }
        }

        /* Form Controls Responsive */
        @media (max-width: 768px) {
            .form-control-lg {
                font-size: 0.9rem;
                padding: 0.5rem 0.75rem;
            }
            .d-flex.justify-content-center.flex-wrap {
                flex-direction: column !important;
                align-items: center !important;
            }
            .d-flex.justify-content-center.flex-wrap select,
            .d-flex.justify-content-center.flex-wrap button {
                width: 100% !important;
                max-width: 100% !important;
                margin-bottom: 0.5rem;
            }
        }

        /* Navbar Mobile */
        @media (max-width: 992px) {
            .navbar-nav {
                padding-top: 1rem;
            }
            .navbar-nav .nav-link {
                padding: 0.5rem 0;
                border-bottom: 1px solid #eee;
            }
        }

        /* Swiper Navigation Responsive */
        @media (max-width: 576px) {
            .swiper-button-next,
            .swiper-button-prev {
                display: none;
            }
        }

        /* Contact Form Responsive */
        @media (max-width: 768px) {
            .contact-section .container {
                padding: 1rem;
            }
            .contact-section h2 {
                font-size: 1.5rem;
            }
        }

        /* Table Responsive */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        @media (max-width: 768px) {
            table {
                font-size: 0.85rem;
            }
            table th, table td {
                padding: 0.5rem;
                white-space: nowrap;
            }
        }

        /* Button Responsive */
        @media (max-width: 576px) {
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
            .btn-block {
                width: 100%;
            }
        }

        /* Modal Responsive */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 0.5rem;
            }
            .modal-body {
                padding: 1rem;
            }
        }

        /* Footer Responsive */
        @media (max-width: 576px) {
            footer {
                font-size: 0.85rem;
                padding: 1rem !important;
            }
        }

        /* Stats Cards Responsive */
        @media (max-width: 576px) {
            .h5.mb-0.font-weight-bold {
                font-size: 1.25rem;
            }
            .text-xs {
                font-size: 0.7rem;
            }
            .fa-2x {
                font-size: 1.5rem !important;
            }
        }

        /* General Text Responsiveness */
        @media (max-width: 576px) {
            .lead {
                font-size: 1rem;
            }
            p {
                font-size: 0.9rem;
            }
            .small, small {
                font-size: 0.75rem;
            }
        }

    </style>
</head>
<body>
    <script src="<?= base_url('front/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('admin/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#" style="color: #1B5E20;">
                <i class="fas fa-recycle"></i>
                LWM-RIS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link hover-green active" href="<?= base_url('/') ?>">Home</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link hover-green" href="<?= base_url('/#events') ?>">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-green" href="<?= base_url('/#recyclingcenters') ?>">Centers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-green" href="<?= base_url('/#contact') ?>">Contact Us</a>
                    </li>                  
                </ul>
            </div>
        </div>
    </nav>
