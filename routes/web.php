<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GuestGalleryController;
use App\Http\Controllers\GuestAgendaController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GuestNewsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Admin\{
    ContactMessageController,
    AgendaController as AdminAgendaController,
    NewsController as AdminNewsController,
    GalleryController as AdminGalleryController,
    AdminController,
    AdminAuthController,
    UserController as AdminUserController
};

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('guest.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Autentikasi (Breeze / Laravel Default)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Dashboard untuk user biasa (bukan admin)
|--------------------------------------------------------------------------
|
| Ini penting untuk menghilangkan error:
| "Route [dashboard] not defined."
| Dipakai setelah register / login user biasa.
|
*/

Route::get('/dashboard', function () {
    // Kalau mau diarahkan ke halaman lain, ganti 'home' di sini
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| OTP Authentication
|--------------------------------------------------------------------------
*/

Route::prefix('login')->group(function () {
    Route::get('/otp', [\App\Http\Controllers\Auth\OtpController::class, 'showOtpForm'])->name('otp.login');
    Route::post('/otp', [\App\Http\Controllers\Auth\OtpController::class, 'sendOtp'])->name('otp.send');
    Route::get('/otp/verify', [\App\Http\Controllers\Auth\OtpController::class, 'showVerifyForm'])->name('otp.verify');
    Route::post('/otp/verify', [\App\Http\Controllers\Auth\OtpController::class, 'verifyOtp'])->name('otp.verify.submit');
    Route::post('/otp/resend', [\App\Http\Controllers\Auth\OtpController::class, 'resendOtp'])->name('otp.resend');
});

/*
|--------------------------------------------------------------------------
| Google Authentication
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])
    ->name('login.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Rute Tamu (Guest)
|--------------------------------------------------------------------------
*/

Route::name('guest.')->group(function () {
    // Galeri
    Route::get('/galeri', [GuestGalleryController::class, 'index'])->name('gallery');
    Route::get('/galeri/{gallery:slug}', [GuestGalleryController::class, 'show'])->name('gallery.show');
    Route::get('/gallery/{gallery:slug}/share', [GuestGalleryController::class, 'share'])->name('gallery.share');
    
    // Berita
    Route::get('/berita', [GuestNewsController::class, 'index'])->name('news');
    Route::get('/berita/{news:slug}', [GuestNewsController::class, 'show'])->name('news.show');
    
    // Agenda
    Route::get('/agenda', [GuestAgendaController::class, 'index'])->name('agenda');
    
    // Kontak
    Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
    Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');
    
    // Tentang
    Route::get('/tentang', [AboutController::class, 'index'])->name('about');
});

/*
|--------------------------------------------------------------------------
| Rute untuk User yang Sudah Login (guard: web)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Like Gallery
    Route::post('/gallery/{gallery}/like', [GuestGalleryController::class, 'like'])->name('gallery.like');
    
    // Download Gallery
    Route::get('/gallery/{gallery}/download', [GuestGalleryController::class, 'download'])->name('gallery.download');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (guard: admin)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Auth
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {
        // Auth
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Dashboard Admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // User Management
        Route::resource('users', AdminUserController::class);
        Route::post('users/{user}/toggle-block', [AdminUserController::class, 'toggleBlock'])
            ->name('users.toggle-block');

        // Categories
        Route::resource('categories', CategoryController::class)->except(['show']);
        
        // Galleries
        Route::resource('galleries', AdminGalleryController::class);
        
        // News
        Route::resource('news', AdminNewsController::class);
        
        // Agendas
        Route::resource('agendas', AdminAgendaController::class);
        
        // Contact Messages
        Route::get('contact-messages', [ContactMessageController::class, 'index'])
            ->name('contact-messages.index');
        Route::get('contact-messages/{id}', [ContactMessageController::class, 'show'])
            ->name('contact-messages.show');
        Route::delete('contact-messages/{id}', [ContactMessageController::class, 'destroy'])
            ->name('contact-messages.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Test Routes (Hanya untuk development)
|--------------------------------------------------------------------------
*/

if (app()->environment('local')) {
    Route::get('/test-galeri', function () {
        $categories = App\Models\Category::all();
        $galleries = App\Models\Gallery::with('category')->get();
        $userIp = request()->ip();
        return view('guest.gallery', compact('categories', 'galleries', 'userIp'));
    })->name('test.gallery');
}
