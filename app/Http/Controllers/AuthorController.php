<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /** Display a listing of all authors */
    public function index()
    {
        $authors = Author::orderBy('name')->get();
        return view('authors.index', compact('authors'));
    }

    /** Show the form for creating a new author */
    public function create()
    {
        return view('authors.create');
    }

    /** Store a newly created author */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create([
            'name' => $request->name,
        ]);

        return redirect()->route('authors.index')->with('success', 'Author added successfully');
    }

    /** Display a single author's information */
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    /** Show the form for editing an author */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /** Update an author */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->update([
            'name' => $request->name,
        ]);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully');
    }

    /** Delete an author */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted');
    }
}
