@extends('layouts.public')

@section('head-scripts')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- QR Code Library -->
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // Data gambar untuk lightbox
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

        if (!Array.isArray(window.galleryImages)) {
            window.galleryImages = [];
        }

        console.log('Gallery images loaded:', window.galleryImages.length, 'items');
    </script>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col items-center mb-12 scroll-reveal">
            <div class="w-full text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-3 text-gradient-animate tracking-tight">
                    Galeri Sekolah
                </h1>
                <p class="text-gray-700 text-base md:text-lg font-medium float-gentle">
                    Temukan momen terbaik SMKN 4 Bogor ✨
                </p>
            </div>
        </div>

        <!-- Filter Kategori -->
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

        <!-- Galeri Grid -->
        <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($galleries as $index => $gallery)
                <div class="gallery-item group rounded-3xl overflow-hidden bg-white shadow-lg hover:shadow-2xl transform transition-all duration-500 scroll-reveal-scale scroll-reveal-delay-{{ ($index % 6) + 1 }} card-shine gradient-border"
                     data-category="{{ $gallery->category_id ?? '' }}"
                     data-gallery-index="{{ $index }}"
                     onclick="openLightbox({{ $index }})">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $gallery->image) }}"
                             alt="{{ $gallery->title }}"
                             class="w-full h-64 object-cover image-tilt">
                    </div>
                    <div class="p-4 bg-gradient-to-br from-white to-cyan-50/30">
                        <h3 class="text-base font-semibold text-gray-800 mb-2 group-hover:text-cyan-600 transition-colors line-clamp-2">
                            {{ $gallery->title }}
                        </h3>

                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            {{-- LIKE --}}
                            @auth
                                <button class="flex items-center gap-1 like-button {{ $gallery->is_liked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }}"
                                        data-gallery-id="{{ $gallery->id }}"
                                        title="{{ $gallery->is_liked ? 'Batalkan suka' : 'Suka gambar ini' }}">
                                    <i class="{{ $gallery->is_liked ? 'fas' : 'far' }} fa-heart"></i>
                                    <span class="like-count ml-1">{{ $gallery->likes_count ?? 0 }}</span>
                                </button>
                            @else
                                <button class="flex items-center gap-1 text-gray-500 hover:text-red-500"
                                        title="Login untuk menyukai gambar"
                                        onclick="event.preventDefault(); event.stopPropagation(); showLoginToastAndRedirect('Anda harus login terlebih dahulu untuk menyukai foto.');">
                                    <i class="far fa-heart"></i>
                                    <span class="like-count ml-1">{{ $gallery->likes_count ?? 0 }}</span>
                                </button>
                            @endauth

                            {{-- SHARE --}}
                            @auth
                                <button class="flex items-center gap-1 hover:text-blue-500 transition-colors share-button"
                                        data-gallery-id="{{ $gallery->id }}"
                                        data-gallery-title="{{ $gallery->title }}"
                                        title="Bagikan gambar ini"
                                        onclick="event.preventDefault(); event.stopPropagation();">
                                    <i class="fas fa-share-alt"></i>
                                    <span class="text-xs font-medium ml-1">Bagikan</span>
                                </button>
                            @else
                                <button class="flex items-center gap-1 hover:text-blue-500 transition-colors"
                                        title="Login untuk membagikan foto"
                                        onclick="event.preventDefault(); event.stopPropagation(); showLoginToastAndRedirect('Anda harus login terlebih dahulu untuk membagikan foto.');">
                                    <i class="fas fa-share-alt"></i>
                                    <span class="text-xs font-medium ml-1">Bagikan</span>
                                </button>
                            @endauth

                            {{-- DOWNLOAD --}}
                            <a href="{{ Auth::check() ? route('gallery.download', $gallery) : route('login') }}"
                               class="group relative flex items-center text-gray-600 hover:text-cyan-600 transition-colors"
                               title="{{ Auth::check() ? 'Download Gambar' : 'Login untuk mengunduh' }}"
                               @if(!Auth::check())
                                   onclick="event.preventDefault(); event.stopPropagation(); showLoginToastAndRedirect('Anda harus login terlebih dahulu untuk mengunduh gambar.');"
                               @else
                                   onclick="event.stopPropagation();"
                               @endif>
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

    {{-- SHARE MODAL --}}
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

                {{-- Copy Link --}}
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

                {{-- QR Code --}}
                <div class="mb-6 text-center">
                    <div class="flex justify-center mb-3" id="qrcode"></div>
                    <p class="text-sm text-gray-600">Scan untuk membagikan</p>
                </div>

                {{-- Social Media --}}
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

@push('styles')
<style>
    /* LIGHTBOX */
    .lightbox-overlay {
        position: fixed;
        inset: 0;
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
        overflow: hidden;
        touch-action: pan-y;
        transition: opacity 0.2s ease;
    }
    .lightbox-image {
        max-height: 70vh;
        max-width: 100%;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease;
        user-select: none;
    }
    .lightbox-sidebar {
        flex: 1;
        background: #1e293b;
        padding: 1.5rem;
        overflow-y: auto;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
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
        align-items: center;
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
        inset-inline: 0;
        top: 50%;
        transform: translateY(-50%);
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
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.2s ease;
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
        }
        .lightbox-body {
            flex-direction: column;
            height: 100%;
        }
        .lightbox-sidebar {
            max-height: 30%;
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
            border-radius: 9999px;
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
    // ===== TOAST & LOGIN REDIRECT =====
    function showToast(message, type = 'info') {
        const existingToast = document.getElementById('toast-notification');
        if (existingToast) existingToast.remove();

        const toast = document.createElement('div');
        toast.id = 'toast-notification';

        let bgColor = 'bg-blue-500';
        if (type === 'success') bgColor = 'bg-green-500';
        else if (type === 'error') bgColor = 'bg-red-500';
        else if (type === 'warning') bgColor = 'bg-yellow-500';

        toast.className = `fixed bottom-6 right-6 px-6 py-3 rounded-lg text-white shadow-lg transform transition-all duration-300 translate-y-4 opacity-0 ${bgColor} z-50`;
        toast.textContent = message;

        document.body.appendChild(toast);
        toast.offsetHeight;

        toast.classList.remove('translate-y-4', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    function showLoginToastAndRedirect(message) {
        showToast(message, 'error');
        setTimeout(function () {
            window.location.href = "{{ route('login') }}";
        }, 2000);
    }

    // ===== LIKE (untuk user login) =====
    async function handleLike(e) {
        e.preventDefault();
        e.stopPropagation();

        const button = e.currentTarget;
        const galleryId = button.getAttribute('data-gallery-id');
        const likeCount = button.querySelector('.like-count');
        const icon = button.querySelector('i');

        button.disabled = true;

        try {
            const response = await fetch(`/gallery/${galleryId}/like`, {
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
                if (data.liked) {
                    // LIKE
                    button.classList.add('text-red-500');
                    button.classList.remove('text-gray-500', 'hover:text-red-500');
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    showToast('Anda menyukai foto ini!', 'success');
                } else {
                    // UNLIKE
                    button.classList.remove('text-red-500');
                    button.classList.add('text-gray-500', 'hover:text-red-500');
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    showToast('Suka dibatalkan', 'info');
                }

                if (likeCount) {
                    likeCount.textContent = data.likes_count;
                }

                // Sinkron lightbox kalau mau, di-skip dulu supaya simpel
            } else {
                console.warn(data.message || 'Gagal like');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Gagal menyimpan like. Silakan coba lagi.', 'error');
        } finally {
            button.disabled = false;
        }
    }

    // ===== SHARE =====
    let currentShareUrl = '';
    let qrCode = null;

    function loadQRCodeLibrary() {
        return new Promise((resolve, reject) => {
            if (typeof QRCode !== 'undefined') {
                resolve();
                return;
            }
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js';
            script.onload = () => resolve();
            script.onerror = reject;
            document.head.appendChild(script);
        });
    }

    function openShareModal(galleryId, title) {
        try {
            const baseUrl = window.location.origin;
            currentShareUrl = `${baseUrl}/galeri/${galleryId}`;

            const shareLinkInput = document.getElementById('shareLink');
            if (shareLinkInput) {
                shareLinkInput.value = currentShareUrl;
            }

            const shareTitle = document.getElementById('shareModalTitle');
            if (shareTitle) {
                shareTitle.textContent = title || 'Bagikan Gambar';
            }

            const shareModal = document.getElementById('shareModal');
            if (shareModal) {
                shareModal.classList.remove('hidden');
                shareModal.classList.add('flex');
                document.body.style.overflow = 'hidden';

                const qrElement = document.getElementById('qrcode');
                if (qrElement) {
                    qrElement.innerHTML = '';

                    if (typeof QRCode !== 'undefined') {
                        qrCode = new QRCode(qrElement, {
                            text: currentShareUrl,
                            width: 150,
                            height: 150,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H
                        });
                    }
                }
            }
        } catch (error) {
            console.error('Error in openShareModal:', error);
        }
    }

    function closeShareModal() {
        const modal = document.getElementById('shareModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';

            const copyStatus = document.getElementById('copyStatus');
            if (copyStatus) copyStatus.classList.add('hidden');

            if (qrCode) {
                try {
                    qrCode.clear();
                    const qrElement = document.getElementById('qrcode');
                    if (qrElement) qrElement.innerHTML = '';
                } catch (e) {
                    console.error('Error clearing QR code:', e);
                }
                qrCode = null;
            }
        }
    }

    function copyToClipboard() {
        const copyText = document.getElementById("shareLink");
        if (!copyText) return;

        copyText.select();
        copyText.setSelectionRange(0, 99999);

        navigator.clipboard.writeText(copyText.value)
            .then(() => {
                const copyStatus = document.getElementById('copyStatus');
                if (copyStatus) {
                    copyStatus.classList.remove('hidden');
                    setTimeout(() => copyStatus.classList.add('hidden'), 3000);
                }
                showToast('Tautan berhasil disalin!', 'success');
            })
            .catch(err => {
                console.error('Gagal menyalin teks: ', err);
            });
    }

    function shareOnSocial(platform) {
        if (!currentShareUrl) {
            console.warn('Tautan berbagi tidak tersedia');
            return false;
        }

        const text = 'Lihat foto menarik ini: ';
        const title = document.getElementById('shareModalTitle')?.textContent || 'Galeri Foto';
        let url = '';

        switch (platform.toLowerCase()) {
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
            default:
                return false;
        }

        if (url) {
            const width = 600;
            const height = 500;
            const left = (window.innerWidth - width) / 2;
            const top = (window.innerHeight - height) / 2;

            window.open(
                url,
                'share',
                `width=${width},height=${height},top=${top},left=${left},toolbar=0,location=0,menubar=0,scrollbars=1,status=1,resizable=1`
            );
        }

        return false;
    }

    function initShareButtons() {
        const shareButtons = document.querySelectorAll('.share-button');
        shareButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                const galleryId = this.getAttribute('data-gallery-id');
                const title = this.getAttribute('data-gallery-title');

                if (!galleryId) {
                    console.warn('Gagal membuka menu berbagi: ID galeri tidak valid');
                    return;
                }

                if (typeof QRCode === 'undefined') {
                    loadQRCodeLibrary().then(() => openShareModal(galleryId, title))
                        .catch(error => {
                            console.error('Failed to load QRCode library:', error);
                        });
                } else {
                    openShareModal(galleryId, title);
                }
            });
        });

        const shareModal = document.getElementById('shareModal');
        if (shareModal) {
            shareModal.addEventListener('click', function (e) {
                if (e.target === shareModal) {
                    closeShareModal();
                }
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeShareModal();
            }
        });
    }

    // ===== LIGHTBOX =====
    let currentIndex = 0;
    let lightboxOpen = false;
    let touchStartX = 0;
    let touchEndX = 0;
    const SWIPE_THRESHOLD = 50;

    function openLightbox(index) {
        currentIndex = index;
        lightboxOpen = true;
        updateLightbox();
        document.body.style.overflow = 'hidden';

        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('active');

        document.addEventListener('keydown', handleKeyDown);

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

        document.removeEventListener('keydown', handleKeyDown);

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
        const img = new Image();
        img.onload = function () {
            imageElement.src = this.src;
        };
        img.src = galleryItem.src;

        lightbox.querySelector('.lightbox-title').textContent = galleryItem.title;
        lightbox.querySelector('.lightbox-category').textContent = galleryItem.category || 'Uncategorized';

        lightbox.querySelector('.lightbox-prev').disabled = currentIndex === 0;
        lightbox.querySelector('.lightbox-next').disabled = currentIndex === window.galleryImages.length - 1;

        const imageContainer = lightbox.querySelector('.lightbox-image-container');
        imageContainer.style.opacity = '0';
        setTimeout(() => {
            imageContainer.style.opacity = '1';
        }, 10);

        const currentMeta = lightbox.querySelector('.meta-item-current .meta-value');
        if (currentMeta) {
            currentMeta.textContent = currentIndex + 1;
        }
    }

    function handleTouchStart(e) {
        touchStartX = e.touches[0].clientX;
    }

    function handleTouchMove(e) {
        if (!touchStartX) return;
        touchEndX = e.touches[0].clientX;
        if (Math.abs(touchEndX - touchStartX) > 10) {
            e.preventDefault();
        }
    }

    function handleTouchEnd() {
        if (!touchStartX || !touchEndX) return;

        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > SWIPE_THRESHOLD) {
            if (diff > 0 && currentIndex < window.galleryImages.length - 1) {
                navigateLightbox('next');
            } else if (diff < 0 && currentIndex > 0) {
                navigateLightbox('prev');
            }
        }

        touchStartX = 0;
        touchEndX = 0;
    }

    function handleKeyDown(e) {
        if (!lightboxOpen) return;

        switch (e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                if (currentIndex > 0) navigateLightbox('prev');
                break;
            case 'ArrowRight':
                if (currentIndex < window.galleryImages.length - 1) navigateLightbox('next');
                break;
        }
    }

    function shareCurrentImage() {
        if (window.galleryImages && window.galleryImages[currentIndex]) {
            const galleryId = window.galleryImages[currentIndex].id;
            const title = window.galleryImages[currentIndex].title || 'Galeri Foto';
            openShareModal(galleryId, title);
        } else {
            const currentUrl = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: 'Galeri Sekolah',
                    text: 'Lihat galeri foto sekolah kami',
                    url: currentUrl
                }).catch(err => console.error(err));
            } else {
                openShareModal('share', 'Galeri Sekolah');
            }
        }
    }

    function initLightboxShareButton() {
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            const shareButton = lightbox.querySelector('#headerShareButton');
            if (shareButton) {
                shareButton.onclick = function () {
                    @auth
                        shareCurrentImage();
                    @else
                        showLoginToastAndRedirect('Anda harus login terlebih dahulu untuk membagikan foto.');
                    @endauth
                };
            }
        }
    }

    // ===== FILTER GALERI =====
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

    // ===== INIT DOM =====
    document.addEventListener('DOMContentLoaded', function () {
        // inject lightbox jika belum ada
        if (!document.getElementById('lightbox')) {
            const lightboxHTML = `
                <div id="lightbox" class="lightbox-overlay">
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
                                <span class="lightbox-category"></span>
                                <h3 class="lightbox-title"></h3>
                                <p class="lightbox-description">Klik panah kiri/kanan atau geser untuk melihat gambar lainnya</p>
                                <div class="lightbox-meta">
                                    <button onclick="shareCurrentImage()" class="flex items-center gap-2 text-blue-400 hover:text-blue-200 transition-colors">
                                        <i class="fas fa-share"></i>
                                        <span>Bagikan</span>
                                    </button>
                                    <div class="meta-item">
                                        <span class="meta-value">{{ $galleries->count() }}</span>
                                        <span class="meta-label">Total Gambar</span>
                                    </div>
                                    <div class="meta-item meta-item-current">
                                        <span class="meta-value">1</span>
                                        <span class="meta-label">Gambar Saat Ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            document.body.insertAdjacentHTML('beforeend', lightboxHTML);
            initLightboxShareButton();
        }

        // inisialisasi tombol like untuk user login
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', handleLike);
        });

        // inisialisasi share
        initShareButtons();
    });
</script>
@endpush
@endsection
