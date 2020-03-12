<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a list of all of the user's book.
     */
    public function index(Request $request)
    {
    return view('books.index');
    }
}
