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
        Schema::create('vehicule', function (Blueprint $table) {
            $table->increments('id_vehicule');
            $table->foreignId('id_agence')->constrained('agences','id_agence')->onDelete('cascade');
            $table->string('titre', 200);
            $table->string('marque', 50);
            $table->string('modele', 50);
            $table->text('description');
            $table->string('photo', 200);
            $table->string('prix_journalier');
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
        Schema::dropIfExists('vehicule');
    }
};
