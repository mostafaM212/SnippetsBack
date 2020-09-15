<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('myAuth')->only(['update']) ;
    }
    /**
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return  new UserResource($user);
    }

    /**
     * @param User $user
     * @param UserUpdateRequest $request
     * @return UserResource
     */
    public function update(User $user , UserUpdateRequest  $request)
    {
        //authorize coming request
        $this->authorize('update',$user);

        $data = $request->only(['name','email','username']);
        if ($request->has('password')){
            $request->password = trim($request->password) ;
            $data = array_merge($data, ['password ' => $request->only(['password'])]) ;
        }
        $user->update($data);

        return new UserResource($user);
    }
}
