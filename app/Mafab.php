<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mafab extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mafab';

    // Disable created_at, updated_at TABLE fields
    public $timestamps = false;

    // Now id column can be string
    public $incrementing = false;
}
