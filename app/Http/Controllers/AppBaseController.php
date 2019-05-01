<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Auth;
/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
    public function authorized()
    {
        return Auth::user()->activated_user;
      
    }
    function arrayAdd($array) {
        $carry = null;
        $count = count($array);
        return array_reduce($array, function ($carried, $value) use ($count) {
             return ($carried===null?0:$carried) + $value;
        },$carry);
    }
}

