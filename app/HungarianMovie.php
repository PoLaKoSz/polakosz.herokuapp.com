<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HungarianMovie extends Model
{
    protected $table = 'movies_hungarian';

    // Disable created_at, updated_at TABLE fields
    public $timestamps = false;


    public function mafab()
    {
        return $this->hasOne('App\Mafab');
    }
}
