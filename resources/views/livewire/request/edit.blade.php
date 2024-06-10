<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Requests / ') . $request->title }}
            </h2>

            <div class="flex items-center space-x-3">
                @if (!$request->paid_at)
                    <span class="whitespace-nowrap bg-rose-100 text-rose-900 rounded-lg text-xs uppercase font-medium px-2 py-1">{{ __("Pending payment") }}</span>
                @elseif ($request->paid_at && !$request->completed_at)
                    <span class="whitespace-nowrap bg-orange-100 text-orange-900 rounded-lg text-xs uppercase font-medium px-2 py-1">{{ __("In progress") }}</span>
                @else
                    <span class="whitespace-nowrap bg-green-100 text-green-900 rounded-lg text-xs uppercase font-medium px-2 py-1">{{ __("Completed") }}</span>
                @endif
                @if (!Auth::user()->is_client)
                    @livewire('request.solve', ['request' => $request])
                @endif
            </div>
        </div>
    </x-slot>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($request->solution && $request->completed_at)
            <div class="block font-medium text-lg text-gray-900 dark:text-gray-300">{{__("Solution")}}</div>
            <div class="mt-3 prose max-w-full bg-green-100 border border-dashed border-green-300 text-black p-4 rounded-xl">
                {!! str($request->solution)->markdown() !!}
            </div>
            <div class="mt-6"></div>
        @endif

        <div class="block font-medium text-lg text-gray-900 dark:text-gray-300">{{__("How can we assist you today?")}}</div>
        <div class="mt-3 prose prose-blue dark:prose-invert max-w-full">
            {{ $request->description }}
        </div>

        <div class="mt-6 block font-medium text-lg text-gray-900 dark:text-gray-300">{{__("The content you need help with")}}</div>
        <div class="mt-3 prose prose-blue dark:prose-invert max-w-full">
            {!! str($request->content)->markdown() !!}
        </div>

        <div class="mt-6">
            {{-- Comments here --}}
            @livewire('comment.index', ['request' => $request])
            @if (!$request->completed_at)
                @livewire('comment.create', ['request' => $request])
            @endif
        </div>
    </main>
</div>
