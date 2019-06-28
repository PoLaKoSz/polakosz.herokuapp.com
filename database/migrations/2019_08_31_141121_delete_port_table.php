<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('port');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('port', function (Blueprint $table) {
            $table->unsignedBigInteger('hungarian_movie_id');

            $table->integer('id')
                ->nullable();

            $table->foreign('hungarian_movie_id')
                ->references('movie_id')->on('movies_hungarian')
                ->onDelete('cascade');
        });
    }
}
