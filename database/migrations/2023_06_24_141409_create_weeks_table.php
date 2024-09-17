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
        Schema::create('weeks', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('stream_id');
          $table->foreign('stream_id')
            ->references('id')
            ->on('streams')->onDelete('cascade');
          $table->integer('number')->nullable();
          $table->string('progress')->nullable();
          $table->boolean('system_confirmed')->default(false);
          $table->boolean('user_confirmed')->default(false);
          $table->json('cells')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};
