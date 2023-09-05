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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('name');
            $table->string('custom_name')->nullable();
            $table->json('harga')->nullable();
            $table->integer('markup_harga')->default(0);
            $table->bigInteger('harga_jual')->default(0);
            $table->boolean('multi_trx')->default(false);
            $table->boolean('status')->default(true);
            $table->time('maintenance_start')->nullable();
            $table->time('maintenance_end')->nullable();
            $table->string('prepost')->nullable();
            $table->text('note')->nullable();
            $table->integer('min_nominal')->nullable();
            $table->integer('max_nominal')->nullable();
            $table->string('server')->nullable();
            $table->foreignId('provider_produk_id')->constrained('provider_produks')->onDelete('cascade');
            $table->foreignId('brand_produk_id')->nullable()->constrained('brand_produks')->onDelete('cascade');
            $table->foreignId('kategori_produk_id')->nullable()->constrained('kategori_produks')->onDelete('cascade');
            $table->foreignId('type_produk_id')->nullable()->constrained('type_produks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
