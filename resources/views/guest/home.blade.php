@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<div class="relative min-h-screen bg-gradient-to-br from-cyan-50 via-teal-50 to-blue-50 flex items-center">
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="scroll-reveal">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-gradient-animate">
                    Galeri Sekolah
                    <span class="block text-cyan-600">SMKN 4 Bogor</span>
                </h1>
                <p class="text-xl text-gray-700 mb-8 leading-relaxed">
                    Dokumentasi kegiatan dan prestasi sekolah dalam satu platform modern. 
                    Lihat momen-momen terbaik kami! ✨
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/galeri" class="btn-hover px-8 py-4 bg-cyan-600 text-white font-bold rounded-2xl hover:bg-cyan-700 transition-all duration-300 flex items-center gap-2 transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        <span>Lihat Galeri</span>
                    </a>
                    <a href="{{ route('guest.contact') }}" class="btn-hover px-8 py-4 bg-white text-cyan-600 border-2 border-cyan-600 font-bold rounded-2xl hover:bg-cyan-50 transition-all duration-300 flex items-center gap-2 transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        <span>Hubungi Kami</span>
                    </a>
                </div>
                <style>
                    @keyframes pulse {
                        0% { transform: scale(1); }
                        50% { transform: scale(1.05); }
                        100% { transform: scale(1); }
                    }
                    .btn-hover:hover {
                        animation: pulse 1.5s infinite;
                    }
                    .transition-all {
                        transition-property: all;
                        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                        transition-duration: 300ms;
                    }
                </style>
            </div>

            <!-- Right Content - Gallery Grid -->
            <div class="scroll-reveal scroll-reveal-right">
                <div class="grid grid-cols-2 gap-4">
                    @php
                        $galleryImages = [
                            'images/hero/1.jpg',
                            'images/hero/2.jpg',
                            'images/hero/3.jpg',
                            'images/hero/4.jpg'
                        ];
                    @endphp

                    @foreach($galleryImages as $index => $image)
                    <div class="relative group overflow-hidden rounded-xl shadow-lg transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <img 
                            src="{{ asset($image) }}" 
                            alt="Kegiatan SMKN 4 Bogor {{ $index + 1 }}" 
                            class="w-full h-40 md:h-48 object-cover transition-transform duration-500 group-hover:scale-110"
                            onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}'"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white font-medium"> </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest Gallery Section -->
<div class="py-20 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12 scroll-reveal">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Galeri Terbaru</h2>
            <p class="text-gray-600">Lihat foto-foto kegiatan terbaru kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $latestGalleries = \App\Models\Gallery::with('category')->latest()->take(4)->get();
            @endphp
            
            @foreach($latestGalleries as $index => $gallery)
                <div class="scroll-reveal-scale scroll-reveal-delay-{{ $index + 1 }} group">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">
                        <div class="relative overflow-hidden h-64">
                            <img src="{{ asset('storage/' . $gallery->image) }}" 
                                 alt="{{ $gallery->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $gallery->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $gallery->category->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="/galeri" class="inline-block px-8 py-4 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-bold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300">
                Lihat Semua Galeri →
            </a>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 px-6 bg-gradient-to-r from-cyan-500 to-teal-500">
    <div class="max-w-4xl mx-auto text-center text-white">
        <h2 class="text-4xl font-bold mb-6">Ingin Tahu Lebih Banyak?</h2>
        <p class="text-xl text-cyan-50 mb-8">Jelajahi galeri lengkap kami atau hubungi kami untuk informasi lebih lanjut</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="/galeri" class="px-8 py-4 bg-white text-cyan-600 font-bold rounded-2xl hover:shadow-xl hover:scale-105 transition-all duration-300">
                Jelajahi Galeri
            </a>
            <a href="/kontak" class="px-8 py-4 bg-white/20 backdrop-blur-lg text-white font-bold rounded-2xl border-2 border-white hover:bg-white hover:text-cyan-600 transition-all duration-300">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>
@endsection
