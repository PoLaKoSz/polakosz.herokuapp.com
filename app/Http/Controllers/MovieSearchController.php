<?php

namespace App\Http\Controllers;

use App\Components\MovieUnifier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PoLaKoSz\Mafab\Models\MafabMovie;
use PoLaKoSz\Mafab\Search;
use PoLaKoSz\PortHu\QuickSearch;

class MovieSearchController extends Controller
{
    private $mafab;
    private $port;



    public function __construct()
    {
        $this->mafab = new Search();
        $this->port = new QuickSearch();
    }



    /**
     * Handle when API request
     * 
     * @return \Illuminate\Http\Response
     */
    public function mafab(Request $request)
    {
        $searchResults = $this->mafab->search( $request->movie_name );

        $response = array();

        foreach($searchResults as $movie)
        {
            array_push(
                $response,
                MovieUnifier::get(
                    $movie->getID(),
                    $movie->getURL(),
                    $movie->getHungarianTitle(),
                    0,
                    $movie->getYear(),
                    '',
                    $movie->getThumbnailImage()
                ));
        }

        return response()->json( $response );
    }

    /**
     * Handle when API request
     * 
     * @return \Illuminate\Http\Response
     */
    public function port(Request $request)
    {
        $searchResults = $this->port->get( $request->movie_name );

        $response = array();

        foreach($searchResults as $movie)
        {
            array_push(
                $response,
                MovieUnifier::get(
                    $movie->getID(),
                    $movie->getURL(),
                    $movie->getHungarianTitle(),
                    0,
                    $movie->getYear(),
                    '',
                    $movie->getPoster()
                ));
        }

        return response()->json( $response );
    }
}
