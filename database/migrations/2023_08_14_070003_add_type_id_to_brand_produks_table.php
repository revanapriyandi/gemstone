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
        Schema::table('brand_produks', function (Blueprint $table) {
            $table->foreignId('type_id')->nullable()->after('logo')->constrained('type_produks')->onDelete('cascade');
            $table->foreignId('kategori_id')->nullable()->after('type_id')->constrained('kategori_produks')->onDelete('cascade');
            $table->text('cara_topup')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand_produks', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
            $table->dropColumn('cara_topup');
        });
    }
};
