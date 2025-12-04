<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">{{ $author->name }}</h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">

        <p class="text-lg font-semibold text-gray-700">Author Name:</p>
        <p class="text-xl font-bold text-indigo-700 mb-6">{{ $author->name }}</p>

        <div class="flex gap-3">
            <a href="{{ route('authors.edit', $author->id) }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
               Edit
            </a>

            <form action="{{ route('authors.destroy', $author->id) }}"
                  method="POST" onsubmit="return confirm('Delete author?')">
                @csrf @method('DELETE')
                <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 shadow">
                    Delete
                </button>
            </form>
        </div>

        <a href="{{ route('authors.index') }}"
           class="block mt-4 text-indigo-600 hover:underline">← Back</a>
    </div>
</x-app-layout>
