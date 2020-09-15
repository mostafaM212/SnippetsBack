<?php

namespace App\Policies;

use App\Models\Snippet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SnippetsPolicy
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
     * @param User|null $user
     * @param Snippet $snippet
     * @return bool|mixed
     */
    public function show(?User $user , Snippet $snippet)
    {
        if ($snippet->is_public){
            return $snippet->is_public ;
        }

        return  $snippet->user->id === optional($user)->id ;
    }

    /**
     * @param User $user
     * @param Snippet $snippet
     * @return bool
     */
    public function update( User $user,Snippet $snippet)
    {
        return $snippet->user->id === $user->id ;
    }

    /**
     * @param User $user
     * @param Snippet $snippet
     * @return bool
     */
    public function store( User $user,Snippet $snippet)
    {
        return $snippet->user->id === $user->id ;
    }

    /**
     * @param User $user
     * @param Snippet $snippet
     * @return bool
     */
    public function destroy(User $user , Snippet $snippet)
    {
        return $user->id === $snippet->user->id ;
    }
}
