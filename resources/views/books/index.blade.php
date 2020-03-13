@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->
<div class="container">
      <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Book Form -->
        <form action="/book" method="POST" class="form-horizontal">
        @csrf

            <!-- Book Name -->
            <div class="form-group">
                <label for="book-title" class="col-sm-3 control-label">Book</label>

                <div class="col-sm-6">
                    Title: <input type="text" name="title" id="book-title" class="form-control">
                </div>

                <div class="col-sm-6">
                    Author: <input type="text" name="author" id="book-author" class="form-control">
                </div>
            </div>

            <!-- Add Book Button -->
            <div class="form-group mb-5">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Book
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current Books -->
    @if (count($books) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                My Books
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

                                        <button>Delete Book</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
