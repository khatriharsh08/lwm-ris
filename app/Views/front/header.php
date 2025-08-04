<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LWM-RIS - Local Waste Management & Recycling Information System</title>
    
    <link href="front\bootstrap\css\bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="front\fontawesome\css\all.min.css">
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
    </style>
</head>
<body>
    <script src="front/bootstrap/js/bootstrap.bundle.min.js"></script>
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
                        <a class="nav-link hover-green active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-green" href="#search">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-green" href="#events">Events</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link hover-green" href="#recyclingcenters">Centers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hover-green" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
