<footer class="relative bg-gray-800 py-8 h-96 bg-cover bg-center" style="background-image: url('/images/footer-bg.jpg');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/80"></div>

    <!-- Konten -->
    <div
        class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex h-full items-center justify-center flex-col text-white">
        <div class="flex flex-col items-center justify-center mb-8">
            <img src="{{ $footerSection->logo ? asset('storage/' . $footerSection->logo) : asset('images/logo.png') }}"
                alt="Museum" class="w-48 filter brightness-0 invert mb-8">
            <strong class="text-2xl">{{ $footerSection->title }}</strong>
            <p class="text-sm mt-4">{{ $footerSection->address }}</p>
        </div>

        <!-- Navigasi Link -->
        <nav class="flex justify-center flex-wrap gap-6 mb-6 text-slate-200">
            @foreach ($footerSection->details as $link)
                <a href="{{ $link->href }}" class="hover:text-white transition">{{ $link->navigation }}</a>
            @endforeach
        </nav>

        <!-- Sosial Media -->
        <div class="flex justify-center gap-6 mb-6 text-slate-200">
            <a href="#" class="hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="hover:text-white transition"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-white transition"><i class="fab fa-x-twitter"></i></a>
            <a href="#" class="hover:text-white transition"><i class="fab fa-github"></i></a>
            <a href="#" class="hover:text-white transition"><i class="fab fa-youtube"></i></a>
        </div>

        <!-- Copyright -->
        <p class="text-white text-sm">&copy; 2025 Museum Maritim Indonesia, Inc. All rights reserved.</p>
    </div>
</footer>
