<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('etudiants', function (Blueprint $table) {
			$table->id();
            $table->string('etudiant_nom', 255);
            $table->string('etudiant_adresse', 255);
            $table->string('etudiant_telephone', 50);
            // $table->string('etudiant_courriel', 255);
            $table->date('etudiant_date_naissance');
            $table->unsignedBigInteger('etudiant_ville_id');
			$table->unsignedBigInteger('etudiant_user_id');
            $table->foreign('etudiant_ville_id')->references('id')->on('villes');
			$table->foreign('etudiant_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('etudiants');
    }
}
