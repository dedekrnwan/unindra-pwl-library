<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Usecase\Book as BookUsecase;

class BookController extends BaseController
{
    public function __construct()
    {
        $model = new Book();
        $uc = new BookUsecase($model);
        parent::__construct($uc, [
            'store' => [
                'title' => 'required|string',
                'writer' => 'required|string',
                'publisher' => 'required|string',
                'publish_year' => 'required|numeric',
                'stock' => 'required|numeric',
                'category' => 'required|string',
                'price' => 'required|numeric',
            ],
            'update' => [
                'title' => 'string',
                'writer' => 'string',
                'publisher' => 'string',
                'publish_year' => 'numeric',
                'stock' => 'numeric',
                'category' => 'string',
                'price' => 'numeric',
            ],
        ]);
    }
}
