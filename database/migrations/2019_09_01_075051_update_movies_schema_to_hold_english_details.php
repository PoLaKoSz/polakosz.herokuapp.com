<?php

use App\Movie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMoviesSchemaToHoldEnglishDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->string('en_title')
                ->nullable();
            $table->string('en_comment', 500)
                ->nullable();
            $table->integer('imdb_id')
                ->nullable();
        });

        $this->importData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function($table) {
            $table->dropColumn('en_title');
            $table->dropColumn('en_comment');
            $table->dropColumn('imdb_id');
        });
    }

    private function importData() : void
    {
        $movies = Movie::with('english')
            ->get();
        
        foreach ($movies as $movie) {
            $movie->en_title = $movie->english->title;
            $movie->en_comment = $movie->english->comment;
            $movie->imdb_id = $movie->english->id;

            $movie->save();
        }
    }
}
