
@extends('layouts.app')

@section('content')
    <div class="container">
          <div class="panel-body">
                @if(isset($details))
            <h2> The Search result(s) are:</h2>
        <h2>Book(s) details</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $book)
                <tr>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

      </div>
</div>
@endsection
