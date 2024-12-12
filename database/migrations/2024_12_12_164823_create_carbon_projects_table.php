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
        Schema::create('carbon_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('developer')->nullable(); // Nhà phát triển dự án
            $table->string('validation_entity')->nullable(); // Đơn vị xác minh
            $table->enum('project_type',['forestry', 'renewable energy', 'waste Management', 'other'])->default('Forestry'); // Loại dự án
            $table->enum('status',['development', 'operational', 'completed'])->default('development'); // Trạng thái
            $table->timestamp('start_date')->nullable(); // Ngày bắt đầu
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carbon_projects');
    }
};
