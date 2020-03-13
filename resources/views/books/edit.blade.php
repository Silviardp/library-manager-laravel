@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/books/{{ $book->id }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
    <div class="row">
      <div class="col-8 offset-2">
          <div class="row">
            <h1>Edit author's name</h1>
          </div>

          <div class="form-group row">
           <label for="Author" class="col-md-4 col-form-label">Author</label>
              <input id="book-author"
                    type="text"
                    name="author"
                    class="form-control @error('author') is-invalid @enderror"
                    value="{{ old('author') ?? $book->author }}"
                    required autocomplete="author" autofocus>

              @error('Author')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="row pt-4">
          <button class="btn btn-primary">
            Save change
          </button>

          </div>
      </div>
    </div>
  </form>
</div>
@endsection
