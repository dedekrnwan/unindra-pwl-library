<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserLoan;
use App\Usecase\UserLoan as UserLoanUsecase;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserLoanController extends BaseController
{
    public function __construct()
    {
        $model = new UserLoan();
        $uc = new UserLoanUsecase($model);
        parent::__construct($uc, [
            'store' => [
                'effective_date' => 'required|date_format:d-m-Y',
                'expired_date' => 'required|date_format:d-m-Y',
                'user_id' => 'required|numeric',
                'book_id' => 'required|numeric',
                'quantity' => 'required|numeric',
            ],
            'update' => [
                'effective_date' => 'date_format:d-m-Y',
                'expired_date' => 'date_format:d-m-Y',
                'user_id' => 'numeric',
                'book_id' => 'numeric',
                'quantity' => 'numeric',
                'status' => [
                    Rule::in(['borrowed', 'returned', 'lost'])
                ],
                'return_date' => 'numeric',
            ],
        ]);
    }
}
