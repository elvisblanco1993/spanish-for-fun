<?php

namespace App\Livewire\Request;

use App\Models\Request;
use Livewire\Component;

class Edit extends Component
{
    public Request $request;

    public function render()
    {
        return view('livewire.request.edit');
    }
}
