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
        Schema::create('provider_produks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->boolean('status')->default(true);
            $table->string('app_id')->nullable()->comment('APP ID For provider Vipress || Username for Digiflazz');
            $table->string('api_key')->nullable()->comment('API Key For provider Vipress || Key for Digiflazz');
            $table->string('level')->nullable()->comment('Level For provider Vipress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_produks');
    }
};
