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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn13', 50)->nullable();
            $table->string('isbn10', 50)->nullable();
            $table->string('title', 1000);
            $table->string('subtitle', 1000)->nullable();
            $table->string('authors', 1000)->nullable();
            $table->string('categories', 1000)->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->string('publish_year')->nullable();
            $table->string('num_pages')->nullable();
            $table->integer('uploader')->nullable();
            $table->integer('editor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
