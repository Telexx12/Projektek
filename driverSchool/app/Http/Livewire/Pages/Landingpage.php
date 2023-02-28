<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Landingpage extends Component
{

    protected $listeners =  [
        'languageChanged',
        'refresh' => '$refresh',
    ];

    public function languageChanged($local){
        app()->setLocale($local);
//        $this->emit('refresh');
    }

    public function render()
    {
        return view('livewire.pages.landingpage');
    }
}
