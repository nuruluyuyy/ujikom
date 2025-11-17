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
        Schema::table('news', function (Blueprint $table) {
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('category');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->dateTime('published_date')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'title',
                'content',
                'image',
                'category',
                'status',
                'published_date',
                'slug',
                'user_id'
            ]);
        });
    }
};
