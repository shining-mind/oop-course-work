<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class CRUDController extends BaseController
{
    abstract public function getModel(): Model;

    abstract public function getRules(int $id = null): array;

    public function create(Request $request)
    {
        $attributes = $this->validate($request, $this->getRules());
        $model = $this->getModel();
        foreach ($attributes as $key => $value) {
            $model->setAttribute($key, $value);
        }
        if ($model->save()) {
            return response('', 201);
        }
        return response('', 500);
    }

    public function edit(Request $request, int $id)
    {
        $attributes = $this->validate($request, $this->getRules($id));
        $model = $this->getModel()::findOrFail($id);
        foreach ($attributes as $key => $value) {
            $model->setAttribute($key, $value);
        }
        if ($model->save()) {
            return response('', 200);
        }
        return response('', 500);
    }


    public function delete(Request $request, int $id)
    {
        $model = $this->getModel()::findOrFail($id);
        if ($model->delete()) {
            return response('', 200);
        }
        return response('', 500);
    }

    public function list()
    {
        return $this->getModel()::paginate(10);
    }
}
