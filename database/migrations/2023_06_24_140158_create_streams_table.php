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
        Schema::create('streams', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
              ->references('id')
              ->on('users')->onDelete('cascade');
            $table->date('start_at')->nullable();
            $table->boolean('is_active')->default(false);
            $table->string('course_id')->nullable();
            $table->integer('weeks')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('target_minimum')->nullable();
            $table->string('target_external_key')->nullable();
            $table->string('target_external_value')->nullable();
            $table->string('target_internal_key')->nullable();
            $table->string('target_internal_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streams');
    }
};
