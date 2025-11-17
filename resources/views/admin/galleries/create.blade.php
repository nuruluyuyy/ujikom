@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-plus-circle text-blue-500 mr-2"></i>
            Tambah Galeri Baru
        </h1>
        <a href="{{ route('admin.galleries.index') }}" class="text-blue-500 hover:text-blue-700">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <div class="font-medium">
                <i class="fas fa-exclamation-circle mr-1"></i> Terjadi kesalahan:
            </div>
            <ul class="mt-1 ml-5 list-disc text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <!-- Judul -->
            <div>
                <label for="title" class="block text-gray-700 mb-1">
                    Judul Galeri <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Contoh: Kegiatan Pramuka 2023"
                    required
                >
            </div>
            
            <!-- Kategori -->
            <div>
                <label for="category_id" class="block text-gray-700 mb-1">Kategori</label>
                <select
                    name="category_id"
                    id="category_id"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Pilih Kategori (Opsional)</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Unggah Gambar -->
            <div>
                <label class="block text-gray-700 mb-1">
                    Gambar Utama <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <div id="uploadArea" class="flex flex-col items-center justify-center">
                        <!-- Icon -->
                        <i id="uploadIcon" class="fas fa-image text-4xl text-blue-500 mb-4"></i>

                        <!-- Tombol Pilih/Ganti Gambar -->
                        <div class="mb-4">
                            <label for="image" class="cursor-pointer">
                                <div
                                    id="uploadButton"
                                    class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 inline-flex items-center"
                                >
                                    <i class="fas fa-upload mr-2"></i>
                                    <span>Pilih Gambar</span>
                                </div>
                            </label>
                        </div>

                        <!-- Info file + nama file -->
                        <div id="fileInfo" class="mt-2 text-center">
                            <p class="text-sm text-gray-500 mb-1">
                                Format: JPG, PNG, GIF (Maks. 5MB)
                            </p>
                            <div
                                id="fileNameDisplay"
                                class="hidden mt-2 p-2 bg-gray-100 rounded-lg border border-gray-200 inline-flex items-center"
                            >
                                <i class="fas fa-file-image text-blue-500 mr-2"></i>
                                <span id="fileNameText" class="text-sm font-medium text-gray-700"></span>
                                <span id="fileSize" class="text-xs text-gray-500 ml-2"></span>
                            </div>
                        </div>

                        <!-- Input file asli (disembunyikan) -->
                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="hidden"
                            accept="image/jpeg,image/png,image/gif"
                            onchange="previewImage(this)"
                            required
                        >
                    </div>
                    
                    <!-- Preview gambar -->
                    <div id="imagePreview" class="hidden mt-4">
                        <p class="text-sm text-gray-600 mb-2">Pratinjau Gambar:</p>
                        <div class="relative inline-block bg-gray-100 p-2 rounded-lg">
                            <img
                                id="preview"
                                class="h-48 rounded-lg border-2 border-dashed border-gray-300 object-cover"
                            >
                            <button
                                type="button"
                                onclick="removeImage()"
                                class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors duration-200"
                            >
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Status -->
            <div class="flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    {{ old('is_active', true) ? 'checked' : '' }}
                >
                <label for="is_active" class="ml-2 text-gray-700">Tampilkan galeri</label>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a
                    href="{{ route('admin.galleries.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-300"
                >
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    #dropZone {
        transition: all 0.3s ease;
    }
    #dropZone.drag-over {
        border-color: #3b82f6;
        background-color: #f0f9ff;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Dipanggil dari onchange="previewImage(this)"
    function previewImage(input) {
        const file = input.files[0];
        if (!file) {
            resetUI();
            return;
        }

        // Validasi ukuran (maks 5MB)
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            Swal.fire({
                icon: 'error',
                title: 'Ukuran terlalu besar',
                text: 'Ukuran gambar maksimal 5MB.'
            });
            input.value = '';
            resetUI();
            return;
        }

        // ------- TAMPILKAN NAMA FILE & SIZE --------
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const fileNameText    = document.getElementById('fileNameText');
        const fileSize        = document.getElementById('fileSize');

        if (fileNameDisplay && fileNameText && fileSize) {
            fileNameText.textContent = file.name;
            fileSize.textContent     = `(${(file.size / 1024).toFixed(1)} KB)`;
            fileNameDisplay.classList.remove('hidden');
        }

        // ------- UPDATE ICON & TOMBOL --------
        const uploadIcon   = document.getElementById('uploadIcon');
        const uploadButton = document.getElementById('uploadButton');

        if (uploadIcon) {
            uploadIcon.className = 'fas fa-check-circle text-4xl text-green-500 mb-4';
        }
        if (uploadButton) {
            uploadButton.innerHTML = '<i class="fas fa-sync-alt mr-2"></i><span>Ganti Gambar</span>';
            uploadButton.className = 'px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 inline-flex items-center';
        }

        // ------- PREVIEW GAMBAR --------
        const reader      = new FileReader();
        const previewImg  = document.getElementById('preview');
        const previewWrap = document.getElementById('imagePreview');

        reader.onload = function(e) {
            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.alt = 'Preview ' + file.name;
            }
            if (previewWrap) {
                previewWrap.classList.remove('hidden');
            }
        };

        reader.onerror = function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal membaca file. Silakan coba lagi.'
            });
            resetUI();
        };

        reader.readAsDataURL(file);
    }

    // Reset tampilan ke kondisi awal
    function resetUI() {
        const uploadIcon      = document.getElementById('uploadIcon');
        const uploadButton    = document.getElementById('uploadButton');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const fileNameText    = document.getElementById('fileNameText');
        const fileSize        = document.getElementById('fileSize');
        const previewImg      = document.getElementById('preview');
        const previewWrap     = document.getElementById('imagePreview');

        if (uploadIcon) {
            uploadIcon.className = 'fas fa-image text-4xl text-blue-500 mb-4';
        }
        if (uploadButton) {
            uploadButton.innerHTML = '<i class="fas fa-upload mr-2"></i><span>Pilih Gambar</span>';
            uploadButton.className = 'px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 inline-flex items-center';
        }
        if (fileNameDisplay) fileNameDisplay.classList.add('hidden');
        if (fileNameText)    fileNameText.textContent = '';
        if (fileSize)        fileSize.textContent     = '';
        if (previewImg) {
            previewImg.src = '';
            previewImg.alt = '';
        }
        if (previewWrap) previewWrap.classList.add('hidden');
    }

    // Tombol hapus gambar
    function removeImage() {
        const input = document.getElementById('image');
        if (input) {
            input.value = '';
        }
        resetUI();
    }

    // Biar fungsi bisa dipanggil dari HTML
    window.previewImage = previewImage;
    window.removeImage  = removeImage;
</script>
@endpush

@endsection
