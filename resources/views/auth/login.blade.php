<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Medical Cabinet</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .login-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: white;
        }
        .login-form {
            padding: 50px;
        }
        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .medical-icon {
            font-size: 5rem;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .login-image {
                display: none;
            }
            .login-form {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="row g-0">
            <div class="col-lg-6 login-image">
                <div class="text-center">
                    <i class="bi bi-hospital medical-icon"></i>
                    <h2 class="fw-bold mb-3">Medical Cabinet</h2>
                    <p class="opacity-75">Your trusted healthcare management partner</p>
                </div>
            </div>
            <div class="col-lg-6 login-form">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Welcome Back</h3>
                    <p class="text-muted">Sign in to your account</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bi bi-envelope me-2"></i>Email Address
                        </label>
                        <input id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            <i class="bi bi-lock me-2"></i>Password
                        </label>
                        <input id="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 form-check">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="form-check-input" 
                               name="remember">
                        <label for="remember_me" class="form-check-label">
                            Remember me
                        </label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none text-primary" href="{{ route('password.request') }}">
                                <i class="bi bi-question-circle me-1"></i>Forgot your password?
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary btn-login text-white">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Log in
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted">
                        Don't have an account? 
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">
                                Sign up
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
