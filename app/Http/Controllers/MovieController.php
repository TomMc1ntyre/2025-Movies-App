<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $movies = Movie::all(); //fetch all the moveis from the database


        $query = Movie::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
            }
        $movies = $query->latest()->get();

        return view('movies.index', compact('movies'));

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
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|string|max:100',
        ]);

        // handle file upload
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
        } else {
            $coverName = null; // or set a default image name
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
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'genre' => 'required|string|max:100',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'release_year', 'description', 'genre');

        // if ($request->hasFile('cover')) {
        //     // Optional: Delete old cover to keep storage clean
        //     if ($movie->cover && Storage::disk('public')->exists($movie->cover)) {
        //         Storage::disk('public')->delete($movie->cover);
        //     }

        //     $path = $request->file('cover')->store('covers', 'public');
        //     $data['cover'] = basename($path);
        // }
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
        } else {
            $coverName = null; // or set a default image name
        }
        $data['cover'] = $coverName;


        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        // Optional: Delete cover image from storage
        if ($movie->cover && Storage::disk('public')->exists($movie->cover)) {
            Storage::disk('public')->delete($movie->cover);
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }

}
