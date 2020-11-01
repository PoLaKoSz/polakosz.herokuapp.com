<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Services\MovieServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MovieSelector;
use Carbon\Carbon;
use \DateTime;
use App\Movie;
use LaravelLocalization;

class MoviesController extends Controller
{
    /**
     * @var MovieServiceInterface
     */
    private $movieService;

    protected $resultCount = 6;

    public function __construct(MovieServiceInterface $movieService)
    {
        $this->middleware('auth')->except([
            'index',
            'jSonModule'
        ]);

        $this->movieService = $movieService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        $movies = $this->movieService->getWithDetails($this->resultCount);

        return view('pages.movies.index')->with('movies', $movies);
    }

    /**
     * Gets movies for the Movies section in the home page.
     *
     * @return  Array of App\Movie.
     */
    public function module(int $startIndex = 0) : array
    {
        $selector = new MovieSelector($this->movieService, $startIndex, $this->resultCount);

        return $selector->get(LaravelLocalization::getCurrentLocale());
    }

    /**
     * Gets movies for the Movies section when clicking on the "More" button.
     *
     * @return  Array
     */
    public function jSonModule(Request $request) : object
    {
        $firstShownID = $request->id;

        $movies = $this->module($firstShownID);

        $view = view("inc.movies")
            ->with('movies', $movies)
            ->render();

        $data = [
            'data' => $view,
            'meta' => [
                'next-id' => $firstShownID + $this->resultCount,
            ],
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() : View
    {
        // TODO: This is a security issue, because all registered user can access it, not just the Admin(s)!!!
        return view('pages.movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->requestParameterValidation($request);

        $date = Carbon::today();
        if ($request->input('date') != null)
            $date = Carbon::createFromFormat(trans('movies.date_php_format'), $request->input('date'));

        $request->merge([
            'date' => $date->format('Y-m-d'),
        ]);

        $movie = $this->movieService->create();

        $this->abstractEditUpdate($request, $movie);

        return redirect(LaravelLocalization::localizeURL('movies/new'))->with('success', trans('movies.success_save'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(int $id)
    {
        $movie = $this->movieService->find($id);

        if ($movie == null) {
            return redirect(LaravelLocalization::localizeURL('movies/'. ($id + 1) .'/edit'));
        }

        $data = (object) [
            'id'          => $movie->id,
            'rating'      => $movie->rating,
            'date'        => date_format($movie->date, trans('movies.date_php_format')),
            'cover_image' => $movie->cover_image,
            'hu'          => (object) [
                'title'   => $movie->hu_title,
                'comment' => $movie->hu_comment,
                'mafab'   => (object) [
                    'id'  => $movie->mafab_id
                ]
            ],
            'en'          => (object) [
                'title'   => $movie->en_title,
                'comment' => $movie->en_comment,
                'imdb'    => (object) [
                    'id'  => $movie->imdb_id,
                ]
            ]
        ];

        return view('pages.movies.edit')
            ->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $this->requestParameterValidation($request);

        $movie = $this->movieService->find($id);

        if ($movie == null) {
            abort(404);
        }

        $this->abstractEditUpdate($request, $movie);

        return redirect(LaravelLocalization::localizeURL('movies'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(int $id)
    {
        $movie = $this->movieService->find($id);

        if ($movie == null) {
            abort(404);
        }

        $movie->delete();

        return response()->json();
    }

    private function requestParameterValidation(Request $request)
    {
        $this->validate($request, [
            'title_en'   => 'required|string',
            'mafab_id'   => 'nullable|string',
            'imdb_id'    => 'required|integer',
            'cover_image'=> 'required|string',
            'rating'     => 'required|integer|between:0,101',
        ]);
    }

    private function abstractEditUpdate(Request $request, Movie $movie)
    {
        if ($request->input('title_hu') === null) {
            $request->request->add(['title_hu' => $request->input('title_en')]);
        }

        $movie->cover_image = $request->input('cover_image');
        $movie->date        = $request->input('date');
        $movie->rating      = $request->input('rating');
        $movie->hu_title    = $request->input('title_hu');
        $movie->hu_comment  = $request->input('comment_hu');
        $movie->mafab_id    = $request->input('mafab_id');

        $movie->imdb_id     = $request->input('imdb_id');
        $movie->en_title    = $request->input('title_en');
        $movie->en_comment  = $request->input('comment_en');

        $movie->save();
    }
}
