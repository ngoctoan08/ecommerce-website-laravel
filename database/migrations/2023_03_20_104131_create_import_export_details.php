<?php

use App\Models\ImportExportProduct;
use App\Models\Product;
use App\Models\Partner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportExportDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_export_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ImportExportProduct::class);
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Partner::class);
            $table->integer('amount');
            $table->string('conversion_unit');
            $table->decimal('price', 12, 2);
            $table->decimal('total_amount', 12, 2); //tổng tiền
            $table->decimal('tax_money', 12, 2); // tiền thuế
            $table->decimal('discount', 12, 2); //chiết khấu
            $table->decimal('into_money', 12, 2); // thành tiền
            $table->string('note'); //ghi chú
            $table->timestamps();
            $table->softDeletes();
            // Có thể thêm đơn vị quy đổi nếu cần // trường hợp này là web bán giày nên để là "Đôi" nên không cần
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_export_details');
    }
}