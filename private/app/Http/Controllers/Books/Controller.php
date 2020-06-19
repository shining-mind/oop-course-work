<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\CRUDController;
use App\Models\Books\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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

    public function search(Request $request)
    {
        $data = $this->validate($request, ['query' => 'required|max:100']);
        $words = explode(' ', preg_replace('/\s+/', ' ', $data['query']));
        $sql = $this->getModel()->query();
        $sql->orWhere(function ($sub) use ($words) {
            foreach ($words as $word) {
                $sub->where('name', 'like', "%$word%");
            }
        });
        $sql->orWhere(function ($sub) use ($words) {
            foreach ($words as $word) {
                $sub->where('author', 'like', "%$word%");
            }
        });
        return $sql->take(5)->get();
    }
}
