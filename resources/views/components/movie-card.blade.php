@props(['title', 'release_year', 'genre', 'cover'])

<div>
    <div class="border rounded-lg shadow-mp p-6 bg-white hover:shadow-lg transition duration-300">
        <h4 class="font-bold text-lg mb-2">{{ $title }}</h4>

        <!-- fixed-size image container -->
        <div class="w-24 h-32 overflow-hidden rounded-md mb-4 mx-auto">
            <img
                src="/covers/{{ $cover }}"
                alt="{{ $title }}"
                class="w-full h-40 object-cover rounded"
            >
        </div>
    </div>
</div>
