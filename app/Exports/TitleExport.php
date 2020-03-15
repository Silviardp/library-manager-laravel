<?php

namespace App\Exports;

use App\Book;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class TitleExport implements FromQuery
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Book::select('title');
    }
}
