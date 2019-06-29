<?php

use App\Movie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteMafabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('mafab');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('mafab', function (Blueprint $table) {
            $table->unsignedBigInteger('hungarian_movie_id');

            $table->string('id')
                ->comment('https://www.mafab.hu/movies/<ID>.html')
                ->nullable();

            $table->foreign('hungarian_movie_id')
                ->references('movie_id')->on('movies_hungarian')
                ->onDelete('cascade');
        });
    }
}
