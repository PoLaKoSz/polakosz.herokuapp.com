<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = DB::table('movies')
            ->orderBy('datum', 'desc')
            ->take(6)
            ->get();

        return view('pages.movies', ['movies' => $movies]);
    }

    public function module()
    {
        // TODO: Not so S.O.L.I.D.
        $movies = DB::table('movies')
            ->orderBy('datum', 'desc')
            ->take(6)
            ->get();

        return view('inc.movies', ['movies' => $movies]);
    }
}
