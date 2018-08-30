<?php

namespace App\Http\Controllers;

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
        return $this->formatAsHungarian();
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
                    $this->addMovie(
                        'https://mafab.hu/movies/' . $hun->mafab->id . '.html',
                        $movie));
            }
            else if ($this->hasPort($hun))
            {
                array_push( $response,
                    $this->addMovie(
                        'https://port.hu/adatlap/film/tv/-/movie-' . $hun->port->id,
                        $movie));
            }
        }

        return $response;
    }

    private function hasMafab($movie) : bool
    {
        return $movie->mafab != null;
    }

    private function hasPort($movie) : bool
    {
        return $movie->port != null;
    }

    private function addMovie(string $url, Movie $movie) : object
    {
        return (object) [
            'url'     => $url,
            'name'    => $movie->hungarian->title,
            'rating'  => $movie->rating,
            'comment' => $movie->hungarian->comment,
            'image'   => $movie->cover_image
        ];
    }
}
