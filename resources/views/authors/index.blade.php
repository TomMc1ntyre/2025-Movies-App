<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Authors</h2>

            <a href="{{ route('authors.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 shadow">
               + Add Author
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">

            @if($authors->count())
                <ul class="divide-y divide-gray-300">
                    @foreach($authors as $author)
                        <li class="py-3 flex justify-between items-center hover:bg-gray-50 px-3 rounded">
                            <span class="font-medium text-gray-800">{{ $author->name }}</span>

                            <div class="flex gap-2">
                                <a href="{{ route('authors.show', $author->id) }}"
                                   class="text-blue-600 hover:underline">View</a>

                                <a href="{{ route('authors.edit', $author->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>

                                <form action="{{ route('authors.destroy', $author->id) }}"
                                      method="POST" onsubmit="return confirm('Delete author?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600 text-center">No authors found.</p>
            @endif

        </div>
    </div>
</x-app-layout>
