<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gallery_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->unsignedBigInteger('shares_count')->default(0);
            $table->unsignedBigInteger('downloads_count')->default(0);
            $table->timestamp('last_liked_at')->nullable();
            $table->timestamp('last_shared_at')->nullable();
            $table->timestamp('last_downloaded_at')->nullable();
            $table->timestamps();

            $table->unique('gallery_id'); // 1 galeri = 1 baris statistik
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_stats');
    }
};
