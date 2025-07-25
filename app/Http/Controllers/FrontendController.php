<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Logic for the homepage
        return view('frontend.ui.home');
    }

    public function detail()
    {
        // Logic for the detail page
        return view('frontend.ui.detail');
    }
}
