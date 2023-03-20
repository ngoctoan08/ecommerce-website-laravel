<?php

use App\Models\ContentRevenueExpenditure;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueExpenditures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_expenditures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Partner::class);
            $table->foreignIdFor(ContentRevenueExpenditure::class);
            $table->dateTime('re_day');
            $table->decimal('re_amount_money'); //số tiền thu/chi
            $table->decimal('re_discount'); //chiết khấu
            $table->string('bill_number', 100)->unique();
            $table->string('re_content'); //revenue_expenditure_content
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
        Schema::dropIfExists('revenue_expenditures');
    }
}