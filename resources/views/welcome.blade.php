<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Medical Cabinet - Modern Healthcare Management</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #667eea !important;
        }
        .hero-section {
            min-height: calc(100vh - 76px);
            display: flex;
            align-items: center;
            padding: 80px 0;
        }
        .hero-content {
            color: white;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        .hero-description {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        .btn-custom {
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-primary-custom {
            background: white;
            color: #667eea;
            border: none;
        }
        .btn-primary-custom:hover {
            background: #f0f0f0;
            color: #764ba2;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .btn-outline-custom {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        .btn-outline-custom:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            color: white;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .footer {
            background: rgba(0, 0, 0, 0.3);
            color: white;
            padding: 30px 0;
        }
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-description {
                font-size: 1rem;
            }
            .btn-custom {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-hospital me-2"></i>Medical Cabinet
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary-custom btn-sm ms-2" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary-custom btn-sm ms-2" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-custom btn-sm ms-2" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-2"></i>Sign Up
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="hero-title">Modern Healthcare Management</h1>
                        <p class="hero-description">
                            Streamline your medical clinic operations with our comprehensive appointment management system. 
                            Schedule, track, and manage appointments with ease.
                        </p>
                        <div class="d-flex gap-3 flex-wrap">
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn btn-custom btn-primary-custom">
                                    <i class="bi bi-speedometer2 me-2"></i>Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-custom btn-primary-custom">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </a>
                                @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-custom btn-outline-custom">
                                    <i class="bi bi-person-plus me-2"></i>Sign Up
                                </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="feature-card text-center">
                                <i class="bi bi-calendar-check feature-icon"></i>
                                <h5>Easy Scheduling</h5>
                                <p class="mb-0">Book appointments in seconds with our intuitive interface</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card text-center">
                                <i class="bi bi-shield-check feature-icon"></i>
                                <h5>Secure & Private</h5>
                                <p class="mb-0">Your data is protected with enterprise-grade security</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card text-center">
                                <i class="bi bi-translate feature-icon"></i>
                                <h5>Multi-Language</h5>
                                <p class="mb-0">Support for English and French languages</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card text-center">
                                <i class="bi bi-envelope feature-icon"></i>
                                <h5>Email Notifications</h5>
                                <p class="mb-0">Automatic appointment confirmations via email</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Medical Cabinet. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
