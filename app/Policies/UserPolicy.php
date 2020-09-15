<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $authuser
     * @param User $user
     * @return bool
     */
    public function update(User $authuser ,User $user)
    {
        return $authuser->id === $user->id ;
    }
}
