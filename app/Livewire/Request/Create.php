<?php

namespace App\Livewire\Request;

use App\Models\Request;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Create extends Component
{
    use WithFileUploads;

    public $modal;

    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $description;

    public $content;

    public $wordCount = 0;

    public $service;
    public $selectedService;
    public $amount_due;

    public function render()
    {
        return view('livewire.request.create', [
            'services' => Service::where('is_active', 1)->get(),
        ]);
    }

    public function save()
    {
        $this->validate();

        try {
            $request = Request::create([
                'user_id' => auth()->id(),
                'service_id' => $this->selectedService->id,
                'title' => $this->title,
                'description' => $this->description,
                'amount_due' => $this->amount_due,
                'content' => $this->content,
            ]);
            return redirect()->route('checkout.service', ['request' => $request]);
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'Error! Service was not created.');
            session()->flash('flash.bannerStyle', 'danger');
        }
        $this->redirect(url()->previous(), navigate: true);
    }

    public function setService($service)
    {
        $this->selectedService = Service::findOrFail($service);
        $this->amount_due = ($this->selectedService->price_modifier == 'per-word')
            ? ($this->selectedService->price * $this->wordCount)
            : $this->selectedService->price;
    }

    public function updatedContent()
    {
        $this->wordCount = str_word_count(trim(strip_tags($this->content)));
        $this->amount_due = $this->selectedService?->price * $this->wordCount;
    }
}
