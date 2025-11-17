<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            // Tambahkan kolom yang diperlukan
            if (!Schema::hasColumn('galleries', 'category_id')) {
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('galleries', 'title')) {
                $table->string('title');
            }
            if (!Schema::hasColumn('galleries', 'image')) {
                $table->string('image');
            }
            if (!Schema::hasColumn('galleries', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('galleries', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('galleries', 'is_published')) {
                $table->boolean('is_published')->default(true);
            }
        });
    }

    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['category_id', 'title', 'image', 'description', 'user_id', 'is_published']);
        });
    }
};