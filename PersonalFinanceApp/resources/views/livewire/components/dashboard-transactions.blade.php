    <div class="flex flex-col md:flex-row md:pl-3 mt-6 gap-2">
        <div class="w-full order-2 md:order-1 md:w-6/12">
            <x-card cardClasses="h-full">
                <div class="flex justify-center items-center mb-2">
                    <h1 class="flex items-center text-base md:text-lg font-bold text-center">Transactions</h1>
                </div>
                <div
                    class="overflow-y-auto md:overflow-y-scroll md:h-[60vh] soft-scrollbar md:pr-2 md:border rounded-lg">
                    @foreach($transactions as $transaction)
                        <livewire:components.transaction-card :transaction="$transaction"
                                                              :hide="true"
                                                              :wire:key="'transaction-'.$transaction->id"/>
                    @endforeach
                    <div class="block md:hidden flex justify-center mt-3">
                        <x-button purple wire:click="incrementNumberOfTransactions">Load more...</x-button>
                    </div>
                </div>
                <div class="hidden md:flex justify-center mt-3">
                    <x-button purple wire:click="incrementNumberOfTransactions">Load more...</x-button>
                </div>
            </x-card>
        </div>
    </div>
