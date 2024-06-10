<?php

namespace App\Livewire\Request;

use App\Models\Request;
use App\Notifications\RequestSolved;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class Solve extends Component
{
    public ?Request $request;
    public $modal;

    #[Validate('required')]
    public $solution;

    public function mount()
    {
        $this->solution = $this->request?->solution;
    }

    public function render()
    {
        return view('livewire.request.solve');
    }

    public function save()
    {
        $this->validate();

        try {
            $this->request->update([
                'solution' => $this->solution,
                'completed_at' => now(),
            ]);
            Notification::send($this->request->user, new RequestSolved($this->request));

            session()->flash('flash.banner', 'Your solution has been successfully recorded. We\'ll notify the author via email.');
            session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            Log::error($th);
            session()->flash('flash.banner', 'Error uploading solution. Please try again later or contact support.');
            session()->flash('flash.bannerStyle', 'danger');
        }

        $this->redirect(url()->previous(), navigate: true);
    }
}
