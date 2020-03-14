<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Book extends Model
{
  use Sortable;
    protected $fillable = ['title', 'author'];
  public $sortable = ['title', 'author'];

  /**
   * Get the user that owns the book.
   */
  public function user()
    {
        return $this->belongsTo(User::class);
    }

}
