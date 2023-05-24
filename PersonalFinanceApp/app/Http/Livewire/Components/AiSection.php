<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AiSection extends Component
{

    public $questions = [];

    public $answer;

    public $own_question;


    public function mount(){
//        $response = Http::withHeaders([
//            'Authorization' => 'Bearer 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',
//        ])->post('https://api.openai.com/v1/chat/completions', [
//            "model" => "gpt-3.5-turbo",
//            "messages" => [
//                ["role" => "user", "content" => "Hello!"]
//            ]
//        ])->json();
//
//
//        dd($response['choices'][0]['message']['content']);


        array_push($this->questions,'How to save money?','How to improve my money managment?',
            'How can I start saving and investing for my future?',
            'How can I create an emergency fund to handle unexpected expenses?',
            'What are some effective ways to minimize my expenses and save money on a daily basis?',
            'What are the benefits and risks associated with different investment options, such as stocks, bonds, real estate, or mutual funds?');


    }

    public function askAi($key){
        $asked_question = $this->questions[$key];

        set_time_limit(0);

        $response = Http::timeout(50)->withHeaders([
            'Authorization' => 'Bearer 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',
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "user", "content" => $asked_question]
            ]
        ])->json();


        $this->answer = $response['choices'][0]['message']['content'];
    }

    public function askMyQuestion(){
        $response = Http::timeout(50)->withHeaders([
            'Authorization' => 'Bearer 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',
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "user", "content" => $this->own_question]
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
