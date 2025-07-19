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
        Schema::table('booking', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_lno');
            $table->string('vehicle_num');
            $table->string('mileage');
            $table->datetime('book_date');
            $table->string('message');
            $table->datetime('return_date');
            $table->string('new_mileage');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('status');
            $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
