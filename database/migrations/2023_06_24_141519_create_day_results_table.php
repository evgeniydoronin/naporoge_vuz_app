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
    Schema::create('day_results', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('day_id');
      $table->foreign('day_id')
        ->references('id')
        ->on('days')->onDelete('cascade');
      $table->integer('execution_scope')->nullable();
      $table->string('result')->nullable();
      $table->string('desires')->nullable();
      $table->string('reluctance')->nullable();
      $table->text('interference')->nullable();
      $table->string('rejoice')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('day_results');
  }
};
