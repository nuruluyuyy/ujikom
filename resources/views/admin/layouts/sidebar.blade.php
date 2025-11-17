<!-- Sidebar -->
<nav id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h3>Admin Panel</h3>
    </div>

    <ul class="list-unstyled components" id="admin-sidebar-menu">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link" data-route="dashboard">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if(Route::has('admin.users.index'))
        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="nav-link" data-route="users">
                <i class="fas fa-users"></i>
                <span>Pengguna</span>
            </a>
        </li>
        @endif

        @if(Route::has('admin.categories.index'))
        <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="nav-link" data-route="categories">
                <i class="fas fa-tags"></i>
                <span>Kategori</span>
            </a>
        </li>
        @endif


        @if(Route::has('admin.news.index'))
        <li class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <a href="{{ route('admin.news.index') }}" class="nav-link" data-route="news">
                <i class="fas fa-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>
        @endif

        @if(Route::has('admin.settings'))
        <li class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <a href="{{ route('admin.settings') }}" class="nav-link" data-route="settings">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </li>
        @endif
    </ul>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan semua tautan di sidebar berfungsi dengan benar
        const navLinks = document.querySelectorAll('#admin-sidebar-menu .nav-link');
        
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                console.log('Navigating to:', this.getAttribute('href'));
                // Biarkan browser menangani navigasi secara default
                return true;
            });
            
            // Hapus semua event listener yang mungkin menimpa perilaku default
            const newLink = link.cloneNode(true);
            link.parentNode.replaceChild(newLink, link);
        });
    });
</script>
@endpush
<!-- End of Sidebar -->
