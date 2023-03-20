<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TypeRevenueExpenditure;

class CreateContentRevenueExpenditures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_revenue_expenditures', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->foreignIdFor(TypeRevenueExpenditure::class);
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
        Schema::dropIfExists('content_revenue_expenditures');
    }
}