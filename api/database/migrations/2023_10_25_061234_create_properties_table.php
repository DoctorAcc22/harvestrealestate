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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('area');
            $table->string('title');
            $table->string('description');
            $table->string('loc_city');
            $table->string('loc_latitude');
            $table->string('loc_longitude');
            $table->string('loc_address');
            $table->string('loc_state');
            $table->string('loc_neightborhood');
            $table->string('loc_zip');
            $table->string('loc_country');
            $table->string('price');
            $table->string('price_label');
            $table->foreignId('agent_id')->references('id')->on('agents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
