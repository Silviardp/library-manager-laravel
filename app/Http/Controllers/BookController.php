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
    /**
     * Update author's name
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
     * Destroy book
     */
    public function destroy(Request $request,Book $book)
    {
        $this->authorize('destroy', $book);
        $book->delete();
        return redirect('/books');
    }

     /**
     * Export function
     */
    public function export_csv()
    {
        return Excel::download(new BooksExport(), 'books.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function export_xml()
    {
        return Excel::download(new BooksExport(), 'bookss.xml', \Maatwebsite\Excel\Excel::XML);
    }
}
