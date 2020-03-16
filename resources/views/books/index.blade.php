@extends('layouts.app')

@section('content')
<div class="container">
      <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Book Form -->
        <form action="/book" method="POST" class="form-horizontal">
        @csrf

            <!-- Add Book -->
            <div class="form-group">
                <h2><label for="book-title" class="col-sm-3 control-label">Add a book</label></h2>

                <div class="col-sm-6">
                    <input type="text" placeholder= "Title" name="title" id="book-title" class="form-control mb-2" required>
                </div>

                <div class="col-sm-6">
                    <input type="text" placeholder= "Author" name="author" id="book-author" class="form-control" required>
                </div>
            </div>

            <!-- Add Book Button -->
            <div class="form-group mb-5">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </div>
            </div>
        </form>

        <!-- Search a book -->

        <h2><label for="book-title" class="col-sm-3 control-label">Search for a book</label></h2>
        <form action="/books/search" method="POST" role="search">
            @csrf
            <div class="input-group">
              <div class="col-sm-6">
                  <input
                    type="text"
                    class="form-control"
                    name="search"
                    placeholder="Search a title or author's name">
                    <span class="input-group-btn"> </span>
              </div>
                  <button type="submit" class="btn btn-success">Search</button>

            </div>
        </form>

    <!-- Current Books -->
    @if (count($books) > 0)
        <div class="panel panel-default">
            <div class="panel-heading mt-5">
                <h2>List of books</h2>
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th></i>@sortablelink('title')</th>
                        <th></i>@sortablelink('author')</th>
                        <th>Delete</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @if($books->count())
                        @foreach ($books as $key => $book)
                            <tr>
                                <!-- Book title and author -->
                                <td class="table-text">
                                    <div>{{ $book->title }}</div>
                                </td>

                                <td class="table-text">
                                    <div>{{ $book->author }}</div>
                                    <a href="/books/{{ $book->id }}/edit">Edit</a>
                                </td>

                                <td>
                                    <!-- Delete Button -->
                                    <form action="/book/{{ $book->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger">Delete Book</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                      @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Export list -->

    <div class="d-flex pt-3">
      <h2 class="mr-3">Download to CSV</h2>
          <form action="/books/export-csv" method="GET">
                  <div class="form-group">
                    <select class="form-control" name="book-export-csv">
                      <option value="titlebookcsv">Title & Author</option>
                      <option value="titlecsv">Title</option>
                      <option value="authorcsv">Author</option>
                    </select>
                  </div>
                <button type="submit" class="btn btn-dark">Download</button>
          </form>
    </div>

    <div class="d-flex pt-3">
      <h2 class="mr-3">Download to XML</h2>
          <form action="/books/export-xml" method="GET">
                  <div class="form-group">
                    <select class="form-control" name="book-export">
                      <option value="titlebook">Title & Author</option>
                      <option value="title">Title</option>
                      <option value="author">Author</option>
                    </select>
                  </div>
                <button type="submit" class="btn btn-dark">Download</button>
          </form>
    </div>
    <br>
        <!-- Paginate -->
      {{ $books->links() }}
</div>
@endsection
