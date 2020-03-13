<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable = ['title', 'author'];
  // protected $guarded = [];

  /**
   * Get the user that owns the book.
   */
  public function user()
    {
        return $this->belongsTo(User::class);
    }

}
