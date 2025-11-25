<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActorController extends Controller
{
    // Show list of all actors //
    public function index()
    {
        $actors = Actor::orderBy('name')->get();

        return view('actors.index', compact('actors'));
    }

    // Show form to create a new actor (admin only) //
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('actors.index')->with('error', 'Unauthorized.');
        }

        return view('actors.create');
    }

    // Store a new actor in the database (admin only) //
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('actors.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Actor::create([
            'name' => $request->name,
        ]);

        return redirect()->route('actors.index')->with('success', 'Actor created.');
    }

    // Show form to edit an actor (admin only) //
    public function edit(Actor $actor)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('actors.index')->with('error', 'Unauthorized.');
        }

        return view('actors.edit', compact('actor'));
    }

    // Update an actor (admin only) //
    public function update(Request $request, Actor $actor)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('actors.index')->with('error', 'Unauthorized.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $actor->update([
            'name' => $request->name,
        ]);

        return redirect()->route('actors.index')->with('success', 'Actor updated.');
    }

    // Delete an actor (admin only) //
    public function destroy(Actor $actor)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('actors.index')->with('error', 'Unauthorized.');
        }

        $actor->delete();

        return redirect()->route('actors.index')->with('success', 'Actor deleted.');
    }
}
