<?php

namespace Tests\Http;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

abstract class CRUD extends TestCase
{
    use DatabaseMigrations;

    abstract public function getModel($create = false): Model;

    abstract public function getRoute(string $postfix = ''): string;

    abstract public function getData(): array;

    public function testCreate()
    {
        $this->post($this->getRoute(), $this->getData())
            ->assertResponseStatus(201);
    }

    public function testEdit()
    {
        $model = $this->getModel(true);
        $this->put($this->getRoute($model->id), $this->getData())
            ->assertResponseOk();
    }

    public function testDelete()
    {
        $model = $this->getModel(true);
        $this->delete($this->getRoute($model->id))
            ->assertResponseOk();
    }

    public function testList()
    {
        $this->get($this->getRoute())
            ->seeJsonStructure([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
}
