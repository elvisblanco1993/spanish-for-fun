<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use App\Models\Request;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public ?Request $request;

    #[Validate('required')]
    public $content;

    public function render()
    {
        return view('livewire.comment.create');
    }

    public function save()
    {
        $this->validate();
        try {
            Comment::create([
                'request_id' => $this->request->id,
                'user_id' => Auth::id(),
                'content' => $this->content,
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
        $this->redirect(url()->previous(), navigate: true);
    }
}
