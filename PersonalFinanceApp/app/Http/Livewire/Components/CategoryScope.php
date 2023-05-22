<?php

namespace App\Http\Livewire\Components;

use App\Models\Categories;
use Livewire\Component;

class CategoryScope extends Component
{

    public $categories;

    public $category_names = [];

    public $selected_category;

    public $scope_name;

    public $scopes;


    public function mount()
    {


        $this->category_names = $this->categories->map(function ($category) {
            return collect($category->toArray())
                ->only(['id', 'category_name','category_color'])
                ->all();
        });

    }


    public function updatedSelectedCategory()
    {
        $this->getScopes();
    }

    public function getScopes()
    {
        $this->scopes = Categories::query()->where('id', $this->selected_category)->first()->scopes;
    }

    public function saveScope()
    {

        $this->scope_name = strtolower($this->scope_name);

        $this->validate([
            'selected_category' => 'required',
            'scope_name' => 'required|unique:category_scopes,category_scope_name',
        ]);

        \App\Models\CategoryScope::create([
            'category_scope_name' => $this->scope_name,
            'category_id' => $this->selected_category
        ]);


        $this->scope_name = null;
//        $this->selected_category = null;

        $this->getScopes();

    }


    public function render()
    {
        return view('livewire.components.category-scope');
    }
}
