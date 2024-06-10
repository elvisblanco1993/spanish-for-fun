<div>
    <div class="mt-6 p-4 w-full bg-white rounded-xl">

        <textarea wire:model="content" rows="6" class="w-full border-none outline-none focus:outline-none rounded-lg" placeholder="{{ __("Add a comment...") }}"></textarea>
        <x-input-error for="content"/>

        <div class="mt-4 flex items-center justify-between space-x-3">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="" class="h-10 w-10 rounded-full object-cover">
            <div class="flex items-center space-x-3">
                <x-button wire:click="save">{{ __("Post") }}</x-button>
            </div>
        </div>
    </div>
</div>
