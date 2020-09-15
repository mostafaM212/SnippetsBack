<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\WithSnippetsStepsResource;
use App\Models\Snippet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SnippetsController extends Controller
{
    //**
    /**
     * SnippetsController constructor.
     */
    public function __construct()
    {
        $this->middleware('myAuth')->except(['show','index','search']);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $snippets = Snippet::isPublic()->paginate(10) ;

        return SnippetResource::collection($snippets);
    }

    /**
     * @param Request $request
     * @return SnippetResource
     */
    public function store(Request $request)
    {
        $snippet = $request->user()->snippets()->create([
            'uuid'=>Str::uuid(),
//            'is_public'=> $request->is_public
        ]);
        return new WithSnippetsStepsResource($snippet) ;
    }

    /**
     * @param Snippet $snippet
     * @return SnippetResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Snippet $snippet)
    {
        //authorize our coming user
        $this->authorize('show',$snippet);
        //returning data for valid user
        return new WithSnippetsStepsResource($snippet) ;
    }

    /**
     * @param Snippet $snippet
     * @param Request $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Snippet $snippet,Request $request)
    {
        //authorize
        $this->authorize('update',$snippet) ;
       //update snippets

        $snippet->update($request->only('title','is_public'));
    }

    /**
     * @param Snippet $snippet
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Snippet $snippet)
    {
        //authorize user
        $this->authorize('destroy',$snippet);

        //delete snippet
        $snippet->delete();
        return response()->json(null , 201);
    }

    public function search()
    {


        if (Auth::check()){
            $mysnippets = Snippet::mySnippets()->get();

            $all =  $mysnippets->merge(Snippet::all()->where('user_id','!=',Auth::user()->id)
                                ->where('is_public','=',true));
            return SnippetResource::collection($all) ;
        }
        $all =  Snippet::where('is_public','=',true)->get();
        return SnippetResource::collection($all) ;
    }
}
