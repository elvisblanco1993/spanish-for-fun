<div>
    <x-button wire:click="$toggle('modal')">{{__("New service")}}</x-button>

    <x-dialog-modal wire:model="modal" maxWidth="xl">
        <x-slot name="title">{{__("New service")}}</x-slot>
        <x-slot name="content">
            <div>
                <x-label for="name">{{__("Name")}}</x-label>
                <x-input id="name" wire:model="name" class="mt-1 w-full" />
                <x-input-error for="name" class="mt-1"/>
            </div>
            <div class="mt-6">
                <x-label for="price">{{__("Price (in cents)")}}</x-label>
                <x-input type="number" id="price" wire:model="price" class="mt-1 w-full" />
                <x-input-error for="price" class="mt-1"/>
            </div>
            <div class="mt-6">
                <x-label for="price_modifier">{{__("How will this be priced?")}}</x-label>
                <x-select id="price_modifier" wire:model="price_modifier" class="mt-1 w-full">
                    <option value="">{{ __("Select pricing modifier") }}</option>
                    @forelse (config('internal.service_types') as $slug => $service)
                        <option value="{{ $slug }}">{{ $service }}</option>
                    @empty
                    @endforelse
                </x-select>
                <x-input-error for="price_modifier" class="mt-1"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">
                {{__("Cancel")}}
            </x-secondary-button>
            <x-button wire:click="save" class="ms-3">
                {{__("Create service")}}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
