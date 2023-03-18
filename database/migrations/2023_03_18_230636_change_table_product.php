<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\User;
class ChangeTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->string('name');
            $table->string('slug');
            $table->string('name_image');
            $table->string('path_image');
            $table->text('description');
            $table->string('conversion_unit');
            $table->decimal('entry_price', 12, 2);
            $table->decimal('wholesale_price', 12, 2);
            $table->decimal('retail_price', 12, 2);
            $table->integer('standard_stock');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(User::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_import_export_products');
    }
}