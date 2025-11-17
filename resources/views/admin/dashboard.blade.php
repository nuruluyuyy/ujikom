@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang di admin panel SMKN 4 Bogor')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-cyan-500 to-teal-500 rounded-3xl p-8 text-white shadow-xl">
        <h1 class="text-3xl font-bold mb-2">👋 Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</h1>
        <p class="text-cyan-50">Kelola galeri sekolah dan kategori dengan mudah.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Galleries -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">🖼️</span>
                </div>
                <span class="text-3xl font-bold text-blue-600">{{ \App\Models\Gallery::count() }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Galeri</h3>
            <a href="{{ route('admin.galleries.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua →</a>
        </div>

        <!-- Total Categories -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📂</span>
                </div>
                <span class="text-3xl font-bold text-purple-600">{{ \App\Models\Category::count() }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-600 mb-1">Total Kategori</h3>
            <a href="{{ route('admin.categories.index') }}" class="text-xs text-purple-600 hover:text-purple-700 font-medium">Lihat Semua →</a>
        </div>

        <!-- Stats Placeholder -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📊</span>
                </div>
                <span class="text-3xl font-bold text-green-600">0</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-600 mb-1">Statistik</h3>
            <p class="text-xs text-gray-500">Fitur komentar dinonaktifkan</p>
        </div>

        <!-- Unread Messages -->
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📧</span>
                </div>
                @php
                    try {
                        $unreadMessages = \App\Models\ContactMessage::where('is_read', false)->count();
                    } catch (\Exception $e) {
                        $unreadMessages = 0;
                    }
                @endphp
                <span class="text-3xl font-bold text-orange-600">{{ $unreadMessages }}</span>
            </div>
            <h3 class="text-sm font-semibold text-gray-600 mb-1">Pesan Belum Dibaca</h3>
            <a href="{{ route('admin.contact-messages.index') }}" class="text-xs text-orange-600 hover:text-orange-700 font-medium">Lihat Pesan →</a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all border-l-4 border-teal-500">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-14 h-14 bg-teal-100 rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">🖼️</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Kelola Galeri</h3>
                    <p class="text-sm text-gray-600">Upload atau edit foto</p>
                </div>
            </div>
            <a href="{{ route('admin.galleries.index') }}" class="block w-full text-center bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-semibold py-3 rounded-xl hover:shadow-lg transition-all">
                Buka Galeri
            </a>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all border-l-4 border-green-500">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                    <span class="text-3xl">✨</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Fitur Baru</h3>
                    <p class="text-sm text-gray-600">Segera hadir</p>
                </div>
            </div>
            <button class="w-full text-center bg-gradient-to-r from-green-500 to-teal-500 text-white font-semibold py-3 rounded-xl opacity-50 cursor-not-allowed">
                Dalam Pengembangan
            </button>
        </div>
    </div>
</div>
@endsection
