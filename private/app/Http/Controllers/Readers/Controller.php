<?php

namespace App\Http\Controllers\Readers;

use App\Http\Controllers\CRUDController;
use App\Models\Readers\Reader;
use Illuminate\Database\Eloquent\Model;

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
}
