<div>
    <x-button wire:click="$toggle('modal')">
        @if ($request->solution)
            {{ __("Update solution") }}
        @else
            {{ __("Post solution") }}
        @endif
    </x-button>

    <x-dialog-modal wire:model="modal" maxWidth="3xl">
        <x-slot name="title">{{ __("Post solution") }}</x-slot>
        <x-slot name="content">
            <div class="mt-6">
                <x-label for="solution">{{__("Paste the solution here")}}</x-label>
                <x-textarea id="solution" wire:model.live.debounce.250ms="solution" class="w-full mt-1" rows="10"/>
                <x-input-error for="solution" class="mt-1"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modal')">
                {{__("Cancel")}}
            </x-secondary-button>
            <x-button wire:click="save" class="ms-3" :disabled="!$solution">
                {{__("Submit solution")}}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
