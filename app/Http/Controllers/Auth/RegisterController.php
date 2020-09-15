<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    /**
     * @param RegisterRequest $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->only(['name','username','email','password']));

        if (! $token = Auth::attempt($request->only(['email','password']))){
            return response()->json(null,401);
        }

        return (new UserResource($user))->additional(['meta'=>[
            'token'=>$token
        ]]);
    }
}
