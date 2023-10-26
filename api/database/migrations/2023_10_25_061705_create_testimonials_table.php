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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('email');
            $table->string('content');
            $table->string('rating');
            $table->foreignId('property_id')->references('id')->on('properties');
            $table->string('company');
            $table->string('photo_url');
            $table->string('video_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
