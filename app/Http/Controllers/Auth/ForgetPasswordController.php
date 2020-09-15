<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetRequest;
use App\Mail\newUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Psy\Util\Str;

class ForgetPasswordController extends Controller
{
    //

    public function __invoke(User $user ,Request $request)
    {
        $newPassword = \Illuminate\Support\Str::random(6) ;
        $user->password = $newPassword ;
        $user->save();
        Mail::to([$user->email])->send(new newUserMail($user ,$newPassword));

        return response()->json(null,200);
    }
}
