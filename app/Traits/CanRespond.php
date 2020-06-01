<?php

namespace App\Traits;

trait CanRespond{

    public function respondWithError($error){
        return response()->json(['status' => 'error', 'response' => null, 'errors' => $error], 400);
    }

    public function respondWithSuccess($response){
        return response()->json(['status' => 'success', 'response' => $response], 200);
    }

}