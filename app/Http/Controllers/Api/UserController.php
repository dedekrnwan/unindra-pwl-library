<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Usecase\User as UserUsecase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends BaseController
{
    public function __construct()
    {
        $model = new User();
        $uc = new UserUsecase($model);
        parent::__construct($uc, [
            'store' => [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string',
            ],
            'update' => [
                'name' => 'string',
                'email' => 'email|unique:users',
                'password' => 'string',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->res;
        try {
            $payload = $request->post();
            if (array_key_exists('store',$this->validation)) {
                $request->validate($this->validation['store']);
            }
//            $payload['password'] = Hash::make($payload['password']);
            $payload['password'] = bcrypt($payload['password']);
            $data = $this->uc->create($payload);
            $response['data'] = $data;
            return response($response, 200)->header("Content-Type", "application/json");
        } catch (\Exception $e) {
            $response['meta']['success'] = false;
            $response['meta']['message'] = $e->getMessage();
            return response($response, 500)->header("Content-Type", "application/json");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id)
    {
        $response = $this->res;
        try {
            $payload = $request->input();
            if (array_key_exists('update',$this->validation)) {
                $request->validate($this->validation['update']);
            }
            if (array_key_exists('password',$payload)) {
//                $payload['password'] = Hash::make($payload['password']);
                $payload['password'] = bcrypt($payload['password']);
            }
            $data = $this->uc->update( $id,$payload);
            $response['data'] = $data;
            return response($response, 200)->header("Content-Type", "application/json");
        } catch (\Exception $e) {
            $response['meta']['success'] = false;
            $response['meta']['message'] = $e->getMessage();
            return response($response, 500)->header("Content-Type", "application/json");
        }
    }
}
