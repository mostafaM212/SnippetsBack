<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SnippetResource;
use App\Models\Snippet;
use App\Models\User;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    //

    /**
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(User $user)
    {
        $snippets = $user->snippets()->isPublic()->paginate(10) ;

        return SnippetResource::collection($snippets);
    }
}
