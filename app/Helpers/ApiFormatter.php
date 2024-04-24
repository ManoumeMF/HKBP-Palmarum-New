<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

namespace app\Helpers;

class ApiFormatter{
    protected static $response = [
	    'code' => null,
	    'message' => null,
	    'data' => null,
    ];

    public static function createApiDataIndex($data = null){
        return response()->json($data);
    }

    public static function createApi ($code = null, $message = null, $data = null)
    {
	    self::$response['code'] = $code;
	    self::$response['message'] = $message;
	    self::$response['data'] = $data;
        
        return response()->json(self::$response, self::$response['code']);
    }
}

