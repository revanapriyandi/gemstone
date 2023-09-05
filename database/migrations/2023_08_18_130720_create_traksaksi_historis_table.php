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
        Schema::create('traksaksi_historis', function (Blueprint $table) {
            $table->id();
            $table->string('order_id', 100);
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');
            $table->string('zona', 50)->nullable();
            $table->string('nickname', 50)->nullable();
            $table->string('etc', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->bigInteger('total_harga');
            $table->enum('status', ['pending', 'process', 'success', 'failed', 'expired', 'cancel']);
            $table->string('no_hp', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->json('log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traksaksi_historis');
    }
};
