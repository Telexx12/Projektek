<div class="flex flex-col md:flex-row md:pl-3 mt-6 gap-2">
    <div class="w-full order-2 md:order-1 md:w-6/12">
        <x-card cardClasses="h-full">

            <div x-data="{open:false}" class="flex justify-between gap-2 mb-2">
                <x-select
                    placeholder="Select category"
                    :options="$categories"
                    option-label="category_name"
                    option-value="id"
                    wire:model="search_category"
                    class="flex-1"
                    autocomplete="one-time-code"
                />
                <x-select
                    placeholder="Time"
                    :options="[
                            ['name' => 'Week', 'value' => 'week'],
                            ['name' => 'Month', 'value' => 'month'],
                            ['name' => '3 Month', 'value' => 'months'],
                            ['name' => 'Year', 'value' => 'year'],
                        ]"
                    option-label="name"
                    option-value="value"
                    wire:model="search_time"
                    class="flex-1"
                    autocomplete="one-time-code"
                />
                <div class="hidden md:flex px-2 rounded-full bg-red-100  items-center justify-center" wire:click="clearFilters">
                    <x-icon name="ban" class="hidden md:block w-5 h-5"/>
                </div>
                <div class="hidden md:flex px-2 rounded-full bg-blue-100  items-center justify-center" wire:click="getTransactions">
                    <x-icon name="search" class="hidden md:block w-5 h-5"/>
                </div>

            </div>
            <div class="flex gap-2">
                <button class="flex md:hidden text-sm items-center justify-center w-1/2 bg-red-100 p-2 rounded-lg" wire:click="clearFilters">
                    <div class="flex gap-2">
                        <x-icon name="ban" class="w-5 h-5"/>
                        <span>Reset filters</span>
                    </div>
                </button>
                <button class="flex md:hidden text-sm items-center justify-center w-1/2 bg-blue-100 p-2 rounded-lg"  wire:click="getTransactions">
                    <div class="flex gap-2">
                        <x-icon name="search" class="w-5 h-5"/>
                        <span>Search</span>
                    </div>
                </button>
            </div>

            <div class="flex justify-center items-center mb-2">
                <h1 class="flex items-center text-base md:text-lg font-bold text-center">Transactions</h1>
            </div>

            <div
                class="overflow-y-auto md:overflow-y-scroll md:h-[60vh] soft-scrollbar md:pr-2 md:border rounded-lg">
                @foreach($transactions as $transaction)
                    <livewire:components.transaction-card :transaction="$transaction"
                                                          :categories="$categories"
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
