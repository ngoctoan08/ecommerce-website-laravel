<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Partner;
use App\Models\TypeImportExport;
use App\Models\User;
class ChangeTableImportExportProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_export_products', function (Blueprint $table) {
            $table->id();
            $table->string('bill_code', 100)->unique();
            $table->dateTime('day');
            $table->decimal('total_amount', 12, 2); //tổng tiền
            $table->decimal('tax_money', 12, 2); //tổng tiền
            $table->decimal('discount', 12, 2); //chiết khấu
            $table->decimal('into_money', 12, 2); // thành tiền
            $table->decimal('paymented', 12, 2); //chuyen khoan
            $table->string('note'); //ghi chú
            $table->string('status', 100); //Trạng thái
            $table->timestamps();
            $table->softDeletes();
            // Khoa ngoai
            $table->foreignIdFor(Partner::class);
            $table->foreignIdFor(TypeImportExport::class);
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
        Schema::table('import_export_products', function (Blueprint $table) {
        });
    }
}