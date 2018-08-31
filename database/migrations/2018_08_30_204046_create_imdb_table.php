<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImdbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imdb', function (Blueprint $table) {
            $table->integer('id');

            $table->unsignedBigInteger('movie_id');

            $table->string('title')
                ->comment('Movie English name')
                ->nullable();

            $table->string('comment')
                ->nullable();

            $table->foreign('movie_id')
                ->references('id')->on('movies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imdb');
    }
}
