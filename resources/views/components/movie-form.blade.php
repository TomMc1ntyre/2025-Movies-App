@props(['action', 'method', 'movie' => null, 'actors' => []])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    {{-- Title --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Title</label>
        <input
            type="text"
            name="title"
            value="{{ old('title', $movie?->title) }}"
            required
            class="w-full border border-gray-300 rounded-lg px-3 py-2"
        >
    </div>

    {{-- Description --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Description</label>
        <textarea
            name="description"
            required
            class="w-full border border-gray-300 rounded-lg px-3 py-2"
        >{{ old('description', $movie?->description) }}</textarea>
    </div>

    {{-- Release Year --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Release Year</label>
        <input
            type="number"
            name="release_year"
            value="{{ old('release_year', $movie?->release_year) }}"
            required
            class="w-full border border-gray-300 rounded-lg px-3 py-2"
        >
    </div>

    {{-- Genre --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Genre</label>
        <input
            type="text"
            name="genre"
            value="{{ old('genre', $movie?->genre) }}"
            required
            class="w-full border border-gray-300 rounded-lg px-3 py-2"
        >
    </div>

    {{-- Award --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Award (optional)</label>
        <input
            type="text"
            name="award"
            value="{{ old('award', $movie?->award) }}"
            class="w-full border border-gray-300 rounded-lg px-3 py-2"
        >
    </div>

    {{-- Actors --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Actors</label>

        <select name="actors[]" multiple class="w-full border border-gray-300 rounded-lg px-3 py-2">
            @foreach ($actors as $actor)
                <option
                    value="{{ $actor->id }}"
                    @if($movie && $movie->actors->contains($actor->id)) selected @endif
                >
                    {{ $actor->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Cover --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Cover Image</label>

        <input
            type="file"
            name="cover"
            {{ $movie ? '' : 'required' }}
            class="w-full border border-gray-300 rounded-lg px-3 py-2"
        >

        @if($movie && $movie->cover)
            <img src="{{ asset('covers/' . $movie->cover) }}" class="w-24 h-32 mt-2 rounded">
        @endif
    </div>

    <button
        type="submit"
        class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition"
    >
        {{ $movie ? 'Update Movie' : 'Create Movie' }}
    </button>

</form>
