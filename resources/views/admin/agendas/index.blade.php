@extends('layouts.admin')

@section('page-title', 'Kelola Agenda')
@section('page-subtitle', 'Tambah, edit, atau hapus agenda sekolah')

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
            <h2 class="text-2xl font-bold text-gray-800">Daftar Agenda</h2>
            <p class="text-gray-600 text-sm">Total: {{ $agendas->total() }} agenda</p>
        </div>
        <a href="{{ route('admin.agendas.create') }}" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all flex items-center gap-2">
            <span class="text-xl">➕</span>
            <span>Tambah Agenda</span>
        </a>
    </div>

    <!-- Agendas Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold">No</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Judul</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Lokasi</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($agendas as $index => $agenda)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $agendas->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">{{ $agenda->title }}</div>
                                <div class="text-sm text-gray-500 line-clamp-1">{{ Str::limit($agenda->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div>{{ $agenda->start_date->format('d M Y') }}</div>
                                @if($agenda->start_date != $agenda->end_date)
                                    <div class="text-xs text-gray-500">s/d {{ $agenda->end_date->format('d M Y') }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $agenda->location ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($agenda->status == 'upcoming')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Akan Datang</span>
                                @elseif($agenda->status == 'ongoing')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Sedang Berlangsung</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">Selesai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.agendas.edit', $agenda) }}" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors" title="Edit">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors" title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="text-6xl mb-4">📅</div>
                                <p class="text-lg font-semibold mb-2">Belum ada agenda</p>
                                <p class="text-sm">Klik tombol "Tambah Agenda" untuk menambahkan agenda baru</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($agendas->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t">
                {{ $agendas->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
