<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande', function (Blueprint $table) {
            $table->increments('id_commande');
            $table->foreignId('id_membre')->constrained('membre','id_membre')->onDelete('cascade');
            $table->foreignId('id_vehicule')->constrained('vehicule','id_vehicule')->onDelete('cascade');
            $table->foreignId('id_agence')->constrained('agences','id_agence')->onDelete('cascade');
            $table->dateTime('date_heure_depart');
            $table->dateTime('date_heure_fin');
            $table->string('prix_total');
            $table->dateTime('date_enregistrement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande');
    }
};
