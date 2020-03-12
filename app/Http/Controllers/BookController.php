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
    /**
     * Create a new book
     */
    public function store(Request $request)
    {
    $this->validate($request, [
        'title' => 'required',
        'author' => 'required',
    ]);

    $request->user()->books()->create([
        'title' => $request->title,
        'author' => $request->author,
    ]);

    return redirect('/books');
    }
}
