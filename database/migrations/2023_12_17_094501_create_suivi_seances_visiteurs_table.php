<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuiviSeancesVisiteursTable extends Migration
{
    public function up()
    {
        Schema::create('suivi_seances_visiteurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visiteur_id');
            $table->unsignedBigInteger('payer_id')->nullable();
            $table->date('date_seance')->nullable();
            $table->integer('seances_payees')->default(0);
            $table->boolean('a_fait_seance')->default(false);
            $table->boolean('seance_gratuite_utilisee')->default(0);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('visiteur_id')->references('visiteur_id')->on('visiteurs')->onDelete('cascade');
            $table->foreign('payer_id')->references('id')->on('payers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('suivi_seances_visiteurs');
    }
}

