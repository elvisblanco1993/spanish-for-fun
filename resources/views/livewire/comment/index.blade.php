<div>
    <div class="relative flex py-5 items-center">
        <div class="flex-grow border-t border-slate-400"></div>
        <span class="flex-shrink mx-4 text-slate-700">{{ __("Comments") }}</span>
        <div class="flex-grow border-t border-slate-400"></div>
    </div>

    <div class="space-y-6">
        @forelse ($comments as $comment)
            <div class="block p-4 w-full bg-white rounded-xl">
                <div class="flex items-start space-x-4">
                    <img src="{{ $comment->user->profile_photo_url }}" alt="" class="h-12 w-12 rounded-full object-cover">
                    <div class="block">
                        <p>{{ $comment->user->name }}</p>
                        <small class="text-slate-500">{{ __("Posted ") . $comment->created_at->diffForHumans() }}</small>
                        <div class="mt-3">
                            {{ $comment->content }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
