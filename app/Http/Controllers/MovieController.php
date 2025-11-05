<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // ✅ Needed for Auth::user()

class MovieController extends Controller
{
    /**
     * Display a listing of all movies.
     */
    public function index(Request $request)
    {
        // Build query for movies
        $query = Movie::query();

        // Allow users to search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Get all movies ordered by newest first
        $movies = $query->latest()->get();

        // Return the index view
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new movie.
     * Both admin and user can access this.
     */
    public function create()
    {
        // Any logged-in user (admin or ordinary user) can create a movie
        if (!Auth::check()) {
            // Redirect guests who are not logged in
            return redirect()->route('movies.index')->with('error', 'You must be logged in to create a movie.');
        }

        // Return the create view
        return view('movies.create');
    }

    /**
     * Store a newly created movie in the database.
     * Both admin and user can do this.
     */
    public function store(Request $request)
    {
        // Ensure only logged-in users can store
        if (!Auth::check()) {
            return redirect()->route('movies.index')->with('error', 'Unauthorized access.');
        }

        // Validate input fields
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|string|max:100',
        ]);

        // Handle image upload
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
        } else {
            $coverName = null;
        }

        // Save movie to database
        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_year' => $request->release_year,
            'cover' => $coverName,
            'genre' => $request->genre,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with success
        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    /**
     * Show a specific movie.
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing a movie.
     * Only admins can do this.
     */
    public function edit(Movie $movie)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized access.');
        }

        return view('movies.edit', compact('movie'));
    }

    /**
     * Update a movie record.
     * Only admins can do this.
     */
    public function update(Request $request, Movie $movie)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized access.');
        }

        // Validate form input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'genre' => 'required|string|max:100',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'release_year', 'description', 'genre');

        // If a new image is uploaded, handle it
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('covers'), $coverName);
            $data['cover'] = $coverName;
        }

        // Update the movie in the database
        $movie->update($data);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    /**
     * Delete a movie.
     * Only admins can do this.
     */
    public function destroy(Movie $movie)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('movies.index')->with('error', 'Unauthorized access.');
        }

        // Delete the cover image if it exists
        if ($movie->cover && Storage::disk('public')->exists($movie->cover)) {
            Storage::disk('public')->delete($movie->cover);
        }

        // Delete the movie from the database
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully!');
    }
}
