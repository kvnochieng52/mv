<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieRate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        return Inertia::render('Movie/Movie')->with([
            'movies' => Movie::paginate(4)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {;
        return Inertia::render('Movie/MovieDetails')->with([
            'movie' => $movie,
            'averageRate' => MovieRate::where('movie_id', $movie->id)->avg('rate')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }


    public function rate(Request $request)
    {

        $check = MovieRate::where('movie_id', $request->movie_id)->where('user_id', auth()->user()->id)->get();



        if (count($check) == 0) {
            MovieRate::create([
                'movie_id' => $request->movie_id,
                'rate' => $request->rating,
                'user_id' => auth()->user()->id
            ]);
            return back()->with('success', 'Movie Rated');
        } else {
            return back()->with('error', 'You have already rated this movie');
        }
    }
}
