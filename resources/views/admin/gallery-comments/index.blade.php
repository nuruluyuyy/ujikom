@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Moderasi Komentar Galeri</h1>
            <p class="text-gray-600 mt-1">Kelola komentar dari pengunjung</p>
        </div>
        @if($pendingCount > 0)
        <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-3 rounded-2xl shadow-lg">
            <span class="text-2xl font-bold">{{ $pendingCount }}</span>
            <span class="text-sm ml-2">Menunggu Persetujuan</span>
        </div>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Comments List -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        @if($comments->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Galeri</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Komentar</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($comments as $comment)
                        <tr class="hover:bg-gray-50 transition-colors {{ !$comment->is_approved ? 'bg-orange-50' : '' }}">
                            <td class="px-6 py-4">
                                @if($comment->is_approved)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        ✓ Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-500 text-white animate-pulse">
                                        ⏳ Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $comment->gallery->image) }}" 
                                         alt="{{ $comment->gallery->title }}"
                                         class="w-12 h-12 object-cover rounded-lg">
                                    <span class="font-medium text-gray-800">{{ Str::limit($comment->gallery->title, 30) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $comment->name }}</div>
                                @if($comment->email)
                                    <div class="text-xs text-gray-500">{{ $comment->email }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-700">{{ Str::limit($comment->comment, 50) }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ $comment->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    @if(!$comment->is_approved)
                                        <form action="{{ route('admin.gallery-comments.approve', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm font-semibold transition-all hover:scale-105">
                                                ✓ Setujui
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.gallery-comments.reject', $comment->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold transition-all hover:scale-105">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50">
                {{ $comments->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">💬</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Komentar</h3>
                <p class="text-gray-600">Komentar dari pengunjung akan muncul di sini</p>
            </div>
        @endif
    </div>
</div>
@endsection
