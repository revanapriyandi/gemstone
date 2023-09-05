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
        Schema::table('metode_pembayarans', function (Blueprint $table) {
            $table->bigInteger('min_value')->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metode_pembayarans', function (Blueprint $table) {
            $table->dropColumn('min_value');
        });
    }
};
