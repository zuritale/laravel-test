<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeasonRequest;

class SeasonController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSeasonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeasonRequest $request)
    {
        $season_number = Season::where('show_id', '=', $request->input('show_id'))->count() + 1;

        $season = Season::create($request->post() + ['season_number' => $season_number]);

        return response()->json([
            'message' => 'Season Created Successfully',
            'data' => $season
        ], 201);
    }

    /**
     * Show the specified resource from storage.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        return response()->json(['data' => $season->load(['episodes', 'show'])], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreSeasonRequest  $request
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSeasonRequest $request, Season $season)
    {
        $season_updated = $season->fill($request->post())->save();

        return response()->json(['message' => 'Season Updated Successfully'], 201);
    }
}
