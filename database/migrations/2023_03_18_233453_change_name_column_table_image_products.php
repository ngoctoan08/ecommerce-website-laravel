<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
class ChangeNameColumnTableImageProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class);
            $table->string('name_sub_image');
            $table->string('path_sub_image');
            $table->smallInteger('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_products');
    }
}