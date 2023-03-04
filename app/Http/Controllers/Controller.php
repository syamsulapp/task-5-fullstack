<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function customError($errors)
    {
        $data = collect($errors);
        $result = collect([]);

        foreach ($data as $key => $value) {
            $errors = array(
                'fields' => $key,
                'message' => $value[0]
            );

            $result->push($errors);
        }

        return response()->json(['errors' => $result], 422);
    }


    public static function resBuilder($data, int $statusCode = 200, String $message = 'Successfully Data')
    {
        switch ($statusCode) {
            case 200:
                $res = array(
                    'message' => $message,
                    'data' => $data
                );
                break;
            default:
                if ($statusCode === 422) $res = array('message' => $message, 'data' => $data);
                if ($statusCode === 426) $res = array('message' => $message);
                if ($statusCode === 401) $res = array('message' => $message);
                break;
        }

        return response()->json($res, $statusCode);
    }
}
