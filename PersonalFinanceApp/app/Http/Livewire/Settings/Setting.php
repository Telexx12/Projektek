<?php

namespace App\Http\Livewire\Settings;

use App\Models\Categories;
use Livewire\Component;

class Setting extends Component
{

//    public $categories;

    protected $listeners = [
      'category_created',
        'refreshComponent' => '$refresh',
    ];

    public function getCategories(){
//        $this->categories = Categories::query()->where('user_id',auth()->user()->id)->get();
        return Categories::query()->where('user_id',auth()->user()->id)->orWhere('user_id',null)->orderBy('created_at','desc')->get();
    }

    public function category_created(){
        $this->getCategories();
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.settings.setting',['categories' => $this->getCategories()]);
    }
}
