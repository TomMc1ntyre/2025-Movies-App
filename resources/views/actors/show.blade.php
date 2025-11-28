<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Actor Details
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto">

        <div class="bg-white shadow rounded-lg p-6">

            {{-- Actor Name --}}
            <h3 class="text-3xl font-bold text-gray-800 mb-6">
                {{ $actor->name }}
            </h3>

            {{-- Movies --}}
            <h4 class="text-xl font-semibold text-gray-700 mb-3">
                Movies featuring {{ $actor->name }}:
            </h4>

            @if($actor->movies->count() > 0)
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($actor->movies as $movie)
                        <a href="{{ route('movies.show', $movie->id) }}"
                           class="block bg-gray-50 hover:bg-gray-100 border rounded-lg p-4 shadow transition">

                            {{-- Movie Cover --}}
                            @if($movie->cover)
                                <img src="/covers/{{ $movie->cover }}"
                                     class="w-full h-40 object-cover rounded mb-3">
                            @else
                                <div class="w-full h-40 bg-gray-300 rounded mb-3"></div>
                            @endif

                            {{-- Movie Title --}}
                            <p class="font-semibold text-gray-800 text-center">
                                {{ $movie->title }}
                            </p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">This actor has no movies listed.</p>
            @endif

        </div>

    </div>

</x-app-layout>
