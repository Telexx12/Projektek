<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dashboard-cards extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $total_income,
        public $monthly_income,
        public $last_month_income,
        public $income_monthly_change,
        public $average_income,
        public $total_expens,
        public $monthly_expens,
        public $last_month_expens,
        public $expens_monthly_change,
        public $average_expens,
        public $average_expens_change,
        public $current_balance,
        public $last_month_balance,
        public $balance_change,

){}


    /**
     * Get the view / contents that represent the component.
     */
    public
    function render(): View|Closure|string
    {
        return view('components.dashboard-cards');
    }
}
