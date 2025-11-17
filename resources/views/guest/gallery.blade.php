@extends('layouts.public')

@section('head-scripts')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- QR Code Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    // Define gallery data BEFORE everything else
    window.galleryImages = [
        @forelse ($galleries as $gallery)
        {
            id: {{ $gallery->id }},
            src: "{{ asset('storage/' . $gallery->image) }}",
            title: {!! json_encode($gallery->title) !!},
            category: {!! json_encode($gallery->category->name ?? '-') !!}
        }{{ !$loop->last ? ',' : '' }}
        @empty
        @endforelse
    ];
    
    // Ensure galleryImages is always defined as an array
    if (typeof window.galleryImages === 'undefined') {
        window.galleryImages = [];
    }
    
    console.log('Gallery images loaded:', window.galleryImages.length, 'items');
</script>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Modern -->
        <div class="flex flex-col items-center mb-12 scroll-reveal">
            <div class="w-full text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-3 text-gradient-animate tracking-tight">
                    Galeri Sekolah
                </h1>
                <p class="text-gray-700 text-base md:text-lg font-medium float-gentle">Temukan momen terbaik SMKN 4 Bogor ✨</p>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const headerShareButton = document.getElementById('headerShareButton');
                if (headerShareButton) {
                    headerShareButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        const currentUrl = window.location.href;
                        
                        // Cek apakah browser mendukung Web Share API
                        if (navigator.share) {
                            navigator.share({
                                title: 'Galeri Sekolah SMKN 4 Bogor',
                                text: 'Lihat koleksi foto terbaik dari SMKN 4 Bogor',
                                url: currentUrl
                            }).catch(err => {
                                console.log('Error sharing:', err);
                                openShareModal('share', 'Galeri Sekolah');
                            });
                        } else {
                            // Fallback untuk browser yang tidak mendukung Web Share API
                            openShareModal('share', 'Galeri Sekolah');
                        }
                    });
                }
            });
        </script>

        <!-- Filter Kategori Modern -->
        <div class="flex flex-wrap justify-center gap-3 mb-12 scroll-reveal scroll-reveal-delay-1">
            <button onclick="filterGallery('all')"
                    class="filter-btn px-6 py-3 bg-gradient-to-r from-cyan-500 to-teal-500 text-white rounded-2xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 glow-on-hover ripple">
                Semua
            </button>
            @foreach ($categories as $category)
                <button onclick="filterGallery('{{ $category->id }}')"
                        class="filter-btn px-6 py-3 bg-white text-gray-700 rounded-2xl font-semibold shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 border border-gray-200 ripple">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <!-- Galeri Grid Modern -->
        <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($galleries as $index => $gallery)
                <div class="gallery-item group rounded-3xl overflow-hidden bg-white shadow-lg hover:shadow-2xl transform transition-all duration-500 scroll-reveal-scale scroll-reveal-delay-{{ ($index % 6) + 1 }} card-shine gradient-border"
                     data-category="{{ $gallery->category_id ?? '' }}"
                     data-gallery-index="{{ $index }}">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $gallery->image) }}"
                             alt="{{ $gallery->title }}"
                             class="w-full h-64 object-cover image-tilt">
                    </div>
                    <div class="p-4 bg-gradient-to-br from-white to-cyan-50/30">
                        <h3 class="text-base font-semibold text-gray-800 mb-2 group-hover:text-cyan-600 transition-colors line-clamp-2">{{ $gallery->title }}</h3>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <!-- Like Button -->
                            <button class="flex items-center gap-1 like-button {{ $gallery->is_liked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }}"
                                    data-gallery-id="{{ $gallery->id }}"
                                    onclick="handleLike(event)"
                                    title="{{ $gallery->is_liked ? 'Batalkan suka' : 'Suka gambar ini' }}">
                                <i class="{{ $gallery->is_liked ? 'fas' : 'far' }} fa-heart"></i>
                                <span class="like-count ml-1">{{ $gallery->likes_count }}</span>
                            </button>
                            
<!-- Share Button -->
                            <button class="flex items-center gap-1 hover:text-blue-500 transition-colors share-button"
                                    data-gallery-id="{{ $gallery->id }}"
                                    data-gallery-title="{{ $gallery->title }}"
                                    title="Bagikan gambar ini">
                                <i class="fas fa-share-alt"></i>
                                <span class="text-xs font-medium ml-1">Bagikan</span>
                            </button>
                            
                            <!-- Download Button -->
                            <a href="{{ Auth::check() ? route('gallery.download', $gallery) : route('login') }}" 
                               class="group relative flex items-center text-gray-600 hover:text-cyan-600 transition-colors"
                               title="{{ Auth::check() ? 'Download Gambar' : 'Login untuk mengunduh' }}"
                               @if(!Auth::check()) onclick="event.preventDefault(); showToast('Anda harus login terlebih dahulu untuk mengunduh gambar.', 'error');" @endif>
                                <div class="relative p-1.5 group-hover:bg-cyan-50 rounded-full transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <div class="absolute inset-0 bg-cyan-500/10 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                                </div>
                                <span class="text-xs font-medium ml-1">Unduh</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Belum ada foto di galeri.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Share Modal -->
    <div id="shareModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 id="shareModalTitle" class="text-xl font-bold text-gray-800">Bagikan</h3>
                    <button onclick="closeShareModal()" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Copy Link -->
                <div class="mb-6">
                    <div class="flex items-center border rounded-lg overflow-hidden">
                        <input type="text" id="shareLink" readonly 
                               class="flex-1 px-4 py-3 text-sm text-gray-700 bg-gray-50 focus:outline-none"
                               value="">
                        <button onclick="copyToClipboard()" 
                                class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-3 transition-colors">
                            Salin
                        </button>
                    </div>
                    <p id="copyStatus" class="text-xs text-green-500 mt-1 hidden">Tautan berhasil disalin!</p>
                </div>

                <!-- QR Code -->
                <div class="mb-6 text-center">
                    <div class="flex justify-center mb-3" id="qrcode"></div>
                    <p class="text-sm text-gray-600">Scan untuk membagikan</p>
                </div>

                <!-- Social Media -->
                <div class="grid grid-cols-4 gap-4">
                    <a href="#" onclick="return shareOnSocial('whatsapp')" class="flex flex-col items-center p-3 rounded-xl hover:bg-green-50 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mb-1">
                            <i class="fab fa-whatsapp text-green-500 text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-600">WhatsApp</span>
                    </a>
                    <a href="#" onclick="return shareOnSocial('facebook')" class="flex flex-col items-center p-3 rounded-xl hover:bg-blue-50 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-1">
                            <i class="fab fa-facebook text-blue-600 text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-600">Facebook</span>
                    </a>
                    <a href="#" onclick="return shareOnSocial('twitter')" class="flex flex-col items-center p-3 rounded-xl hover:bg-blue-50 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-1">
                            <i class="fab fa-twitter text-blue-400 text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-600">Twitter</span>
                    </a>
                    <a href="#" onclick="return shareOnSocial('telegram')" class="flex flex-col items-center p-3 rounded-xl hover:bg-blue-50 transition-colors">
                        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mb-1">
                            <i class="fab fa-telegram text-blue-500 text-2xl"></i>
                        </div>
                        <span class="text-xs text-gray-600">Telegram</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Global variables
    let currentShareUrl = '';
    let qrCode = null;
    
    // Pastikan fungsi tersedia di global scope
    window.openShareModal = openShareModal;
    window.closeShareModal = closeShareModal;
    window.copyToClipboard = copyToClipboard;
    window.shareOnSocial = shareOnSocial;
    
    // Function to show toast notifications
    function showToast(message, type = 'info') {
        // Remove existing toast if any
        const existingToast = document.getElementById('toast-notification');
        if (existingToast) {
            existingToast.remove();
        }

        // Create toast element
        const toast = document.createElement('div');
        toast.id = 'toast-notification';
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${
            type === 'error' ? 'bg-red-500' : 
            type === 'success' ? 'bg-green-500' : 
            'bg-blue-500'
        } z-50 transform transition-all duration-300 translate-y-2 opacity-0`;
        
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Trigger reflow
        void toast.offsetWidth;
        
        // Show toast
        toast.classList.remove('translate-y-2', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-2', 'opacity-0');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
    
    // Function to handle like button click
    async function handleLike(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const button = e.currentTarget;
        const galleryId = button.getAttribute('data-gallery-id');
        const likeCount = button.querySelector('.like-count');
        const icon = button.querySelector('i');
        
        // Tampilkan loading state
        const originalHTML = button.innerHTML;
        button.disabled = true;
        
        try {
            const response = await fetch(`/galleries/${galleryId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const data = await response.json();
            
            if (data.success) {
                // Update UI
                if (data.liked) {
                    button.classList.add('text-red-500');
                    button.classList.remove('text-gray-500', 'hover:text-red-500');
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    showToast('Anda menyukai foto ini!', 'success');
                } else {
                    button.classList.remove('text-red-500');
                    button.classList.add('text-gray-500', 'hover:text-red-500');
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    showToast('Suka dibatalkan', 'info');
                }
                
                // Update like count
                if (likeCount) {
                    likeCount.textContent = data.likes_count;
                }
                
                // Update lightbox if open
                const lightbox = document.getElementById('lightbox');
                if (lightbox && !lightbox.classList.contains('hidden')) {
                    const lightboxLikeBtn = document.getElementById('lightbox-like');
                    const lightboxLikeCount = document.getElementById('lightbox-like-count');
                    if (lightboxLikeBtn && lightboxLikeCount) {
                        lightboxLikeBtn.innerHTML = `
                            <i class="${data.liked ? 'fas' : 'far'} fa-heart"></i>
                            <span id="lightbox-like-count" class="ml-1">${data.likes_count}</span>
                        `;
                    }
                }
            } else {
                showToast(data.message || 'Terjadi kesalahan', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Gagal menyimpan like. Silakan coba lagi.', 'error');
        } finally {
            // Kembalikan tombol ke state semula
            button.disabled = false;
        }
                
                
            // Kembalikan tombol ke keadaan semula
            button.innerHTML = originalHTML;
            button.disabled = false;
        }
    }

    // Inisialisasi tombol like dan share
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded, initializing buttons...');
        
        // Inisialisasi tombol like
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', handleLike);
        });
        
        // Inisialisasi tombol share
        document.querySelectorAll('.share-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const galleryId = this.getAttribute('data-gallery-id');
                const title = this.getAttribute('data-gallery-title');
                console.log('Share button clicked - Gallery ID:', galleryId, 'Title:', title);
                openShareModal(galleryId, title);
            });
        });
        
        // Close modal when clicking outside
        const shareModal = document.getElementById('shareModal');
        if (shareModal) {
            shareModal.addEventListener('click', function(e) {
                if (e.target === shareModal) {
                    closeShareModal();
                }
            });
        }
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeShareModal();
            }
        });
        
        // Pastikan library QR Code sudah dimuat
        if (typeof QRCode === 'undefined') {
            console.warn('QRCode library not loaded, loading now...');
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js';
            script.integrity = 'sha384-3zSEDfvllQohrq0PHLsnkwU8Kh1QyPhxXvI+AUv0FQhA6U8dEeO/RO6kS+gC3M';
            script.crossOrigin = 'anonymous';
            document.head.appendChild(script);
        }
        
        // Inisialisasi tooltip untuk tombol like
        tippy('.like-button', {
            content: 'Menyukai gambar ini',
            allowHTML: true,
            animation: 'scale-extreme',
            theme: 'light',
            placement: 'bottom',
            delay: [200, 0],
            onShow(instance) {
                const button = instance.reference;
                const title = button.getAttribute('title');
                instance.setContent(title);
            }
        });
    });

    // Fungsi untuk membuka modal berbagi
    function openShareModal(galleryId, title) {
        try {
            console.log('Opening share modal for gallery:', galleryId, 'with title:', title);
            
            // Generate URL yang akan dibagikan
            const baseUrl = window.location.origin;
            currentShareUrl = `${baseUrl}/gallery/${galleryId}`;
            console.log('Share URL:', currentShareUrl);
            
            // Perbarui URL di input
            const shareLinkInput = document.getElementById('shareLink');
            if (shareLinkInput) {
                shareLinkInput.value = currentShareUrl;
                shareLinkInput.select();
            } else {
                console.error('Share link input not found');
            }
            
            // Set judul di modal
            const shareTitle = document.getElementById('shareModalTitle');
            if (shareTitle) {
                shareTitle.textContent = title || 'Bagikan Gambar';
            } else {
                console.error('Share modal title not found');
            }
            
            // Tampilkan modal terlebih dahulu
            const shareModal = document.getElementById('shareModal');
            if (shareModal) {
                shareModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                // Generate QR Code setelah modal ditampilkan
                const qrElement = document.getElementById('qrcode');
                if (qrElement) {
                    qrElement.innerHTML = ''; // Clear previous QR code
                    
                    // Pastikan QRCode terdefinisi
                    if (typeof QRCode !== 'undefined') {
                        try {
                            // Hapus instance QR Code sebelumnya jika ada
                            if (qrCode) {
                                qrCode.clear();
                            }
                            
                            qrCode = new QRCode(qrElement, {
                                text: currentShareUrl,
                                width: 150,
                                height: 150,
                                colorDark: "#000000",
                                colorLight: "#ffffff",
                                correctLevel: QRCode.CorrectLevel.H
                            });
                            console.log('QR Code generated successfully');
                        } catch (qrError) {
                            console.error('Error generating QR code:', qrError);
                            showToast('Gagal membuat QR Code', 'error');
                        }
                    } else {
                        console.error('QRCode library not loaded');
                        // Coba muat ulang library QRCode
                        loadQRCodeLibrary().then(() => {
                            if (typeof QRCode !== 'undefined') {
                                openShareModal(galleryId, title); // Coba lagi setelah library dimuat
                            }
                        });
                    }
                } else {
                    console.error('QR Code element not found');
                }
                
                // Fokus ke input
                if (shareLinkInput) {
                    shareLinkInput.select();
                }
            } else {
                console.error('Share modal element not found');
                showToast('Terjadi kesalahan saat membuka menu berbagi', 'error');
            }
        } catch (error) {
            console.error('Error in openShareModal:', error);
            showToast('Terjadi kesalahan saat membuka menu berbagi', 'error');
        }
    }
    
    // Fungsi untuk memuat library QRCode
    function loadQRCodeLibrary() {
        return new Promise((resolve, reject) => {
            if (typeof QRCode !== 'undefined') {
                resolve();
                return;
            }
            
            console.log('Loading QRCode library...');
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js';
            script.integrity = 'sha384-3zSEDfvllQohrq0PHLsnkwU8Kh1QyPhxXvI+AUv0FQhA6U8dEeO/RO6kS+gC3M';
            script.crossOrigin = 'anonymous';
            script.onload = () => {
                console.log('QRCode library loaded successfully');
                resolve();
            };
            script.onerror = (error) => {
                console.error('Failed to load QRCode library:', error);
                reject(error);
            };
            document.head.appendChild(script);
        });
    }

    // Fungsi untuk menutup modal
    function closeShareModal() {
        const modal = document.getElementById('shareModal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            
            // Sembunyikan status salin
            const copyStatus = document.getElementById('copyStatus');
            if (copyStatus) {
                copyStatus.classList.add('hidden');
            }
            
            // Hapus QR Code
            if (qrCode) {
                try {
                    qrCode.clear();
                    const qrElement = document.getElementById('qrcode');
                    if (qrElement) {
                        qrElement.innerHTML = '';
                    }
                } catch (e) {
                    console.error('Error clearing QR code:', e);
                }
                qrCode = null;
            }
        }
    }
    
    // Fungsi untuk menampilkan notifikasi toast
    function showToast(message, type = 'info') {
        // Hapus toast yang sudah ada
        const existingToast = document.getElementById('toast-notification');
        if (existingToast) {
            existingToast.remove();
        }

        // Buat elemen toast baru
        const toast = document.createElement('div');
        toast.id = 'toast-notification';
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${
            type === 'error' ? 'bg-red-500' : 
            type === 'success' ? 'bg-green-500' : 
            'bg-blue-500'
        } z-50 transform transition-all duration-300 translate-y-2 opacity-0`;
        
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Trigger reflow
        void toast.offsetWidth;
        
        // Show toast
        toast.classList.remove('translate-y-2', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-2', 'opacity-0');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
    
    // Fungsi untuk menyalin tautan ke clipboard
    function copyToClipboard() {
        const copyText = document.getElementById("shareLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        
        navigator.clipboard.writeText(copyText.value)
            .then(() => {
                const copyStatus = document.getElementById('copyStatus');
                copyStatus.classList.remove('hidden');
                setTimeout(() => {
                    copyStatus.classList.add('hidden');
                }, 3000);
                showToast('Tautan berhasil disalin!', 'success');
            })
            .catch(err => {
                console.error('Gagal menyalin teks: ', err);
                showToast('Gagal menyalin tautan', 'error');
            });
    }

    // Fungsi untuk berbagi ke media sosial
    function shareOnSocial(platform) {
        if (!currentShareUrl) {
            showToast('Tautan berbagi tidak tersedia', 'error');
            return;
        }
        
        const text = 'Lihat foto menarik ini: ';
        const title = document.getElementById('shareModalTitle')?.textContent || 'Galeri Foto';
        let url = '';
        
        switch(platform.toLowerCase()) {
            case 'whatsapp':
                url = `https://wa.me/?text=${encodeURIComponent(`${title} - ${text} ${currentShareUrl}`)}`;
                break;
            case 'facebook':
                url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentShareUrl)}&quote=${encodeURIComponent(title)}`;
                break;
            case 'twitter':
                url = `https://twitter.com/intent/tweet?text=${encodeURIComponent(`${title} - ${text}`)}&url=${encodeURIComponent(currentShareUrl)}`;
                break;
            case 'telegram':
                url = `https://t.me/share/url?url=${encodeURIComponent(currentShareUrl)}&text=${encodeURIComponent(`${title}\n\n${text}`)}`;
                break;
            case 'copy':
                navigator.clipboard.writeText(currentShareUrl).then(() => {
                    showToast('Tautan berhasil disalin!', 'success');
                }).catch(err => {
                    console.error('Gagal menyalin: ', err);
                    showToast('Gagal menyalin tautan', 'error');
                });
                return;
            default:
                console.warn('Platform berbagi tidak didukung:', platform);
                return;
        }
        
        if (url) {
            const width = 600;
            const height = 500;
            const left = (window.innerWidth - width) / 2;
            const top = (window.innerHeight - height) / 2;
            
            window.open(url, 'share', 
                `width=${width},height=${height},top=${top},left=${left},` +
                'toolbar=0,location=0,menubar=0,scrollbars=1,status=1,resizable=1');
        }
    }

    // Tutup modal saat mengklik di luar konten
    document.getElementById('shareModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeShareModal();
        }
    });

    // Fungsi untuk inisialisasi tombol share
    function initShareButtons() {
        console.log('Initializing share buttons...');
        const shareButtons = document.querySelectorAll('.share-button');
        console.log('Found', shareButtons.length, 'share buttons');
        
        shareButtons.forEach(button => {
            // Hapus event listener yang mungkin sudah ada
            const newButton = button.cloneNode(true);
            button.parentNode.replaceChild(newButton, button);
            
            // Tambahkan event listener baru
            newButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const galleryId = this.getAttribute('data-gallery-id');
                const title = this.getAttribute('data-gallery-title');
                console.log('Share button clicked - Gallery ID:', galleryId, 'Title:', title);
                
                if (!galleryId) {
                    console.error('No gallery ID found on share button');
                    showToast('Gagal membuka menu berbagi: ID galeri tidak valid', 'error');
                    return;
                }
                
                // Pastikan library QR Code sudah dimuat
                if (typeof QRCode === 'undefined') {
                    loadQRCodeLibrary().then(() => {
                        openShareModal(galleryId, title);
                    }).catch(error => {
                        console.error('Failed to load QRCode library:', error);
                        showToast('Gagal memuat library QR Code', 'error');
                    });
                } else {
                    openShareModal(galleryId, title);
                }
            });
            
            console.log('Added event listener to share button:', newButton);
        });
    }
    
    // Inisialisasi fungsi share
    function initializeShareFunctionality() {
        console.log('Initializing share functionality...');
        
        // Inisialisasi tombol share
        initShareButtons();
        
        // Inisialisasi event listener untuk tombol close modal
        const closeButtons = document.querySelectorAll('.close-share-modal');
        closeButtons.forEach(button => {
            button.addEventListener('click', closeShareModal);
        });
        
        // Inisialisasi event listener untuk menutup modal saat mengklik di luar
        const shareModal = document.getElementById('shareModal');
        if (shareModal) {
            shareModal.addEventListener('click', function(e) {
                if (e.target === shareModal) {
                    closeShareModal();
                }
            });
        }
        
        // Inisialisasi event listener untuk tombol keyboard
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeShareModal();
            }
        });
        
        console.log('Share functionality initialized');
    }

    // Inisialisasi saat DOM selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded, initializing share functionality...');
        
        // Pastikan library QR Code sudah dimuat
        if (typeof QRCode === 'undefined') {
            console.log('QRCode library not found, loading...');
            loadQRCodeLibrary()
                .then(() => {
                    console.log('QRCode library loaded successfully, initializing share functionality...');
                    initializeShareFunctionality();
                })
                .catch(error => {
                    console.error('Failed to load QRCode library:', error);
                    showToast('Gagal memuat library QR Code', 'error');
                    // Tetap lanjutkan inisialisasi meskipun QR Code gagal dimuat
                    initializeShareFunctionality();
                });
        } else {
            console.log('QRCode library already loaded, initializing share functionality...');
            initializeShareFunctionality();
        }
        
        // Inisialisasi tombol like
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', handleLike);
        });
    });
    
    // Juga inisialisasi ulang setelah konten dinamis dimuat
    document.addEventListener('galleryContentLoaded', initializeShareFunctionality);

    // Inisialisasi saat DOM selesai dimuat
    document.addEventListener('DOMContentLoaded', initShareButtons);
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initShareButtons);
    } else {
        initShareButtons();
    }
</script>
@endpush

@endsection

@push('styles')
<style>
    /* Lightbox Overlay */
    .lightbox-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease-in-out;
    }

    .lightbox-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .lightbox-container {
        position: relative;
        width: 90%;
        max-width: 1200px;
        max-height: 90vh;
        background: #0f172a;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(0.9);
        transition: transform 0.3s ease-out;
    }

    .lightbox-overlay.active .lightbox-container {
        transform: scale(1);
    }

    .lightbox-content {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .lightbox-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background: rgba(15, 23, 42, 0.8);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .lightbox-title {
        color: #e2e8f0;
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }

    .lightbox-close {
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 1.5rem;
        cursor: pointer;
        transition: color 0.2s;
        padding: 0.5rem;
        line-height: 1;
    }

    .lightbox-close:hover {
        color: #e2e8f0;
    }

    .lightbox-body {
        display: flex;
        flex: 1;
        overflow: hidden;
    }

    .lightbox-image-container {
        flex: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        background: #0f172a;
        position: relative;
        touch-action: pan-y;
        -webkit-overflow-scrolling: touch;
        overflow: hidden;
    }

    .lightbox-image {
        max-height: 70vh;
        max-width: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
        -webkit-touch-callout: none;
    }

    .lightbox-sidebar {
        flex: 1;
        background: #1e293b;
        padding: 1.5rem;
        overflow-y: auto;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
    }

    .lightbox-details {
        color: #e2e8f0;
    }

    .lightbox-category {
        display: inline-block;
        background: rgba(56, 189, 248, 0.2);
        color: #7dd3fc;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .lightbox-description {
        color: #94a3b8;
        line-height: 1.6;
        margin: 1rem 0;
    }

    .lightbox-meta {
        display: flex;
        gap: 1.5rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .meta-value {
        font-size: 1.125rem;
        font-weight: 700;
        color: #e2e8f0;
    }

    .meta-label {
        font-size: 0.75rem;
        color: #94a3b8;
        margin-top: 0.25rem;
    }

    .lightbox-nav {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 1rem;
        pointer-events: none;
        z-index: 10;
    }

    .lightbox-nav button {
        pointer-events: auto;
        background: rgba(15, 23, 42, 0.8);
        border: 2px solid rgba(255, 255, 255, 0.3);
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        outline: none;
        transition: all 0.2s ease;
        transition: all 0.2s;
        backdrop-filter: blur(4px);
    }

    .lightbox-nav button:hover {
        background: #0ea5e9;
        transform: scale(1.1);
    }

    .lightbox-nav button:disabled {
        opacity: 0.3;
        cursor: not-allowed;
        transform: none !important;
    }

    .lightbox-nav button svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    @media (max-width: 768px) {
        .lightbox-container {
            width: 100%;
            height: 100%;
            max-height: 100%;
            border-radius: 0;
            border-radius: 0;
        }
        
        .lightbox-body {
            flex-direction: column;
            height: 100%;
        }
        
        .lightbox-sidebar {
            max-height: 30%;
            overflow-y: auto;
            border-left: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem;
        }
        
        .lightbox-image-container {
            flex: 1;
            padding: 0.5rem;
            min-height: 50vh;
        }
        
        .lightbox-nav button {
            width: 2.5rem;
            height: 2.5rem;
            background: rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-close {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Lightbox functionality
    let currentIndex = 0;
    let lightboxOpen = false;
    let touchStartX = 0;
    let touchEndX = 0;
    const SWIPE_THRESHOLD = 50; // Minimum distance for a swipe to be detected

    function openLightbox(index) {
        currentIndex = index;
        lightboxOpen = true;
        updateLightbox();
        document.body.style.overflow = 'hidden';
        
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('active');
        
        // Add event listeners
        document.addEventListener('keydown', handleKeyDown);
        
        // Add touch event listeners for swipe
        const imageContainer = lightbox.querySelector('.lightbox-image-container');
        if (imageContainer) {
            imageContainer.addEventListener('touchstart', handleTouchStart, { passive: true });
            imageContainer.addEventListener('touchmove', handleTouchMove, { passive: false });
            imageContainer.addEventListener('touchend', handleTouchEnd, { passive: true });
        }
    }

    function closeLightbox() {
        lightboxOpen = false;
        document.body.style.overflow = '';
        
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('active');
        
        // Remove event listeners
        document.removeEventListener('keydown', handleKeyDown);
        
        // Remove touch event listeners
        const imageContainer = lightbox.querySelector('.lightbox-image-container');
        if (imageContainer) {
            imageContainer.removeEventListener('touchstart', handleTouchStart);
            imageContainer.removeEventListener('touchmove', handleTouchMove);
            imageContainer.removeEventListener('touchend', handleTouchEnd);
        }
    }

    function navigateLightbox(direction) {
        if (direction === 'prev' && currentIndex > 0) {
            currentIndex--;
        } else if (direction === 'next' && currentIndex < window.galleryImages.length - 1) {
            currentIndex++;
        }
        updateLightbox();
    }

    function updateLightbox() {
        if (!window.galleryImages || !window.galleryImages[currentIndex]) return;
        
        const galleryItem = window.galleryImages[currentIndex];
        const lightbox = document.getElementById('lightbox');
        
        if (!lightbox) return;
        
        const imageElement = lightbox.querySelector('.lightbox-image');
        
        // Add loading class
        imageElement.classList.add('loading');
        
        // Preload image
        const img = new Image();
        img.onload = function() {
            imageElement.src = this.src;
            imageElement.classList.remove('loading');
        };
        img.src = galleryItem.src;
        
        // Update other elements
        lightbox.querySelector('.lightbox-title').textContent = galleryItem.title;
        lightbox.querySelector('.lightbox-category').textContent = galleryItem.category || 'Uncategorized';
        
        // Update navigation buttons
        lightbox.querySelector('.lightbox-prev').disabled = currentIndex === 0;
        lightbox.querySelector('.lightbox-next').disabled = currentIndex === window.galleryImages.length - 1;
        
        // Add smooth transition
        const imageContainer = lightbox.querySelector('.lightbox-image-container');
        imageContainer.style.opacity = '0';
        setTimeout(() => {
            imageContainer.style.opacity = '1';
        }, 10);
    }

    // Touch event handlers for swipe detection
    function handleTouchStart(e) {
        touchStartX = e.touches[0].clientX;
    }
    
    function handleTouchMove(e) {
        if (!touchStartX) return;
        touchEndX = e.touches[0].clientX;
        
        // Prevent scrolling if we're swiping horizontally
        if (Math.abs(touchEndX - touchStartX) > 10) {
            e.preventDefault();
        }
    }
    
    function handleTouchEnd() {
        if (!touchStartX || !touchEndX) return;
        
        const diff = touchStartX - touchEndX;
        
        // Check if the swipe was far enough
        if (Math.abs(diff) > SWIPE_THRESHOLD) {
            if (diff > 0) {
                // Swipe left - go to next
                if (currentIndex < window.galleryImages.length - 1) {
                    navigateLightbox('next');
                }
            } else {
                // Swipe right - go to previous
                if (currentIndex > 0) {
                    navigateLightbox('prev');
                }
            }
        }
        
        // Reset values
        touchStartX = 0;
        touchEndX = 0;
    }
    
    function handleKeyDown(e) {
        if (!lightboxOpen) return;
        
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                if (currentIndex > 0) {
                    navigateLightbox('prev');
                }
                break;
            case 'ArrowRight':
                if (currentIndex < window.galleryImages.length - 1) {
                    navigateLightbox('next');
                }
                break;
        }
    }

    // Close lightbox when clicking outside content
    document.addEventListener('click', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (lightbox && lightboxOpen && e.target === lightbox) {
            closeLightbox();
        }
    });

    // Initialize lightbox HTML if not exists
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('lightbox')) {
            const lightboxHTML = `
                <div id="lightbox" class="lightbox-overlay">
                    <div class="flex items-center gap-4">
                        <button id="headerShareButton" class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <i class="fas fa-share-alt text-gray-600"></i>
                        </button>
                        <button class="bg-gradient-to-r from-cyan-500 to-teal-500 text-white px-4 py-2 rounded-full font-medium hover:opacity-90 transition-opacity">
                            <i class="fas fa-plus mr-2"></i> Unggah
                        </button>
                    </div>

                    <!-- Tombol share di lightbox -->
                    <div class="lightbox-container">
                        <div class="lightbox-header">
                            <h2 class="lightbox-title"></h2>
                            <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
                        </div>
                        <div class="lightbox-body">
                            <div class="lightbox-image-container">
                                <img src="" alt="" class="lightbox-image">
                                <div class="lightbox-nav">
                                    <button class="lightbox-prev" onclick="navigateLightbox('prev')" disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button class="lightbox-next" onclick="navigateLightbox('next')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="lightbox-sidebar">
                                <div class="lightbox-category"></div>
                                <h3 class="lightbox-title"></h3>
                                <p class="lightbox-description">Klik panah kiri/kanan untuk melihat gambar lainnya</p>
                                <div class="lightbox-meta">
                                    <button onclick="shareCurrentImage()" class="flex items-center gap-2 text-blue-600 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-share"></i>
                                        <span>Bagikan</span>
                                    </button>
                                    <div class="meta-item">
                                        <span class="meta-value">${window.galleryImages.length}</span>
                                        <span class="meta-label">Total Gambar</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-value">${currentIndex + 1}</span>
                                        <span class="meta-label">Gambar Saat Ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', lightboxHTML);
            console.log('✅ Lightbox HTML injected');
            
            // Initialize lightbox after it's added to the DOM
            lightbox = document.getElementById('lightbox');
            
            // Inisialisasi tombol share di lightbox
            initLightboxShareButton();
        }
    });

    console.log('✅ Pushed scripts loaded');
    
    // Function to update gallery card like counts
    function updateGalleryLikes(galleryId, likesCount) {
        const likesEl = document.querySelector('.gallery-likes-' + galleryId);
        if (likesEl) likesEl.textContent = likesCount || 0;
    }
    
    // Fungsi untuk membagikan gambar saat ini di lightbox
    function shareCurrentImage() {
        if (window.galleryImages && window.galleryImages[currentIndex]) {
            const galleryId = window.galleryImages[currentIndex].id;
            const title = window.galleryImages[currentIndex].title || 'Galeri Foto';
            openShareModal(galleryId, title);
        } else {
            // Fallback jika data tidak tersedia
            const currentUrl = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: 'Galeri Sekolah',
                    text: 'Lihat galeri foto sekolah kami',
                    url: currentUrl
                }).catch(console.error);
            } else {
                openShareModal('share', 'Galeri Sekolah');
            }
        }
    }

    // Inisialisasi tombol share di lightbox setelah lightbox dibuat
    function initLightboxShareButton() {
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            const shareButton = lightbox.querySelector('#headerShareButton');
            if (shareButton) {
                shareButton.onclick = shareCurrentImage;
            }
        }
    }

    // Load likes when page loads
    window.addEventListener('load', function() {
        console.log('✅ Page loaded, loading likes...');
        
        // Load likes
        if (window.galleryImages && window.galleryImages.length > 0) {
            window.galleryImages.forEach(gallery => {
                fetch('/gallery/' + gallery.id + '/like')
                    .then(r => r.json())
                    .then(data => {
                        updateGalleryLikes(gallery.id, data.likes_count);
                    });
            });
        }
        
        // Update like button state
        const likeButton = document.querySelector(`.like-btn[data-gallery-id="${galleryId}"]`);
        if (likeButton) {
            const isLiked = likeButton.getAttribute('data-liked') === 'true';
            likeButton.setAttribute('data-liked', isLiked ? 'true' : 'false');
            likeButton.innerHTML = isLiked ? 
                '❤️ <span class="like-count" data-gallery-id="' + galleryId + '">' + likesCount + '</span>' : 
                '🤍 <span class="like-count" data-gallery-id="' + galleryId + '">' + likesCount + '</span>';
        }
    }
    
    // Function to handle like action
    window.likeGallery = function(galleryId) {
        const likeButton = document.querySelector(`.like-btn[data-gallery-id="${galleryId}"]`);
        if (!likeButton) return;
        
        // Disable button to prevent multiple clicks
        likeButton.disabled = true;
        
        // Show loading state
        likeButton.innerHTML = '⏳';
        
        // Send AJAX request
        fetch(`/galleries/${galleryId}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                const likeCount = data.likes_count;
                const isLiked = data.liked;
                
                likeButton.setAttribute('data-liked', isLiked ? 'true' : 'false');
                likeButton.innerHTML = isLiked ? 
                    '❤️ <span class="like-count" data-gallery-id="' + galleryId + '">' + likeCount + '</span>' : 
                    '🤍 <span class="like-count" data-gallery-id="' + galleryId + '">' + likeCount + '</span>';
                
                // Update like count in the card
                const likeCountElement = document.querySelector(`.like-count[data-gallery-id="${galleryId}"]`);
                if (likeCountElement) {
                    likeCountElement.textContent = likeCount;
                }
                
                // Show success message
                if (isLiked) {
                    showToast('Anda menyukai foto ini!', 'success');
                } else {
                    showToast('Anda tidak lagi menyukai foto ini', 'info');
                }
            } else {
                showToast('Gagal menyukai foto', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan', 'error');
        })
        .finally(() => {
            // Re-enable button
            likeButton.disabled = false;
        });
    };
    
    // Function to show toast notifications
    // Fungsi untuk menampilkan notifikasi toast
    function showToast(message, type = 'info') {
        // Hapus toast yang sudah ada
        const existingToast = document.getElementById('toast-notification');
        if (existingToast) {
            existingToast.remove();
        }
        
        // Buat elemen toast
        const toast = document.createElement('div');
        toast.id = 'toast-notification';
        
        // Tentukan warna berdasarkan tipe
        let bgColor = 'bg-blue-500';
        switch(type) {
            case 'success':
                bgColor = 'bg-green-500';
                break;
            case 'error':
                bgColor = 'bg-red-500';
                break;
            case 'warning':
                bgColor = 'bg-yellow-500';
                break;
        }
        
        // Tambahkan class dan konten ke toast
        toast.className = `fixed bottom-6 right-6 px-6 py-3 rounded-lg text-white shadow-lg transform transition-all duration-300 translate-y-4 opacity-0 ${bgColor}`;
        toast.textContent = message;
        
        // Tambahkan ke body
        document.body.appendChild(toast);
        
        // Trigger reflow
        toast.offsetHeight;
        
        // Tampilkan dengan animasi
        toast.classList.remove('translate-y-4', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
        
        // Sembunyikan setelah 3 detik
        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-4', 'opacity-0');
            
            // Hapus dari DOM setelah animasi selesai
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
        
        // Log ke console untuk debugging
        console.log(`[${type.toUpperCase()}] ${message}`);
    }
    
    function filterGallery(categoryId) {
        const items = document.querySelectorAll('.gallery-item');
        items.forEach(item => {
            if (categoryId === 'all' || item.dataset.category === categoryId) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    }
</script>
@endpush
