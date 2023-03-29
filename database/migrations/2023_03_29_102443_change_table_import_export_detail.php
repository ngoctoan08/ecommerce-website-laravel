<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableImportExportDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_export_details', function (Blueprint $table) {
            $table->dropColumn('partner_id');
            $table->string('size', 100);
            $table->renameColumn('amount', 'quantity');
            $table->renameColumn('conversion_unit', 'unit');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_export_details', function (Blueprint $table) {
            $table->dropIfExists('size');
        });
    }
}