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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_type_ID')->nullable();
            $table->float('carbon_credit_ID')->nullable();
            $table->unsignedBigInteger('standards_ID')->nullable();
            $table->unsignedBigInteger('user_ID')->nullable();
            $table->string('validator', 255)->nullable();
            $table->string('name', 255);
            $table->string('location', 255)->nullable();
            $table->string('developer', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->dateTime('registered_at')->nullable();
            $table->decimal('total_credits', 10, 2)->nullable();
            $table->boolean('is_verified')->default(false);
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
