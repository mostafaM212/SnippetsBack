<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware('myAuth') ;// TODO: Change the autogenerated stub
    }

    public function __invoke(Request $request)
    {
        return new UserResource($request->user());
    }
}
