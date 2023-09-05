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
        Schema::create('brand_produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('position')->default(0);
            $table->integer('form_order')->default(0);
            $table->string('prepost')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_produks');
    }
};
