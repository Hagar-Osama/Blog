<?php

namespace App\Http\Traits;


trait ApiResponseTrait {

    public function success($data, $message = null, $code = 200 )
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ],$code);
    }

    public function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => 'Error Was Occured..',
            'message' => $message,
            'data' => $data
        ],$code);
    }
}

