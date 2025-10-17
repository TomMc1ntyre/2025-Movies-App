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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
