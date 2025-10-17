<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all(); //fetch all the moveis from the database
        return view('movies.index', compact('movies')); //returns the view with the movies data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create'); //returns the view to create a new movie
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'cover' => 'required|cover|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|string|max:100',
        ]);
        // handle file upload
        if ($request->hasFile('cover')) {
            $coverName = time().'.'.$request->image->extension();
            $request->cover->move(public_path('covers'), $coverName);
        }
        // create new movie record in the database
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_year' => $request->release_year,
            'cover' => $coverName,
            'genre' => $request->genre,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // redirects to movies index with success message
        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie')); //returns the view with the specific movie data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

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
}
