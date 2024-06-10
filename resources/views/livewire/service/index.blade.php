<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Services') }}
            </h2>
            @livewire('service.create')
        </div>
    </x-slot>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 my-12 prose">
        @if ($services->count() > 0)
            <div class="w-full">
                <table class="table-fixed text-left bg-white rounded-lg overflow-hidden shadow">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2">{{__("ID")}}</th>
                            <th class="px-3 py-2">{{__("Name")}}</th>
                            <th class="px-3 py-2">{{__("Price")}}</th>
                            <th class="px-3 py-2 sr-only">{{__("Options")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td class="px-3 py-2">{{ $service->id }}</td>
                                <td class="px-3 py-2">{{ $service->name }}</td>
                                <td class="px-3 py-2">{{ \Cknow\Money\Money::USD($service->price) }} {{ $service->price_modifier }}</td>
                                <td class="px-3 py-2"></td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="w-full bg-white dark:bg-gray-800 rounded-lg p-4 shadow">
                <div class="text-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto flex-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span>No services found.</span>
                </div>
            </div>
        @endif
    </main>
</div>
