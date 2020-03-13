<?php

namespace App\Repositories;

use App\User;
use App\Book;

class BookRepository
{
    /**
     * Get all of the books for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Book::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
