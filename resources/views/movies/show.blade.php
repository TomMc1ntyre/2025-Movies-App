<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('All Movies')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 items-center">
                    <h3 class="text-lg font-medium text-gray-900">{{ $movie->title }}</h3>
                    <p class="mt-2 text-gray-600">{{ $movie->description }}</p>
                    <div class="mt-4">
                        <img src="{{ asset('covers/' . $movie->cover) }}" alt="{{ $movie->title }}" class="w-48 h-72 object-cover rounded-md">
                    </div>
                    <p class="mt-2 text-gray-600"><strong>Release Year:</strong> {{ $movie->release_year }}</p>
                    <p class="mt-2 text-gray-600"><strong>genre:</strong> {{ $movie->genre }}</p>
                    {{-- Edit button --}}
                    <a href="{{ route('movies.edit', $movie->id) }}"
                        class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>


                    {{-- Delete button --}}
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-500 text-white px-3 py-0 rounded hover:bg-red-600 ">
                        Delete
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
