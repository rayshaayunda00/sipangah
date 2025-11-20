<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pl-10" type="email"
                    name="email" :value="old('email')" required autofocus autocomplete="username" />
                {{-- Ikon berwarna Teal --}}
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-teal-600">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        {{-- Mengurangi jarak dari mt-4 menjadi mt-3 --}}
        <div class="mt-3">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pl-10 pr-10"
                    type="password" name="password" required autocomplete="current-password" />
                {{-- Ikon berwarna Teal --}}
                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-teal-600">
                    <i class="fas fa-lock"></i>
                </div>
                {{-- Toggle Eye Icon --}}
                <button type="button" class="password-toggle absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-teal-600 focus:outline-none">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- Mengurangi jarak dari mt-4 menjadi mt-3 --}}
        <div class="block mt-3">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Login Button -->
        {{-- Mengurangi jarak dari mt-4 menjadi mt-3 --}}
        <div class="flex items-center justify-end mt-3">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-teal-600 hover:bg-teal-700">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- ========================== -->
    <!-- 🔵 LOGIN / REGISTER DENGAN GOOGLE (TOMBOL RESMI GOOGLE STYLE) -->
    <!-- ========================== -->
    {{-- Mengurangi jarak dari mt-6 menjadi mt-4 --}}
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
            Masuk dengan Google
        </span>
    </a>

    <!-- BARIS BARU DITAMBAHKAN -->
    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            Belum punya akun?
            <a class="underline text-teal-600 hover:text-teal-800 font-semibold"
               href="{{ route('register') }}">
                Daftar sekarang
            </a>
        </p>
    </div>

    <!-- Script password toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.querySelector('.password-toggle');
            const passwordInput = document.getElementById('password');
            const passwordIcon = passwordToggle.querySelector('i');

            if (passwordToggle && passwordInput) {
                passwordToggle.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        passwordIcon.classList.remove('fa-eye');
                        passwordIcon.classList.add('fa-eye-slash');
                        // Mengganti warna toggle menjadi teal saat aktif
                        passwordToggle.classList.add('text-teal-600');
                    } else {
                        passwordInput.type = 'password';
                        passwordIcon.classList.remove('fa-eye-slash');
                        passwordIcon.classList.add('fa-eye');
                        // Menghapus warna teal saat tidak aktif
                        passwordToggle.classList.remove('text-teal-600');
                    }
                });
            }
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

        .pl-10 { padding-left: 2.5rem; }
        .pr-10 { padding-right: 2.5rem; }
    </style>
</x-guest-layout>
