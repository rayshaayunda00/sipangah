<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pl-10 pr-10"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-lock"></i>
                </div>
                <button type="button" class="password-toggle absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            const passwordToggle = document.querySelector('.password-toggle');
            const passwordInput = document.getElementById('password');
            const passwordIcon = passwordToggle.querySelector('i');

            if (passwordToggle && passwordInput) {
                passwordToggle.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        passwordIcon.classList.remove('fa-eye');
                        passwordIcon.classList.add('fa-eye-slash');
                        passwordToggle.classList.add('text-indigo-600');
                    } else {
                        passwordInput.type = 'password';
                        passwordIcon.classList.remove('fa-eye-slash');
                        passwordIcon.classList.add('fa-eye');
                        passwordToggle.classList.remove('text-indigo-600');
                    }
                });
            }

            // Add focus styles for inputs
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-indigo-500', 'ring-opacity-50');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-indigo-500', 'ring-opacity-50');
                });
            });
        });
    </script>

    <style>
        .password-toggle {
            transition: all 0.2s ease;
            padding: 0.25rem;
            border-radius: 0.25rem;
        }

        .password-toggle:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .password-toggle:active {
            transform: scale(0.95);
        }

        /* Ensure the input has proper padding for icons */
        .pl-10 {
            padding-left: 2.5rem;
        }

        .pr-10 {
            padding-right: 2.5rem;
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .password-toggle:hover {
                background-color: rgba(255, 255, 255, 0.1);
            }
        }
    </style>
</x-guest-layout>
