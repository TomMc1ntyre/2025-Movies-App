<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        <h2 class="text-3xl font-bold mb-8 text-center">Edit Movie</h2>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('movies.update', $movie->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white shadow-lg rounded-xl px-10 pt-8 pb-12">

            @csrf
            @method('PUT')

            {{-- GRID LAYOUT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Title --}}
                <div>
                    <label class="block text-gray-800 font-semibold mb-2">Title</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $movie->title) }}"
                           class="w-full border rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Genre --}}
                <div>
                    <label class="block text-gray-800 font-semibold mb-2">Genre</label>
                    <input type="text"
                           name="genre"
                           value="{{ old('genre', $movie->genre) }}"
                           class="w-full border rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Release Year --}}
                <div>
                    <label class="block text-gray-800 font-semibold mb-2">Release Year</label>
                    <input type="number"
                           name="release_year"
                           value="{{ old('release_year', $movie->release_year) }}"
                           class="w-full border rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Award --}}
                <div>
                    <label class="block text-gray-800 font-semibold mb-2">Award (optional)</label>
                    <input type="text"
                           name="award"
                           value="{{ old('award', $movie->award ?? '') }}"
                           placeholder="Best Picture, Best Actor..."
                           class="w-full border rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            {{-- AUTHOR --}}
            <div class="mt-10">
                <label class="block text-gray-800 font-semibold mb-2">Author</label>

                <select name="author_id" class="w-full border rounded-lg p-3 focus:ring-indigo-500">
                    <option value="">— No Author Assigned —</option>

                    @foreach($authors as $author)
                        <option value="{{ $author->id }}"
                            @if($movie->author_id == $author->id) selected @endif>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- DESCRIPTION FULL WIDTH --}}
            <div class="mt-8">
                <label class="block text-gray-800 font-semibold mb-2">Description</label>
                <textarea name="description"
                          rows="4"
                          class="w-full border rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $movie->description) }}</textarea>
            </div>


            {{-- ACTORS --}}
            <div class="mt-10">
                <label class="block text-gray-800 font-semibold mb-3">Actors</label>

                <div class="flex flex-wrap gap-2">

                    @foreach($actors as $actor)
                        <label class="cursor-pointer">
                            <input type="checkbox"
                                   name="actors[]"
                                   value="{{ $actor->id }}"
                                   class="hidden peer"
                                   @if($movie->actors->contains($actor->id)) checked @endif>

                            <span class="px-4 py-2 rounded-full border border-gray-300 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 transition">
                                {{ $actor->name }}
                            </span>
                        </label>
                    @endforeach

                </div>

                <p class="text-gray-500 text-sm mt-2">Click to toggle actors.</p>
            </div>


            {{-- POSTER --}}
            <div class="mt-10">
                <label class="block text-gray-800 font-semibold mb-2">Movie Poster</label>
                <input type="file"
                       name="cover"
                       class="w-full border rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500">

                {{-- Existing Preview --}}
                @if($movie->cover)
                    <img src="{{ asset('covers/' . $movie->cover) }}"
                         class="w-32 h-44 mt-4 rounded shadow border">
                @endif
            </div>


            {{-- BUTTONS --}}
            <div class="mt-12 flex justify-between">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Update Movie
                </button>

                <a href="{{ route('movies.index') }}"
                   class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</x-app-layout>
