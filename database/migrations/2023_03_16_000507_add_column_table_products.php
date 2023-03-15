<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('entry_price', 9, 3);
            $table->decimal('wholesale_price', 9, 3);
            $table->decimal('retail_price', 9, 3);
            $table->unsignedInteger('standard_stock');
            $table->string('conversion_unit');
            $table->char('code_id', 50);
            $table->bigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIfExists('entry_price');
            $table->dropIfExists('wholesale_price');
            $table->dropIfExists('retail_price');
            $table->dropIfExists('standard_stock');
            $table->dropIfExists('conversion_unit');
            $table->dropIfExists('code_id');
            $table->dropIfExists('user_id');
        });
    }
}