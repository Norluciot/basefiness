<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcheterTable extends Migration
{
    public function up()
    {
        Schema::create('acheter', function (Blueprint $table) {
            $table->bigIncrements('acheter_id');

            // Ajouter d'autres colonnes nécessaires
            $table->bigInteger('produit_id')->unsigned();
            $table->foreign('produit_id')->references('produit_id')->on('produits');

            $table->string('type_client');
            $table->date('date_achat');
            $table->integer('quantite_achete');
            $table->double('total_achete');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acheter');
    }
}
