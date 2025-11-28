@props([
    'action',
    'method' => 'POST',
    'movie' => null,
    'actors' => [],
])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif

    {{-- Title --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Title</label>
        <input type="text"
               name="title"
               value="{{ old('title', $movie->title ?? '') }}"
               required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- Description --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Description</label>
        <textarea name="description"
                  required
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('description', $movie->description ?? '') }}</textarea>
    </div>

    {{-- Release Year --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Release Year</label>
        <input type="number"
               name="release_year"
               value="{{ old('release_year', $movie->release_year ?? '') }}"
               required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- Genre --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Genre</label>
        <input type="text"
               name="genre"
               value="{{ old('genre', $movie->genre ?? '') }}"
               required
               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- Award --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Award (optional)</label>
        <input type="text"
               name="award"
               value="{{ old('award', $movie->award ?? '') }}"
               placeholder="Best Picture, Best Actor, etc."
               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- Actors (pill selector) --}}
    @php
        // what should be selected? (handles validation errors + edit form)
        $selectedActorIds = collect(
            old('actors', isset($movie) ? $movie->actors->pluck('id')->toArray() : [])
        );
    @endphp

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Actors</label>

        {{-- Pills --}}
        <div id="actor-pill-container" class="flex flex-wrap gap-2">
            @foreach ($actors as $actor)
                @php $isSelected = $selectedActorIds->contains($actor->id); @endphp

                <button
                    type="button"
                    class="actor-pill px-3 py-1 rounded-full border text-sm transition
                           {{ $isSelected
                                ? 'bg-indigo-600 text-white border-indigo-600'
                                : 'bg-gray-100 text-gray-800 border-gray-300 hover:bg-gray-200' }}"
                    data-id="{{ $actor->id }}"
                >
                    {{ $actor->name }}
                </button>
            @endforeach
        </div>

        <p class="text-gray-500 text-sm mt-1">Click an actor to select / deselect. Multiple actors allowed.</p>

        {{-- Hidden real field Laravel actually reads --}}
        <select name="actors[]" id="actors-input" multiple class="hidden">
            @foreach ($actors as $actor)
                <option value="{{ $actor->id }}"
                    {{ $selectedActorIds->contains($actor->id) ? 'selected' : '' }}>
                </option>
            @endforeach
        </select>
    </div>

    {{-- Cover --}}
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">Cover Image</label>
        <input type="file"
               name="cover"
               {{ isset($movie) ? '' : 'required' }}
               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">

        @isset($movie->cover)
            <img src="{{ asset('covers/' . $movie->cover) }}"
                 class="w-24 h-32 mt-2 rounded object-cover">
        @endisset
    </div>

    {{-- Submit --}}
    <button type="submit"
            class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition">
        {{ isset($movie) ? 'Update Movie' : 'Create Movie' }}
    </button>
</form>

{{-- Tiny JS for the pill behaviour --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('actor-pill-container');
        const select    = document.getElementById('actors-input');
        if (!container || !select) return;

        function setSelected(id, on) {
            const opt = select.querySelector('option[value="' + id + '"]');
            if (opt) opt.selected = !!on;
        }

        container.querySelectorAll('.actor-pill').forEach(pill => {
            pill.addEventListener('click', () => {
                const id       = pill.dataset.id;
                const isActive = pill.classList.contains('bg-indigo-600');

                if (isActive) {
                    pill.classList.remove('bg-indigo-600','text-white','border-indigo-600');
                    pill.classList.add('bg-gray-100','text-gray-800','border-gray-300');
                    setSelected(id, false);
                } else {
                    pill.classList.add('bg-indigo-600','text-white','border-indigo-600');
                    pill.classList.remove('bg-gray-100','text-gray-800','border-gray-300');
                    setSelected(id, true);
                }
            });
        });
    });
</script>
