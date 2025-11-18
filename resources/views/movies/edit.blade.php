<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h2 class="text-3xl font-bold mb-6 text-center">Edit Movie</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <!-- Movie Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="genre">Genre</label>
                <input type="text" name="genre" id="genre" value="{{ old('genre', $movie->genre) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Movie Description -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="description">Description</label>
                <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $movie->description) }}</textarea>
            </div>

            <!-- Release Year -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="release_year">Release Year</label>
                <input type="number" name="release_year" id="release_year" value="{{ old('release_year', $movie->release_year) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="award" class="block text-gray-700 font-bold mb-2">Award (optional)</label>
                <input
                    type="text"
                    name="award"
                    id="award"
                    placeholder="Best Picture, Best Actor etc."
                    value="{{ old('award', $movie->award ?? '') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
            </div>

            <!-- Movie Image -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="cover">Movie Poster</label>
                <input type="file" name="cover" id="cover" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>



            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Movie
                </button>

                <a href="{{ route('movies.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>


        </form>
    </div>
</x-app-layout>
