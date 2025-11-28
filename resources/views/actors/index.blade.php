<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Actors
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto">

        @if($actors->count() > 0)
            <div class="bg-white shadow rounded-lg p-6">
                <ul class="space-y-3">
                    @foreach ($actors as $actor)
                        <li class="flex justify-between items-center border-b pb-2">
                            <span class="text-gray-800 font-semibold">
                                {{ $actor->name }}
                            </span>

                            <a href="{{ route('actors.show', $actor->id) }}"
                               class="text-blue-600 hover:underline">
                                View
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-gray-600">No actors found.</p>
        @endif

    </div>
</x-app-layout>
