@extends('layouts.public')

@section('head-scripts')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- QR Code Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"
        integrity="sha384-3zSEDfvllQohrq0PHLsnkwU8Kh1QyPhxXvI+AUv0FQhA6U8dEeO/RO6kS+gC3M"
        crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-teal-50 py-16 px-6">
    <div class="max-w-4xl mx-auto">
        <!-- Kembali ke Galeri -->
        <a href="{{ route('guest.gallery') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Galeri
        </a>

        <!-- Detail Gambar -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Gambar Utama -->
            <div class="w-full h-96 overflow-hidden">
                <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                     alt="{{ $gallery->title }}" 
                     class="w-full h-full object-cover">
            </div>
            
            <!-- Konten -->
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $gallery->title }}</h1>
                        <div class="flex items-center text-gray-500 text-sm mt-1">
                            <span class="mr-4">
                                <i class="far fa-folder mr-1"></i> {{ $gallery->category->name }}
                            </span>
                            <span>
                                <i class="far fa-calendar-alt mr-1"></i> {{ $gallery->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <!-- Like Button -->
                        <button class="flex items-center text-gray-600 hover:text-red-500 like-button"
                                data-gallery-id="{{ $gallery->id }}"
                                title="{{ $gallery->is_liked ? 'Batalkan suka' : 'Sukai gambar ini' }}">
                            {!! $gallery->is_liked ? '❤️' : '🤍' !!}
                            <span class="like-count font-semibold ml-1">{{ $gallery->likes_count }}</span>
                        </button>
                        
                        <!-- Share Button -->
                        <button class="flex items-center text-gray-600 hover:text-blue-500 share-button"
                                data-gallery-id="{{ $gallery->id }}"
                                data-gallery-title="{{ $gallery->title }}"
                                title="Bagikan gambar ini">
                            <i class="fas fa-share-alt"></i>
                            <span class="ml-1">Bagikan</span>
                        </button>
                    </div>
                </div>
                
                <!-- Deskripsi -->
                @if($gallery->description)
                <div class="prose max-w-none mt-6 text-gray-700">
                    {!! nl2br(e($gallery->description)) !!}
                </div>
                @endif
            </div>
        </div>
        
        <!-- Galeri Lainnya -->
        @if($relatedGalleries->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Galeri Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedGalleries as $related)
                <a href="{{ route('gallery.show', $related) }}" class="block group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 group-hover:shadow-lg group-hover:-translate-y-1 h-full">
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $related->image_path) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-1 line-clamp-1">{{ $related->title }}</h3>
                            <span class="text-sm text-gray-600">{{ $related->category->name }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@include('partials.share-modal')
@endsection

@push('scripts')
<script>
    // Global variables
    let currentShareUrl = '';
    let qrCode = null;
    
    // Fungsi untuk membuka modal berbagi
    function openShareModal(galleryId, title) {
        try {
            console.log('Opening share modal for gallery:', galleryId, 'with title:', title);
            
            // Generate URL yang akan dibagikan
            const baseUrl = window.location.origin;
            currentShareUrl = `${baseUrl}/gallery/${galleryId}`;
            console.log('Share URL:', currentShareUrl);
            
            // Perbarui URL di input
            const shareLink = document.getElementById('shareLink');
            if (shareLink) {
                shareLink.value = currentShareUrl;
            }
            
            // Set judul di modal
            const shareTitle = document.getElementById('shareModalTitle');
            if (shareTitle) {
                shareTitle.textContent = title || 'Bagikan Gambar';
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
                        showToast('Library QR Code tidak tersedia', 'error');
                    }
                }
            } else {
                throw new Error('Share modal element not found');
            }
        } catch (error) {
            console.error('Error in openShareModal:', error);
            showToast('Terjadi kesalahan saat membuka menu berbagi', 'error');
        }
    }
    
    // Fungsi untuk menutup modal
    function closeShareModal() {
        const modal = document.getElementById('shareModal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            const copyStatus = document.getElementById('copyStatus');
            if (copyStatus) {
                copyStatus.classList.add('hidden');
            }
        }
    }
    
    // Fungsi untuk menyalin tautan ke clipboard
    function copyToClipboard() {
        const copyText = document.getElementById("shareLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        
        navigator.clipboard.writeText(copyText.value)
            .then(() => {
                const copyStatus = document.getElementById('copyStatus');
                if (copyStatus) {
                    copyStatus.classList.remove('hidden');
                    setTimeout(() => {
                        copyStatus.classList.add('hidden');
                    }, 3000);
                }
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

        let shareUrl = '';
        const encodedUrl = encodeURIComponent(currentShareUrl);
        const text = 'Lihat gambar menarik ini: ';

        switch(platform) {
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${encodeURIComponent(text)} ${encodedUrl}`;
                break;
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodeURIComponent(text)}`;
                break;
            case 'telegram':
                shareUrl = `https://t.me/share/url?url=${encodedUrl}&text=${encodeURIComponent(text)}`;
                break;
            default:
                return;
        }

        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
    
    // Inisialisasi saat dokumen siap
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Gallery detail page loaded');
        
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
    });
    
    // Fungsi untuk menangani like
    async function handleLike(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const button = e.currentTarget;
        const galleryId = button.getAttribute('data-gallery-id');
        const likeCount = button.querySelector('.like-count');
        
        if (!galleryId) {
            console.error('Gallery ID not found');
            return;
        }
        
        // Simpan HTML asli untuk rollback jika terjadi error
        const originalHTML = button.innerHTML;
        
        try {
            // Tampilkan loading state
            button.disabled = true;
            button.innerHTML = '...';
            
            // Kirim request ke server
            const response = await fetch(`/gallery/${galleryId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const data = await response.json();
            
            // Update UI
            if (likeCount) {
                likeCount.textContent = data.likes_count;
            }
            
            if (data.liked) {
                button.innerHTML = '❤️' + (likeCount ? `<span class="like-count font-semibold ml-1">${data.likes_count}</span>` : '');
                button.setAttribute('title', 'Batalkan suka');
            } else {
                button.innerHTML = '🤍' + (likeCount ? `<span class="like-count font-semibold ml-1">${data.likes_count}</span>` : '');
                button.setAttribute('title', 'Sukai gambar ini');
            }
            
            // Perbarui status is_liked
            button.setAttribute('data-liked', data.liked ? 'true' : 'false');
            
        } catch (error) {
            console.error('Error:', error);
            showToast('Terjadi kesalahan saat memproses like', 'error');
            // Kembalikan ke state semula
            button.innerHTML = originalHTML;
        } finally {
            button.disabled = false;
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
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium flex items-center ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 
            'bg-blue-500'
        }`;
        
        // Tambahkan ikon berdasarkan tpes
        let icon = '';
        if (type === 'success') {
            icon = '<i class="fas fa-check-circle mr-2"></i>';
        } else if (type === 'error') {
            icon = '<i class="fas fa-exclamation-circle mr-2"></i>';
        } else {
            icon = '<i class="fas fa-info-circle mr-2"></i>';
        }
        
        toast.innerHTML = `${icon}${message}`;
        
        // Tambahkan ke body
        document.body.appendChild(toast);
        
        // Hapus otomatis setelah 3 detik
        setTimeout(() => {
            toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
</script>
@endpush
