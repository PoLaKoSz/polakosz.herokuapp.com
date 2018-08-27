<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesHungarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_hungarian', function (Blueprint $table) {
            $table->unsignedBigInteger('id');

            $table->unsignedBigInteger('movie_id');

            $table->string('title')
                ->comment('Movie hungarian name')
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
        Schema::dropIfExists('movies_hungarian');
    }
}
