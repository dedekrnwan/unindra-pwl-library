<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookTurnover;
use App\Usecase\BookTurnover as BookTurnoverUsecase;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookTurnoverController extends BaseController
{
    public function __construct()
    {
        $model = new BookTurnover();
        $uc = new BookTurnoverUsecase($model);
        parent::__construct($uc, [

        ]);
    }
}
