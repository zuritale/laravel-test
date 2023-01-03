<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActorRequest;
use App\Http\Requests\UpdateActorRequest;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actors = Actor::all();

        return response()->json(['data' => $actors], 200);
    } // Chequiao

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActorRequest $request)
    {
        $actor = Actor::create($request->post());

        return response()->json([
            'message' => 'Actor Created Successfully',
            'data' => $actor
        ], 201);
    } // Chequiao

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActorRequest  $request
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActorRequest $request, Actor $actor)
    {
        $actor_updated = $actor->fill($request->post())->save();

        return response()->json(['message' => 'Actor Updated Successfully'], 201);
    } // Chequiao

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();

        return response()->json(['message' => 'Actor Deleted Successfully'], 201);
    } // Chequiao
}
