@extends('admin.layouts.app') {{-- sesuaikan dengan layout admin kamu --}}

@section('title', 'Statistik Galeri')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Statistik Galeri</h1>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <th class="px-4 py-3 border-b">#</th>
                    <th class="px-4 py-3 border-b">Judul Foto</th>
                    <th class="px-4 py-3 border-b">Likes</th>
                    <th class="px-4 py-3 border-b">Shares</th>
                    <th class="px-4 py-3 border-b">Downloads</th>
                    <th class="px-4 py-3 border-b">Terakhir Disukai</th>
                    <th class="px-4 py-3 border-b">Terakhir Dibagikan</th>
                    <th class="px-4 py-3 border-b">Terakhir Diunduh</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse ($galleries as $index => $gallery)
                    @php
                        $stats = $gallery->stats;
                    @endphp
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                        <td class="px-4 py-3 border-b">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 border-b">
                            {{ $gallery->title }}
                        </td>
                        <td class="px-4 py-3 border-b font-semibold text-red-500">
                            {{ $stats->likes_count ?? 0 }}
                        </td>
                        <td class="px-4 py-3 border-b font-semibold text-blue-500">
                            {{ $stats->shares_count ?? 0 }}
                        </td>
                        <td class="px-4 py-3 border-b font-semibold text-green-600">
                            {{ $stats->downloads_count ?? 0 }}
                        </td>
                        <td class="px-4 py-3 border-b text-xs text-gray-500">
                            {{ optional($stats->last_liked_at)->format('d M Y H:i') ?? '-' }}
                        </td>
                        <td class="px-4 py-3 border-b text-xs text-gray-500">
                            {{ optional($stats->last_shared_at)->format('d M Y H:i') ?? '-' }}
                        </td>
                        <td class="px-4 py-3 border-b text-xs text-gray-500">
                            {{ optional($stats->last_downloaded_at)->format('d M Y H:i') ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                            Belum ada data galeri.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
