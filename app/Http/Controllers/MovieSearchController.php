<?php

namespace App\Http\Controllers;

use App\Components\MovieUnifier;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Imdb\Config;
use Imdb\TitleSearch;
use PoLaKoSz\Mafab\Models\MafabMovie;
use PoLaKoSz\Mafab\Search;

class MovieSearchController extends Controller
{
    private $mafab;
    private $imdb;



    public function __construct()
    {
        $this->mafab = new Search();

        $config = new Config();
        $config->language = "en-US,en";

        $this->imdb = new TitleSearch($config);
    }



    /**
     * Handle Mafab.hu search request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function mafab(Request $request) : JsonResponse
    {
        $searchResults = $this->mafab->search($request->movie_name);

        $response = array();

        foreach ($searchResults as $movie) {
            array_push(
                $response,
                MovieUnifier::fromSearch(
                    $movie->getID(),
                    $movie->getURL(),
                    $movie->getHungarianTitle(),
                    $movie->getYear(),
                    $movie->getThumbnailImage()
                )
            );
        }

        return response()->json($response);
    }

    /**
     * Handle IMDb.com search request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function imdb(Request $request) : JsonResponse
    {
        $searchResults = $this->imdb->search(
            $request->movie_name,
            [
                TitleSearch::MOVIE,
                TitleSearch::TV_MINI_SERIES,
                TitleSearch::TV_MOVIE,
                TitleSearch::TV_SERIES,
                TitleSearch::TV_SPECIAL,
                TitleSearch::VIDEO,
                TitleSearch::SHORT
            ],
            2
        );

        $response = array();

        foreach ($searchResults as $imdbMovie) {
            $title = $imdbMovie->orig_title();
            if (empty($title)) {
                $title = $imdbMovie->title();
            }

            array_push(
                $response,
                MovieUnifier::fromSearch(
                    ltrim($imdbMovie->imdbid(), '0'),
                    $imdbMovie->main_url(),
                    $title,
                    $imdbMovie->year(),
                    $imdbMovie->photo()
                )
            );
        }

        return response()->json($response);
    }
}
