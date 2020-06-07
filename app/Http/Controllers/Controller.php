<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // custom validation error status code to 400 (instead of 422)
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return new JsonResponse($errors, 400);
    }
}
