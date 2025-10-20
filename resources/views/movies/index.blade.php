<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Movies') }}
            </h2>

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Movie List -->
                        <h1 class="text-2xl font-bold mb-4">Movie List</h1>

                        @if ($movies->isEmpty())
                        <p>No movies available.</p>
                        @else
                        <div class="md:grid grid-cols-3 gap-4">
                            @foreach ($movies as $movie)
                            <a href="{{ route('movies.show', $movie->id) }}" class="w-full">
                                <x-movie-card
                                    :title="$movie->title"
                                    :release_year="$movie->release_year"
                                    :genre="$movie->genre"
                                    :cover="$movie->cover" />
                            </a>
                            <!-- Edit Button -->
                            <a href="{{ route('movies.edit', $movie->id) }}" class="bg-blue-500 text-b px-3 py-1 rounded">Edit</a>

                            <!-- Delete Button (implementation later) -->
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>

                                @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>