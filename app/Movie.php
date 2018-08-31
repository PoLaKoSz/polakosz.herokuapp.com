<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // Disable created_at, updated_at TABLE fields
    public $timestamps = false;

    public function hungarian()
    {
        return $this->hasOne('App\HungarianMovie');
    }

    public function english()
    {
        return $this->hasOne('App\IMDb');
    }
}
