<?php

use App\Models\Area;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TypePartner;
use App\Models\Area as AreaPartNer;
class CreateTablePartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name_partner');
            $table->foreignIdFor(TypePartner::class);
            $table->foreignIdFor(AreaPartNer::class);
            $table->string('address');
            $table->string('tel', 20);
            $table->string('email', 50);
            $table->string('note');
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
        Schema::dropIfExists('partners');
    }
}