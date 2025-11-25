<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movie Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                <div class="p-6">

                    {{-- Top Section: Title + Cover --}}
                    <div class="flex gap-6">

                        {{-- Cover Image --}}
                        <div>
                            <img src="/covers/{{ $movie->cover }}"
                                alt="{{ $movie->title }}"
                                class="w-48 h-72 object-cover rounded-md">

                        </div>

                        {{-- Title + Description --}}
                        <div class="flex-1">
                            <h3 class="text-3xl font-bold text-gray-900">{{ $movie->title }}</h3>

                            <p class="mt-3 text-gray-700 leading-relaxed">
                                {{ $movie->description }}
                            </p>

                            {{-- Release Year --}}
                            <p class="mt-4 text-gray-600">
                                <span class="font-semibold">Release Year:</span>
                                {{ $movie->release_year }}
                            </p>

                            {{-- Genre --}}
                            <p class="mt-1 text-gray-600">
                                <span class="font-semibold">Genre:</span>
                                {{ $movie->genre }}
                            </p>

                            {{-- Award --}}
                            <p class="mt-1 text-gray-600">
                                <span class="font-semibold">Award:</span>
                                {{ $movie->award ?? 'This movie has won no awards.' }}
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <hr class="my-6 border-gray-300">

                    {{-- Actors --}}
                    <div>
                        <p class="text-lg font-semibold text-gray-800 mb-2">Actors</p>

                        @if($movie->actors->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($movie->actors as $actor)
                                    <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm shadow-sm">
                                        {{ $actor->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600">No actors listed.</p>
                        @endif
                    </div>

                    {{-- Divider --}}
                    <hr class="my-6 border-gray-300">

                    {{-- Admin Buttons --}}
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <div class="flex gap-3">

                            {{-- Edit --}}
                            <a href="{{ route('movies.edit', $movie->id) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('movies.destroy', $movie->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 shadow">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
