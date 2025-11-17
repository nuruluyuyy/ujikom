@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Pesan Kontak</h1>
            <p class="text-gray-600 mt-1">Kelola pesan dari pengunjung</p>
        </div>
        @if($unreadCount > 0)
        <div class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white px-6 py-3 rounded-2xl shadow-lg">
            <span class="text-2xl font-bold">{{ $unreadCount }}</span>
            <span class="text-sm ml-2">Pesan Baru</span>
        </div>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-2xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Messages List -->
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        @if($messages->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Nama</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Subjek</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($messages as $message)
                        <tr class="hover:bg-gray-50 transition-colors {{ !$message->is_read ? 'bg-cyan-50' : '' }}">
                            <td class="px-6 py-4">
                                @if($message->is_read)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">
                                        ✓ Dibaca
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-cyan-500 text-white animate-pulse">
                                        ● Baru
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $message->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $message->email }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ Str::limit($message->subject, 30) }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ $message->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                                       class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm font-semibold transition-all hover:scale-105">
                                        Detail
                                    </a>
                                    <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm font-semibold transition-all hover:scale-105">
                                            Hapus
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
                {{ $messages->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Pesan</h3>
                <p class="text-gray-600">Pesan dari pengunjung akan muncul di sini</p>
            </div>
        @endif
    </div>
</div>
@endsection
