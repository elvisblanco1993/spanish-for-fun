<x-guest-layout>
    @include('website.navbar')

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose max-w-full">
            <h1>{{ __("Welcome to the Spanish For Fun Help Center!") }}</h1>
            <p>{{ __("Please create a free account to request assistance with your Spanish languange related needs.") }}</p>
        </div>
    </header>
</x-guest-layout>
