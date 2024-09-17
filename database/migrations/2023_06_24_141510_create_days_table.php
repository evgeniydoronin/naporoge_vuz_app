<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('days', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('week_id');
      $table->foreign('week_id')
        ->references('id')
        ->on('weeks')->onDelete('cascade');
      $table->dateTime('start_at')->nullable();
      $table->dateTime('completed_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('days');
  }
};
