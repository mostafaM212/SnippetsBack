<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\StepsResource;
use App\Models\Snippet;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
    //
    /**
     * SnippetsController constructor.
     */
    public function __construct()
    {
        $this->middleware('myAuth') ;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $snippets = Snippet::mySnippets()->orderBy('created_at','desc')->get();

        return SnippetResource::collection($snippets) ;
    }
}
