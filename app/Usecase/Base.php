<?php

namespace App\Usecase;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Integer;

interface IBase {
    public function find(): \Illuminate\Database\Eloquent\Collection;
    public function findOne(int $id): Model|null;
    public function create(array $payload): Model;
    public function update(int $id, array $payload): Model;
    public function delete(int $id);
}

class Base implements IBase
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function find() : Collection{
        try {
            $data = $this->model->newQuery()->orderBy("created_at", 'desc')->get();
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function findOne(int $id): Model | null
    {
        try {
            $data = $this->model->newQuery()->findOrFail($id);
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(int $id, array $payload): Model
    {
        try {
            $data = $this->model->newQuery()->findOrFail($id);
            $data->update($payload);
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(int $id)
    {
        try {
            $data = $this->model->newQuery()->findOrFail($id);
            $data->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create(array $payload): Model
    {
        try {
            $data = $this->model->newQuery()->create($payload);
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
