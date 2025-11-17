<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Gallery Sekolah')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .like-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 1rem;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .like-btn:hover {
            background: #f3f4f6;
        }

        .like-btn.liked {
            color: #ef4444;
        }

        .like-btn i {
            transition: all 0.2s;
        }

        .like-btn.liked i {
            font-weight: 900;
        }

        .like-count {
            font-size: 0.875rem;
            margin-left: 4px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen">
        @include('layouts.admin.navigation')
        
        <main class="py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle like button click
        document.addEventListener('click', async function(e) {
            if (e.target.closest('.like-btn')) {
                const button = e.target.closest('.like-btn');
                const galleryId = button.dataset.galleryId;
                const likeCount = button.querySelector('.like-count');
                const icon = button.querySelector('i');
                
                try {
                    const response = await fetch(`/galleries/${galleryId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    if (data.success) {
                        // Toggle class 'liked'
                        button.classList.toggle('liked', data.liked);
                        
                        // Update like count
                        if (likeCount) {
                            likeCount.textContent = data.likes_count;
                        }
                        
                        // Update icon
                        if (icon) {
                            icon.className = data.liked ? 'fas fa-heart' : 'far fa-heart';
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            }
        });
    });
    </script>
</body>
</html>