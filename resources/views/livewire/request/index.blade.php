<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Requests') }}
            </h2>
            @livewire('request.create')
        </div>
    </x-slot>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 my-12 prose">
        @if ($requests->count() > 0)
            <div class="w-full">
                <table class="table-fixed text-left bg-white rounded-lg overflow-hidden shadow">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2">{{__("ID")}}</th>
                            @if (!Auth::user()->is_client)
                                <th class="px-3 py-2">{{__("Author")}}</th>
                            @endif
                            <th class="px-3 py-2">{{__("Title")}}</th>
                            <th class="px-3 py-2">{{__("Status")}}</th>
                            <th class="px-3 py-2 sr-only">{{__("Options")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr wire:key="request-{{$request->id}}">
                                <td class="px-3 py-2">{{ $request->id }}</td>
                                @if (!Auth::user()->is_client)
                                    <td class="px-3 py-2 whitespace-nowrap">{{ $request->user->name }}</td>
                                @endif
                                <td class="px-3 py-2 whitespace-nowrap">{{ $request->title }}</td>
                                <td class="px-3 py-2">
                                    @if (!$request->paid_at)
                                        <span class="whitespace-nowrap bg-rose-100 text-rose-900 rounded-lg text-xs uppercase font-medium px-2 py-1">{{ __("Pending payment") }}</span>
                                    @elseif ($request->paid_at && !$request->completed_at)
                                        <span class="whitespace-nowrap bg-orange-100 text-orange-900 rounded-lg text-xs uppercase font-medium px-2 py-1">{{ __("In progress") }}</span>
                                    @else
                                        <span class="whitespace-nowrap bg-green-100 text-green-900 rounded-lg text-xs uppercase font-medium px-2 py-1">{{ __("Completed") }}</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center justify-end space-x-3">
                                        @if (! $request->paid_at && $request->amount_due >= 100)
                                            <a href="{{ route('checkout.service', ['request' => $request]) }}" class="whitespace-nowrap">{{__("Pay and submit")}}</a>
                                        @endif
                                        <a wire:navigate href="{{ route('request.show', ['request' => $request]) }}">Details</a>
                                        @if (!$request->paid_at)
                                            @livewire('request.delete', ['request' => $request], key('delete-'.$request->id))
                                        @endif
                                    </div>
                                </td>
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
                    <span>No requests found.</span>
                </div>
            </div>
        @endif
    </main>
</div>
