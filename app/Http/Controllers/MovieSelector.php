<?php

namespace App\Http\Controllers;

use App\Components\MovieUnifier;
use App\Movie;
use App\Services\MovieServiceInterface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieSelector
{
    private $movieService;
    private $startIndex;
    private $resultCount;

    function __construct(MovieServiceInterface $movieService, int $startIndex, int $resultCount)
    {
        $this->movieService = $movieService;
        $this->startIndex   = $startIndex;
        $this->resultCount  = $resultCount;
    }

    /**
     * Get the collection of Movies in a unified format
     *
     * @param   String  User selected UI language (hu OR en)
     *
     * @return  Array
     *
     * @throws \Invalidargumentexception When $language parameter not 'hu' or 'en'.
     */
    public function get(string $language) : array
    {
        $movies = $this->movieService->getWithDetails($this->resultCount, $this->startIndex);

        if ($language == 'hu') {
            return $this->formatAsHungarian($movies);
        } elseif ($language == 'en') {
            return $this->formatAsEnglish($movies);
        }

        throw new \Invalidargumentexception('Parameter $language should be \'hu\' or \'en\'');
    }


    private function formatAsHungarian(Collection $movies) : array
    {
        $response = array();

        foreach ($movies as $movie) {
            $hun = $movie->hungarian;

            if ($this->hasMafab($hun)) {
                array_push(
                    $response,
                    $this->addHungarianMovie(
                        'https://mafab.hu/movies/' . $hun->mafab->id . '.html',
                        $movie
                    )
                );
            } else {
                $this->addFromIMDb($movie, $response);
            }
        }

        return $response;
    }

    private function hasMafab($movie) : bool
    {
        return $movie->mafab->id != null;
    }

    private function addHungarianMovie(string $url, Movie $movie) : object
    {
        return MovieUnifier::fromDB(
            $url,
            $movie->hungarian->title,
            $movie->rating,
            $movie->hungarian->comment,
            $movie->cover_image
        );
    }

    private function formatAsEnglish(Collection $movies) : array
    {
        $response = array();

        foreach ($movies as $movie) {
            $this->addFromIMDb($movie, $response);
        }

        return $response;
    }

    private function addFromIMDb($movie, array &$container)
    {
        array_push(
            $container,
            MovieUnifier::fromDB(
                'https://imdb.com/title/tt' . $this->appendLeadingZeros($movie->english->id),
                $movie->english->title,
                $movie->rating,
                $movie->english->comment,
                $movie->cover_image
            )
        );
    }

    private function appendLeadingZeros(int $number) : string
    {
        return sprintf('%07d', $number);
    }
}
