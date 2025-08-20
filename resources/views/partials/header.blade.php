<nav x-data="{ scrolled: false, open: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-sky-800 shadow-md' : 'bg-sky-800 md:bg-transparent'"
    class="fixed top-0 z-50 w-full transition-colors duration-300 ease-in-out">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div :class="scrolled ? 'h-20' : 'h-20 md:h-28'"
            class="flex items-center justify-between transition-all duration-300 ease-in-out">
            <div class="flex items-center space-x-12">
                <a href="#" class="text-lg font-semibold text-white">
                    <img src="{{ $navbarSection->logo ? asset('storage/' . $navbarSection->logo) : asset('images/logo.png') }}"
                        alt="logo" :class="scrolled ? 'filter brightness-0 invert' : ''"
                        class="h-6 transition-all duration-200 ease-in-out md:h-8">
                </a>
                <div class="hidden space-x-6 md:flex">
                    @foreach ($navbarSection->links as $link)
                        <a href="{{ $link->href }}"
                            class="text-sm font-medium text-gray-200 hover:text-white">{{ $link->navigation }}</a>
                    @endforeach
                </div>
            </div>
            <div class="md:hidden">
                <button type="button" class="text-gray-200 hover:text-white focus:outline-none" @click="open = !open">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden">
        <div x-show="open" x-transition class="relative px-2 pt-2 pb-3 space-y-1 bg-gray-800 -top-3">
            @foreach ($navbarSection->links as $link)
                <a href="{{ $link->href }}"
                    class="block px-3 py-2 text-base font-medium text-gray-200 rounded-md hover:bg-gray-700 hover:text-white">{{ $link->navigation }}</a>
            @endforeach
        </div>
    </div>
</nav>
