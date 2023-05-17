<?php

namespace App\Http\Livewire\Settings;

use App\Models\Categories;
use Livewire\Component;

class Setting extends Component
{

//    public $categories;

    public function getCategories(){
//        $this->categories = Categories::query()->where('user_id',auth()->user()->id)->get();
        return Categories::query()->where('user_id',auth()->user()->id)->orWhere('user_id',null)->orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.settings.setting',['categories' => $this->getCategories()]);
    }
}
