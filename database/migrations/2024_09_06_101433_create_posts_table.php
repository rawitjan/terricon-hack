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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('ended')->default(0);
            $table->integer('user_id')->nullable();
            $table->integer('club_id')->nullable();
            $table->string('type')->default('text');
            $table->longText('thumbnail')->nullable();
            $table->longText('body')->nullable();
            $table->json('data')->nullable();
            $table->json('assets')->nullable();
            $table->string('deleted')->nullable();
            $table->integer('publish_profile')->default(0);
            $table->integer('reply_id')->nullable();
            $table->integer('editor_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
