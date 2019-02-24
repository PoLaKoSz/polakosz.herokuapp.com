<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncreaseCommentsMaxLength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies_hungarian', function (Blueprint $table) {
            $table->string('comment', 500)->change();
        });

        Schema::table('imdb', function (Blueprint $table) {
            $table->string('comment', 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies_hungarian', function (Blueprint $table) {
            $table->string('comment')->change();
        });
        
        Schema::table('imdb', function (Blueprint $table) {
            $table->string('comment')->change();
        });
    }
}
