<?php

namespace App\Services;

use App\IMDb;
use App\Movie;
use Illuminate\Database\Eloquent\Collection;

interface MovieServiceInterface
{
    /**
     * Get a new IMDb eloquent model.
     */
    public function asIMDb() : IMDb;

    /**
     * Get a new Movie eloquent model.
     */
    public function create() : Movie;

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
