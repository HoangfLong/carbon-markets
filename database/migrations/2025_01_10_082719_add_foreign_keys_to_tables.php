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
        Schema::table('carbon_projects', function (Blueprint $table) {
            $table->foreign('project_type_ID')->references('id')->on('project_types');
            $table->foreign('standards_ID')->references('id')->on('standards');
            $table->foreign('user_ID')->references('id')->on('users');
        });
        Schema::table('carbon_credits', function (Blueprint $table) {
            $table->foreign('project_ID')->references('id')->on('projects');
        });
        Schema::table('project_images', function (Blueprint $table) {
            $table->foreign('project_ID')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
