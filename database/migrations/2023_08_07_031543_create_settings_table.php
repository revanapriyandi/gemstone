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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('app_slogan')->nullable();
            $table->string('app_url')->nullable();
            $table->boolean('app_register')->default(true);
            $table->text('app_detail')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('app_map')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('currency')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->string('email')->nullable();
            $table->string('office_address')->nullable();
            $table->string('phone')->nullable();
            $table->integer('markup_harga')->default(0);
            $table->boolean('google_login')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
