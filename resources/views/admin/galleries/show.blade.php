@extends('layouts.admin')

@section('content')
<style>
    /* Fade-in Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Zoom-in Animation */
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Slide-in from Left */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Slide-in from Right */
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.6s ease-out;
    }

    .animate-zoomIn {
        animation: zoomIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .animate-slideInLeft {
        animation: slideInLeft 0.6s ease-out;
    }

    .animate-slideInRight {
        animation: slideInRight 0.6s ease-out;
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
</style>

<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 p-6">
    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-3xl overflow-hidden animate-zoomIn">
        <!-- Image Section with Zoom -->
        <div class="relative overflow-hidden group">
            <!-- Tombol Download -->
            <div class="absolute top-4 right-4 z-10">
                <a href="{{ route('gallery.download', $gallery) }}" 
                   class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full shadow-lg transform hover:scale-105 transition-all duration-300"
                   title="Download Gambar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Download</span>
                </a>
            </div>
            
            <img src="{{ asset('storage/' . $gallery->image) }}" 
                 alt="{{ $gallery->title }}" 
                 class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-110">
            
            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <!-- Category Badge -->
            <div class="absolute top-6 left-6 bg-gradient-to-r from-cyan-500 to-teal-500 text-white text-sm font-semibold px-4 py-2 rounded-full shadow-lg animate-slideInLeft">
                {{ $gallery->category->name ?? 'Tanpa Kategori' }}
            </div>

            <!-- Date Badge -->
            <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-sm text-gray-700 text-sm font-semibold px-4 py-2 rounded-full shadow-lg animate-slideInRight">
                📅 {{ $gallery->created_at->format('d M Y') }}
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-8">
            <!-- Title -->
            <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mb-4 text-center animate-fadeIn">
                {{ $gallery->title }}
            </h1>

            <!-- Description (if exists) -->
            @if($gallery->description ?? false)
            <p class="text-gray-600 text-center mb-6 leading-relaxed animate-fadeIn delay-100">
                {{ $gallery->description }}
            </p>
            @endif

            <!-- Divider -->
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-500 to-teal-500 mx-auto mb-8 rounded-full animate-fadeIn delay-200"></div>

            <!-- Info Cards -->
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-gradient-to-br from-cyan-50 to-teal-50 p-4 rounded-2xl text-center animate-fadeIn delay-300">
                    <div class="text-2xl mb-2">📸</div>
                    <div class="text-sm text-gray-600">Kategori</div>
                    <div class="font-semibold text-gray-800">{{ $gallery->category->name ?? '-' }}</div>
                </div>
                <div class="bg-gradient-to-br from-cyan-50 to-teal-50 p-4 rounded-2xl text-center animate-fadeIn delay-400">
                    <div class="text-2xl mb-2">📅</div>
                    <div class="text-sm text-gray-600">Ditambahkan</div>
                    <div class="font-semibold text-gray-800">{{ $gallery->created_at->format('d M Y') }}</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center gap-4 animate-fadeIn delay-400">
                <a href="{{ route('admin.galleries.index') }}"
                   class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all duration-300 hover:scale-105 hover:shadow-lg flex items-center gap-2">
                   <span>←</span> Kembali
                </a>
                <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                   class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white rounded-xl font-semibold transition-all duration-300 hover:scale-105 hover:shadow-lg flex items-center gap-2">
                   <span>✏️</span> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
