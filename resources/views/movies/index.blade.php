<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Movies') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Movie List -->
                        <h1 class="text-2xl font-bold mb-4">Movie List</h1>
                        @if($movies->isEmpty())
                            <p>No movies available.</p>
                        @else
                            <ul class="list-disc pl-5 space-y-2">
                                @foreach($movies as $movie)
                                    <li>
                                        <a href="{{ route('movies.show', $movie->id) }}" class="text-blue-600 hover:underline">
                                            {{ $movie->title }} ({{ $movie->release_year ?? 'N/A' }})

                                            {{-- {{ $movie->release_year ? $movie->release_year->format('Y') : 'N/A' }} I removed as release_year is an integer field so format was not needed --}}

                                        </a>
                                        <p class="text-sm text-gray-600">Genre: {{ $movie->genre ?? 'Unknown' }}</p>

                                        @if($movie->cover)
                                            <img src="{{ asset('storage/' . $movie->cover) }}" alt="{{ $movie->title }}" class="mt-2 w-48 h-auto">
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
