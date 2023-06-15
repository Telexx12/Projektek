<div class="flex flex-col md:flex-row md:pl-3 mt-6 gap-2 relative mb-16">
    <x-card>
        <h1 class="text-xl font-bold text-center mb-6">Have a question? Ask the AI about it!</h1>
        <div class="flex flex-col md:flex-row">
            <div class="flex justify-center w-full md:w-3/12">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3/12 mb-6 md:mb-0 md:w-10/12" viewBox="0 0 48 48"
                     version="1" enable-background="new 0 0 48 48">
                    <circle fill="#FFF59D" cx="24" cy="22" r="20"/>
                    <path fill="#FBC02D"
                          d="M37,22c0-7.7-6.6-13.8-14.5-12.9c-6,0.7-10.8,5.5-11.4,11.5c-0.5,4.6,1.4,8.7,4.6,11.3 c1.4,1.2,2.3,2.9,2.3,4.8V37h12v-0.1c0-1.8,0.8-3.6,2.2-4.8C35.1,29.7,37,26.1,37,22z"/>
                    <path fill="#FFF59D"
                          d="M30.6,20.2l-3-2c-0.3-0.2-0.8-0.2-1.1,0L24,19.8l-2.4-1.6c-0.3-0.2-0.8-0.2-1.1,0l-3,2 c-0.2,0.2-0.4,0.4-0.4,0.7s0,0.6,0.2,0.8l3.8,4.7V37h2V26c0-0.2-0.1-0.4-0.2-0.6l-3.3-4.1l1.5-1l2.4,1.6c0.3,0.2,0.8,0.2,1.1,0 l2.4-1.6l1.5,1l-3.3,4.1C25.1,25.6,25,25.8,25,26v11h2V26.4l3.8-4.7c0.2-0.2,0.3-0.5,0.2-0.8S30.8,20.3,30.6,20.2z"/>
                    <circle fill="#5C6BC0" cx="24" cy="44" r="3"/>
                    <path fill="#9FA8DA" d="M26,45h-4c-2.2,0-4-1.8-4-4v-5h12v5C30,43.2,28.2,45,26,45z"/>
                    <g fill="#5C6BC0">
                        <path d="M30,41l-11.6,1.6c0.3,0.7,0.9,1.4,1.6,1.8l9.4-1.3C29.8,42.5,30,41.8,30,41z"/>
                        <polygon points="18,38.7 18,40.7 30,39 30,37"/>
                    </g>
                </svg>
            </div>
            <div class="w-full md:w-9/12 flex flex-col">
                <div class="mb-2">
                    <div class="flex justify-center">
                        <button class="flex rounded-lg border border-blue-200 justify-between items-center gap-3 px-3 py-1 w-full md:w-1/3 bg-gradient-to-r from-green-100 via-purple-100 to-blue-100" wire:click="askAiToAnalyze">
                            <x-icon name="cash" class="w-10 h-10 text-green-600"/>
                            <p class="font-bold">Analyze my financial state</p>
                            <x-icon name="document-search" class="w-10 h-10 text-blue-600"/>
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($questions as $key=>$que)
                        <div class="rounded-lg bg-blue-100 p-2">
                            <button wire:click="askAi({{$key}})"><span
                                    class="rounded-lg bg-white p-1 text-sm md:text-base">{{$que}}</span></button>
                        </div>
                    @endforeach
                </div>
                <div class="m-2 border min-h-[20vh] relative" p-2>
                    @if($answer)
                        <p class="p-6 text-sm md:text-base">{!! $answer !!}</p>
                    @else
                        <div class="flex w-full h-full items-center justify-center">
                            {{--                            <p class="p-6">As an AI language model, I don't have personal preferences but here are some steps you could take to improve your money management: 1. Create a budget: Start by creating a budget that covers all of your expenses, including bills, groceries, and other essentials. This will give you a clear idea of how much money you have available to spend and where you can cut back. 2. Track your spending: Keep track of every dollar that you spend and categorize your expenses accordingly. This will help you identify areas where you can save money and make adjustments to your budget. 3. Set financial goals: Determine your short-term and long-term financial goals. This can include saving for retirement, paying off debt, or building an emergency fund. 4. Limit unnecessary expenses: Cut back on unnecessary expenses, such as eating out or buying expensive coffee. Consider cheaper alternatives, such as bringing your lunch to work or making your own coffee at home. 5. Use credit cards wisely: Avoid using credit cards for unnecessary purchases and pay your balance in full each month. Try to limit the number of credit cards you have and choose ones with low-interest rates and rewards programs that benefit you. 6. Save for unexpected expenses: Make sure to set aside some money each month for unexpected expenses, such as car repairs or medical bills. This will help you avoid going into debt if unexpected expenses arise. 7. Review and adjust your budget regularly: Regularly review your budget to see if it’s working for you. Make adjustments as needed to ensure that you stay on track towards meeting your financial goals.</p>--}}

                            <p>Ai's answer will be here!</p>
                        </div>
                    @endif
                    <div wire:loading>
                        <div class="absolute flex w-full h-full top-0 left-0 justify-center items-center bg-black   ">
                            <span class="loader"></span>
                        </div>
                    </div>


                </div>
                <div class="relative">
                    <input type="text" id="input_no_comment-323"
                           class="block rounded-full px-2.5 w-full text-sm text-gray-900 focus:outline-none focus:ring-0 focus:border-gray-300 peer"
                           placeholder="Or ask your own question" wire:model.lazy="own_question"
                           wire:keydown.enter="askMyQuestion">
                    <svg class="rotate-90 w-[0.95rem] absolute peer-focus:block top-3 right-3 text-blue-500"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         wire:click="askMyQuestion">
                        <path
                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </x-card>
</div>
