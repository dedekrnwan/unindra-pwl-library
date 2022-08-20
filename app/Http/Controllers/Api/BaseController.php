<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Usecase\Base as BaseUsecase;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class BaseController extends Controller
{
    protected $uc;
    public $res = [
        "meta" => [
            "success" => true,
            "message" => "Request succcessfully proceed"
        ],
        "data" => null
    ];
    public $validation = [];
    public function __construct(BaseUsecase $uc, array $validation)
    {
        $this->uc = $uc;
        $this->validation = $validation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = $this->res;
        try {
            $data = $this->uc->find();
            $response['data'] = $data;
            return response($response, 200)->header("Content-Type", "application/json");
        } catch (\Exception $e) {
            $response['meta']['success'] = false;
            $response['meta']['message'] = $e->getMessage();
            $response['data'] = [];
            return response($response, 500)->header("Content-Type", "application/json");
        }
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,int $id)
    {
        $response = $this->res;
        try {
            $data = $this->uc->findOne($id);
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

            $data = $this->uc->update( $id,$payload);
            $response['data'] = $data;
            return response($response, 200)->header("Content-Type", "application/json");
        } catch (\Exception $e) {
            $response['meta']['success'] = false;
            $response['meta']['message'] = $e->getMessage();
            return response($response, 500)->header("Content-Type", "application/json");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = $this->res;
        try {

           $this->uc->delete((int)$request->route('id'));
            return response($response, 200)->header("Content-Type", "application/json");
        } catch (\Exception $e) {
            $response['meta']['success'] = false;
            $response['meta']['message'] = $e->getMessage();
            return response($response, 500)->header("Content-Type", "application/json");
        }
    }
}
