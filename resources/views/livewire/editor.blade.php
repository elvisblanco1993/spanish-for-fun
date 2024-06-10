@assets
<link rel="stylesheet" href="https://unpkg.com/trix@2.0.0-alpha.1/dist/trix.css"></link>
<script src="https://unpkg.com/trix@2.0.0-alpha.1/dist/trix.umd.js"></script>
    <style>[data-trix-button-group="file-tools"] { display: none !important; }</style>
@endassets
<div>
    <div
        x-data="{ value: '{{ $content }}' }"
        x-init="$refs.trix.editor.loadHTML(value)"
        x-id="['trix']"
        class="w-full"
        @trix-change="$wire.dispatch('editorContentUpdated', {content: $refs.input.value})"
        @trix-file-accept.prevent
        wire:ignore
    >
        <input :id="$id('trix')" type="text" class="sr-only" x-ref="input" wire:model="content">
        <trix-editor x-ref="trix" :input="$id('trix')"
            class="-mt-1 min-h-32 prose dark:prose-invert prose-orange outline-none text-base border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-2 focus:border-orange-500 dark:focus:border-orange-600 focus:ring-orange-500 dark:focus:ring-orange-600 rounded-md shadow-sm w-full max-w-full"
        ></trix-editor>
    </div>
</div>
