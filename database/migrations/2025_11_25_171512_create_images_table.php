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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 220)->unique();
            $table->text('description')->nullable();
            $table->text('file_path');
            $table->text('thumbnail_path');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->bigInteger('file_size_bytes')->nullable();
            $table->string('format', 20)->default('png');
            $table->string('background_type', 20)->default('transparent');
            
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('license_id')->nullable()->constrained('licenses')->nullOnDelete();
            $table->foreignId('uploader_id')->nullable()->constrained('users')->nullOnDelete();

            $table->boolean('is_published')->default(true);
            $table->boolean('is_deleted')->default(false);

            $table->bigInteger('downloads_count')->default(0);
            $table->bigInteger('favorites_count')->default(0);
            $table->bigInteger('views_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
