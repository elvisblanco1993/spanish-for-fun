<nav class="max-w-7xl mx-auto lg:my-6 px-4 sm:px-6 lg:px-8 py-6 bg-white/80 shadow-sm lg:rounded-full backdrop-blur-lg">
    <div class="w-full flex items-center justify-between">
        <a href="/">
            <img src="{{ asset('logo.png') }}" alt="logo image" class="h-12 w-auto">
        </a>

        <div class="flex items-center justify-center space-x-4">
            @if (Route::has('login'))
                @auth
                    <a
                        href="{{ url('/requests') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="px-5 py-3 rounded-full bg-[#ec482e] hover:brightness-95 text-white"
                        >
                            Get started
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
