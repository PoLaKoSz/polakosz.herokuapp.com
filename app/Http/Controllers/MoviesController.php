<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Movie;
use LaravelLocalization;

class MoviesController extends Controller
{
    protected $resultCount = 6;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function module()
    {
        // TODO: Not so S.O.L.I.D.
        return $movies = DB::table('movies')
                                            ->orderBy('datum', 'desc')
                                            ->orderBy('id', 'desc')
                                            ->take($this->resultCount)
                                            ->get();
    }

    public function jSonModule(Request $request)
    {
        // TODO: Not so S.O.L.I.D.
        $firstShownID = $request->id;

        $movies = DB::table('movies')
                                    ->orderBy('datum', 'desc')
                                    ->orderBy('id', 'desc')
                                    ->skip($firstShownID)
                                    ->take($this->resultCount)
                                    ->get();
        
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: This is only works, if logged in, not only for Admins!!!
        if (Auth::check())
            return view('pages.movies.create');
        else
            abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'portId'    => 'nullable|integer',
            'coverImage'=> 'required|url',
            'rating'    => 'required|integer|between:0,101',
        ]);

        $date = (strlen($request->input('date') == 0) ? Carbon::today() : date('Y-m-d', strtotime($request->input('date'))));
        
        $movie = new Movie;
            $movie->filmcim = $request->input('name');
            $movie->port = $request->input('portId');
            $movie->csillag = $request->input('rating');
            $movie->cover_image = $request->input('coverImage');
            $movie->filmcim = $request->input('title');
            $movie->megjegyzes = $request->input('comment');
            $movie->datum = $date;
        $movie->save();
        
        return redirect( LaravelLocalization::localizeURL('movies/new') )->with('success', trans('movies.success_save'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
