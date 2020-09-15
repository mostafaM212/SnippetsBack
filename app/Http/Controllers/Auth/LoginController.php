<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function __invoke(LoginRequest $request)
    {
        if (!$token = Auth::attempt($request->only(['email','password']))){

            return response()->json(['error'=>['failed'=>'make sure that you enter data correctly']],401);
        }

        return (new UserResource(Auth::user()))->additional([
            'meta'=>[
                'token'=>$token
            ]
        ]);
    }
}
