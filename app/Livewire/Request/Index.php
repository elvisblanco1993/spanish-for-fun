<?php

namespace App\Livewire\Request;

use App\Models\Request;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $per_page = 10;

    public function mount()
    {
        $stripe = new \Stripe\StripeClient(config('cashier.key'));
    }

    public function render()
    {
        return view('livewire.request.index', [
            'requests' => Request::search($this->search)->orderBy('created_at', 'DESC')->paginate($this->per_page)
        ]);
    }
}
