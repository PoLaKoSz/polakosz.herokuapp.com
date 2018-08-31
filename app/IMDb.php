<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IMDb extends Model
{
    protected $table = 'imdb';

    // Disable created_at, updated_at TABLE fields
    public $timestamps = false;
}
