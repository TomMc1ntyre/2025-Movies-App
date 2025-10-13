@props(['title', 'release_year', 'genre', 'cover'])
<div>
    <div class = "border rounded-lg overflow-hidden shadow-mp p-6 bg-white hover:shadow-lg transition-shadow duration-300">
        <h4 class ="font-bold text-lg mb-2">{{ $title }}</h4>
        <img src="{{ asset('covers/' . $cover)}}" alt="{{ $title }}" class="object-cover">
    </div>
</div>
