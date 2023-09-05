<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $isset = DB::select("SHOW TRIGGERS LIKE 'calculate_harga_jual'");
        if (empty($isset)) {
            DB::unprepared('
            CREATE TRIGGER calculate_harga_jual BEFORE INSERT ON produks
            FOR EACH ROW
            BEGIN
                DECLARE level VARCHAR(255);
                SELECT `level` INTO level FROM provider_produks WHERE id = NEW.provider_produk_id;

                IF JSON_EXTRACT(NEW.harga, CONCAT("$.", level)) IS NOT NULL THEN
                    SET NEW.harga_jual = JSON_EXTRACT(NEW.harga, CONCAT("$.", level)) * (1 + (NEW.markup_harga / 100));
                END IF;
            END
        ');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS calculate_harga_jual');
    }
};
