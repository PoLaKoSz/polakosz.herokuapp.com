<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueIndexesToAllMovieRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imdb', function (Blueprint $table) {
            $table->unique('movie_id');
        });

        Schema::table('movies_hungarian', function (Blueprint $table) {
            $table->unique('movie_id');
        });

        Schema::table('mafab', function (Blueprint $table) {
            $table->unique('hungarian_movie_id');
        });

        Schema::table('port', function (Blueprint $table) {
            $table->unique('hungarian_movie_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imdb', function (Blueprint $table) {
            $table->dropUnique('imdb_movie_id_unique');
        });
        
        Schema::table('movies_hungarian', function (Blueprint $table) {
            $table->dropUnique('movies_hungarian_movie_id_unique');
        });

        Schema::table('mafab', function (Blueprint $table) {
            $table->unique('mafab_movie_id_unique');
        });

        Schema::table('port', function (Blueprint $table) {
            $table->unique('port_movie_id_unique');
        });
    }
}
