<?php

namespace App\Livewire\Comment;

use App\Models\Request;
use Livewire\Component;

class Index extends Component
{

    public ?Request $request;

    public $comments = [];

    public function mount()
    {
        if ($this->request) {
            $this->comments = $this->request->comments()->orderBy('created_at', 'DESC')->get();
            $this->comments->load('user');
        }
    }

    public function render()
    {
        return view('livewire.comment.index');
    }
}
