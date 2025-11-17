<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Buat tabel baru dengan struktur yang diinginkan
        Schema::create('gallery_likes_new', function (Blueprint $table) {
            $table->id();
            $table->string('user_ip');
            $table->foreignId('gallery_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_ip', 'gallery_id']);
        });

        // Salin data dari tabel lama ke tabel baru (jika ada)
        DB::statement('INSERT INTO gallery_likes_new (id, gallery_id, created_at, updated_at) SELECT id, gallery_id, created_at, updated_at FROM gallery_likes');
        
        // Hapus tabel lama
        Schema::dropIfExists('gallery_likes');
        
        // Ganti nama tabel baru menjadi gallery_likes
        Schema::rename('gallery_likes_new', 'gallery_likes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Buat tabel lama dengan struktur asli
        Schema::create('gallery_likes_old', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('gallery_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'gallery_id']);
        });

        // Salin data dari tabel baru ke tabel lama (perlu penyesuaian karena struktur berbeda)
        // Catatan: Data user_id akan hilang karena tidak ada di tabel baru
        DB::statement('INSERT INTO gallery_likes_old (id, gallery_id, created_at, updated_at) SELECT id, gallery_id, created_at, updated_at FROM gallery_likes');
        
        // Hapus tabel baru
        Schema::dropIfExists('gallery_likes');
        
        // Ganti nama tabel lama menjadi gallery_likes
        Schema::rename('gallery_likes_old', 'gallery_likes');
    }
};
