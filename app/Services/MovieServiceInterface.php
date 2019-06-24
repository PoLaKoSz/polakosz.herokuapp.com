<?php

namespace App\Services;

use App\HungarianMovie;
use App\IMDb;
use App\Mafab;
use App\Movie;
use App\Port;
use Illuminate\Database\Eloquent\Collection;

interface MovieServiceInterface
{
    /**
     * Get a new HungarianMovie eloquent model.
     */
    public function asHungarian() : HungarianMovie;

    /**
     * Get a new IMDb eloquent model.
     */
    public function asIMDb() : IMDb;

    /**
     * Get a new Mafab eloquent model.
     */
    public function asMafab() : Mafab;

    /**
     * Get a new Movie eloquent model.
     */
    public function create() : Movie;

    /**
     * Get a new Port eloquent model.
     */
    public function asPort() : Port;

    /**
     * Get a Movie with the given unique ID.
     */
    public function find(int $id) : ?Movie;

    /**
     * Get all movie with hungarian and english details.
     * 
     * @param $count     The maximum required number of items.
     * @param $skipCount Number of items that should be skipped.
     * 
     * @return Collection of App\Movie
     */
    public function getWithDetails(int $count, int $skipCount = 0) : Collection;
}
