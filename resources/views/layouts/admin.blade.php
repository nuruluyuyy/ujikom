<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - SMKN 4 Bogor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Ikon SVG inline */
        .icon {
            display: inline-block;
            width: 1em;
            height: 1em;
            stroke-width: 0;
            stroke: currentColor;
            fill: currentColor;
            margin-right: 0.5rem;
        }
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Sidebar Active State */
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }
        
        /* Smooth Transitions */
        .nav-link {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid rgba(255, 255, 255, 0.5);
        }
        
        /* Badge Animation */
        @keyframes pulse-badge {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .badge-pulse {
            animation: pulse-badge 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-b from-cyan-600 via-teal-600 to-cyan-700 text-white flex flex-col fixed h-full shadow-2xl">
        <!-- Logo & Brand -->
        <div class="p-6 border-b border-cyan-500/30">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-2xl">📸</span>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                    <p class="text-xs text-cyan-100">SMKN 4 Bogor</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <div class="text-xs font-semibold text-cyan-100 uppercase tracking-wider px-4 mb-3">Menu Utama</div>
            
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-white">
                <span class="text-xl">🏠</span>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-white">
                <span class="text-xl">📂</span>
                <span class="font-medium">Kategori</span>
            </a>
            
            <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-white">
                <span class="text-xl">🖼️</span>
                <span class="font-medium">Galeri</span>
            </a>
            
            <a href="{{ route('admin.agendas.index') }}" class="nav-link {{ request()->routeIs('admin.agendas.*') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-white">
                <span class="text-xl">📅</span>
                <span class="font-medium">Agenda</span>
            </a>
            
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-white">
                <span class="text-xl">📰</span>
                <span class="font-medium">Berita</span>
            </a>

            @if(auth()->user()->is_super_admin)
            <div class="text-xs font-semibold text-cyan-100 uppercase tracking-wider px-4 mb-3 mt-6">Administrasi</div>
            
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} flex items-center gap-3 py-3 px-4 rounded-xl text-white">
                <span class="text-xl">👥</span>
                <span class="font-medium">Kelola Admin</span>
            </a>
            @endif
            
            <div class="text-xs font-semibold text-cyan-100 uppercase tracking-wider px-4 mb-3 mt-6">Interaksi</div>
            
            <!-- Menu komentar dihapus -->
            
            <a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }} flex items-center justify-between py-3 px-4 rounded-xl text-white">
                <div class="flex items-center gap-3">
                    <span class="text-xl">📧</span>
                    <span class="font-medium">Pesan Kontak</span>
                </div>
                @php
                    try {
                        $unreadMessages = \App\Models\ContactMessage::where('is_read', false)->count();
                    } catch (\Exception $e) {
                        $unreadMessages = 0;
                    }
                @endphp
                @if($unreadMessages > 0)
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full badge-pulse">{{ $unreadMessages }}</span>
                @endif
            </a>

            <div class="text-xs font-semibold text-cyan-100 uppercase tracking-wider px-4 mb-3 mt-6">Lainnya</div>
            
            <a href="/" target="_blank" class="nav-link flex items-center gap-3 py-3 px-4 rounded-xl text-white">
                <span class="text-xl">🌐</span>
                <span class="font-medium">Lihat Website</span>
            </a>
        </nav>

        <!-- User Profile -->
        <div class="p-4 border-t border-cyan-500/30">
            <div class="flex items-center gap-3 px-2">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center font-bold text-cyan-600">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-cyan-100">{{ Auth::user()->is_super_admin ? 'Super Admin' : 'Administrator' }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-72 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white border-b border-gray-200 px-8 py-5 sticky top-0 z-10 shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'Selamat datang di admin panel')</p>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-all">
                        <span class="text-2xl">🔔</span>
                        @php
                            try {
                                $totalNotif = \App\Models\ContactMessage::where('is_read', false)->count();
                            } catch (\Exception $e) {
                                $totalNotif = 0;
                            }
                        @endphp
                        @if($totalNotif > 0)
                            <span class="absolute top-1 right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">{{ $totalNotif }}</span>
                        @endif
                    </button>
                    
                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-3 pl-4 border-l border-gray-200 focus:outline-none">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->is_super_admin ? 'Super Admin' : 'Administrator' }}</p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-teal-500 rounded-full flex items-center justify-center font-bold text-white shadow-lg hover:shadow-xl transition-all">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-500 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                             style="display: none;">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 flex items-center" role="menuitem">
                                    <svg class="icon text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 flex items-center" role="menuitem">
                                    <svg class="icon text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                                    </svg>
                                    <span>Pengaturan</span>
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-900 flex items-center" role="menuitem">
                                        <svg class="icon text-red-500" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                                        </svg>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 bg-gray-50">
            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 mt-auto">
            <div class="max-w-7xl mx-auto px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-2">
                    <p class="text-sm text-gray-600">
                        © 2025 <span class="font-semibold text-gray-800">SMKN 4 Bogor</span> - Admin Panel
                    </p>
                    <p class="text-xs text-gray-500">
                        Gallery Management System v1.0.0
                    </p>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>
