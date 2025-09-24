<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error401()
    {
        return view('pages.error401');
    }

    public function error404()
    {
        return view('pages.error404');
    }

    public function error500()
    {
        return view('pages.error500');
    }

}
