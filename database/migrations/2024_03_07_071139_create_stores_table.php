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
        Schema::create('stores', function (Blueprint $table) {
              //id BIGINT Unsigned AutoINCREMENT PRIMARYKEY
              $table->id();
              $table->string('name');//VARCHAR(255)
              $table->string('slug')->unique();
              $table->text('description')->nullable();
              $table->string('logo_image')->nullable();
              $table->string('cover_image')->nullable();
              $table->enum('status',['active','inactive'])->default('active');
              //2 COLUMNS :created_At and updated_at
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
