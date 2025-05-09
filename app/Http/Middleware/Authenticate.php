<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {

            response()->json([
                'data' => [],
                'status' => 'fail',
                'error' => 'You are not authenticated.',
                'code' => 401
            ],401)->send();

            
            exit;

        //return $request->expectsJson() ? null : route('login');
    }
}
