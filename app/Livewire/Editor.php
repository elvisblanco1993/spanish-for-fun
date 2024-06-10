<?php

namespace App\Livewire;

use Livewire\Component;

class Editor extends Component
{
    public $content = '';

    public function mount($content = '')
    {
        $this->content = $content;
    }

    public function render()
    {
        return view('livewire.editor');
    }
}
