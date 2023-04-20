<div class="flex flex-wrap justify-around mt-6 pb-12 md:mb-0 pl-3">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="mx-4 w-full">
        <div class="flex w-full">
            <div class="w-1/2"></div>
            <div class="w-1/2">
                <x-card>
                    <div class="w-full flex flex-col">
                        <livewire:components.cash-line-chart :account="$account"/>
                    </div>
                </x-card>
            </div>
        </div>
        <div class="flex mt-6">
            <div class="w-2/3">
                <x-card>
                    <h1 class="font-bold text-center">Transactions</h1>
                    @foreach($transactions as $transaction)
                        <x-card cardClasses="mb-6">
                            <div class="flex flex-col  md:flex-row">
                                <div class="w-100 md:w-10/12 mb-4 md:mb-0">
                                    <p class="font-bold">
                                        {{$transaction->completed_date}}
                                    </p>
                                    <p>
                                        {{$transaction->description}}
                                    </p>
                                </div>
                                <div class="flex justify-center items-center w-100 text-right md:w-2/12">
                                    <p class="font-bold text-xl">{{$transaction->amount}} {{$transaction->currency}}  @if($transaction->amount > 0)
                                            <span class="text-green-600"><i
                                                    class="fa-solid fa-arrow-trend-up"></i></span>
                                        @else
                                            <span class="text-red-600"><i
                                                    class="fa-solid fa-arrow-trend-down"></i></span>
                                        @endif</p>
                                </div>
                            </div>
                        </x-card>
                    @endforeach

                    <div class="flex justify-center">
                        <button>Load More...</button>
                    </div>
                </x-card>
            </div>
            <div class="w-1/3">


            </div>
        </div>
    </div>
</div>
