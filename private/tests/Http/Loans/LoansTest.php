<?php

namespace Tests\Http;

use App\Models\Books\Book;
use App\Models\Loans\Loan;
use App\Models\Readers\Reader;
use Illuminate\Database\Eloquent\Model;
use Tests\Http\CRUD;

class LoansTest extends CRUD
{
    public function getModel($create = false): Model
    {
        if ($create) {
            $book = factory(Book::class)->create();
            $reader = factory(Reader::class)->create();
            return factory(Loan::class)->create([
                'book_id' => $book->id,
                'reader_id' => $reader->id
            ]);
        }
        return new Loan();
    }

    public function getRoute(string $postfix = ''): string
    {
        return '/loans/' . $postfix;
    }

    public function getData(): array
    {
        $book = factory(Book::class)->create();
        $reader = factory(Reader::class)->create();
        return ['book_id' => $book->id, 'reader_id' => $reader->id, 'expires_at' => 10];
    }
}
