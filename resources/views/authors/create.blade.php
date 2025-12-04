<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Add New Author</h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('authors.store') }}" method="POST">
            @csrf

            <label class="block font-medium mb-1 text-gray-700">Author Name</label>
            <input type="text" name="name" required
                   class="w-full border rounded px-3 py-2 mb-4 focus:ring-indigo-500 focus:ring">

            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 shadow">
                Save Author
            </button>

            <a href="{{ route('authors.index') }}" class="ml-3 text-gray-600 hover:underline">
                Cancel
            </a>
        </form>
    </div>
</x-app-layout>
