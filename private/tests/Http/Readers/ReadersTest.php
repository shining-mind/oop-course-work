<?php

namespace Tests\Http;

use App\Models\Readers\Reader;
use Illuminate\Database\Eloquent\Model;
use Tests\Http\CRUD;

class ReadersTest extends CRUD
{
    public function getModel($create = false): Model
    {
        if ($create) {
            return factory(Reader::class)->create();
        }
        return new Reader();
    }

    public function getRoute(string $postfix = ''): string
    {
        return '/readers/' . $postfix;
    }

    public function getData(): array
    {
        /**
         * @var Reader
         */
        $reader = factory(Reader::class)->make();
        return collect($reader->getAttributes())->only('firstname', 'lastname', 'patronymic')->toArray();
    }
}
