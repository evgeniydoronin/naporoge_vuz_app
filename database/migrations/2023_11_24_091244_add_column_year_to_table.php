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
        Schema::table('weeks', function (Blueprint $table) {
            $table->integer('year')->nullable()->after('number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weeks', function (Blueprint $table) {
          $table->integer('year')->nullable()->after('number');
        });
    }
};
