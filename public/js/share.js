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
        const shareLinkInput = document.getElementById('shareLink');
        if (shareLinkInput) {
            shareLinkInput.value = currentShareUrl;
            shareLinkInput.select();
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
                }, 2000);
            }
        })
        .catch(err => {
            console.error('Failed to copy text: ', err);
            showToast('Gagal menyalin tautan', 'error');
        });
}

// Fungsi untuk berbagi ke media sosial
function shareOnSocial(platform) {
    const shareUrl = currentShareUrl || window.location.href;
    let shareLink = '';
    
    switch (platform) {
        case 'whatsapp':
            shareLink = `https://wa.me/?text=${encodeURIComponent(shareUrl)}`;
            break;
        case 'facebook':
            shareLink = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
            break;
        case 'twitter':
            shareLink = `https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}`;
            break;
        case 'telegram':
            shareLink = `https://t.me/share/url?url=${encodeURIComponent(shareUrl)}`;
            break;
        default:
            console.error('Platform not supported:', platform);
            showToast('Platform tidak didukung', 'error');
            return;
    }
    
    window.open(shareLink, '_blank', 'width=600,height=400');
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
    
    // Tambahkan ikon berdasarkan tipe
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

// Inisialisasi event listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('Initializing share functionality...');
    
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
        script.onload = function() {
            console.log('QRCode library loaded successfully');
        };
        script.onerror = function() {
            console.error('Failed to load QRCode library');
            showToast('Gagal memuat library QR Code', 'error');
        };
        document.head.appendChild(script);
    }
});

// Ekspos fungsi ke global scope
window.openShareModal = openShareModal;
window.closeShareModal = closeShareModal;
window.copyToClipboard = copyToClipboard;
window.shareOnSocial = shareOnSocial;
