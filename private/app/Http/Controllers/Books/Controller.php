<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\CRUDController;
use App\Models\Books\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Controller extends CRUDController
{
    public function getModel(): Model
    {
        return new Book();
    }

    public function getRules(int $id = null): array
    {
        return [
            'name' => ['required' ,'max:255', Rule::unique('books')->ignore($id)],
            'author' => 'required|max:255',
            'condition' => 'required|integer|between:0,100'
        ];
    }
}
