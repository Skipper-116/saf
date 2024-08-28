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
        Schema::create('application_social_programmes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications');
            $table->foreignId('social_programme_id')->constrained('social_programs');
            $table->foreignId('creator')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_social_programmes');
    }
};
