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
        Schema::create('applicant_identifiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained('applicants')->cascadeOnDelete();
            $table->string('identifier');
            $table->foreignId('identifier_type_id')->constrainted('identifier_types');
            $table->foreignId('creator')->constrained('users');
            $table->timestamps();
        });

        // Add the unique constraint on the identifier and identifier_type_id columns
        Schema::table('applicant_identifiers', function (Blueprint $table) {
            $table->unique(['identifier', 'identifier_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_identifiers');
    }
};
