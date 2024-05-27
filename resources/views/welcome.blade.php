<x-app-layout>
    <div
        id="welcome"
        class="welcome-canvas flex min-h-screen justify-center items-center bg-black"
    >
        <div class="flex flex-col gap-5 text-center mb-32 max-w-5xl">
            <h1 data-aos="zoom-in" data-aos-duration="1000" class="shhh text-londrina text-6xl text-white font-semibold transition-all duration-500">
                shhh.
            </h1>
            <p data-aos="zoom-out" data-aos-duration="1500" class="text-londrina text-7xl text-white font-semibold transition-all duration-500">
                @php $quotes = [ "Spill the tea...
                anonymously.", "Say it. Secretly.", "Speak your mind. Unmasked.", "Unleash your thoughts. Incognito." ]; $randomQuote =
                $quotes[array_rand($quotes)]; @endphp

                {{ $randomQuote }}

            </p>
        </div>
    </div>
</x-app-layout>
