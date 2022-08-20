<?php

namespace App\Usecase;

use App\Usecase\Base;
use App\Usecase\IBase;
use Illuminate\Database\Eloquent\Model;

class User extends Base implements IBase
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
