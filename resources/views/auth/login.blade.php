@extends('layouts.public')

@php
    $hideHeader = true; // Menyembunyikan header
    $hideFooter = true; // Menyembunyikan footer
@endphp

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-cyan-50 via-teal-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Animated Background Orbs -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-orb orb-3"></div>
    
    <div class="max-w-md w-full space-y-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl p-8 z-10 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-cyan-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
        <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-teal-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -top-20 left-1/3 w-40 h-40 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
        
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-600 to-teal-500">
                    Masuk ke Akun Anda
                </span>
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Silakan masukkan kredensial Anda untuk melanjutkan
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <p class="font-medium">{{ $errors->first() }}</p>
            </div>
        @endif

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <div class="rounded-md space-y-4">
                <!-- Email -->
                <div class="group relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-cyan-600 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input id="email" name="email" type="email" required 
                           class="appearance-none rounded-lg relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-all duration-200"
                           placeholder="Alamat Email" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="group relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-cyan-600 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" name="password" type="password" required 
                           class="appearance-none rounded-lg relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-all duration-200"
                           placeholder="Kata Sandi">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Ingat Saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-cyan-600 hover:text-cyan-500 transition-colors duration-200">
                                Lupa password?
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-cyan-600 to-teal-500 hover:from-cyan-700 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 shadow-lg shadow-cyan-500/20 hover:shadow-xl hover:shadow-cyan-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-cyan-300 group-hover:text-white transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </span>
                    Masuk
                </button>
            </div>
        </form>

        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white/80 text-gray-500">
                        Atau lanjutkan dengan
                    </span>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-200">
                    <span class="sr-only">Masuk dengan Google</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,14.991,2,12.166,2C6.626,2,2.162,6.262,2.162,11.5c0,5.338,4.664,9.5,10.004,9.5c8.396,0,10.249-7.85,9.426-11.748H12.545z"/>
                    </svg>
                </a>
                <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-200">
                    <span class="sr-only">Masuk dengan Facebook</span>
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-medium text-cyan-600 hover:text-cyan-500 transition-colors duration-200">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>
</div>

<style>
    .bg-orb {
        position: fixed;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.2;
        z-index: 0;
    }
    
    .orb-1 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #06b6d4, #14b8a6);
        top: -50px;
        left: -50px;
        animation: float-orb 25s infinite alternate;
    }
    
    .orb-2 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #3b82f6, #06b6d4);
        top: 50%;
        right: -100px;
        animation: float-orb 30s infinite alternate-reverse;
    }
    
    .orb-3 {
        width: 250px;
        height: 250px;
        background: linear-gradient(135deg, #8b5cf6, #ec4899);
        bottom: -50px;
        left: 30%;
        animation: float-orb 20s infinite alternate;
    }
    
    @keyframes float-orb {
        0% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, 20px) scale(1.05); }
        50% { transform: translate(0, 40px) scale(0.95); }
        75% { transform: translate(-20px, 20px) scale(1.03); }
        100% { transform: translate(0, 0) scale(1); }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    @keyframes blob {
        0% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0, 0) scale(1); }
    }
    
    input:focus, button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
    }
    
    /* Animasi untuk form */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    #loginForm > * {
        animation: fadeIn 0.6s ease-out forwards;
    }
    
    #loginForm > *:nth-child(1) { animation-delay: 0.1s; }
    #loginForm > *:nth-child(2) { animation-delay: 0.2s; }
    #loginForm > *:nth-child(3) { animation-delay: 0.3s; }
    #loginForm > *:nth-child(4) { animation-delay: 0.4s; }
    #loginForm > *:nth-child(5) { animation-delay: 0.5s; }
</style>

<script>
    // Efek hover pada input
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-cyan-500', 'rounded-lg');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-cyan-500', 'rounded-lg');
            });
        });
    });
</script>
            </div>
        </div>
    </div>
</div>
@endsection
