@extends('layouts.admin')

@section('page-title', 'Kelola Berita')
@section('page-subtitle', 'Tambah, edit, atau hapus berita sekolah')

@section('content')
<div class="space-y-6">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header & Add Button -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Berita</h2>
            <p class="text-gray-600 text-sm">Total: {{ $news->total() }} berita</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all flex items-center gap-2">
            <span class="text-xl">➕</span>
            <span>Tambah Berita</span>
        </a>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $item)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all">
                <!-- Image -->
                @if($item->image)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-cyan-100 to-teal-100 flex items-center justify-center">
                        <span class="text-6xl">📰</span>
                    </div>
                @endif

                <!-- Content -->
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-cyan-100 text-cyan-700 text-xs font-semibold rounded-full">
                            {{ ucfirst($item->category) }}
                        </span>
                        @if($item->status == 'published')
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Published</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">Draft</span>
                        @endif
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                    
                    <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                        <span>📅</span>
                        <span>{{ $item->published_date->format('d M Y') }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <a href="{{ route('admin.news.edit', $item) }}" class="flex-1 px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-center text-sm font-semibold">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors text-sm font-semibold">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="text-6xl mb-4">📰</div>
                <p class="text-lg font-semibold mb-2">Belum ada berita</p>
                <p class="text-sm text-gray-600">Klik tombol "Tambah Berita" untuk menambahkan berita baru</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
        <div class="mt-6">
            {{ $news->links() }}
        </div>
    @endif
</div>
@endsection
