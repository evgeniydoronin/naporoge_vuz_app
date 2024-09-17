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
        Schema::create('two_targets', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('stream_id');
          $table->foreign('stream_id')
            ->references('id')
            ->on('streams')->onDelete('cascade');
          $table->string('title')->nullable();
          $table->string('minimum')->nullable();
          $table->string('target_one_title')->nullable();
          $table->string('target_one_description')->nullable();
          $table->string('target_two_title')->nullable();
          $table->string('target_two_description')->nullable();
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('two_targets');
    }
};
