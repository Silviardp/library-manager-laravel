<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
  use RefreshDatabase;

  public function a_book_can_be_added_to_the_library()
  {

    $response = $this->post('/books', [
      'title' => 'Cool title',
      'author' => 'Silvia',
    ]);

    $response->assertOk();
    $this->assertCount(1, Book::all());
  }

  public function a_title_is_required()
  {
    $this->withoutExceptionHandling();

    $response = $this->post('/books', [
      'title' => '',
      'author' => 'Silvia',
    ]);

    $response->assertSessionHasErrors('title');
  }

  public function a_author_is_required()
  {
    $this->withoutExceptionHandling();

    $response = $this->post('/books', [
      'title' => 'Cool title',
      'author' => '',
    ]);

    $response->assertSessionHasErrors('author');
  }

  public function a_book_author_can_be_updated()
  {

    $this->post('/books', [
      'author' => 'Author',
    ]);

    $book = Book::first();

    $response = $this->patch('/books' . $book->id, [
        'author' => 'New author',
    ]);

    $this->assertEquals('New author', Book::first()->author);
  }

  public function a_book_can_be_deleted()
  {
    $this->post('/books', [
      'author' => 'Author',
    ]);

    $book = Book::first();
    $this->assertCount(1, Book::all());


    $response = $this->delete('/books/' . $book->id, [
        'title' => 'Cool title',
        'author' => 'New author',
    ]);

    $this->assertCount(0, Book::all());
  }
}
