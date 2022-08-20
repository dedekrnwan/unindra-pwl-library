<?php

namespace App\Usecase;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookTurnover extends Base implements IBase
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function find() : Collection{
        try {
            $data = $this->model->newQuery()->with("user", "book", "user_loan")->orderBy("created_at", 'desc')->get();
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
