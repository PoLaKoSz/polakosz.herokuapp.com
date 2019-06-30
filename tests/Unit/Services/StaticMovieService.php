<?php

namespace Tests\Unit\Services;

use App\Movie;
use App\Services\MovieServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class StaticMovieService extends TestCase implements MovieServiceInterface
{
    private $cache;

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
        $movies = $this->getWithDetails(0, 0);

        foreach ($movies as $movie) {
            if ($id == $movie->id) {
                return $movie;
            }
        }
        
        return null;
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
        if ($this->cache == null) {
            $this->cache = new Collection([
                $this->fullDetailedMovie(),
                $this->movieWithOnlyIMDb(),
            ]);
        }

        return $this->cache;
    }

    private function fullDetailedMovie() : Movie
    {
        $movie = factory(\App\Movie::class)->make([
            'id' => 99000 + 0,
            'hu_title' => 'Jay és Néma Bob visszavág',
            'hu_comment' => 'Füvet szívsz ... :)',
            'mafab_id' => 'jay-es-nema-bob-visszavag-11027',

            'imdb_id' => 6521876,
            'en_title' => 'Jay and Silent Bob Reboot',
            'en_comment' => 'No comment :D',

            'rating' => 6,
            'cover_image' => 'jay-and-silent-bob-reboot.jpg',
        ]);
        
        return $movie;
    }

    private function movieWithOnlyIMDb() : Movie
    {
        $movie = factory('App\Movie')->make([
            'id' => 99000 + 2,

            'imdb_id' => 1063669,
            'en_title' => 'The Wave',
            'en_comment' => 'Interesting',

            'rating' => 6,
            'cover_image' => 'the-wave.jpg',
        ]);
        
        return $movie;
    }
}
