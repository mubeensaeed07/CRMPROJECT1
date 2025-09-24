<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
    
    public function google_maps()
    {
        return view('pages.google-maps');
    }

    public function leaflet_maps()
    {
        return view('pages.leaflet-maps');
    }

    public function vector_maps()
    {
        return view('pages.vector-maps');
    }

}
