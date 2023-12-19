<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembresTable extends Migration
{
    public function up()
    {
        Schema::create('membres', function (Blueprint $table) {
            $table->bigIncrements('membre_id'); // Utilisation de bigIncrements pour unsigned big integer
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->string('contact');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('membres');
    }

}

