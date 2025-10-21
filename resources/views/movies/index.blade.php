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

        <div class="grid grid-cols-3 gap-6">
            @foreach ($movies as $movie)
            <!-- Container for one movie -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">

                <!-- Movie Card (not full-width link wrapping everything) -->
                <div class="flex-grow">
                    <x-movie-card
                        :title="$movie->title"
                        :release_year="$movie->release_year"
                        :genre="$movie->genre"
                        :cover="$movie->cover" />
                </div>

                <!-- Buttons inside the same container -->
                <div class="flex justify-between items-center p-4 border-t border-gray-200 bg-gray-50">
                    <a href="{{ route('movies.show', $movie->id) }}"
                        class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">View</a>

                </div>
            </div>
            @endforeach
        </div>

    </x-app-layout>
</div>
