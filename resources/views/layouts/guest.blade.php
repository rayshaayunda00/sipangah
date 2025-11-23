<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SIPANGAH | Sistem Informasi Kelurahan')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #0f766e;
            --primary-light: #0d9488;
            --primary-dark: #115e59;
            --secondary: #059669;
            --accent: #d97706;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-500: #6b7280;
            --gray-700: #374151;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d9488 0%, #115e59 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
        }

        /* Main form card - Clean and modern */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        /* Logo section - Minimalist */
        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-container {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
        }

        .logo-container img {
            width: 40px;
            height: 40px;
            border-radius: 6px;
        }

        .logo-placeholder {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-placeholder i {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .app-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 0.25rem;
        }

        .app-subtitle {
            font-size: 0.9rem;
            color: var(--gray-600);
            font-weight: 400;
        }

        /* Form header */
        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--gray-600);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        /* Form content */
        .form-content {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        /* Form elements - Clean design */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
        }

        .input-container {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.5rem;
            border: 1.5px solid var(--gray-200);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: white;
            font-family: 'Poppins', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
        }

        .form-input::placeholder {
            color: var(--gray-500);
        }

        .input-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            z-index: 1;
        }

        .form-input:focus + .input-icon {
            color: var(--primary);
        }

        /* Password toggle button */
        .password-toggle {
            position: absolute;
            right: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-500);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: all 0.2s ease;
            z-index: 1;
        }

        .password-toggle:hover {
            color: var(--primary);
            background: var(--gray-100);
        }

        .password-toggle:active {
            transform: translateY(-50%) scale(0.95);
        }

        /* Button styles - Modern flat design */
        .btn {
            width: 100%;
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Link styles */
        .form-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .form-link:hover {
            color: var(--primary-dark);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--gray-500);
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        .divider-text {
            padding: 0 1rem;
        }

        /* Footer */
        .form-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
        }

        .form-footer p {
            color: var(--gray-500);
            font-size: 0.75rem;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            body {
                padding: 0.5rem;
            }

            .form-card {
                padding: 2rem 1.5rem;
                border-radius: 12px;
            }

            .logo-container {
                width: 60px;
                height: 60px;
            }

            .logo-container img,
            .logo-placeholder {
                width: 35px;
                height: 35px;
            }

            .app-title {
                font-size: 1.375rem;
            }

            .form-header h2 {
                font-size: 1.125rem;
            }
        }

        /* Loading state */
        .btn-loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-loading::after {
            content: '';
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Error states */
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-input {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important;
        }

        /* Success states */
        .success-message {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 0.875rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
        }

        .success-message i {
            color: #059669;
        }

        /* Utility classes */
        .text-center {
            text-align: center;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .space-y-4 > * + * {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <!-- Main Auth Container -->
    <div class="auth-container">
        <div class="form-card">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-container">
                    @if(file_exists(public_path('images/sipangah-logo.png')))
    <img src="{{ asset('images/sipangah-logo.png') }}" alt="Logo Kelurahan">
@else
    <div class="logo-placeholder">
        <i class="fas fa-landmark"></i>
    </div>
@endif

                </div>
                <h1 class="app-title">SIPANGAH</h1>
                <p class="app-subtitle">Sistem Informasi Kelurahan</p>
            </div>

            <!-- Form Header -->
            <div class="form-header">
                <h2>@yield('formTitle', 'Selamat Datang')</h2>
                <p>@yield('formSubtitle', 'Masuk ke akun Anda')</p>
            </div>

            <!-- Dynamic Content Slot -->
            <div class="form-content">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="form-footer">
                <p>&copy; {{ date('Y') }} SIPANGAH - Layanan Kelurahan</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form input interactions
            const formInputs = document.querySelectorAll('.form-input');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });

            // Form submission handling
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.classList.contains('btn-loading')) {
                        // Add loading state
                        submitBtn.classList.add('btn-loading');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '';

                        // Re-enable after 3 seconds (in case of error)
                        setTimeout(() => {
                            submitBtn.classList.remove('btn-loading');
                            submitBtn.innerHTML = originalText;
                        }, 3000);
                    }
                });
            });

            // Password toggle functionality
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const passwordInput = this.previousElementSibling;
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Auto-focus first input
            const firstInput = document.querySelector('.form-input');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 300);
            }
        });
    </script>
</body>
</html>
