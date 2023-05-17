<?php

namespace App\Http\Livewire\Components;

use App\Models\Categories;
use Livewire\Component;

class CategoryCard extends Component
{

    public $category;

    public $category_color;

    protected $listeners =[
      'refreshChild' => '$refresh'
    ];

    public function updatedCategoryColor(){


        Categories::query()->where('id',$this->category->id)->update(['category_color' => $this->category_color]);

//        $this->emitUp('refreshComponent');

        $this->emit('refreshChild');

//        $this->category = null;
//        $this->category_color = null;

    }

    public function mount(){
        $this->category_color = $this->category->category_color;
    }



    public function delete(){
        Categories::query()->where('id',$this->category->id)->delete();

        $this->emitUp('refreshComponent');
    }

    public function render()
    {
        return view('livewire.components.category-card');
    }
}
