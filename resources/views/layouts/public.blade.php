<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Sekolah - SMKN 4 Bogor</title>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    
    <!-- Page-specific head scripts (loaded FIRST) -->
    @yield('head-scripts')
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        
        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }
        
        /* Animated Background Orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 20s infinite ease-in-out;
            z-index: -1;
        }
        
        .orb-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #06b6d4, #14b8a6);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }
        
        .orb-2 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            top: 50%;
            right: -150px;
            animation-delay: 5s;
        }
        
        .orb-3 {
            width: 350px;
            height: 350px;
            background: linear-gradient(135deg, #14b8a6, #10b981);
            bottom: -100px;
            left: 30%;
            animation-delay: 10s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(50px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-30px, 30px) scale(0.9);
            }
        }
        
        /* Sparkle Effect */
        .sparkle {
            position: fixed;
            width: 3px;
            height: 3px;
            background: white;
            border-radius: 50%;
            animation: sparkle 3s infinite;
            z-index: -1;
        }
        
        @keyframes sparkle {
            0%, 100% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Scroll Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .fade-in-up.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Navbar Scroll Effect */
        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Hover Glow Effect */
        .glow-on-hover {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .glow-on-hover::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: inherit;
            background: linear-gradient(45deg, #06b6d4, #14b8a6, #3b82f6, #06b6d4);
            background-size: 300% 300%;
            opacity: 0;
            filter: blur(10px);
            z-index: -1;
            transition: opacity 0.3s ease;
            animation: glow-rotate 3s linear infinite;
        }
        
        .glow-on-hover:hover::before {
            opacity: 0.7;
        }
        
        @keyframes glow-rotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Card Shine Effect */
        .card-shine {
            position: relative;
            overflow: hidden;
        }
        
        .card-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 30%,
                rgba(255, 255, 255, 0.3) 50%,
                transparent 70%
            );
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
            transition: transform 0.6s ease;
        }
        
        .card-shine:hover::after {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }
        
        /* Pulse Animation */
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(6, 182, 212, 0.4);
            }
            50% {
                box-shadow: 0 0 40px rgba(6, 182, 212, 0.8);
            }
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        
        /* Floating Animation */
        @keyframes float-gentle {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        .float-gentle {
            animation: float-gentle 3s ease-in-out infinite;
        }
        
        /* Gradient Border Animation */
        .gradient-border {
            position: relative;
            background: white;
            border-radius: 1.5rem;
        }
        
        .gradient-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 1.5rem;
            padding: 2px;
            background: linear-gradient(45deg, #06b6d4, #14b8a6, #3b82f6);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gradient-border:hover::before {
            opacity: 1;
        }
        
        /* Text Gradient Animation */
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .text-gradient-animate {
            background: linear-gradient(90deg, #06b6d4, #14b8a6, #3b82f6, #06b6d4);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 3s ease infinite;
        }
        
        /* Button Ripple Effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }
        
        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .ripple:active::after {
            width: 300px;
            height: 300px;
        }
        
        /* Image Zoom & Tilt */
        .image-tilt {
            transition: transform 0.5s ease;
        }
        
        .image-tilt:hover {
            transform: scale(1.05) rotate(2deg);
        }
        
        /* Scroll Progress Bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, #06b6d4, #14b8a6, #3b82f6);
            z-index: 9999;
            transition: width 0.1s ease;
        }
        
        /* Lightbox Styles */
        .lightbox {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }
        
        .lightbox.active {
            opacity: 1;
            visibility: visible;
        }
        
        .lightbox-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            transform: scale(0.8) translateY(50px);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .lightbox.active .lightbox-content {
            transform: scale(1) translateY(0);
        }
        
        .lightbox-image {
            max-width: 100%;
            max-height: 85vh;
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 3px solid rgba(255, 255, 255, 0.1);
        }
        
        .lightbox-close {
            position: absolute;
            top: -50px;
            right: 0;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            font-size: 24px;
        }
        
        .lightbox-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg) scale(1.1);
        }
        
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            font-size: 24px;
        }
        
        .lightbox-nav:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-50%) scale(1.1);
        }
        
        .lightbox-nav.prev {
            left: -70px;
        }
        
        .lightbox-nav.next {
            right: -70px;
        }
        
        .lightbox-info {
            position: absolute;
            bottom: -80px;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
        }
        
        .lightbox-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-category {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Zoom Animation */
        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .zoom-in {
            animation: zoomIn 0.3s ease;
        }
        
        /* Prevent body scroll when lightbox is open */
        body.lightbox-open {
            overflow: hidden;
        }
        
        /* Page Transition Overlay - Subtle & Professional */
        .page-transition {
            position: fixed;
            inset: 0;
            z-index: 99999;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .page-transition.active {
            opacity: 1;
        }
        
        .page-transition-logo {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.4s ease;
        }
        
        .page-transition.active .page-transition-logo {
            opacity: 1;
            transform: translateY(0);
        }
        
        .page-transition-logo-inner {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #06b6d4, #14b8a6);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 10px 30px rgba(6, 182, 212, 0.2);
        }
        
        /* Page Enter Animation - Subtle */
        .page-enter {
            animation: pageEnter 0.5s ease-out;
        }
        
        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Smooth Page Load */
        body {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        body.loaded {
            opacity: 1;
        }
        
        /* Loading Spinner - Minimal */
        .loading-spinner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 99998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        
        .loading-spinner.active {
            opacity: 1;
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(6, 182, 212, 0.15);
            border-top-color: #06b6d4;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Scroll Reveal Animations - Enhanced */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Scroll Reveal Variants */
        .scroll-reveal-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-reveal-left.revealed {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-reveal-right {
            opacity: 0;
            transform: translateX(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-reveal-right.revealed {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-reveal-scale {
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-reveal-scale.revealed {
            opacity: 1;
            transform: scale(1);
        }
        
        /* New: Scroll Reveal Rotate */
        .scroll-reveal-rotate {
            opacity: 0;
            transform: rotate(-5deg) scale(0.95);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-reveal-rotate.revealed {
            opacity: 1;
            transform: rotate(0deg) scale(1);
        }
        
        /* New: Scroll Reveal Blur */
        .scroll-reveal-blur {
            opacity: 0;
            filter: blur(10px);
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, filter 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .scroll-reveal-blur.revealed {
            opacity: 1;
            filter: blur(0px);
            transform: translateY(0);
        }
        
        /* Stagger Animation Delays */
        .scroll-reveal-delay-1 { transition-delay: 0.1s; }
        .scroll-reveal-delay-2 { transition-delay: 0.2s; }
        .scroll-reveal-delay-3 { transition-delay: 0.3s; }
        .scroll-reveal-delay-4 { transition-delay: 0.4s; }
        .scroll-reveal-delay-5 { transition-delay: 0.5s; }
        .scroll-reveal-delay-6 { transition-delay: 0.6s; }
        
        /* Enhanced Hover Glow Effects */
        .hover-glow {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .hover-glow::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(45deg, #06b6d4, #14b8a6, #3b82f6, #06b6d4);
            background-size: 300% 300%;
            border-radius: inherit;
            opacity: 0;
            z-index: -1;
            filter: blur(10px);
            transition: opacity 0.3s ease;
            animation: gradientShift 3s ease infinite;
        }
        
        .hover-glow:hover::before {
            opacity: 0.7;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        /* Button Hover Glow */
        .btn-glow {
            position: relative;
            overflow: hidden;
        }
        
        .btn-glow::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }
        
        .btn-glow:hover::after {
            width: 300px;
            height: 300px;
        }
        
        /* Image Hover Effects */
        .image-hover-zoom {
            overflow: hidden;
        }
        
        .image-hover-zoom img {
            transition: transform 0.5s ease, filter 0.5s ease;
        }
        
        .image-hover-zoom:hover img {
            transform: scale(1.1);
            filter: brightness(1.1);
        }
        
        /* Text Glow on Hover */
        .text-glow-hover {
            transition: text-shadow 0.3s ease;
        }
        
        .text-glow-hover:hover {
            text-shadow: 0 0 20px rgba(6, 182, 212, 0.5),
                         0 0 40px rgba(6, 182, 212, 0.3);
        }
        
        /* Counter Animation */
        .counter {
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <!-- Animated Background Orbs -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-orb orb-3"></div>
    
    @php
        $hideHeader = $hideHeader ?? false;
    @endphp
    
    <!-- Sparkles -->
    <div class="sparkle" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="sparkle" style="top: 40%; left: 80%; animation-delay: 1s;"></div>
    <div class="sparkle" style="top: 60%; left: 30%; animation-delay: 2s;"></div>
    <div class="sparkle" style="top: 80%; left: 70%; animation-delay: 1.5s;"></div>
    <div class="sparkle" style="top: 30%; left: 50%; animation-delay: 2.5s;"></div>
    <div class="sparkle" style="top: 70%; left: 20%; animation-delay: 0.5s;"></div>
    
    <!-- Page Transition Overlay -->
    <div class="page-transition" id="pageTransition">
        <div class="page-transition-logo">
            <div class="page-transition-logo-inner">
                📸
            </div>
        </div>
    </div>
    
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>
    
    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>
    
    <!-- Navbar -->
    @if(!$hideHeader)
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-lg overflow-hidden">
                        <img src="{{ $logo ?? asset('images/logo-snap4.png.png') }}" alt="snap4 Logo" class="w-full h-full object-cover" style="object-fit: cover;">
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent tracking-tight">
                            snap4
                        </h1>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Capture Every Moment</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="/" class="text-gray-700 hover:text-cyan-600 font-medium transition-colors duration-300">
                        Beranda
                    </a>
                    <a href="/galeri" class="text-gray-700 hover:text-cyan-600 font-medium transition-colors duration-300">
                        Galeri
                    </a>
                    <a href="/berita" class="text-gray-700 hover:text-cyan-600 font-medium transition-colors duration-300">
                        Berita
                    </a>
                    <a href="/kontak" class="text-gray-700 hover:text-cyan-600 font-medium transition-colors duration-300">
                        Kontak
                    </a>
                    
                    @auth
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-cyan-600 font-medium transition-colors duration-300 focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center text-white font-semibold text-sm">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="hidden lg:inline">{{ auth()->user()->name }}</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                    Profil Saya
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Login/Register Links -->
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-cyan-600 hover:text-cyan-700 font-medium transition-colors duration-300">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-300">
                            Daftar
                        </a>
                    </div>
                    @endauth
                </div>

                <!-- User Auth Buttons (Mobile) -->
                <div class="md:hidden flex items-center gap-2">
                    @auth
                    <a href="{{ route('profile.edit') }}" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center text-white font-semibold text-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="px-3 py-2 text-sm text-cyan-600 hover:text-cyan-700 font-medium">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-3 py-2 text-sm bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg font-medium">
                        Daftar
                    </a>
                    @endauth
                    <button id="mobileMenuBtn" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 space-y-3">
                <a href="/" class="block text-gray-700 hover:text-cyan-600 font-medium py-2 px-4 rounded-lg hover:bg-cyan-50 transition-all">
                    Beranda
                </a>
                <a href="/galeri" class="block text-gray-700 hover:text-cyan-600 font-medium py-2 px-4 rounded-lg hover:bg-cyan-50 transition-all">
                    Galeri
                </a>
                <a href="/berita" class="block text-gray-700 hover:text-cyan-600 font-medium py-2 px-4 rounded-lg hover:bg-cyan-50 transition-all">
                    Berita
                </a>
                <a href="/kontak" class="block text-gray-700 hover:text-cyan-600 font-medium py-2 px-4 rounded-lg hover:bg-cyan-50 transition-all">
                    Kontak
                </a>
            </div>
        </div>
    </nav>
    @endif

    <!-- Content with padding for navbar -->
    <div class="{{ $hideHeader ? '' : 'pt-20' }}">
        @yield('content')
    </div>
    
    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox">
        <div class="lightbox-content">
            <button class="lightbox-close" onclick="closeLightbox()">×</button>
            <button class="lightbox-nav prev" onclick="navigateLightbox(-1)">‹</button>
            <button class="lightbox-nav next" onclick="navigateLightbox(1)">›</button>
            <img id="lightbox-image" src="" alt="" class="lightbox-image zoom-in">
            <div class="lightbox-info">
                <div class="lightbox-title" id="lightbox-title"></div>
                <div class="lightbox-category" id="lightbox-category"></div>
                
                <!-- Action Buttons -->
                <div class="mt-4 flex items-center gap-4">
                    <!-- Like Button -->
                    <button onclick="toggleLike()" id="like-btn" class="group flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 backdrop-blur-lg rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                        <span id="like-icon" class="group-hover:scale-110 transition-transform duration-300">🤍</span>
                        <span id="like-count" class="font-medium text-sm">0</span>
                    </button>
                    
                    <!-- Download Button -->
                    <a href="#" id="download-btn" class="group relative flex items-center text-white hover:text-cyan-300 transition-colors">
                        <div class="relative p-2 group-hover:bg-white/10 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <div class="absolute inset-0 bg-cyan-400/10 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                        </div>
                        <span class="text-sm font-medium ml-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Unduh</span>
                    </a>
                    
                    <!-- Share Button -->
                    <button onclick="openShareModal(getCurrentGalleryUrl(), document.getElementById('lightbox-title').textContent)" class="group relative flex items-center text-white hover:text-cyan-300 transition-colors">
                        <div class="relative p-2 group-hover:bg-white/10 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            <div class="absolute inset-0 bg-cyan-400/10 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                        </div>
                        <span class="text-sm font-medium ml-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">Bagikan</span>
                    </button>
                </div>
                
                <!-- Include Share Modal -->
                @include('components.share-modal')
            </div>
        </div>
    </div>

    @if(!isset($hideFooter) || $hideFooter === false)
    <!-- Footer Professional & Modern -->
    <footer class="relative bg-gradient-to-br from-cyan-100 via-teal-100 to-blue-100 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Top Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- About Section -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-lg overflow-hidden p-1">
                            <img src="{{ asset('images/logo smkn 4.png') }}" alt="SMKN 4 Bogor" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">SMKN 4 Bogor</h3>
                            <p class="text-sm text-gray-600">Gallery Sekolah</p>
                        </div>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Platform galeri digital modern untuk dokumentasi kegiatan dan prestasi SMKN 4 Bogor.
                    </p>
                    <!-- Social Media -->
                    <div class="flex flex-wrap gap-2">
                        <!-- YouTube -->
                        <a href="https://youtube.com/@smknegeri4bogor905?si=fUaPreI1LhQoQiwB" target="_blank" 
                           class="group relative w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                            <div class="absolute inset-0 bg-gradient-to-br from-red-500 to-red-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fab fa-youtube text-lg text-red-500 group-hover:text-white relative z-10 transition-colors"></i>
                            <span class="sr-only">YouTube</span>
                        </a>
                        
                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/@smkn4kotabogor" target="_blank" 
                           class="group relative w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-black opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fab fa-tiktok text-lg group-hover:text-white relative z-10 transition-colors"></i>
                            <span class="sr-only">TikTok</span>
                        </a>
                        
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/smkn4kotabogor" target="_blank" 
                           class="group relative w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                            <div class="absolute inset-0 bg-gradient-to-br from-pink-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fab fa-instagram text-lg text-pink-500 group-hover:text-white relative z-10 transition-colors"></i>
                            <span class="sr-only">Instagram</span>
                        </a>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" target="_blank" 
                           class="group relative w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fab fa-facebook-f text-lg text-blue-600 group-hover:text-white relative z-10 transition-colors"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                        
                        <!-- S.ID -->
                        <a href="https://s.id/dmvsmkn4bogor" target="_blank" 
                           class="group relative w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fas fa-link text-lg text-cyan-500 group-hover:text-white relative z-10 transition-colors"></i>
                            <span class="sr-only">S.ID</span>
                        </a>
                        
                        <!-- WhatsApp -->
                        <a href="https://wa.me/6282260168886" target="_blank" 
                           class="group relative w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-white to-gray-50 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden border border-gray-100">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-500 to-green-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="fab fa-whatsapp text-lg text-green-500 group-hover:text-white relative z-10 transition-colors"></i>
                            <span class="sr-only">WhatsApp</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-6 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1 h-4 bg-gradient-to-b from-cyan-500 to-teal-500 rounded-full"></span>
                        Menu
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="/" class="text-gray-600 hover:text-cyan-600 transition-colors duration-300 text-sm flex items-center gap-2 group">
                                <span class="text-cyan-500 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="/galeri" class="text-gray-600 hover:text-cyan-600 transition-colors duration-300 text-sm flex items-center gap-2 group">
                                <span class="text-cyan-500 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span>
                                <span>Galeri</span>
                            </a>
                        </li>
                        <li>
                            <a href="/kontak" class="text-gray-600 hover:text-cyan-600 transition-colors duration-300 text-sm flex items-center gap-2 group">
                                <span class="text-cyan-500 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">→</span>
                                <span>Kontak</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-6 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-1 h-4 bg-gradient-to-b from-cyan-500 to-teal-500 rounded-full"></span>
                        Kontak
                    </h4>
                    <ul class="space-y-4 text-gray-600 text-sm">
                        <li class="flex items-start gap-3 hover:text-cyan-600 transition-colors group">
                            <span class="text-lg text-cyan-500 group-hover:scale-110 transition-transform">📍</span>
                            <span>Jl. Raya Tajur, Bogor</span>
                        </li>
                        <li class="flex items-center gap-3 hover:text-cyan-600 transition-colors group">
                            <span class="text-lg text-cyan-500 group-hover:scale-110 transition-transform">📞</span>
                            <span>(0251) 1234567</span>
                        </li>
                        <li class="flex items-center gap-3 hover:text-cyan-600 transition-colors group">
                            <span class="text-lg text-cyan-500 group-hover:scale-110 transition-transform">✉️</span>
                            <span>info@smkn4bogor.sch.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-200 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
                    <p>
                        © 2025 <span class="font-semibold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent">SMKN 4 Bogor</span>. All rights reserved.
                    </p>
                    <div class="flex items-center gap-6">
                        <a href="#" class="hover:text-cyan-600 transition-colors">Privacy</a>
                        <span class="text-gray-400">•</span>
                        <a href="#" class="hover:text-cyan-600 transition-colors">Terms</a>
                        <span class="text-gray-400">•</span>
                        <span class="bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent font-semibold">Made with ❤️</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <!-- Scripts -->
    <script>
        // Page Transition System - Subtle & Fast
        let isTransitioning = false;

        // Page Load Animation
        window.addEventListener('load', function() {
            const transition = document.getElementById('pageTransition');
            const body = document.body;
            
            // Show page transition briefly
            transition.classList.add('active');
            
            setTimeout(() => {
                transition.classList.remove('active');
                body.classList.add('loaded');
                
                // Add subtle page enter animation
                const mainContent = document.querySelector('.pt-20');
                if (mainContent) {
                    mainContent.classList.add('page-enter');
                }
            }, 400);
        });

        // Intercept all internal links for smooth transitions
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="/"], a[href^="' + window.location.origin + '"]');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Skip if it's a hash link or external
                    if (href.startsWith('#') || this.target === '_blank' || isTransitioning) {
                        return;
                    }
                    
                    e.preventDefault();
                    isTransitioning = true;
                    
                    // Show subtle transition
                    const transition = document.getElementById('pageTransition');
                    transition.classList.add('active');
                    
                    // Navigate quickly
                    setTimeout(() => {
                        window.location.href = href;
                    }, 400);
                });
            });
        });

        // Mobile Menu Toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });

        // Navbar Scroll Effect
        const navbar = document.querySelector('nav');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Scroll Progress Bar
        const scrollProgress = document.getElementById('scrollProgress');
        window.addEventListener('scroll', function() {
            const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (window.scrollY / windowHeight) * 100;
            scrollProgress.style.width = scrolled + '%';
        });

        // Scroll Reveal System - Professional & Smooth
        const scrollRevealOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -80px 0px'
        };

        const scrollRevealObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    // Optional: unobserve after reveal for performance
                    // scrollRevealObserver.unobserve(entry.target);
                }
            });
        }, scrollRevealOptions);

        // Initialize Scroll Reveal
        document.addEventListener('DOMContentLoaded', function() {
            // Observe all scroll-reveal elements
            const revealElements = document.querySelectorAll(
                '.scroll-reveal, .scroll-reveal-left, .scroll-reveal-right, .scroll-reveal-scale, .scroll-reveal-rotate, .scroll-reveal-blur, .fade-in-up'
            );
            
            revealElements.forEach(el => {
                scrollRevealObserver.observe(el);
            });
            
            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('button, .btn');
            buttons.forEach(button => {
                if (!button.classList.contains('ripple')) {
                    button.classList.add('ripple');
                }
            });
            
            // Counter Animation
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;
                
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                // Start counter when element is visible
                const counterObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCounter();
                            counterObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                
                counterObserver.observe(counter);
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Parallax effect for background orbs
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const orbs = document.querySelectorAll('.bg-orb');
            orbs.forEach((orb, index) => {
                const speed = 0.5 + (index * 0.1);
                orb.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Add hover sound effect (optional - visual feedback)
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Lightbox Functionality
        let currentImageIndex = 0;
        let currentGalleryId = null;
        
        // Function to get current gallery URL
        function getCurrentGalleryUrl() {
            if (currentGalleryId) {
                return `${window.location.origin}/gallery/${currentGalleryId}`;
            }
            return window.location.href;
        }

        function initLightbox() {
            if (typeof window.galleryImages === 'undefined') {
                console.error('❌ initLightbox called but galleryImages is undefined!');
                return;
            }
            
            console.log('✅ initLightbox: Setting up click events for', window.galleryImages.length, 'items');
            
            // Add click event to each gallery item
            const items = document.querySelectorAll('.gallery-item');
            console.log('📸 Found', items.length, 'gallery items in DOM');
            
            items.forEach((item, index) => {
                item.style.cursor = 'pointer';
                item.addEventListener('click', function() {
                    console.log('🖱️ Gallery item', index, 'clicked');
                    openLightbox(index);
                });
            });
            
            console.log('✅ initLightbox: Click events attached successfully');
        }


        // Expose openLightbox to global scope
        window.openLightbox = function(index) {
            console.log('=== Opening Lightbox ===');
            console.log('Index:', index);
            console.log('Gallery Images:', window.galleryImages);
            
            currentImageIndex = index;
            const lightbox = document.getElementById('lightbox');
            const image = document.getElementById('lightbox-image');
            const title = document.getElementById('lightbox-title');
            const category = document.getElementById('lightbox-category');

            // Check if galleryImages exists and is an array
            if (typeof window.galleryImages === 'undefined' || !Array.isArray(window.galleryImages)) {
                console.error('❌ window.galleryImages is undefined or not an array!');
                // Try to reload the page data
                if (typeof window.galleryImages === 'undefined') {
                    alert('Error: Gallery data not loaded. Please refresh the page.');
                    return;
                }
                window.galleryImages = [];
            }
            
            if (!window.galleryImages[index]) {
                console.error('❌ Gallery image at index', index, 'not found! Total images:', window.galleryImages.length);
                alert('Foto tidak ditemukan. Silakan coba lagi.');
                return;
            }

            // Set content
            image.src = window.galleryImages[index].src;
            title.textContent = window.galleryImages[index].title;
            category.textContent = window.galleryImages[index].category;
            currentGalleryId = window.galleryImages[index].id;

            console.log('✅ Opened lightbox for gallery ID:', currentGalleryId);

            // Load likes and comments
            loadLikesAndComments(currentGalleryId);

            // Show lightbox
            lightbox.classList.add('active');
            document.body.classList.add('lightbox-open');
        }

        window.closeLightbox = function() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('active');
            document.body.classList.remove('lightbox-open');
        }

        function navigateLightbox(direction) {
            if (typeof window.galleryImages === 'undefined') return;
            
            currentImageIndex += direction;
            
            // Loop around
            if (currentImageIndex < 0) {
                currentImageIndex = window.galleryImages.length - 1;
            } else if (currentImageIndex >= window.galleryImages.length) {
                currentImageIndex = 0;
            }
            
            const currentImage = window.galleryImages[currentImageIndex];
            const image = document.getElementById('lightbox-image');
            const title = document.getElementById('lightbox-title');
            const category = document.getElementById('lightbox-category');
            const downloadBtn = document.getElementById('download-btn');
            
            // Fade out image
            image.classList.add('opacity-0');
            
            // Wait for fade out, then update and fade in
            setTimeout(() => {
                image.src = currentImage.fullImageUrl;
                title.textContent = currentImage.title;
                category.textContent = currentImage.category;
                currentGalleryId = currentImage.id;
                
                // Update download button
                if (downloadBtn) {
                    downloadBtn.href = `/gallery/${currentGalleryId}/download`;
                    downloadBtn.setAttribute('download', '');
                    downloadBtn.setAttribute('title', 'Download ' + currentImage.title);
                }
                
                // Reload likes for new image
                loadLikesAndComments(currentGalleryId);
                
                // Fade in
                setTimeout(() => {
                    image.classList.remove('opacity-0');
                }, 50);
            }, 200);
        }

        // Close lightbox on background click
        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        // Lightbox initialization is now handled by individual pages
        // Gallery page will attach click events directly

        // Like & Comment Functions
        function loadLikesAndComments(galleryId) {
            // Load likes count and status
            fetch(`/gallery/${galleryId}/like`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const likeCountEl = document.getElementById('like-count');
                const likeIconEl = document.getElementById('like-icon');
                
                if (likeCountEl) likeCountEl.textContent = data.likes_count || 0;
                if (likeIconEl) likeIconEl.textContent = data.is_liked ? '❤️' : '🤍';
                
                console.log('Likes loaded:', data);
            })
            .catch(error => console.error('Error loading likes:', error));
        }

        window.toggleLike = function() {
            if (!currentGalleryId) {
                console.error('No gallery ID set');
                return;
            }

            console.log('Toggling like for gallery:', currentGalleryId);

            fetch(`/gallery/${currentGalleryId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Update lightbox counter
                    const likeCountEl = document.getElementById('like-count');
                    const likeIconEl = document.getElementById('like-icon');
                    if (likeCountEl) likeCountEl.textContent = data.likes_count || 0;
                    if (likeIconEl) likeIconEl.textContent = data.liked ? '❤️' : '🤍';
                    
                    // Update card counter
                    const cardLikesElement = document.querySelector('.gallery-likes-' + currentGalleryId);
                    if (cardLikesElement) {
                        cardLikesElement.textContent = data.likes_count || 0;
                    }
                    
                    console.log('Like updated successfully');
                } else {
                    console.error('Success flag is false');
                }
            })
            .catch(error => {
                console.error('Error toggling like:', error);
                alert('Gagal like foto. Silakan coba lagi.');
            });
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diff = Math.floor((now - date) / 1000); // seconds

            if (diff < 60) return 'Baru saja';
            if (diff < 3600) return Math.floor(diff / 60) + ' menit lalu';
            if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
            if (diff < 604800) return Math.floor(diff / 86400) + ' hari lalu';
            
            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
