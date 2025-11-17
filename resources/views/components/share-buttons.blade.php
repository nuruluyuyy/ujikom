<div class="flex flex-wrap items-center gap-3 mt-6 pt-4 border-t border-gray-200">
    <span class="text-sm font-medium text-gray-700">Bagikan:</span>
    
    <!-- WhatsApp -->
    <a href="https://wa.me/?text={{ urlencode('Lihat foto menarik ini di Galeri Sekolah: ' . $shareUrl) }}" 
       target="_blank" 
       rel="noopener noreferrer"
       class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white hover:bg-green-600 transition-colors"
       title="Bagikan ke WhatsApp">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.5 14.4c-.2 0-1.2-.2-1.4-.2s-.3 0-.5.2l-.6.7c-.6.7-1.3.8-1.9.3-1.5-1-2.7-2.7-3-3.8-.3-1.1.1-1.6.6-2.1.1-.1.2-.2.3-.3.2-.2.3-.3.4-.5.1-.2.1-.4 0-.5 0-.2-.3-.6-.4-.8-.5-.5-1.1-1.2-1.5-1.7-.4-.4-.8-.5-1.1-.5h-.5c-.2 0-.5.1-.7.2-.2.1-.5.3-.7.5-.7.8-1.1 1.8-1.1 2.8 0 1.1.4 2.1 1.1 3 .1.1.2.3.2.5s0 .4 0 .5c0 .2-.1.4-.2.5-.1.2-.3.4-.4.6-.1.2-.3.4-.3.6-.1.2 0 .5.1.7.5 1.2 1.3 2.3 2.4 3.1.8.6 1.8 1 2.8 1.3.3.1.6.1.8 0 .2 0 .4-.1.6-.2.1-.1.3-.1.5 0 .2.1.4.2.6.3.7.4 1.6.6 2.4.6 1.4 0 2.7-.5 3.8-1.4.2-.2.3-.4.4-.6.1-.2.2-.4.2-.7 0-.2 0-.5-.1-.7-.1-.1-.3-.2-.5-.3l-.7-.4c-.2-.1-.4-.1-.6 0-.2 0-.4.1-.6.2l-.8.5c-.1.1-.3.1-.5.1-.2 0-.4 0-.6-.1-.5-.2-1.2-.5-2.1-1.3-.1-.1-.2-.2-.3-.3-.1 0-.2-.1-.2-.2 0-.1 0-.2.1-.3.1-.1.2-.3.3-.4.1-.1.2-.2.2-.3.1-.1.1-.2.1-.3 0-.1 0-.2-.1-.3-.1-.1-.2-.3-.3-.4-.1-.1-.2-.3-.3-.4-.1-.1-.2-.2-.2-.3 0-.1 0-.2.1-.3.3-.3.6-.7.8-1 .1-.1.1-.3.1-.4 0-.1 0-.3-.1-.4-.1-.1-.2-.1-.3-.1h-1.4c-.1 0-.3 0-.4.1-.1.1-.2.2-.3.3-.4.6-.6 1.3-.6 2.1 0 .8.2 1.5.6 2.1.4.6 1 1.1 1.7 1.5.2.1.5.3.8.4.3.1.5.2.8.2.3 0 .6-.1.8-.2.2-.1.5-.2.7-.4.2-.1.4-.3.6-.5.2-.2.4-.4.6-.5.2-.1.4-.3.6-.4.2-.1.4-.2.7-.2.3 0 .5 0 .8.1l1.1.5c.1 0 .2 0 .3.1.1.1.1.2.1.3 0 .1 0 .2-.1.3-.1.1-.3.3-.5.4-.2.2-.4.4-.6.6-.2.2-.4.4-.6.6-.2.2-.5.4-.7.6-.3.2-.5.4-.8.5z"/>
        </svg>
    </a>
    
    <!-- Instagram -->
    <a href="https://www.instagram.com/?url={{ urlencode($shareUrl) }}" 
       target="_blank" 
       rel="noopener noreferrer"
       class="flex items-center justify-center w-10 h-10 rounded-full bg-pink-500 text-white hover:bg-pink-600 transition-colors"
       title="Bagikan ke Instagram">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2.2c3.1 0 3.5.1 4.7.3 1.1.2 1.7.5 2.1.9.4.4.7.9.9 2.1.2 1.2.3 1.6.3 4.7 0 3.1-.1 3.5-.3 4.7-.2 1.1-.5 1.7-.9 2.1-.4.4-.9.7-2.1.9-1.2.2-1.6.3-4.7.3s-3.5-.1-4.7-.3c-1.1-.2-1.7-.5-2.1-.9-.4-.4-.7-.9-.9-2.1-.2-1.2-.3-1.6-.3-4.7 0-3.1.1-3.5.3-4.7.2-1.1.5-1.7.9-2.1.4-.4.9-.7 2.1-.9 1.2-.2 1.6-.3 4.7-.3zm0-1.8c-3.2 0-3.6.1-4.8.3-1.3.2-2.2.6-3 1.3-.7.7-1.1 1.6-1.3 3-.2 1.2-.3 1.6-.3 4.8s.1 3.6.3 4.8c.2 1.3.6 2.2 1.3 3 .7.7 1.6 1.1 3 1.3 1.2.2 1.6.3 4.8.3s3.6-.1 4.8-.3c1.3-.2 2.2-.6 3-1.3.7-.7 1.1-1.6 1.3-3 .2-1.2.3-1.6.3-4.8s-.1-3.6-.3-4.8c-.2-1.3-.6-2.2-1.3-3-.7-.7-1.6-1.1-3-1.3-1.2-.2-1.6-.3-4.8-.3zm0 3.1c-3.3 0-6 2.7-6 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6zm0 9.9c-2.1 0-3.9-1.7-3.9-3.9s1.7-3.9 3.9-3.9 3.9 1.7 3.9 3.9-1.8 3.9-3.9 3.9zM19.8 5.6c0 .8-.6 1.4-1.4 1.4s-1.4-.6-1.4-1.4.6-1.4 1.4-1.4 1.4.6 1.4 1.4z"/>
        </svg>
    </a>
    
    <!-- TikTok -->
    <a href="https://www.tiktok.com/share/item/?url={{ urlencode($shareUrl) }}&title=Lihat%20foto%20menarik%20ini%20di%20Galeri%20Sekolah" 
       target="_blank" 
       rel="noopener noreferrer"
       class="flex items-center justify-center w-10 h-10 rounded-full bg-black text-white hover:bg-gray-800 transition-colors"
       title="Bagikan ke TikTok">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16.6 5.82s.51.5 0 0A4.28 4.28 0 0 1 15.54 3h-3.09v12.4a2.59 2.59 0 1 1-5.27 0c0-1.56 1.4-2.77 2.71-2.28V9.66c-4.45-.46-5.18 4.15-5.18 4.15C3.99 19.2 12 21.5 12 21.5c5.15 0 9.5-4.2 9.5-9.5V8.35c.04.17 0-8.35 0-8.35h-3.9a4.28 4.28 0 0 1-.98 5.82z"/>
        </svg>
    </a>
    
    <!-- Copy Link -->
    <button 
        onclick="copyToClipboard('{{ $shareUrl }}')" 
        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
        title="Salin Tautan">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
        </svg>
        <span>Salin Tautan</span>
    </button>
    
    <!-- QR Code Button -->
    <button 
        onclick="showQRCode('{{ $shareUrl }}')" 
        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
        title="Tampilkan QR Code">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
        </svg>
        <span>QR Code</span>
    </button>
    
    <!-- Barcode Scanner Button -->
    <button 
        onclick="document.getElementById('barcode-scanner').classList.toggle('hidden')" 
        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500"
        title="Pindai Barcode">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
        </svg>
        <span>Pindai Barcode</span>
    </button>
    
    <!-- Native Share Button (only shows on supported devices) -->
    <button 
        id="nativeShareBtn" 
        class="hidden items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-cyan-600 border border-transparent rounded-md hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
        title="Bagikan">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
        </svg>
        <span>Bagikan</span>
    </button>
</div>

<!-- QR Code Modal -->
<div id="qrCodeModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" onclick="document.getElementById('qrCodeModal').classList.add('hidden')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                            Scan QR Code
                        </h3>
                        <div class="mt-4">
                            <div id="qrcode" class="flex justify-center p-4 bg-white rounded-lg">
                                <!-- QR Code will be inserted here -->
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Gunakan kamera perangkat Anda untuk memindai kode QR ini
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-cyan-600 border border-transparent rounded-md shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('qrCodeModal').classList.add('hidden')">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
<script>
    // Show native share button if Web Share API is supported
    if (navigator.share) {
        document.getElementById('nativeShareBtn').classList.remove('hidden');
        document.getElementById('nativeShareBtn').addEventListener('click', async () => {
            try {
                await navigator.share({
                    title: document.title,
                    text: 'Lihat foto ini di Galeri Sekolah Nurul:',
                    url: window.location.href,
                });
            } catch (err) {
                console.log('Error sharing:', err);
            }
        });
    }

    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Show success message
            const originalText = event.target.innerText;
            event.target.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> <span>Tersalin!</span>';
            setTimeout(() => {
                event.target.innerHTML = originalText;
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }

    // Show QR Code
    function showQRCode(url) {
        const modal = document.getElementById('qrCodeModal');
        const qrContainer = document.getElementById('qrcode');
        
        // Clear previous QR code
        qrContainer.innerHTML = '';
        
        // Generate new QR code
        QRCode.toCanvas(qrContainer, url, { width: 200 }, function (error) {
            if (error) console.error(error);
        });
        
        // Show modal
        modal.classList.remove('hidden');
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }
</script>
@endpush
