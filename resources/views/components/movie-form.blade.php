@props(['action', 'method', 'movie'])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    <!-- Title -->
<div class="mb-4">
    <label for="title" class="block text-gray-700 font-semibold mb-1">Title</label>
    <input 
        type="text" 
        name="title" 
        id="title" 
        value="{{ old('title', $movie->title ?? '') }}" 
        required
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<!-- Description -->
<div class="mb-4">
    <label for="description" class="block text-gray-700 font-semibold mb-1">Description</label>
    <textarea 
        name="description" 
        id="description" 
        required
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >{{ old('description', $movie->description ?? '') }}</textarea>
    @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<!-- Release Year -->
<div class="mb-4">
    <label for="release_year" class="block text-gray-700 font-semibold mb-1">Release Year</label>
    <input 
        type="number" 
        name="release_year" 
        id="release_year" 
        value="{{ old('release_year', $movie->release_year ?? '') }}" 
        required
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('release_year')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<!-- Genre -->
<div class="mb-4">
    <label for="genre" class="block text-gray-700 font-semibold mb-1">Genre</label>
    <input 
        type="text" 
        name="genre" 
        id="genre" 
        value="{{ old('genre', $movie->genre ?? '') }}" 
        required
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('genre')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
</div>

<!-- Cover -->
<div class="mb-4">
    <label for="cover" class="block text-gray-700 font-semibold mb-1">Cover Image</label>
    <input 
        type="file" 
        name="cover" 
        id="cover" 
        {{ isset($movie) ? '' : 'required' }}
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('cover')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    @isset($movie->cover)
        <img src="{{ asset('covers/' . $movie->cover) }}" alt="cover" class="w-24 h-32 mt-2 rounded">
    @endisset
</div>


    <!-- Submit -->
    <button type="submit" class="border bg-indigo-600 text-black font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition">
        {{ isset($movie) ? 'Update Movie' : 'Create Movie' }}
    </button>


    
</form>
