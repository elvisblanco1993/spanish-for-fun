<div>
    <x-button wire:click="$toggle('modal')">{{__("New request")}}</x-button>

    <x-dialog-modal wire:model="modal" maxWidth="3xl">
        <x-slot name="title">{{__("New request")}}</x-slot>
        <x-slot name="content">
            <div class="space-y-1">
                @forelse ($services as $service)
                    <button @class([
                            "w-full flex items-center justify-between rounded-lg px-4 py-2 border",
                            "bg-green-100 border-green-400 text-green-900 font-medium" => $service->id == $selectedService?->id
                        ])
                        wire:click="setService({{$service->id}})"
                    >
                        <span>{{ $service->name }} - {{ Cknow\Money\Money::USD($service->price) }} {{ $service->price_modifier }}</span>
                        @if ($service->id == $selectedService?->id)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 flex-none">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>
                @empty
                    <span class="block w-full px-4 py-2">{{ __("There are no available service for you to choose from.") }}</span>
                @endforelse
            </div>

            @if ($selectedService)
                <div class="mt-6">
                    <x-label for="title">{{__("Title")}}</x-label>
                    <x-input id="title" wire:model="title" class="mt-1 w-full" />
                    <x-input-error for="title" class="mt-1"/>
                </div>
                <div class="mt-6">
                    <x-label for="description">{{__("How can we assist you today?")}}</x-label>
                    <x-textarea id="description" wire:model="description" class="w-full mt-1"/>
                    <x-input-error for="description" class="mt-1"/>
                </div>
                @if ($selectedService->price_modifier == 'per-word')
                    <div class="mt-6">
                        <x-label for="message">{{__("Paste the content you need help with:")}}</x-label>
                        <x-textarea id="description" wire:model.live="content" class="w-full mt-1" rows="10"/>
                        <div class="mt-1 text-sm font-medium text-slate-600 text-right">
                            <span>{{$wordCount . __(" words")}}</span>
                        </div>
                        <x-input-error for="content" class="mt-1"/>
                    </div>
                @endif

                <div class="mt-6">
                    Your Total: {{ Cknow\Money\Money::USD($this->amount_due) }}
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">
                {{__("Cancel")}}
            </x-secondary-button>
            <x-button wire:click="save" class="ms-3" :disabled="!$selectedService || $amount_due < 100">
                {{__("Pay and submit")}}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
