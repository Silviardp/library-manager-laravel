@extends('layouts.app')

@section('content')
<div class="container">
      <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Book Form -->
        <form action="/book" method="POST" class="form-horizontal">
        @csrf

            <!-- Book Name -->
            <div class="form-group">
                <label for="book-title" class="col-sm-3 control-label">Add a book</label>

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

        <label for="book-title" class="col-sm-3 control-label">Search for book</label>
        <form action="/books/search" method="POST" role="search">
            @csrf
            <div class="input-group">
              <div class="col-sm-6">
                  <input type="text" class="form-control" name="search"
                    placeholder="Search a title or author's name"> <span class="input-group-btn">
              </div>
                  <button type="submit" class="btn btn-success">Search</button>
                   </span>
            </div>
        </form>

    <!-- Current Books -->
    @if (count($books) > 0)
        <div class="panel panel-default">
            <div class="panel-heading mt-5">
                List of books
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Delete</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($books as $book)
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
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <div class="d-flex pr-5">
            <form action="{{route('export-csv')}}">
                <button class="btn btn-dark mr-3" type="submit">Export to CSV</button>
            </form>
            <br>
            <form action="{{route('export-xml')}}">
                <button class="btn btn-dark" type="submit">Export to XML</button>
            </form>
        </div>
</div>
@endsection
