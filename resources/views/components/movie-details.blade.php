@props([
    'title',
    'description'
    'cover',
    'release_year',
    'genre',
])
<div class = "border rounded-lg shadow-mp p-6 bg-white hover:shadow-lg transition duration-300 max-w-xl mx-auto">

    {{-- Title --}}
    <h4 class="font-bold text-lg mb-2">{{ $title }}</h4>

    {{-- Image --}}
    <div class="overflow-hidden rounded-lg mb-4 flex justify-center">
        <img src="{{ asset('covers/' . $cover) }}" alt="{{ $title }}" class="w-full h-full object-cover">
    </div>
    {{-- Details --}}
    <h2 class= "text-gray-500 text-sm italic mb-4">Movie Details</h2>
    <p><strong>Release Year:</strong> {{ $release_year }}</p>
    <p><strong>Genre:</strong> {{ $genre }}</p>

</div>
