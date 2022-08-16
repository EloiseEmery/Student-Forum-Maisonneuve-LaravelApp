<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('documents', function (Blueprint $table) {
            $table->id();
			$table->string('document_nom')->nullable();
			$table->string('document_nom_en')->nullable();
            $table->string('document_path')->nullable();
			$table->unsignedBigInteger('document_user_id');
			$table->foreign('document_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('documents');
    }
}
