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
        Schema::create('membre', function (Blueprint $table) {
            $table->increments('id_membre');
            $table->string('pseudo', 20);
            $table->string('mdp', 60);
            $table->string('nom', 20);
            $table->string('prenom', 20);
            $table->string('email', 50);
            $table->enum('civilite', ['m','f']);
            $table->string('statut');
            $table->timeStamp('date_enregistrement');
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
        Schema::dropIfExists('membre');
    }
};
