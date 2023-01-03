<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShowRequest;
use App\Http\Requests\UpdateShowRequest;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Show::all()->with(['genre', 'seasons']);

        return response()->json(['data' => $shows], 200);
    } // Chequiao

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShowRequest $request)
    {
        $show = Show::create($request->post());

        return response()->json([
            'message' => 'Show Created Successfully',
            'data' => $show
        ], 201);
    } // Chequiao

    /**
     * Show the specified resource from storage.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show)
    {
        return response()->json(['data' => $show->load(['genre', 'seasons'])], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShowRequest  $request
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShowRequest $request, Show $show)
    {
        $show_updated = $show->fill($request->post())->save();

        return response()->json(['message' => 'Show Updated Successfully'], 201);
    } // Chequiao

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show)
    {
        $show->delete();

        return response()->json(['message' => 'Show Deleted Successfully'], 201);
    } // Chequiao
}
