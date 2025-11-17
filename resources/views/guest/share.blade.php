@extends('layouts.guest')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Bagikan Gambar</h1>
            
            <div class="mb-6">
                <img src="{{ $imageUrl }}" alt="{{ $gallery->title }}" class="w-full h-64 object-cover rounded">
                <h2 class="text-xl font-semibold mt-4">{{ $gallery->title }}</h2>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tautan Langsung</label>
                    <div class="flex">
                        <input type="text" id="share-link" value="{{ $url }}" readonly 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button onclick="copyToClipboard()" 
                            class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Salin
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bagikan ke Media Sosial</label>
                    <div class="flex space-x-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" 
                           target="_blank"
                           class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($gallery->title) }}" 
                           target="_blank"
                           class="bg-blue-400 text-white p-2 rounded-full hover:bg-blue-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <!-- Tambahkan platform sosial lainnya sesuai kebutuhan -->
                    </div>
                </div>

                <div class="pt-4 border-t">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Scan QR Code</h3>
                    <div class="flex justify-center">
                        <div id="qrcode" class="p-2 bg-white rounded border"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
<script>
    // Generate QR Code
    new QRCode(document.getElementById("qrcode"), {
        text: "{{ $url }}",
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });

    function copyToClipboard() {
        const copyText = document.getElementById("share-link");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        
        // Tampilkan notifikasi
        const button = event.target;
        const originalText = button.textContent;
        button.textContent = 'Tersalin!';
        button.classList.add('bg-green-500', 'hover:bg-green-600');
        
        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('bg-green-500', 'hover:bg-green-600');
            button.classList.add('bg-blue-500', 'hover:bg-blue-600');
        }, 2000);
    }
</script>
@endpush
@endsection