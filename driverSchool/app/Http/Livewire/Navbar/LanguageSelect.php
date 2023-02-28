<?php

namespace App\Http\Livewire\Navbar;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class LanguageSelect extends Component
{

    public $language;

    public function mount(){
        $this->language = false;
        app()->setLocale('hu');
    }


    public function updatedLanguage(){

        if($this->language){
            app()->setLocale('ro');
            $local = 'ro';
        }else{
            app()->setLocale('hu');
            $local='hu';
        }

        $this->emit('languageChanged',$local);
    }

    public function render()
    {
        return view('livewire.navbar.language-select');
    }
}
