<x-guest-layout>
    <div class="h-screen bg-[#fff2dd] text-[#ec482e]">
        <header class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-full text-center py-12">
                <img src="{{ asset('logo.png') }}" alt="logo image" class="max-w-48 mx-auto">
                <h1 class="mt-4 text-4xl md:text-5xl font-extrabold">Spanish for Fun</h1>
                <h4 class="mt-4 text-xl md:text-2xl">Support Center</h4>
            </div>

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
                                class="px-5 py-3 rounded-lg bg-[#ec482e] text-white"
                            >
                                Get started
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </header>
    </div>
</x-guest-layout>
