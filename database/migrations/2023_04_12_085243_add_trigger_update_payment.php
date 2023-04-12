<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class AddTriggerUpdatePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_export_products', function (Blueprint $table) {
            //
        });
        // if status = 2 Đã giao hàng ==> paymented = into_money
        DB::unprepared('
            CREATE TRIGGER update_paymented
            BEFORE UPDATE ON import_export_products
            FOR EACH ROW
            BEGIN
                IF NEW.status <> OLD.status AND NEW.status = "2" THEN
                    UPDATE import_export_products SET paymented = NEW.into_money WHERE id = NEW.id;
                END IF;
            END;
        ');
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_export_products', function (Blueprint $table) {
            //
        });
    }
}