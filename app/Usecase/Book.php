<?php

namespace App\Usecase;

use Illuminate\Database\Eloquent\Model;

class Book extends Base implements IBase
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
