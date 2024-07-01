<?php

namespace App\Trait;


trait ApiReponse
{
    public function Ok($message, $data=[])
    {
        return $this->success($message, $data, 200);
    }

    protected function success($message, $data , $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'statusCode' => $statusCode
        ], $statusCode);
    }

    protected function error(String $message, Int $statusCode)
    {
        return response()->json([
            'message' => $message,
            'statusCode' => $statusCode
        ], $statusCode);
    }
}


?>