<?php

use App\Movie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMovieTableShemaForMerging extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->string('hu_title')
                ->nullable();
            $table->string('hu_comment', 500)
                ->nullable();
            $table->string('mafab_id')
                ->comment('https://www.mafab.hu/movies/<ID>.html')
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
            $table->dropColumn('hu_title');
            $table->dropColumn('hu_comment');
            $table->dropColumn('mafab_id');
        });
    }

    private function importData() : void
    {
        $movies = Movie::with('hungarian', 'hungarian.mafab')
            ->get();
        
        foreach ($movies as $movie) {
            $movie->hu_title = $movie->hungarian->title;
            $movie->hu_comment = $movie->hungarian->comment;
            $movie->mafab_id = $movie->hungarian->mafab->id;

            $movie->save();
        }
    }
}
