<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    // Display a list of all movies //
    public function index(Request $request)
    {
        $query = Movie::query();

        // Search by title //
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $movies = $query->latest()->get();

        return view('movies.index', compact('movies'));
    }

    // Show the form for creating a movie //
    public function create()
    {
        // Only logged in users can create //
        if (!Auth::check()) {
            return redirect()->route('movies.index')->with('error', 'You must be logged in.');
        }

        return view('movies.create');
    }

    // Store a new movie in the database //
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        // Validate input //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|string|max:100',
            'award' => 'nullable|string|max:255'
        ]);

        // Handle cover upload //
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
        } else {
            $coverName = null;
        }

        // Create movie //
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_year' => $request->release_year,
            'cover' => $coverName,
            'genre' => $request->genre,
            'award' => $request->award,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie created.');
    }

    // Display a single movie //
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    // Show edit form (admin only) //
    public function edit(Movie $movie)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        return view('movies.edit', compact('movie'));
    }

    // Update movie record //
    public function update(Request $request, Movie $movie)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        // Validate form //
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'genre' => 'required|string|max:100',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'award' => 'nullable|string|max:255'
        ]);

        $data = $request->only('title', 'description', 'release_year', 'genre', 'award');

        // Update cover if needed //
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
            $data['cover'] = $coverName;
        }

        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Movie updated.');
    }

    // Delete movie (admin only) //
    public function destroy(Movie $movie)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized.');
        }

        // Delete old cover if it exists //
        if ($movie->cover && Storage::disk('public')->exists($movie->cover)) {
            Storage::disk('public')->delete($movie->cover);
        }

        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted.');
    }
}
