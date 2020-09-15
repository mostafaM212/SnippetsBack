<?php

namespace App\Http\Controllers\Snippets;

use App\Http\Controllers\Controller;
use App\Http\Requests\StepStoreRequest;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\StepsResource;
use App\Models\Snippet;
use App\Models\Step;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('myAuth');
    }

    /**
     * @param Snippet $snippet
     * @param Step $step
     * @param Request $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Snippet $snippet , Step $step ,Request $request)
    {
        //authorise coming info
        $this->authorize('update',$step);
        //update
        $step->update($request->only(['title','body']));
    }

    /**
     * @param Snippet $snippet
     * @param StepStoreRequest $request
     * @return StepsResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Snippet $snippet , StepStoreRequest  $request)
    {
        //authorize coming users
        $this->authorize('store',$snippet) ;
        //storing coming data
        $step = $snippet->steps()->create($request->only(['order']));
        //return the new step
        return new StepsResource($step) ;
    }

    /**
     * @param Snippet $snippet
     * @param Step $step
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Snippet $snippet , Step $step)
    {
        //authorise for coming user to delete step
        $this->authorize('delete',$step);
        /*
         * check count of steps
         */
        if ($snippet->steps()->count()=== 1){
            return response()->json(['cannot delete the last step'],400);
        }
        //reduce order of another steps by one
        $snippet->steps()->each(function ($oldStep)use($step){
            if ($oldStep->order > $step->order){
                $oldStep->order -=1 ;
                $oldStep->save();
            }
        });
        //deleting step
        $step->delete();
        return response()->json(null , 201);
    }

}
