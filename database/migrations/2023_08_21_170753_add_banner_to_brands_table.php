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
            $table->string('banner')->nullable()->after('logo');
            $table->text('deskripsi_field')->nullable()->after('description');
            $table->string('custom_field')->nullable()->after('form_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand_produks', function (Blueprint $table) {
            $table->dropColumn('banner');
            $table->dropColumn('deskripsi_field');
            $table->dropColumn('custom_field');
        });
    }
};
