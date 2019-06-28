<?php

namespace App\Services;

use App\HungarianMovie;
use App\IMDb;
use App\Mafab;
use App\Movie;
use App\Services\MovieServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class MovieService implements MovieServiceInterface
{
    /**
     * Get a new HungarianMovie eloquent model.
     */
    public function asHungarian() : HungarianMovie
    {
        return new HungarianMovie();
    }

    /**
     * Get a new IMDb eloquent model.
     */
    public function asIMDb() : IMDb
    {
        return new IMDb();
    }

    /**
     * Get a new Mafab eloquent model.
     */
    public function asMafab() : Mafab
    {
        return new Mafab();
    }

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
        return Movie::with('hungarian', 'hungarian.mafab', 'english')
            ->skip($skipCount)
            ->take($count)
            ->orderBy('id', 'desc')
            ->get();
    }
}
