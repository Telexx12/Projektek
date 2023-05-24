<?php

namespace App\Http\Livewire\Components;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class DashboardBarChart extends Component
{
    public $data = [];

    public function mount()
    {
        $this->data = Transaction::query()
            ->where('user_id', auth()->user()->id)
            ->where('completed_date', '>=', Carbon::now()->subMonths(2))
            ->selectRaw('month(completed_date) as month')
            ->selectRaw('count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count','month')
            ->toArray();
    }
    public function render()
    {
        return view('livewire.components.dashboard-bar-chart');
    }
}
