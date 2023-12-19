<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('produit_id');
            $table->string('designation',191);
            $table->integer('quantite_stock')->default(0);
            $table->integer('prix_unitaire');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }

}

