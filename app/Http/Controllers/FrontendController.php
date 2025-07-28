<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class FrontendController extends Controller
{
    public function index()
    {
        $books = Book::all();
        // Logic for the homepage
        return view('frontend.ui.home' , compact('books'));
    }

    public function detail($id)
    {
        $book = Book::find($id);
        // Logic for the detail page
        return view('frontend.ui.detail' , compact('book'));
    }
    public function cart()
    {
        // Logic for the cart page
        return view('frontend.ui.cartpage');
    }
}
