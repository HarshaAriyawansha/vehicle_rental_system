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
        Schema::table('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('price_per_km');
            $table->string('model_year');
            $table->string('seating_capacity');
            $table->string('status');
            $table->string('air_conditioner');
            $table->string('air_bags');
            $table->string('antilock_braking_system');
            $table->string('power_windows');
            $table->string('cd_player');
            $table->string('car_availability');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('vehicle');
    }

    /**
     * Reverse the migrations.
     */
};
