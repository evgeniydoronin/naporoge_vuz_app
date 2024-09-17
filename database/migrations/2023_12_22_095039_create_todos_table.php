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
    Schema::create('todos', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')
        ->references('id')
        ->on('users')->onDelete('cascade');
      $table->integer('parent_id')->nullable();
      $table->string('title')->nullable();
      $table->integer('category')->nullable();
      $table->integer('order')->nullable();
      $table->boolean('is_checked')->default(false);
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('todos');
  }
};
