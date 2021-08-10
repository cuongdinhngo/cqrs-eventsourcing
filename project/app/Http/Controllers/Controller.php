<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Response successful Json result
     *
     * @param array       $data       Data return
     * @param int         $statusCode Status code 2xx : 200, 201
     *
     * @return Illuminate\Http\Response response data json
     */
    public function responseSuccess($data = [], $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }

    /**
     * Response Json error.
     *
     * @param string $message    Message error
     * @param string $statusCode Status code
     *
     * @return Illuminate\Http\Response response data json
     */
    public function responseError($message, $statusCode)
    {
        $response = [
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }
}
