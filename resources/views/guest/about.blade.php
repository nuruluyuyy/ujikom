@extends('layouts.public')

@section('content')
<style>
    /* Futuristic Light Effects */
    .light-effect {
        position: relative;
        overflow: hidden;
    }
    
    .light-effect::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.15) 0%, transparent 70%);
        animation: lightPulse 4s ease-in-out infinite;
    }
    
    .light-effect::after {
        content: '';
        position: absolute;
        bottom: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(20, 184, 166, 0.15) 0%, transparent 70%);
        animation: lightPulse 4s ease-in-out infinite reverse;
    }
    
    @keyframes lightPulse {
        0%, 100% {
            transform: translate(0, 0) scale(1);
            opacity: 0.5;
        }
        50% {
            transform: translate(10px, 10px) scale(1.1);
            opacity: 0.8;
        }
    }
    
    /* Glow Cards */
    .glow-card {
        position: relative;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .glow-card::before {
        content: '';
        position: absolute;
        inset: -1px;
        background: linear-gradient(45deg, #06b6d4, #14b8a6, #06b6d4);
        background-size: 200% 200%;
        border-radius: inherit;
        opacity: 0;
        z-index: -1;
        transition: opacity 0.3s ease;
        animation: gradientRotate 3s linear infinite;
    }
    
    .glow-card:hover::before {
        opacity: 0.5;
    }
    
    @keyframes gradientRotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Floating Particles */
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: linear-gradient(45deg, #06b6d4, #14b8a6);
        border-radius: 50%;
        pointer-events: none;
        animation: floatParticle 8s ease-in-out infinite;
    }
    
    @keyframes floatParticle {
        0%, 100% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(50px);
            opacity: 0;
        }
    }
    
    .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
    .particle:nth-child(2) { left: 30%; animation-delay: 2s; }
    .particle:nth-child(3) { left: 50%; animation-delay: 4s; }
    .particle:nth-child(4) { left: 70%; animation-delay: 1s; }
    .particle:nth-child(5) { left: 90%; animation-delay: 3s; }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 py-16 px-6 light-effect relative">
    <!-- Floating Particles -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    
    <div class="max-w-7xl mx-auto relative z-10">
        
        <!-- Hero Section -->
        <div class="text-center mb-20 scroll-reveal">
            <div class="inline-block mb-6">
                <div class="w-24 h-24 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-3xl flex items-center justify-center shadow-2xl float-gentle">
                    <span class="text-5xl">🏫</span>
                </div>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold mb-4 text-gradient-animate tracking-tight">
                {{ $schoolInfo['name'] }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 font-medium mb-2">{{ $schoolInfo['full_name'] }}</p>
            <p class="text-gray-500">Berdiri sejak {{ $schoolInfo['established'] }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-20">
            <div class="scroll-reveal scroll-reveal-scale scroll-reveal-delay-1">
                <div class="glow-card rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300">
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2 counter" data-target="{{ $schoolInfo['stats']['students'] }}">0</div>
                    <div class="text-gray-600 font-semibold">Siswa</div>
                </div>
            </div>
            <div class="scroll-reveal scroll-reveal-scale scroll-reveal-delay-2">
                <div class="glow-card rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300">
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2 counter" data-target="{{ $schoolInfo['stats']['teachers'] }}">0</div>
                    <div class="text-gray-600 font-semibold">Guru</div>
                </div>
            </div>
            <div class="scroll-reveal scroll-reveal-scale scroll-reveal-delay-3">
                <div class="glow-card rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300">
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2 counter" data-target="{{ $schoolInfo['stats']['majors'] }}">0</div>
                    <div class="text-gray-600 font-semibold">Jurusan</div>
                </div>
            </div>
            <div class="scroll-reveal scroll-reveal-scale scroll-reveal-delay-4">
                <div class="glow-card rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300">
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2 counter" data-target="{{ $schoolInfo['stats']['achievements'] }}">0</div>
                    <div class="text-gray-600 font-semibold">Prestasi</div>
                </div>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="grid md:grid-cols-2 gap-8 mb-20">
            <!-- Vision -->
            <div class="scroll-reveal-left">
                <div class="bg-white rounded-3xl p-8 shadow-xl card-shine h-full">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center">
                            <span class="text-2xl">🎯</span>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Visi</h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-lg">{{ $schoolInfo['vision'] }}</p>
                </div>
            </div>

            <!-- Mission -->
            <div class="scroll-reveal-right">
                <div class="bg-white rounded-3xl p-8 shadow-xl card-shine h-full">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center">
                            <span class="text-2xl">🚀</span>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Misi</h2>
                    </div>
                    <ul class="space-y-3">
                        @foreach($schoolInfo['mission'] as $index => $mission)
                            <li class="flex items-start gap-3">
                                <span class="flex-shrink-0 w-6 h-6 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-full flex items-center justify-center text-white text-xs font-bold">{{ $index + 1 }}</span>
                                <span class="text-gray-600 leading-relaxed">{{ $mission }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="grid md:grid-cols-3 gap-6 mb-20">
            <div class="scroll-reveal scroll-reveal-scale scroll-reveal-delay-1">
                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-3xl">🎓</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Pendidikan Berkualitas</h3>
                    <p class="text-gray-600 text-sm">Kurikulum modern dan tenaga pengajar profesional</p>
                </div>
            </div>
            <div class="scroll-reveal scroll-reveal-scale scroll-reveal-delay-2">
                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-3xl">🏆</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Prestasi Gemilang</h3>
                    <p class="text-gray-600 text-sm">Berbagai penghargaan tingkat nasional dan internasional</p>
                </div>
            </div>
            <div class="scroll-reveal scroll-reveal-scale scroll-reveal-delay-3">
                <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 text-center group">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <span class="text-3xl">🌟</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Fasilitas Modern</h3>
                    <p class="text-gray-600 text-sm">Laboratorium lengkap dan teknologi terkini</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="scroll-reveal scroll-reveal-scale">
            <div class="bg-gradient-to-br from-cyan-500 to-teal-500 rounded-3xl p-8 md:p-12 shadow-2xl text-white relative overflow-hidden">
                <!-- Decorative circles -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold mb-8 text-center">Hubungi Kami</h2>
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-white/30 transition-all group-hover:scale-110">
                                    <span class="text-2xl">📍</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Alamat</h3>
                                    <p class="text-cyan-50">{{ $schoolInfo['address'] }}<br>{{ $schoolInfo['city'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-white/30 transition-all group-hover:scale-110">
                                    <span class="text-2xl">📞</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Telepon</h3>
                                    <p class="text-cyan-50">{{ $schoolInfo['phone'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-white/30 transition-all group-hover:scale-110">
                                    <span class="text-2xl">✉️</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Email</h3>
                                    <p class="text-cyan-50">{{ $schoolInfo['email'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 group">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-white/30 transition-all group-hover:scale-110">
                                    <span class="text-2xl">🌐</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold mb-1">Website</h3>
                                    <p class="text-cyan-50">{{ $schoolInfo['website'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10">
                        <a href="/galeri" class="inline-block px-8 py-4 bg-white text-cyan-600 rounded-2xl font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 text-center">
                            📸 Lihat Galeri
                        </a>
                        <a href="/kontak" class="inline-block px-8 py-4 bg-white/20 backdrop-blur-lg text-white border-2 border-white rounded-2xl font-bold hover:bg-white hover:text-cyan-600 hover:scale-105 transition-all duration-300 text-center">
                            📞 Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
