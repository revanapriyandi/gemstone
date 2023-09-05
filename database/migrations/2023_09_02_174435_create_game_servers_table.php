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
        Schema::create('game_servers', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('name', 50);
            $table->foreignId('brand_id')->constrained('brand_produks')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('brand_produks', function (Blueprint $table) {
            $table->string('custom_field2')->nullable()->after('custom_field');
            $table->boolean('game_server')->default(false)->after('custom_field2');
            $table->boolean('cek_id')->default(false)->after('game_server');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_servers');
        Schema::table('brand_produks', function (Blueprint $table) {
            $table->dropColumn('custom_field2');
            $table->dropColumn('game_server');
            $table->dropColumn('cek_id');
        });
    }
};
