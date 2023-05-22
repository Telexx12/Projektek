<?php

namespace App\Http\Livewire\Components;

use App\Models\Categories;
use Livewire\Component;

class CategoryCreate extends Component
{
    public $category_name;
    public $color;

    public $update_color;
    public $updated_category;

    protected $rules = [
        'category_name' => 'required',
        'color'=> 'required'
    ];
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'updateTrigger',
    ];

    public function updatedColor(){
    }

    public function mount(){
        $this->color = "#e5e5e5";
//        $this->getCategories();
    }

    public function updateTrigger($category){
        $this->update_color = $category['category_color'];

        $this->updated_category = $category['id'];
    }

    public function getCategories(){
//        $this->categories = Categories::query()->where('user_id',auth()->user()->id)->get();
        return Categories::query()->where('user_id',auth()->user()->id)->orWhere('user_id',null)->orderBy('created_at','desc')->get();
    }

    public function updateCategory(){
        Categories::query()->where('id',$this->updated_category)->update(['category_color' => $this->update_color]);

        $this->update_color = null;
        $this->updated_category = null;

//       $this->getCategories();

        $this->emit('refreshComponent');
    }

    public function saveCategory(){

        $this->validate($this->rules);

        Categories::create([
            'category_name' => $this->category_name,
            'category_color' => $this->color,
            'user_id' => auth()->user()->id,
        ]);

//        $this->getCategories();

        $this->category_name = null;
        $this->color = "#e5e5e5";

        $this->emit('refreshComponent');
        $this->emit('category_created');
    }


    public function render()
    {
        return view('livewire.components.category-create',['categories' => $this->getCategories()]);
    }
}
