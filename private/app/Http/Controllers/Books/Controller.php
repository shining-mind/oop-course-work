<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\CRUDController;
use App\Models\Books\Book;
use Illuminate\Database\Eloquent\Model;

class Controller extends CRUDController
{
    public function getModel(): Model
    {
        return new Book();
    }

    public function getRules(): array
    {
        return [
            'name' => 'required|max:255|unique:books',
            'author' => 'required|max:255',
            'condition' => 'required|integer|between:0,100'
        ];
    }
}
