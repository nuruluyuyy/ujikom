<div id="shareModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 w-full max-w-md mx-4 shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="shareModalContent">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Bagikan</h3>
            <button onclick="closeShareModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- QR Code Section -->
        <div class="mb-6 text-center">
            <div class="bg-white p-4 rounded-lg inline-block">
                <div id="qrcode" class="w-40 h-40 mx-auto"></div>
            </div>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Scan untuk membuka tautan</p>
        </div>
        
        <!-- Share Options -->
        <div class="grid grid-cols-4 gap-4 mb-6">
            <!-- WhatsApp -->
            <a href="#" class="share-option flex flex-col items-center p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" data-platform="whatsapp">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white mb-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.498 14.382v3.3c0 .6.3.8 1.1.3l3-1.5c.5-.2.7-.6.7-1.1.1-4.2-3.4-7.8-7.8-7.8-4.1 0-7.4 3.3-7.4 7.4 0 4.1 3.3 7.4 7.4 7.4 1.2 0 2.4-.3 3.5-.8.3-.2.2-.5.1-.7l-.5-.8c-.2-.3-.5-.4-.8-.4h-5c-.3 0-.5-.2-.5-.5v-2.5c0-.3.2-.5.5-.5h12.3c.3 0 .5.2.5.5z"/>
                        <path d="M12 2C6.5 2 2 6.5 2 12c0 1.7.5 3.4 1.3 4.8l-1.2 3.6c-.1.3 0 .7.3.9.1.1.3.2.5.2.1 0 .3 0 .4-.1l4.1-2.1c1.2.7 2.5 1.1 3.9 1.1 5.5 0 10-4.5 10-10S17.5 2 12 2zm0 18.5c-1.3 0-2.5-.3-3.6-.9l-.4-.2-2.5 1.3.7-2.1-.2-.4c-.6-1.1-.9-2.3-.9-3.6 0-4.7 3.8-8.5 8.5-8.5s8.5 3.8 8.5 8.5-3.8 8.5-8.5 8.5z" fill-rule="evenodd" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="text-xs mt-1">WhatsApp</span>
            </a>
            
            <!-- Facebook -->
            <a href="#" class="share-option flex flex-col items-center p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" data-platform="facebook">
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white mb-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12c0-5.5-4.5-10-10-10S2 6.5 2 12c0 5 3.7 9.1 8.4 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7c4.7-.8 8.4-4.9 8.4-9.9z"/>
                    </svg>
                </div>
                <span class="text-xs mt-1">Facebook</span>
            </a>
            
            <!-- Twitter -->
            <a href="#" class="share-option flex flex-col items-center p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" data-platform="twitter">
                <div class="w-12 h-12 bg-sky-500 rounded-full flex items-center justify-center text-white mb-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                </div>
                <span class="text-xs mt-1">Twitter</span>
            </a>
            
            <!-- Instagram -->
            <a href="#" class="share-option flex flex-col items-center p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" data-platform="instagram">
                <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-amber-500 rounded-full flex items-center justify-center text-white mb-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                </div>
                <span class="text-xs mt-1">Instagram</span>
            </a>
            
            <!-- TikTok -->
            <a href="#" class="share-option flex flex-col items-center p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" data-platform="tiktok">
                <div class="w-12 h-12 bg-gray-900 rounded-full flex items-center justify-center text-white mb-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                    </svg>
                </div>
                <span class="text-xs mt-1">TikTok</span>
            </a>
            
            <!-- Copy Link -->
            <button onclick="copyToClipboard()" class="share-option flex flex-col items-center p-3 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" data-platform="copy">
                <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white mb-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-xs mt-1">Salin Tautan</span>
                <span id="copySuccess" class="text-xs text-green-600 font-medium hidden">Tersalin!</span>
            </button>
        </div>
        
        <!-- Share Link -->
        <div class="relative">
            <input type="text" id="shareLink" readonly class="w-full px-4 py-2 pr-10 rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
            <button onclick="copyToClipboard()" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
<script>
    let currentShareUrl = '';
    
    function openShareModal(url, title = '') {
        currentShareUrl = url || window.location.href;
        document.getElementById('shareLink').value = currentShareUrl;
        document.getElementById('shareModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        // Animate in
        setTimeout(() => {
            const modal = document.getElementById('shareModalContent');
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        // Generate QR Code
        const qrCodeElement = document.getElementById('qrcode');
        qrCodeElement.innerHTML = '';
        new QRCode(qrCodeElement, {
            text: currentShareUrl,
            width: 160,
            height: 160,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        
        // Setup share options
        setupShareOptions(title);
    }
    
    function closeShareModal() {
        const modal = document.getElementById('shareModalContent');
        modal.classList.remove('scale-100', 'opacity-100');
        modal.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            document.getElementById('shareModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.getElementById('copySuccess').classList.add('hidden');
        }, 200);
    }
    
    function setupShareOptions(title = '') {
        const shareUrl = encodeURIComponent(currentShareUrl);
        const shareText = encodeURIComponent(title || document.title);
        const websiteName = encodeURIComponent('Galeri Sekolah Nurul');
        
        // Update share links
        document.querySelectorAll('.share-option').forEach(option => {
            const platform = option.dataset.platform;
            let url = '#';
            
            switch(platform) {
                case 'whatsapp':
                    url = `https://api.whatsapp.com/send?text=${shareText}%0A%0A${shareUrl}`;
                    break;
                case 'facebook':
                    url = `https://www.facebook.com/sharer/sharer.php?u=${shareUrl}&quote=${shareText}`;
                    break;
                case 'twitter':
                    url = `https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareText}&via=${websiteName}`;
                    break;
                case 'instagram':
                    // Instagram doesn't support direct sharing, use instagram.com/direct/inbox/
                    url = `https://www.instagram.com/direct/inbox/`;
                    option.addEventListener('click', (e) => {
                        e.preventDefault();
                        copyToClipboard();
                        window.open(url, '_blank');
                    });
                    break;
                case 'tiktok':
                    // TikTok sharing via messages
                    url = `https://www.tiktok.com/messages?share_id=${shareUrl}`;
                    option.addEventListener('click', (e) => {
                        e.preventDefault();
                        copyToClipboard();
                        window.open(url, '_blank');
                    });
                    break;
                case 'telegram':
                    url = `https://t.me/share/url?url=${shareUrl}&text=${shareText}`;
                    break;
            }
            
            if (platform !== 'copy') {
                option.href = url;
                option.target = '_blank';
                option.rel = 'noopener noreferrer';
                
                // Remove any existing click event listeners to prevent duplicates
                const newElement = option.cloneNode(true);
                option.parentNode.replaceChild(newElement, option);
            }
        });
    }
    
    function copyToClipboard() {
        const copyText = document.getElementById('shareLink');
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand('copy');
        
        const copySuccess = document.getElementById('copySuccess');
        copySuccess.classList.remove('hidden');
        setTimeout(() => {
            copySuccess.classList.add('hidden');
        }, 2000);
    }
    
    // Close modal when clicking outside
    document.getElementById('shareModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeShareModal();
        }
    });
    
    // Close with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeShareModal();
        }
    });
</script>
@endpush
