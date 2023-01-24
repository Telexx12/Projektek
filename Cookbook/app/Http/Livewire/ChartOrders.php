<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class ChartOrders extends Component
{

    public $lastYearOrders;
    public $thisYearOrders;
    public $selectedYear;

    public function mount(){
        $this->selectedYear = date('Y');
        $this->updateOrdersCount();
    }

    public function updateOrdersCount(){
        $this->lastYearOrders = Order::getYearOrders($this->selectedYear-1)->groupByMonth();

        $this->thisYearOrders = Order::getYearOrders($this->selectedYear)->groupByMonth();


        $this->emit('updateChart');
    }

    public function render()
    {

        $availableYears = [date('Y'), date('Y')-1,date('Y')-2,date('Y')-3];
        return view('livewire.chart-orders',[
            'availableYears' => $availableYears,
        ]);
    }
}
