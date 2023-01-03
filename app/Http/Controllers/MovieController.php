<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movies = Movie::with(['actors', 'director', 'genre']);

        if ($request->has('filter'))
        {
            $movies = $movies->whereHas('director', function ($query) use($request) {
                $query->where('name', 'Like', '%' . $request->query('filter') . '%');
            })->orWhereHas('genre', function ($query) use($request) {
                $query->where('name', 'Like', '%' . $request->query('filter') . '%');
            })->orWhere('name', 'Like', '%' . $request->query('filter') . '%');
        }

        if ($request->has('sort_by'))
        {
            $order = 'asc';
            if ($request->has('sort_desc')) $order = 'desc';

            if ($request->query('sort_by') == 'name')
            {
                $movies = $movies->orderBy('name', $order);
            }

            if ($request->query('sort_by') == 'release_date')
            {
                $movies = $movies->orderBy('release_date', $order);
            }
        }

        return response()->json(['data' => $movies->get()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::create($request->post());

        $movie->actors()->sync($request->input('actors', []));

        return response()->json([
            'message' => 'Movie Created Successfully',
            'data' => $movie
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->fill($request->post())->save();

        $movie->actors()->sync($request->input('actors', []));

        return response()->json(['message' => 'Movie Updated Successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(['message' => 'Movie Deleted Successfully'], 201);
    }
}
