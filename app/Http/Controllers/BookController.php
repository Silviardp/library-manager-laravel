<?php

namespace App\Http\Controllers;

use App\Book;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;
use Illuminate\Support\Facades\Input;



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
        $books = Book::sortable()->paginate(10);
        return view('books.index')->withBooks($books);
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

    /**
     * Update author's name -> only user who create the book
     */
    public function edit(Book $book)
    {
      $this->authorize('update', $book);
      return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
      $this->authorize('update', $book);
      $book->author = $request->input('author');
      $book->update();
      return redirect('/books');
    }

    /**
     * Destroy book -> only user who create the book
     */
    public function destroy(Request $request,Book $book)
    {
        $this->authorize('destroy', $book);
        $book->delete();
        return redirect('/books');
    }

    /**
     * Search for a book by title or author
     */
    public function search(Request $request,Book $book)
    {
      $search = Input::get('search');
      $book = Book::where('title', 'like', '%'.$search.'%')->orWhere('author','LIKE','%'.$search.'%')->get();
      if (count($book)>0)
        return view('books.search')->withDetails($book)->withQuery ( $search );
      else
        return view ('books.search')->withMessage('No book(s) with this title or author found. Try again !');
    }

     /**
     * Export function
     */
    public function exportCsv()
    {
        return Excel::download(new BooksExport(), 'books.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function exportXml()
    {

    }
  }
