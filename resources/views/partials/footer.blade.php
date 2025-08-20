<footer class="relative py-8 bg-gray-800 bg-center bg-cover h-96"
    style="background-image: url('/images/footer-bg.webp');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-sky-900/90"></div>

    <!-- Konten -->
    <div
        class="relative z-10 flex flex-col items-center justify-center h-full px-4 mx-auto text-center text-white max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-center mb-8">
            <img src="{{ $footerSection->logo ? asset('storage/' . $footerSection->logo) : asset('images/logo.png') }}"
                alt="Museum" class="w-48 mb-8 filter brightness-0 invert">
            <strong class="text-2xl">{{ $footerSection->title }}</strong>
            <p class="mt-4 text-sm">{{ $footerSection->address }}</p>
        </div>

        <!-- Navigasi Link -->
        <nav class="flex flex-wrap justify-center gap-6 mb-6 text-slate-200">
            @foreach ($footerSection->details as $link)
                <a href="{{ $link->href }}" class="transition hover:text-white">{{ $link->navigation }}</a>
            @endforeach
        </nav>

        <!-- Sosial Media -->
        <div class="flex justify-center gap-6 mb-6 text-slate-200">
            <a href="#" class="transition hover:text-white"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="transition hover:text-white"><i class="fab fa-instagram"></i></a>
            <a href="#" class="transition hover:text-white"><i class="fab fa-x-twitter"></i></a>
            <a href="#" class="transition hover:text-white"><i class="fab fa-github"></i></a>
            <a href="#" class="transition hover:text-white"><i class="fab fa-youtube"></i></a>
        </div>

        <!-- Copyright -->
        <p class="text-sm text-white">&copy; 2025 Museum Maritim Indonesia, Inc. All rights reserved.</p>
    </div>
</footer>
