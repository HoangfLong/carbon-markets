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
        Schema::create('carbon_credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_ID')->nullable();
            $table->string('serial_number')->unique();
            $table->decimal('price_per_ton', 10, 2);
            $table->integer('quantity_available');
            $table->integer('minimum_purchase')->nullable();
            $table->enum('status', ['active', 'expired', 'pending'])->default('pending');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carbon_credits');
    }
};
