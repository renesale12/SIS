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
        Schema::table('grades', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['subject_id']);

            // Drop the 'subject_id' column
            $table->dropColumn('subject_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            // Re-add the 'subject_id' column
            $table->unsignedBigInteger('subject_id')->nullable()->after('id');

            // Re-add the foreign key constraint
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }
};