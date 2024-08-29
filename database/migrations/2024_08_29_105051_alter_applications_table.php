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
        Schema::table('applications', function (Blueprint $table) {
            // we need to add a column called approved which will be a boolean
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approved_date')->nullable();

            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('approved');
            $table->dropColumn('approved_by');
            $table->dropColumn('approved_date');
        });
    }
};
