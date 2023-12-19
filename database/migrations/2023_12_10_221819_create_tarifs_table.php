<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifsTable extends Migration
{
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->bigIncrements('tarif_id');
            $table->string('activite');
            $table->float('prix_unitaire');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarifs');
    }
}
