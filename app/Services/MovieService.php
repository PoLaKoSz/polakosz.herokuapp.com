<?php

namespace App\Services;

use App\Movie;
use App\Services\MovieServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class MovieService implements MovieServiceInterface
{
    /**
     * Get a new Movie eloquent model.
     */
    public function create() : Movie
    {
        return new Movie();
    }

    /**
     * Get a Movie with the given unique ID.
     */
    public function find(int $id) : ?Movie
    {
        return Movie::find($id);
    }

    /**
     * Get all movie with hungarian and english details.
     *
     * @param $count     The maximum required number of items.
     * @param $skipCount Number of items that should be skipped.
     *
     * @return Collection of App\Movie
     */
    public function getWithDetails(int $count, int $skipCount = 0) : Collection
    {
        return Movie::skip($skipCount)
            ->take($count)
            ->orderBy('id', 'desc')
            ->get();
    }
}
