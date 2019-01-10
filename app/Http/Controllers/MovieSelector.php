<?php

namespace App\Http\Controllers;


use App\Components\MovieUnifier;
use App\Movie;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieSelector
{
    private $startIndex;
    private $resultCount;



    function __construct(int $startIndex, int $resultCount)
    {
        $this->startIndex  = $startIndex;
        $this->resultCount = $resultCount;
    }



    /**
     * Get the collection of Movies in a unified format
     * 
     * @param   String  User selected UI language (hu OR en)
     * 
     * @return  Array
     */
    public function get(string $language) : array
    {
        if ( $language == 'hu')
        {
            return $this->formatAsHungarian();
        }
        else if ( $language == 'en' )
        {
            return $this->formatAsEnglish();
        }
    }


    private function formatAsHungarian()
    {
        $response = array();

        $movies = Movie::with('hungarian', 'hungarian.mafab', 'hungarian.port')
                        ->skip( $this->startIndex )
                        ->take( $this->resultCount )
                        ->orderBy('id', 'desc')
                        ->get();

        foreach($movies as $movie)
        {
            $hun = $movie->hungarian;

            if ($this->hasMafab($hun))
            {
                array_push( $response,
                    $this->addHungarianMovie(
                        'https://mafab.hu/movies/' . $hun->mafab->id . '.html',
                        $movie));
            }
            else if ($this->hasPort($hun))
            {
                array_push( $response,
                    $this->addHungarianMovie(
                        'https://port.hu/adatlap/film/tv/-/movie-' . $hun->port->id,
                        $movie));
            }
        }

        return $response;
    }

    private function hasMafab($movie) : bool
    {
        return $movie->mafab->id != null;
    }

    private function hasPort($movie) : bool
    {
        return $movie->port->id != null;
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

    private function formatAsEnglish()
    {
        $response = array();

        $movies = Movie::with('english')
                        ->skip( $this->startIndex )
                        ->take( $this->resultCount )
                        ->orderBy('id', 'desc')
                        ->get();

        foreach($movies as $movie)
        {
            array_push(
                $response,
                MovieUnifier::fromDB(
                    'https://imdb.com/title/tt' . $this->appendLeadingZeros( $movie->english->id ),
                    $movie->english->title,
                    $movie->rating,
                    $movie->english->comment,
                    $movie->cover_image));
        }

        return $response;
    }

    private function appendLeadingZeros(int $number) : string
    {
        return sprintf('%07d', $number);
    }
}
