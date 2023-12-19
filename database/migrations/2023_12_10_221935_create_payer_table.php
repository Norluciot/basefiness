<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayerTable extends Migration
{
    public function up()
    {
        Schema::create('payers', function (Blueprint $table) {
            $table->bigIncrements('payer_id');
            $table->unsignedBigInteger('membre_id')->nullable();
            $table->unsignedBigInteger('visiteur_id')->nullable();
            $table->unsignedBigInteger('tarif_id');
            $table->date('date_paiement')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->enum('statut', ['Actif', 'Expire'])->default('Actif')->nullable();;
            $table->enum('type_client', ['Membre', 'Visiteur']);
            $table->integer('quantite_paye');
            $table->double('total_paye');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('membre_id')->references('membre_id')->on('membres')->onDelete('cascade');
            $table->foreign('visiteur_id')->references('visiteur_id')->on('visiteurs')->onDelete('cascade');
            $table->foreign('tarif_id')->references('tarif_id')->on('tarifs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payers');
    }
}




