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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id'); // Khóa ngoại
            $table->string('serial_number')->unique();
            $table->decimal('value', 8, 2);
            $table->enum('status', ['available', 'sold', 'retired'])->default('available');
            $table->timestamps();;

            $table->foreign('project_id')
                  ->references('id')
                  ->on('carbon_projects')
                  ->onDelete('cascade');
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
