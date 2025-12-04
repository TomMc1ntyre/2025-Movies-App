<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Author;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    // Display a list of all movies
    public function index(Request $request)
    {
        $query = Movie::query();

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $movies = $query->latest()->get();

        return view('movies.index', compact('movies'));
    }

    // Show the form for creating a movie
    public function create()
    {
        // Only logged in users can create //
        if (!Auth::check()) {
            return redirect()->route('movies.index')
                ->with('error', 'You must be logged in to create a movie.');
        }

        // Get all actors and authors //
        $actors  = Actor::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('movies.create', compact('actors', 'authors'));
    }


    // Store a new movie in the database
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        // Validate input
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'release_year' => 'required|integer',
            'cover'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre'        => 'required|string|max:100',
            'award'        => 'nullable|string|max:255',

            // one optional author
            'author_id'    => 'nullable|exists:authors,id',

            // many-to-many actors
            'actors'       => 'nullable|array',
            'actors.*'     => 'nullable|exists:actors,id',
        ]);

        // Handle cover upload
        $coverName = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
        }

        // Create movie
        $movie = Movie::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'release_year' => $request->release_year,
            'cover'        => $coverName,
            'genre'        => $request->genre,
            'award'        => $request->award,
            'author_id'    => $request->author_id, // store FK
        ]);

        // Attach actors if any
        if ($request->filled('actors')) {
            $movie->actors()->attach($request->actors);
        }

        return redirect()->route('movies.index')->with('success', 'Movie created.');
    }

    // Display a single movie
    public function show(Movie $movie)
    {
        // if you want you can eager load, but not required:
        // $movie->load('actors', 'author');

        return view('movies.show', compact('movie'));
    }

    // Show edit form (admin only)
    public function edit(Movie $movie)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        $actors  = Actor::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();

        return view('movies.edit', compact('movie', 'actors', 'authors'));
    }

    // Update movie record
    public function update(Request $request, Movie $movie)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        // Validate form
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'release_year' => 'required|integer',
            'genre'        => 'required|string|max:100',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'award'        => 'nullable|string|max:255',

            'author_id'    => 'nullable|exists:authors,id',

            'actors'       => 'nullable|array',
            'actors.*'     => 'exists:actors,id',
        ]);

        $data = $request->only('title', 'description', 'release_year', 'genre', 'award', 'author_id');

        // Update cover if needed
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
            $data['cover'] = $coverName;
        }

        $movie->update($data);

        // Sync actors (replace old ones)
        $movie->actors()->sync($request->input('actors', []));

        return redirect()->route('movies.index')->with('success', 'Movie updated.');
    }

    // Delete movie (admin only)
    public function destroy(Movie $movie)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        // Delete old cover if it exists
        if ($movie->cover && file_exists(public_path('covers/' . $movie->cover))) {
            unlink(public_path('covers/' . $movie->cover));
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted.');
    }
}
