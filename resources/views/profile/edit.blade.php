@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-teal-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Animated Background Orbs -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-orb orb-3"></div>
    
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12 scroll-reveal">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-600 to-teal-500">
                    Pengaturan Akun
                </span>
            </h1>
            <p class="text-lg text-gray-600">Kelola informasi profil dan keamanan akun Anda</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Sidebar Navigasi -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-6 bg-gradient-to-br from-cyan-600 to-teal-500 text-white">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-2xl font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">{{ auth()->user()->name }}</h3>
                                <p class="text-sm opacity-90">Anggota sejak {{ auth()->user()->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <nav class="p-4">
                        <a href="#profile" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-cyan-50 text-cyan-700 font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Profil Saya</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="md:col-span-2 space-y-6">
                <!-- Informasi Profil -->
                <div id="profile" class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Informasi Profil
                        </h3>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Ubah Password
                        </h3>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Hapus Akun -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl border border-red-100">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-red-600 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Akun
                        </h3>
                    </div>
                    <div class="p-6">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animated Background Elements -->
<div class="sparkle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
<div class="sparkle" style="top: 40%; left: 80%; animation-delay: 1s;"></div>
<div class="sparkle" style="top: 60%; left: 30%; animation-delay: 2s;"></div>

<style>
    .sparkle {
        position: fixed;
        width: 10px;
        height: 10px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
        animation: float 6s infinite ease-in-out;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.8; }
        50% { transform: translateY(-20px) rotate(180deg); opacity: 0.4; }
    }
    
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
    
    .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    
    .scroll-reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    // Animasi scroll reveal
    document.addEventListener('DOMContentLoaded', function() {
        const revealElements = document.querySelectorAll('.scroll-reveal');
        
        const revealOnScroll = () => {
            revealElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        };
        
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Check on load
    });
</script>
@endsection
