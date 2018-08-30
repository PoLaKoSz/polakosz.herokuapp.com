<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMoviesTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->renameColumn('filmcim', 'title');
            $table->renameColumn('csillag', 'rating');
            $table->renameColumn('megjegyzes', 'comment');
            $table->renameColumn('datum', 'date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->renameColumn('title', 'filmcim');
            $table->renameColumn('rating', 'csillag');
            $table->renameColumn('comment', 'megjegyzes');
            $table->renameColumn('date', 'datum');
        });
    }
}
