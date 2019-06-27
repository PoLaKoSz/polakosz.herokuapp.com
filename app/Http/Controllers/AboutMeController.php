<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutMeController extends Controller
{
    /**
     * Show the about me module.
     * 
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return view('pages.about-me');
    }
}
