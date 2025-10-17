@props(['action', 'method'])

<!-- Form starts, with dynamic action and method (e.g., POST, PUT, PATCH) -->
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- CSRF token for security -->

    <!-- If the method is PUT or PATCH, spoof the method using @method -->
    @if ($method === 'PUT' || $method === 'PATCH')
        @method($method) <!-- Adds a hidden _method input for PUT/PATCH requests -->
    @endif

    <!-- Title Field -->
    <div class="mb-4">
        <label for="title" class="block text-sm text-gray-700">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $movie->title ?? '') }}" required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Cover Upload Field -->
    <div class="mb-4">
        <label for="cover" class="block text-sm font-medium text-gray-700">Movie Cover Image</label>
        <input type="file" name="cover" id="cover" {{ isset($movie) ? '' : 'required' }}
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
        @error('cover')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Preview Existing Cover (Edit Mode) -->
    @isset($movie->cover)
        <div class="mb-4">
            <img src="{{ asset('covers/' . $movie->cover) }}" alt="Movie cover" class="w-24 h-32 object-cover">
        </div>
    @endisset

    <!-- Submit Button -->
    <div>
        <x-primary-button>
            {{ isset($movie) ? 'Update Movie' : 'Add Movie' }}
        </x-primary-button>
    </div>

    @endif



</form>
