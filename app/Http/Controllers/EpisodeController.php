<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEpisodeRequest;
use App\Http\Requests\UpdateEpisodeRequest;

class EpisodeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEpisodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEpisodeRequest $request)
    {
        $episode_number = Episode::where('season_id', '=', $request->input('season_id'))->count() + 1;

        $episode = Episode::create($request->post() + ['episode_number' => $episode_number]);

        $episode->actors()->sync($request->input('actors', []));

        return response()->json([
            'message' => 'Episode Created Successfully',
            'data' => $episode
        ], 201);
    } // Chequiao

    /**
     * Show the specified resource from storage.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        return response()->json(['data' => $episode->load(['actors', 'director', 'season'])], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEpisodeRequest  $request
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEpisodeRequest $request, Episode $episode)
    {
        $episode_updated = $episode->fill($request->post())->save();

        $episode_updated->actors()->sync($request->input('actors', []));

        return response()->json(['message' => 'Episode Updated Successfully'], 201);
    } // chequiao
}
