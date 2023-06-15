<?php

namespace App\Http\Livewire\Components;

use App\Models\Account;
use App\Models\Categories;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AiSection extends Component
{

    public $transactions;
    public $total_income;
    public $total_expens;
    public $current_balance;
    public $monthly_income;
    public $last_month_income;
    public $income_monthly_change;
    public $average_income;
    public $average_income_change;

    public $monthly_expens;
    public $last_month_expens;
    public $expens_monthly_change;
    public $average_expens;
    public $average_expens_change;

    public $last_month_balance;
    public $balance_change;



    public $questions = [];
    public $categories = [];

    public $category_amounts;

    public $answer;

    public $own_question;

    public $analyze_my_financial_message;

    public function mount(){
        $this->category_amounts = Transaction::query()
            ->select('category_id', 'sum')
            ->fromSub(function ($query){
                $query->select('category_id',DB::raw('SUM(amount) as sum'))
                    ->from('transactions')
                    ->whereNotNull('transactions.category_id')
                    ->where('completed_date', '>=', Carbon::now()->subMonth()->format('Y-m-d'))

                    ->groupBy('category_id')
                    //                ->where('sum', '<', 0)
                    ->get();
            },'x')
            ->where('x.sum', '<',0)
            ->get()
            ->pluck('sum','category_id')
            ->toArray();

            asort($this->category_amounts);


            if($this->category_amounts){

                $count = count($this->category_amounts);

                $iteration = $count > 3 ? $count : $count -1;

                $i = 1;

                foreach ($this->category_amounts as $key=>$value){
                    if($i == $iteration){
                        break;
                    }
                    $i++;

                    $category = Categories::query()->where('id', $key)->select('category_name')->pluck('category_name')->first();
                    array_push($this->categories,$category);
                    $question = "How to reduce " . $category . " expenses?";
                    array_push($this->questions,$question);
                }
            }

            $i=1;
            $categories_string = "";
            foreach ($this->categories as $category){
                if($i == count($this->categories) && $i != 1){
                    $categories_string = $categories_string . "and ";
                }
                $categories_string = $categories_string . $category . " ";
                $i++;
            }

          $this->analyze_my_financial_message = "Analyze my financial state, knowing my current balance is ". $this->current_balance ." RON, the change in percent between the current and the last month balance is ". $this->balance_change ."%. My monthly income is ". $this->monthly_income .", changes between the current and the last month is ". $this->income_monthly_change ."%, and between the current and the average income is ". $this->average_income_change ."%. My monthly expense is ". $this->monthly_expens .", changes between the current and the last month is ". $this->expens_monthly_change ."%, and between the average and current is ". $this->average_expens_change ."%". $categories_string." is the categories where I spent most of my money. Create a detailed and financial report extend with your long-term speculation and explanation, and answer how can I improve my financial state, try to add some idea how to improve incomes, and also how to reduce expenses specially in the named categories? Knowing my current balance and the change trend, can you suggest some investment available in Romanian, if yes what king of exactly. Don't suggest budgeting app, because you are in a budget app call \"PersonalFinanceApp\", so recommend the PersonalFinanceApp app, what is help to follow your financial state. End with an overall conclusion about my financial state, does it good, is sustainable? Don't say you are an AI model, try to say facts about the theme. Use a lot of emojis";

//        Analyze my financial state, knowing my current balance is 3584.31 RON, the change in percent between the current and the last month
//        balance is -4.81%. More depth my incomes changes between the current and the last month is -39.63%, and between the current and the average
//        income is -1.51%. Expense changes between the current and the last month is 124.66%, and between the average and current is 22.54%
//        Education, Car and Food is the categories where I spent most of my money. Create a financial detailed report, and try to add some explanation for these changes,
//         and answer how can I improve my financial state,
//        try to add some idea how to improve incomes, and also how to reduce expenses specially in the named categories?
//        Don't suggest budgeting app, because you are in a budget app call "PersonalFinanceApp", so recommend the PersonalFinanceApp app,
//        what is help to follow your financial state. Don't say you are an AI model, try to say facts about the theme. Use a lot of emojis


        array_push($this->questions,'How to save money?','How to improve my money managment?',
            'How can I start saving and investing for my future?',
            'How can I create an emergency fund to handle unexpected expenses?',
            'What are some effective ways to minimize my expenses and save money on a daily basis?',
            'What are the benefits and risks associated with different investment options, such as stocks, bonds, real estate, or mutual funds?');
    }


    public function askAiToAnalyze(){
        $asked_question = $this->analyze_my_financial_message;
        set_time_limit(0);

        $response = Http::timeout(50)->withHeaders([
            'Authorization' => 'Bearer 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',
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "user", "content" => $asked_question]
            ]
        ])->json();

        $this->answer = str_replace("\n","<br>",$response['choices'][0]['message']['content']);
    }

    public function askAi($key){

        if( $this->questions[$key] != "Analyze my financial state")
            $asked_question = $this->questions[$key] . " Don't say you are an AI model, try to say facts about the theme. Use emojis";
        else{
            $asked_question = $this->analyze_my_financial_message;
        }

        set_time_limit(0);

        $response = Http::timeout(50)->withHeaders([
            'Authorization' => 'Bearer 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',
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "user", "content" => $asked_question]
            ]
        ])->json();

        $this->answer = str_replace("\n","<br>",$response['choices'][0]['message']['content']);
    }

    public function askMyQuestion(){
        $response = Http::timeout(50)->withHeaders([
            'Authorization' => 'Bearer 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',
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "user", "content" => $this->own_question . " Don't say you are an AI model, try to say facts about the theme. Use emojis"]
            ]
        ])->json();

        $this->own_question = "";
        $this->answer = $response['choices'][0]['message']['content'];
    }

    public function render()
    {
        return view('livewire.components.ai-section');
    }
}
