<?php

namespace Tests\Http;

use App\Models\Books\Book;
use Illuminate\Database\Eloquent\Model;
use Tests\Http\CRUD;

class BooksTest extends CRUD
{
    public function getModel($create = false): Model
    {
        if ($create) {
            return factory(Book::class)->create();
        }
        return new Book();
    }

    public function getRoute(string $postfix = ''): string
    {
        return '/books/' . $postfix;
    }

    public function getData(): array
    {
        return ['name' => 'Alone in the dark', 'author' => 'Van Dyk Sir', 'condition' => 100];
    }
}
