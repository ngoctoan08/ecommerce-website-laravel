<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTableProductSizeStores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_size_stores', function (Blueprint $table) {
            $table->dropColumn('size_id');
            $table->string('size_name', 100);            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_size_stores', function (Blueprint $table) {
            $table->dropIfExists('size_name');
        });
    }
}