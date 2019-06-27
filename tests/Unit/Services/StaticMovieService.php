<?php

namespace Tests\Unit\Services;

use App\HungarianMovie;
use App\IMDb;
use App\Mafab;
use App\Movie;
use App\Port;
use App\Services\MovieServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class StaticMovieService extends TestCase implements MovieServiceInterface
{
    private $cache;

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
     * Get a new Port eloquent model.
     */
    public function asPort() : Port
    {
        return new Port();
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
                $this->movieWithOnlyPortAndIMDb(),
                $this->movieWithOnlyIMDb(),
            ]);
        }

        return $this->cache;
    }

    private function fullDetailedMovie() : Movie
    {
        $movie = factory('App\Movie')->make([
            'id' => 99000 + 0,
            'rating' => 6,
            'cover_image' => 'jay-and-silent-bob-reboot.jpg',
        ]);

        $hu = factory(\App\HungarianMovie::class)->make([
            'title' => 'Jay és Néma Bob visszavág',
            'comment' => 'Füvet szívsz ... :)',
        ]);

        $mafab = factory(\App\Mafab::class)->make([
            'id' => 'jay-es-nema-bob-visszavag-11027',
        ]);

        $port = factory(\App\Port::class)->make([
            'id' => 42212,
        ]);

        $hu->setRelation('mafab', $mafab);
        $hu->setRelation('port', $port);
        $movie->setRelation('hungarian', $hu);

        $imdb = factory(\App\IMDb::class)->make([
            'id' => 6521876,
            'title' => 'Jay and Silent Bob Reboot',
            'comment' => 'No comment :D',
        ]);

        $movie->setRelation('english', $imdb);
        
        return $movie;
    }

    private function movieWithOnlyPortAndIMDb() : Movie
    {
        $movie = factory('App\Movie')->make([
            'id' => 99000 + 1,
            'rating' => 5,
            'cover_image' => 'the-party-just-beginning.jpg',
        ]);

        $hu = factory(\App\HungarianMovie::class)->make([
            'title' => 'The Party\'s Just Beginning',
            'comment' => 'Érdekes',
        ]);

        $mafab = factory(\App\Mafab::class)->make();

        $port = factory(\App\Port::class)->make([
            'id' => 2,
        ]);

        $hu->setRelation('mafab', $mafab);
        $hu->setRelation('port', $port);
        $movie->setRelation('hungarian', $hu);

        $imdb = factory(\App\IMDb::class)->make([
            'id' => 6219314,
            'title' => 'The Party\'s Just Beginning',
            'comment' => 'Interesting',
        ]);
        
        $movie->setRelation('english', $imdb);
        
        return $movie;
    }

    private function movieWithOnlyIMDb() : Movie
    {
        $movie = factory('App\Movie')->make([
            'id' => 99000 + 2,
            'rating' => 6,
            'cover_image' => 'the-wave.jpg',
        ]);

        $hu = factory(\App\HungarianMovie::class)->make();
            $mafab = factory(\App\Mafab::class)->make();
            $hu->setRelation('mafab', $mafab);

            $port = factory(\App\Port::class)->make();
            $hu->setRelation('port', $port);

        $movie->setRelation('hungarian', $hu);

        $imdb = factory(\App\IMDb::class)->make([
            'id' => 1063669,
            'title' => 'The Wave',
            'comment' => 'Interesting',
        ]);

        $movie->setRelation('english', $imdb);
        
        return $movie;
    }
}
