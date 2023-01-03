<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDirectorRequest;
use App\Http\Requests\UpdateDirectorRequest;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors = Director::all();

        return response()->json(['data' => $directors], 200);
    } // Chequiao

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDirectorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDirectorRequest $request)
    {
        $director = Director::create($request->post());

        return response()->json([
            'message' => 'Director Created Successfully',
            'data' => $director
        ], 201);
    } // Chequiao

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDirectorRequest  $request
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDirectorRequest $request, Director $director)
    {
        $director_updated = $director->fill($request->post())->save();

        return response()->json(['message' => 'Director Updated Successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Director  $director
     * @return \Illuminate\Http\Response
     */
    public function destroy(Director $director)
    {
        $director->delete();

        return response()->json(['message' => 'Director Deleted Successfully'], 201);
    }
}
