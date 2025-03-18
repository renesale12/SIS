<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('grades', function (Blueprint $table) {
        $table->string('grade')->change(); // Change grade column to string
    });
}

public function down()
{
    Schema::table('grades', function (Blueprint $table) {
        $table->decimal('grade', 3, 2)->change(); // Rollback to original
    });
}

};
