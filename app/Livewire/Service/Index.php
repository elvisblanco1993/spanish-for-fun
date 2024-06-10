<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.service.index', [
            'services' => Service::orderBy('created_at', 'DESC')->get(),
        ]);
    }
}
