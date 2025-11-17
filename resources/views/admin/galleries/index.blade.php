@extends('layouts.admin')

@section('title', 'Daftar Galeri')
@section('page-title', 'Daftar Galeri')
@section('page-subtitle', 'Kelola foto-foto galeri sekolah')

@section('content')
    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 flex items-start gap-3">
            <span class="mt-0.5">✅</span>
            <div class="flex-1">
                {{ session('success') }}
            </div>
            <button type="button"
                    onclick="this.parentElement.remove()"
                    class="ml-2 text-emerald-700 hover:text-emerald-900">
                ✕
            </button>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
        {{-- Header kartu --}}
        <div class="px-6 py-4 flex flex-col gap-3 md:flex-row md:items-center md:justify-between border-b border-slate-100">
            <div>
                <h2 class="text-base md:text-lg font-semibold text-slate-800 flex items-center gap-2">
                    <span>🖼️</span> <span>Data Galeri</span>
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Daftar foto galeri yang tampil di website sekolah.
                </p>
            </div>

            <a href="{{ route('admin.galleries.create') }}"
               class="inline-flex items-center justify-center gap-2 rounded-xl bg-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-1">
                <span class="text-base">＋</span>
                <span>Tambah Galeri Baru</span>
            </a>
        </div>

        {{-- Filter & Search --}}
        <div class="px-6 pt-5 pb-3 border-b border-slate-100">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div class="w-full md:w-72">
                    <label for="search" class="block text-xs font-medium text-slate-500 mb-1">Cari galeri</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400 text-sm">🔍</span>
                        <input id="search" type="text"
                               class="w-full rounded-xl border border-slate-200 py-2 pl-9 pr-3 text-sm text-slate-700 placeholder:text-slate-400 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/60 outline-none"
                               placeholder="Cari berdasarkan judul, deskripsi, atau kategori...">
                    </div>
                </div>

                <div class="w-full md:w-60">
                    <label for="category-filter" class="block text-xs font-medium text-slate-500 mb-1">Filter kategori</label>
                    <div class="relative">
                        <select id="category-filter"
                                class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-2 pl-3 pr-9 text-sm text-slate-700 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/60 outline-none">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400 text-xs">▼</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="px-4 pb-4 pt-2">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm" id="dataTable">
                    <thead>
                        <tr class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                            <th class="px-3 py-3 text-center w-16">No</th>
                            <th class="px-3 py-3 text-center w-32">Gambar</th>
                            <th class="px-3 py-3 text-left">Judul</th>
                            <th class="px-3 py-3 text-center w-40">Kategori</th>
                            <th class="px-3 py-3 text-center w-36">Tanggal</th>
                            <th class="px-3 py-3 text-center w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="gallery-table-body" class="divide-y divide-slate-100">
                        @forelse($galleries as $index => $gallery)
                            <tr class="hover:bg-slate-50/60">
                                <td class="px-3 py-3 text-center align-top text-slate-600">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-3 py-3 text-center align-top">
                                    <div class="inline-flex rounded-xl border border-slate-200 bg-slate-50/40 p-0.5">
                                        <img src="{{ $gallery->image ? asset('storage/' . $gallery->image) : 'https://via.placeholder.com/100x75' }}"
                                             alt="{{ $gallery->title }}"
                                             class="h-16 w-20 rounded-lg object-cover">
                                    </div>
                                </td>
                                <td class="px-3 py-3 align-top">
                                    <div class="font-semibold text-slate-800">
                                        {{ $gallery->title }}
                                    </div>
                                    @if($gallery->description)
                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ Str::limit($gallery->description, 100) }}
                                        </p>
                                    @endif
                                </td>
                                <td class="px-3 py-3 text-center align-top">
                                    @if($gallery->category)
                                        <span class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-semibold text-cyan-700">
                                            {{ $gallery->category->name }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-[11px] font-medium text-slate-500">
                                            Tidak ada kategori
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-3 text-center align-top text-slate-600">
                                    {{ $gallery->created_at->format('d M Y') }}
                                </td>
                                <td class="px-3 py-3 text-center align-top">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                           class="inline-flex items-center rounded-lg bg-amber-50 px-2.5 py-1.5 text-xs font-medium text-amber-700 hover:bg-amber-100">
                                            ✏️ <span class="ml-1 hidden sm:inline">Edit</span>
                                        </a>
                                        <button type="button"
                                                onclick="confirmDelete({{ $gallery->id }})"
                                                class="inline-flex items-center rounded-lg bg-rose-50 px-2.5 py-1.5 text-xs font-medium text-rose-700 hover:bg-rose-100">
                                            🗑️ <span class="ml-1 hidden sm:inline">Hapus</span>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $gallery->id }}"
                                          action="{{ route('admin.galleries.destroy', $gallery) }}"
                                          method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <span class="text-4xl">🖼️</span>
                                        <h3 class="text-sm font-medium text-slate-700">Belum ada data galeri</h3>
                                        <p class="text-xs text-slate-500">
                                            Mulai dengan menambahkan galeri baru.
                                        </p>
                                        <a href="{{ route('admin.galleries.create') }}"
                                           class="mt-1 inline-flex items-center rounded-xl bg-cyan-600 px-4 py-2 text-xs font-medium text-white hover:bg-cyan-700">
                                            + Tambah Galeri
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($galleries->hasPages())
                <div class="mt-4">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Konfirmasi hapus (pakai SweetAlert global kalau sudah ada, tapi fallback ini tetap aman)
    function confirmDelete(id) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        } else {
            if (confirm('Yakin ingin menghapus galeri ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    }

    // Pencarian & filter kategori (versi sederhana tanpa DataTables)
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const categoryFilter = document.getElementById('category-filter');
        const rows = document.querySelectorAll('#gallery-table-body tr');

        function applyFilter() {
            const searchValue = (searchInput.value || '').toLowerCase();
            const categoryId = categoryFilter.value;
            const selectedCategoryText = categoryFilter.options[categoryFilter.selectedIndex].text.trim();

            rows.forEach(function (row) {
                const rowText = row.innerText.toLowerCase();
                const badgeEl = row.querySelector('td:nth-child(4) .inline-flex');
                const rowCategory = badgeEl ? badgeEl.textContent.trim() : '';

                const matchesSearch = !searchValue || rowText.indexOf(searchValue) > -1;
                const matchesCategory = !categoryId || rowCategory === selectedCategoryText;

                if (matchesSearch && matchesCategory) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        if (searchInput) {
            searchInput.addEventListener('keyup', applyFilter);
        }
        if (categoryFilter) {
            categoryFilter.addEventListener('change', applyFilter);
        }
    });
</script>
@endpush
