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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->json('thumbnail')->nullable();
            $table->string('title');
            $table->text('description');
            $table->integer('entry_opened')->default(0);
            $table->integer('deleted')->nullable();
            $table->integer('owner_id');
            $table->json('moderators')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
