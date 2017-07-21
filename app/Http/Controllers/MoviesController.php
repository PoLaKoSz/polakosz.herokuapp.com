<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = DB::table('movies')->get();

        return view('pages.movies', ['movies' => $movies]);
    }
}
