<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 items-center">

                    {{-- Movie Title --}}
                    <h3 class="text-lg font-medium text-gray-900">{{ $movie->title }}</h3>

                    {{-- Movie Description --}}
                    <p class="mt-2 text-gray-600">{{ $movie->description }}</p>

                    {{-- Movie Cover Image --}}
                    <div class="mt-4">
                        <img src="{{ asset('covers/' . $movie->cover) }}"
                             alt="{{ $movie->title }}"
                             class="w-48 h-72 object-cover rounded-md">
                    </div>

                    {{-- Release Year --}}
                    <p class="mt-2 text-gray-600">
                        <strong>Release Year:</strong> {{ $movie->release_year }}
                    </p>

                    {{-- Genre --}}
                    <p class="mt-2 text-gray-600">
                        <strong>Genre:</strong> {{ $movie->genre }}
                    </p>

                    {{-- Award (Simple text field, no relationship) --}}
                    @if($movie->award)
                        <p class="mt-2 text-gray-600">
                            <strong>Award:</strong> {{ $movie->award }}
                        </p>
                    @else
                        <p class="mt-2 text-gray-600">
                            <strong>Award:</strong> This movie has won no awards.
                        </p>
                    @endif

                    {{-- Admin-only Edit/Delete UI --}}
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        {{-- Edit Button --}}
                        <a href="{{ route('movies.edit', $movie->id) }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 mt-4 inline-block">
                            Edit
                        </a>

                        {{-- Delete Button --}}
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this movie?');"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
