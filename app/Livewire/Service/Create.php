<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Create extends Component
{
    public $modal;
    public $name;
    public $price;
    public $price_modifier;

    public function render()
    {
        return view('livewire.service.create');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'price_modifier' => 'required',
        ]);

        try {
            Service::create([
                'name' => $this->name,
                'slug' => str($this->name)->slug(),
                'price' => $this->price,
                'price_modifier' => $this->price_modifier,
            ]);
            session()->flash('flash.banner', 'Service created!');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'Error! Service was not created.');
            session()->flash('flash.bannerStyle', 'danger');
        }
        $this->redirect(url()->previous(), navigate: true);
    }
}
