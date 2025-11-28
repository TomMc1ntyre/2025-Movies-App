<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Movies
            </h2>

            {{-- Link to Actors --}}
            <a href="{{ route('actors.index') }}"
               class="text-indigo-600 font-semibold hover:underline">
                View Actors
            </a>
        </div>

        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    </x-slot>

    {{-- Search Bar --}}
    <form action="{{ route('movies.index') }}" method="GET" class="mb-6 mt-4">
        <div class="flex gap-2">
            <input type="text"
                   name="search"
                   placeholder="Search by title..."
                   value="{{ request('search') }}"
                   class="border rounded px-3 py-1 w-64">

            <button type="submit"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                Search
            </button>
        </div>
    </form>

    {{-- Movies Grid --}}
    @if ($movies->count() > 0)
        <div class="grid grid-cols-3 gap-6">
            @foreach ($movies as $movie)
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">

                    <div class="flex-grow">
                        <x-movie-card
                            :title="$movie->title"
                            :release_year="$movie->release_year"
                            :genre="$movie->genre"
                            :cover="$movie->cover"
                        />
                    </div>

                    <span class="inline-block bg-green-200 text-green-800 text-xs px-2 py-1 rounded m-4">
                        {{ $movie->genre }}
                    </span>

                    <div class="flex justify-between items-center p-4 border-t border-gray-200 bg-gray-50">
                        <a href="{{ route('movies.show', $movie->id) }}"
                           class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">
                            View
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 mt-6">No movies found.</p>
    @endif

</x-app-layout>
