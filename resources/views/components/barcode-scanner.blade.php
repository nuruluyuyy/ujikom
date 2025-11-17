<div class="mt-6">
    <!-- Tombol Buka Kamera -->
    <button 
        onclick="openScanner()" 
        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        id="startScannerBtn">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span>Buka Pemindai Barcode</span>
    </button>

    <!-- Area Pindai -->
    <div id="scanner-container" class="mt-4 hidden">
        <div class="relative">
            <video id="scanner" class="w-full h-auto rounded-lg border-2 border-blue-500" playsinline></video>
            <div class="scanner-overlay">
                <div class="scanner-line"></div>
            </div>
            <button 
                onclick="closeScanner()" 
                class="absolute top-2 right-2 p-2 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none"
                title="Tutup Kamera">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="scan-result" class="mt-4 p-4 bg-gray-100 rounded-lg hidden">
            <h4 class="font-medium text-gray-900">Hasil Pindai:</h4>
            <p id="scanned-url" class="text-blue-600 break-all"></p>
            <button 
                onclick="visitScannedUrl()" 
                class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Kunjungi Tautan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/@zxing/library@latest"></script>
<script>
    let codeReader;
    let scannerActive = false;
    let currentStream = null;

    // Inisialisasi pembaca kode
    document.addEventListener('DOMContentLoaded', function() {
        codeReader = new ZXing.BrowserMultiFormatReader();
    });

    // Fungsi untuk membuka kamera dan memulai pemindaian
    async function openScanner() {
        const scannerContainer = document.getElementById('scanner-container');
        const startButton = document.getElementById('startScannerBtn');
        const videoElement = document.getElementById('scanner');
        
        try {
            // Tampilkan container scanner
            scannerContainer.classList.remove('hidden');
            startButton.disabled = true;
            
            // Minta izin kamera
            const stream = await navigator.mediaDevices.getUserMedia({ 
                video: { 
                    facingMode: "environment",
                    width: { ideal: 1920 },
                    height: { ideal: 1080 }
                } 
            });
            
            currentStream = stream;
            videoElement.srcObject = stream;
            
            // Tunggu hingga video siap
            await new Promise((resolve) => {
                videoElement.onloadedmetadata = () => {
                    videoElement.play();
                    resolve();
                };
            });
            
            // Mulai pemindaian
            codeReader.decodeFromVideoElement(videoElement, (result, err) => {
                if (result) {
                    // Tampilkan hasil pemindaian
                    const resultElement = document.getElementById('scan-result');
                    const urlElement = document.getElementById('scanned-url');
                    
                    urlElement.textContent = result.getText();
                    resultElement.classList.remove('hidden');
                    
                    // Berhenti memindai setelah berhasil
                    stopScanning();
                }
                
                if (err && !(err instanceof ZXing.NotFoundException)) {
                    console.error('Error scanning:', err);
                }
            });
            
            scannerActive = true;
            
        } catch (error) {
            console.error('Error accessing camera:', error);
            alert('Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.');
            closeScanner();
        }
    }
    
    // Fungsi untuk menghentikan pemindaian
    function stopScanning() {
        if (codeReader) {
            codeReader.reset();
        }
        
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
            currentStream = null;
        }
        
        scannerActive = false;
    }
    
    // Fungsi untuk menutup scanner
    function closeScanner() {
        stopScanning();
        
        const scannerContainer = document.getElementById('scanner-container');
        const startButton = document.getElementById('startScannerBtn');
        const resultElement = document.getElementById('scan-result');
        
        scannerContainer.classList.add('hidden');
        startButton.disabled = false;
        resultElement.classList.add('hidden');
    }
    
    // Fungsi untuk mengunjungi URL yang dipindai
    function visitScannedUrl() {
        const urlElement = document.getElementById('scanned-url');
        const url = urlElement.textContent.trim();
        
        if (url) {
            // Tambahkan http:// jika tidak ada protokol
            const fullUrl = url.startsWith('http') ? url : `http://${url}`;
            window.open(fullUrl, '_blank');
        }
    }
    
    // Membersihkan saat komponen di-unmount
    window.addEventListener('beforeunload', () => {
        if (scannerActive) {
            closeScanner();
        }
    });
</script>

<style>
    .scanner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }
    
    .scanner-line {
        width: 80%;
        height: 2px;
        background: rgba(59, 130, 246, 0.8);
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.6);
        animation: scan 2s infinite linear;
    }
    
    @keyframes scan {
        0% { transform: translateY(-100%); }
        100% { transform: translateY(200%); }
    }
</style>
@endpush
