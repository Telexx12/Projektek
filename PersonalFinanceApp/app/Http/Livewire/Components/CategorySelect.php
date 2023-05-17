<?php

namespace App\Http\Livewire\Components;

use App\Models\Transaction;
use Livewire\Component;

class CategorySelect extends Component
{

    public $categories;
    public $transaction;

    public $selected_category;

    protected $rules = ['selected_category' => ''];

    protected $listeners = [
        'refreshComponent'   => '$refresh',
    ];

    public function updatedSelectedCategory(){

        Transaction::query()->where('id',$this->transaction->id)->update(['category_id' => $this->selected_category]);

        $this->transaction = Transaction::query()->where('id',$this->transaction->id)->first();

        $this->selected_category = $this->transaction->category;

        $this->emit('refreshComponent');
    }

    public function mount(){
        $this->selected_category = $this->transaction->category;
    }

    public function is_color_dark($hex_color) {
        // Convert the hex color to RGB values
        $red = hexdec(substr($hex_color, 0, 2));
        $green = hexdec(substr($hex_color, 2, 2));
        $blue = hexdec(substr($hex_color, 4, 2));

        // Calculate the YIQ value of the color
        $yiq = (($red * 299) + ($green * 587) + ($blue * 114)) / 1000;

//        dd($yiq,$hex_color);
        // If the color is dark, return true

//        dd($yiq);

        return $yiq > 70;
    }

    public function render()
    {
        return view('livewire.components.category-select',['categoires' => $this->categories]);
    }
}