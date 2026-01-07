<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display index page.
     */
    public function index()
    {
        return view('welcome');
    }
}
