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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id'); // ID người mua
            $table->unsignedBigInteger('seller_id'); // ID người bán
            $table->unsignedBigInteger('carbon_credit_id'); // Tín chỉ được giao dịch
            $table->decimal('price', 10, 2); // Giá giao dịch
            $table->timestamp('transaction_date'); // Thời điểm giao dịch
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('carbon_credit_id')->references('id')->on('carbon_credits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
