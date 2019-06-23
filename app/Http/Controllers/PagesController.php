<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $movies   = new MoviesController;
        $projects = new ProjectsController;

        return view('pages.index')
            ->with('movies',   $movies->module())
            ->with('projects', $projects->module());
    }
}
