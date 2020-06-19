<?php

namespace App\Http\Controllers\Readers;

use App\Http\Controllers\CRUDController;
use App\Models\Readers\Reader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Controller extends CRUDController
{
    public function getModel(): Model
    {
        return new Reader();
    }

    public function getRules(int $id = null): array
    {
        return [
            'lastname' => 'required|max:128',
            'firstname' => 'required|max:128',
            'patronymic' => 'nullable|max:128'
        ];
    }

    public function search(Request $request)
    {
        $data = $this->validate($request, ['query' => 'required|max:100']);
        $words = explode(' ', preg_replace('/\s+/', ' ', $data['query']));
        $sql = $this->getModel()->query();
        $fields = ['lastname', 'firstname', 'patronymic'];
        foreach ($words as $key => $word) {
            $field = $fields[$key] ?? null;
            if ($field) {
                $sql->where($field, 'like', "%$word%");
            }
        }
        return $sql->take(5)->get();
    }
}
