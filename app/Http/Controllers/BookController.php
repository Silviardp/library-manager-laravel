<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;

class BookController extends Controller
{
    protected $books;

    public function __construct(BookRepository $books)
    {
        $this->middleware('auth');
        $this->books = $books;
    }
    /**
     * Display a list of all of the user's book.
     */
    public function index(Request $request)
    {
    return view('books.index', [
        'books' => $this->books->forUser($request->user()),
    ]);
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
