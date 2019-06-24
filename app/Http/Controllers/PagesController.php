<?php

namespace App\Http\Controllers;

use App\Services\MovieServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * @var MovieServiceInterface
     */
    private $movieService;

    public function __construct(MovieServiceInterface $movieService)
    {
        $this->movieService  = $movieService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $movies   = new MoviesController($this->movieService);
        $projects = new ProjectsController;
        
        return view('pages.index')
            ->with('movies',   $movies->module())
            ->with('projects', $projects->module());
    }
}
