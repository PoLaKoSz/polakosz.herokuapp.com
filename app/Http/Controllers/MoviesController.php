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
use App\HungarianMovie;
use App\Mafab;
use App\Movie;
use App\Port;
use App\IMDb;
use LaravelLocalization;

use PoLaKoSz\PortHu\Deserializers\MoviePageDeserializer;
use PoLaKoSz\PortHu\MoviePage;

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
     * @return  Movie   array.
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

        $date = (strlen($request->input('date') == 0) ? Carbon::today() : date('Y-m-d', strtotime($request->input('date'))));

        $movie       = $this->movieService->create();
        $movie->date = $date;
        $imdb        = $this->movieService->asIMDb();
        $huMovie     = $this->movieService->asHungarian();
        $mafab       = $this->movieService->asMafab();
        $port        = $this->movieService->asPort();

        $this->abstractEditUpdate($request, $movie, $imdb, $huMovie, $mafab, $port);

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

        if ($movie == null)
            return redirect(LaravelLocalization::localizeURL('movies/'. ($id + 1) .'/edit'));

        $huMovie = $movie->hungarian;

        $port  = $this->fakeHungarianDetails();
        $mafab = $this->fakeHungarianDetails();
        $imdb  = $this->fakeIMDbDetails();

        if ($this->isHungarianDetailsAvailable($movie))
        {
            if ($this->isMafabDetailsAvailable($huMovie))
                $mafab = $huMovie->mafab;

            if ($this->isPortDetailsAvailable($huMovie))
                $port = $huMovie->port;
        }

        if ($this->isEnglishDetailsAvailable($movie))
            $imdb = $movie->english;

        if ($movie->port == null)
            $movie->port = $this->fakeID();

        $data = (object) [
            'id'          => $movie->id,
            'old_port_URL'=> MoviePageDeserializer::BASE_URL . MoviePageDeserializer::ENDPOINT_URL . $movie->port,
            'old_title'   => $movie->title,
            'old_comment' => $movie->comment,
            'rating'      => $movie->rating,
            'cover_image' => $movie->cover_image,
            'hu'          => (object) [
                'title'   => $huMovie->title,
                'comment' => $huMovie->comment,
                'port'    => $port,
                'mafab'   => $mafab
            ],
            'en'          => (object) [
                'title'   => $imdb->title,
                'comment' => $imdb->comment,
                'imdb'    => (object) [
                    'id'  => $imdb->id,
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
            $imdb = $this->movieService->asIMDb();
            $hun = $this->movieService->asHungarian();
                $mafab = $this->movieService->asMafab();
                $port = $this->movieService->asPort();

        if ($movie == null)
            abort(404);

        if ($this->isEnglishDetailsAvailable($movie))
            $imdb = $movie->english;

        if ($this->isHungarianDetailsAvailable($movie))
        {
            $hun = $movie->hungarian;

            if ($this->isMafabDetailsAvailable($hun))
                $mafab = $hun->mafab;

            if ($this->isPortDetailsAvailable($hun))
                $port = $hun->port;
        }

        $this->abstractEditUpdate($request, $movie, $imdb, $hun, $mafab, $port);

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

        if ($movie == null)
        {
            abort(404);
        }

        $movie->delete();
        
        return response()->json();
    }

    private function isHungarianDetailsAvailable(Model $dbModel) : bool
    {
        return $dbModel->hungarian != null;
    }

    private function isPortDetailsAvailable(Model $dbModel) : bool
    {
        return $dbModel->port != null;
    }

    private function isMafabDetailsAvailable(Model $dbModel) : bool
    {
        return $dbModel->mafab != null;
    }

    private function isEnglishDetailsAvailable(Model $dbModel) : bool
    {
        return $dbModel->english != null;
    }

    private function fakeIMDbDetails() : object
    {
        return (object)[
            'id'      => $this->fakeID(),
            'title'   => '',
            'comment' => ''
        ];
    }

    private function fakeHungarianDetails() : object
    {
        return (object)[
            'id' => $this->fakeID()
        ];
    }

    private function fakeID() : string
    {
        return '';
    }

    private function requestParameterValidation(Request $request)
    {
        $this->validate($request, [
            'title_hu'   => 'required|string',
            'title_en'   => 'required|string',
            'port_id'    => 'nullable|integer',
            'mafab_id'   => 'nullable|string',
            'cover_image'=> 'required|url',
            'imdb_id'    => 'required|integer',
            'rating'     => 'required|integer|between:0,101',
        ]);
    }

    private function abstractEditUpdate(Request $request, Movie $movie, IMDb $imdb, HungarianMovie $hungarian, Mafab $mafab, Port $port)
    {
        $movie->cover_image = $request->input('cover_image');
        $movie->rating      = $request->input('rating');
        $movie->save();

            $hungarian->id      = $movie->id;
            $hungarian->title   = $request->input('title_hu');
            $hungarian->comment = $request->input('comment_hu');
                $mafab->id       = $request->input('mafab_id');
                $port->id        = $request->input('port_id');
            $imdb->id        = $request->input('imdb_id');
            $imdb->title     = $request->input('title_en');
            $imdb->comment   = $request->input('comment_en');
        
        $movie->hungarian()->save($hungarian);
            $movie->hungarian->port()->save($port);
            $movie->hungarian->mafab()->save($mafab);
        $movie->english()->save($imdb);
    }
}
