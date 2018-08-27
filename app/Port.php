<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'port';

    // Disable created_at, updated_at TABLE fields
    public $timestamps = false;

    /**
     * Get the Movie that owns the Mafab movie.
     */
    public function movie()
    {
        return $this->belongsTo('App\HungarianMovie');
    }
}
