<?php

namespace App\Policies;

use App\Models\Step;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
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

    public function update(User $user , Step $step)
    {
        return $step->snippet->user->id == $user->id ;
    }

    public function delete(User $user , Step $step)
    {
        return $step->snippet->user->id === $user->id ;
    }
}
