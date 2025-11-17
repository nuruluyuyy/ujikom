@extends('layouts.admin')

@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Update informasi berita')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita *</label>
                <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konten -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita *</label>
                <textarea name="content" rows="10" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Berita (Opsional)</label>
                
                @if($news->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="max-h-48 rounded-lg shadow-lg">
                    </div>
                @endif
                
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-cyan-500 transition-colors">
                    <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="previewImage(event)">
                    <label for="imageInput" class="cursor-pointer">
                        <div id="imagePreview" class="mb-4">
                            <span class="text-6xl">📷</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Klik untuk upload gambar baru</p>
                        <p class="text-xs text-gray-500">Format: JPG, PNG, GIF (Max: 2MB)</p>
                    </label>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori & Status -->
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                    <select name="category" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                        <option value="akademik" {{ old('category', $news->category) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="prestasi" {{ old('category', $news->category) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="kegiatan" {{ old('category', $news->category) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="pengumuman" {{ old('category', $news->category) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                    <select name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                        <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
            </div>

            <!-- Tanggal Publish -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publish *</label>
                <input type="date" name="published_date" value="{{ old('published_date', $news->published_date->format('Y-m-d')) }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                @error('published_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all">
                    💾 Update Berita
                </button>
                <a href="{{ route('admin.news.index') }}" class="px-8 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition-all">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="max-h-64 mx-auto rounded-lg shadow-lg">`;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
