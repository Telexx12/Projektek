<?php

namespace App\Http\Livewire\Components;

use App\Models\Plan;
use App\Models\Transaction;
use App\View\Components\auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Phpml\Regression\LeastSquares;

class DashboardPlans extends Component
{

    public $createPlanModal = false;

    public $plan_name;
    public $plan_amount;
    public $plans;
    public $transactions;

    public $current_balance;
    public $plansMethod = true;


    protected $regression;

    protected $rules = [
        'plan_name' => 'required',
        'plan_amount' => 'required'
    ];


    public function openModal()
    {
        $this->createPlanModal = true;
    }

    public function mount()
    {
        $this->plans = auth()->user()->plans->where('validated', '<>', true);

        $this->predict();


    }

    public function updatedPlansMethod(){
        if($this->plansMethod){
            $this->plans = auth()->user()->plans->where('validated', '<>', true);

            $this->predict();
        }
        else{
            $this->plans = auth()->user()->plans->where('validated', '<>', false);


            foreach ($this->plans as $plan) {
                $validated_at = new Carbon($plan->validated_at);
                $created_at = new Carbon($plan->created_at);

                $plan['after'] = $validated_at->diffForHumans($created_at);
            }
        }
    }

    public function predict()
    {
        $this->transactions = Transaction::query()->
        select(DB::raw('SUM(amount) as sum,UNIX_timestamp(completed_date) as completed_date'))
            ->from('transactions')
            ->groupBy('completed_date')
            ->get()
            ->pluck('sum', 'completed_date')
            ->toArray();

        $samples = [];
        $targets = [];
        $amount = 0;

        foreach ($this->transactions as $key => $value) {
            $amount += $value;
            array_push($samples, [$amount]);
            array_push($targets, $key);
        }


        $this->regression = new LeastSquares();
        $this->regression->train($samples, $targets);

        foreach ($this->plans as $plan) {
            $plan['prediction'] = $this->prediction($plan->amount);
        }

    }

    public function prediction($value)
    {
        if (!is_null($value) && $value > 0) {

            if ($value > $this->current_balance) {
                $prediction = $this->regression->predict([$value]);
                return Carbon::createFromTimestamp($prediction)->diffForHumans();
            } else {
                return 'done';
            }
        }
    }

    public function calculatePercent($value)
    {
        $percent = ($this->current_balance * 100) / $value;

        if ($percent > 100) {
            return 100;
        } else {
            return $percent;
        }
    }

    public function save()
    {
        $this->validate($this->rules);

        Plan::create([
            'plan_name' => $this->plan_name,
            'amount' => $this->plan_amount,
            'user_id' => auth()->user()->id
        ]);

        $this->createPlanModal = false;
        $this->plan_name = null;
        $this->plan_amount = null;

        if($this->plansMethod){
            $this->plans = auth()->user()->plans->where('validated', '<>', true);

            $this->predict();
        }
        else{
            $this->plans = auth()->user()->plans->where('validated', '<>', false);


            foreach ($this->plans as $plan) {
                $validated_at = new Carbon($plan->validated_at);
                $created_at = new Carbon($plan->created_at);

                $plan['after'] = $validated_at->diffForHumans($created_at);
            }
        }
    }

    public function close()
    {
        $this->createPlanModal = false;
    }

    public function deletePlan($id)
    {
        Plan::query()->where('id', $id)->delete();
        if($this->plansMethod){
            $this->plans = auth()->user()->plans->where('validated', '<>', true);

            $this->predict();
        }
        else{
            $this->plans = auth()->user()->plans->where('validated', '<>', false);


            foreach ($this->plans as $plan) {
                $validated_at = new Carbon($plan->validated_at);
                $created_at = new Carbon($plan->created_at);

                $plan['after'] = $validated_at->diffForHumans($created_at);
            }
        }
    }

    public function validatePlan($id)
    {
        Plan::query()->where('id', $id)->update(['validated' => true, 'validated_at' => date('Y-m-d H:i:s')]);
        if($this->plansMethod){
            $this->plans = auth()->user()->plans->where('validated', '<>', true);

            $this->predict();
        }
        else{
            $this->plans = auth()->user()->plans->where('validated', '<>', false);


            foreach ($this->plans as $plan) {
                $validated_at = new Carbon($plan->validated_at);
                $created_at = new Carbon($plan->created_at);

                $plan['after'] = $validated_at->diffForHumans($created_at);
            }
        }
    }

    public function render()
    {
        return view('livewire.components.dashboard-plans');
    }
}
