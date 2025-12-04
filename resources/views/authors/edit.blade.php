<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Edit Author</h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('authors.update', $author->id) }}" method="POST">
            @csrf @method('PUT')

            <label class="block font-medium mb-1 text-gray-700">Name</label>
            <input type="text" name="name" value="{{ $author->name }}" required
                   class="w-full border rounded px-3 py-2 mb-4 focus:ring-indigo-500 focus:ring">

            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 shadow">
                Update
            </button>

            <a href="{{ route('authors.index') }}" class="ml-3 text-gray-600 hover:underline">
                Cancel
            </a>
        </form>
    </div>
</x-app-layout>
