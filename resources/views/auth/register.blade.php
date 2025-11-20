<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <div class="relative">
                <x-text-input id="name" class="block mt-1 w-full pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                {{-- Ikon Nama (User) --}}
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-teal-600">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        {{-- Mengurangi jarak menjadi mt-3 --}}
        <div class="mt-3">
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autocomplete="username" />
                {{-- Ikon Email --}}
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-teal-600">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        {{-- Mengurangi jarak menjadi mt-3 --}}
        <div class="mt-3">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pl-10 pr-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                {{-- Ikon Kunci --}}
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-teal-600">
                    <i class="fas fa-lock"></i>
                </div>
                {{-- Toggle Eye Icon (Disediakan script di bawah) --}}
                <button type="button" class="password-toggle absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-teal-600 focus:outline-none">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        {{-- Mengurangi jarak menjadi mt-3 --}}
        <div class="mt-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 pr-10"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                {{-- Ikon Kunci --}}
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-teal-600">
                    <i class="fas fa-lock"></i>
                </div>
                {{-- Toggle Eye Icon (Disediakan script di bawah) --}}
                <button type="button" class="password-toggle-confirm absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-teal-600 focus:outline-none">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-teal-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-teal-600 hover:bg-teal-700">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- ========================== -->
    <!-- 🔵 REGISTER DENGAN GOOGLE (TOMBOL RESMI GOOGLE STYLE) -->
    <!-- ========================== -->
    <a href="{{ route('google.redirect') }}"
       class="mt-4 w-full flex items-center justify-center gap-3 border border-gray-300 rounded-lg py-2 hover:bg-gray-100 transition">

        <!-- Google SVG Logo -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512" class="w-5 h-5">
            <path fill="#4285F4" d="M488 261.8c0-17.4-1.6-34.1-4.7-50.3H249.2v95.3h134.3c-6 32.5-24.2 60-51.5 78.4v64.9h83.4c48.8-44.9 72.6-111.2 72.6-188.3z"/>
            <path fill="#34A853" d="M249.2 512c69.1 0 127-22.9 169.4-62.1l-83.4-64.9c-23.2 15.6-53 24.9-86 24.9-66 0-122-44.6-141.8-104.4H22.2v65.5C65.3 467.3 150.1 512 249.2 512z"/>
            <path fill="#FBBC05" d="M107.4 305.5C102 289.9 99 273.3 99 256s3-33.9 8.4-49.5V141H22.2C8 176.2 0 214.1 0 256s8 79.8 22.2 115.1l85.2-65.6z"/>
            <path fill="#EA4335" d="M249.2 100.9c37.6 0 71.4 12.9 98.1 38.3l73.4-73.4C376.2 24.1 318.3 0 249.2 0 150.1 0 65.3 44.7 22.2 140.9l85.2 64.6c19.8-59.8 75.8-104.6 141.8-104.6z"/>
        </svg>

        <span class="text-gray-700 font-medium">
            Daftar dengan Google
        </span>
    </a>

    <!-- Script password toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function untuk mengaitkan toggle ke input password tertentu
            function setupPasswordToggle(toggleSelector, inputId) {
                const passwordToggle = document.querySelector(toggleSelector);
                const passwordInput = document.getElementById(inputId);

                if (passwordToggle && passwordInput) {
                    const passwordIcon = passwordToggle.querySelector('i');

                    passwordToggle.addEventListener('click', function() {
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            passwordIcon.classList.remove('fa-eye');
                            passwordIcon.classList.add('fa-eye-slash');
                            passwordToggle.classList.add('text-teal-600');
                        } else {
                            passwordInput.type = 'password';
                            passwordIcon.classList.remove('fa-eye-slash');
                            passwordIcon.classList.add('fa-eye');
                            passwordToggle.classList.remove('text-teal-600');
                        }
                    });
                }
            }

            // Setup untuk field Password dan Confirm Password
            setupPasswordToggle('.password-toggle', 'password');
            setupPasswordToggle('.password-toggle-confirm', 'password_confirmation');

        });
    </script>

    <style>
        .password-toggle, .password-toggle-confirm {
            transition: all 0.2s ease;
            padding: 0.25rem;
            border-radius: 0.25rem;
        }

        .password-toggle:hover, .password-toggle-confirm:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Mengatur padding untuk input yang memiliki ikon di kiri dan kanan */
        .pl-10 { padding-left: 2.5rem !important; }
        .pr-10 { padding-right: 2.5rem !important; }
    </style>
</x-guest-layout>
