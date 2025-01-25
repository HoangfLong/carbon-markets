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
        Schema::create('credit_serials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_ID')->references('id')->on('transactions')->constrained()->onDelete('cascade');
            $table->foreignId('carbon_credit_ID')->references('id')->on('carbon_credits')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 10, 2); // Số lượng UD
            $table->string('serial_code')->unique(); // Mã serial code duy nhất
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_serials');
    }
};
