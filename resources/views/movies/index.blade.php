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
        <form action="{{ route('movies.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Search by title..." value="{{ request('search') }}"
                class="border rounded px-3 py-1">
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Search</button>
        </form>





        <div class="grid grid-cols-3 gap-6">
            @foreach ($movies as $movie)
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">

                    <div class="flex-grow">
                        <x-movie-card :title="$movie->title" :release_year="$movie->release_year" :genre="$movie->genre" :cover="$movie->cover" />
                    </div>

                    <!-- Move genre span inside the card container -->
                    <span class="inline-block bg-green-200 text-green-800 text-xs px-2 py-1 rounded m-4">
                        {{ $movie->genre }}
                    </span>

                    <div class="flex justify-between items-center p-4 border-t border-gray-200 bg-gray-50">
                        <a href="{{ route('movies.show', $movie->id) }}"
                            class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">View</a>
                    </div>
                </div>
            @endforeach
        </div>

    </x-app-layout>
</div>
