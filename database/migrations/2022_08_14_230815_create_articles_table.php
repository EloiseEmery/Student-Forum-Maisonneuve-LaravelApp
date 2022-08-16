<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('articles', function (Blueprint $table) {
            $table->id();
			$table->string('article_nom', 255)->nullable();
			$table->string('article_nom_en', 255)->nullable();
			$table->longText('article_description', 255)->nullable();
			$table->longText('article_description_en', 255)->nullable();
			$table->unsignedBigInteger('article_user_id');
			$table->foreign('article_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('articles');
    }
}
