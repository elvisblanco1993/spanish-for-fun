<?php

namespace App\Livewire\Request;

use App\Models\Request;
use Livewire\Component;

class Delete extends Component
{
    public Request $request;

    public function render()
    {
        return view('livewire.request.delete');
    }

    public function delete()
    {
        $this->request->delete();
        session()->flash('flash.banner', 'Request successfully deleted!');
        session()->flash('flash.bannerStyle', 'success');
        $this->redirect(url()->previous(), navigate: true);
    }
}
