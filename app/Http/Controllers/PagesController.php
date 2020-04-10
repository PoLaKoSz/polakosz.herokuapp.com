<?php

namespace App\Http\Controllers;

use App\Services\GitHubServiceInterface;
use App\Services\MovieServiceInterface;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * @var MovieServiceInterface
     */
    private $movieService;

    public function __construct(MovieServiceInterface $movieService, GitHubServiceInterface $githubService)
    {
        $this->movieService  = $movieService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $movies   = new MoviesController($this->movieService);

        return view('pages.index')
            ->with('movies', $movies->module());
    }
}
