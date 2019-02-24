<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $movies   = new MoviesController;
        $projects = new ProjectsController;
        
        return view('pages.index')
            ->with('movies',   $movies->module())
            ->with('projects', $projects->module());
    }
}
