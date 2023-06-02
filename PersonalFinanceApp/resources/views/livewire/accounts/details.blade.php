<div class="flex flex-wrap justify-around mt-6 pb-12 md:mb-0 pl-3">
    <script src="{{ asset('assets/js/chart.umd.js') }}"></script>

    <div class="mx-4 w-full">
        <div class="flex w-full flex-col md:flex-row gap-2">
            <div class="w-full  md:w-1/2">
                <x-card>
                    <div class="w-full flex flex-col">
                        <livewire:components.category-pie-chart :account="$account"/>
                    </div>
                </x-card>
            </div>
            <div class="w-full  md:w-1/2">
                <x-card>
                    <div class="w-full flex flex-col">
                        <livewire:components.cash-line-chart :account="$account"/>
                    </div>
                </x-card>
            </div>
        </div>
        <div class="flex flex-col md:flex-row mt-6 gap-2">
            <div class="w-full order-2 md:order-1 md:w-8/12">
                <x-card cardClasses="h-full">
                    <div class="flex justify-between items-center mb-2">
                        <div></div>
                        <h1 class="flex items-center text-base md:text-lg font-bold text-center">Transactions</h1>
                        <div class="p-1 px-2.5 rounded-full bg-blue-100" wire:click="openTransactionCreateModel">
                            <span class="text-lg md:text-2xl text-blue-600"><i class="fa-solid fa-plus"></i></span>
                        </div>
                    </div>
                    <div
                        class="overflow-y-auto md:overflow-y-scroll md:h-[60vh] soft-scrollbar md:pr-2 md:border rounded-lg">
                        @foreach($transactions as $transaction)
                            <livewire:components.transaction-card :categories="$categories"
                                                                  :transaction="$transaction"
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
            <div class="w-full order-1 md:order-2 md:w-4/12">
                <x-card cardClasses="h-full">
                    <div class="w-full h-full flex flex-col">
                        <livewire:components.transaction-bar-chart :account="$account"/>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
    <x-modal.card title="Create Transaction" blur wire:model.defer="createTransactionModal">
        <div x-data="{method : true}">
            <div class="flex w-100 rounded-lg border mb-2">
                <div class="flex flex-1 items-center rounded-l-lg border-r">
                    <input id="type" type="radio" class="peer hidden" name="radio" wire:model="transactionMethod"
                           value="1">
                    <label for="type"
                           class="text-sm rounded-l-lg font-semibold w-full h-full flex items-center justify-center p-2 bg-white-100 peer-checked:bg-blue-100"
                           x-on:click="method = true">
                        Manual
                    </label>
                </div>
                <div class="flex flex-1 items-center rounded-r-lg border-r">
                    <input id="type.1" type="radio" class="peer hidden" name="radio" wire:model="transactionMethod"
                           value="0">
                    <label for="type.1"
                           class="text-sm rounded-r-lg font-semibold w-full h-full flex items-center justify-center p-2 bg-white-100 peer-checked:bg-blue-100"
                           x-on:click="method = false">
                        Import
                    </label>
                </div>
            </div>

            <div>
                <div x-show="method">
                    <x-datetime-picker
                        wire:model.defer="transaction_completed_date"
                        label="Transaction date"
                        without-time="true"
                        without-tips="true"
                    />
                    <div class="mt-2 flex flex-col md:flex-row justify-content-between gap-2">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1"
                                   for="currency_select">Select
                                currency</label>
                            <select id="currency_select" wire:model="transaction_currency"
                                    class=" placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm">
                                <option class="h-8 w-full animate-pulse bg-slate-200 dark:bg-slate-600 rounded"
                                        value="RON">RON
                                </option>
                            </select>
                        </div>

                        <x-inputs.number label="Transaction amount" wire:model="transaction_amount"/>


                    </div>
                    <div class="mt-2">
                        <x-textarea wire:model="transaction_description" label="Description"
                                    placeholder="Write a description"/>
                    </div>
                    <div class="mt-2">
                        <x-input label="Comment" placeholder="Comment" wire:model="transaction_comment"/>
                    </div>
                </div>

                <div x-show="!method">
                    <div x-data="{ files: null }" id="FileUpload"
                         class="block w-full relative bg-white appearance-none rounded-md hover:shadow-outline-gray">
                        <input type="file"
                               accept=".xlsx,.csv"
                               class="absolute inset-0 m-0 p-0 w-full h-full outline-none opacity-0"
                               x-on:change="files = $event.target.files;"
                               x-on:dragover="$el.classList.add('active')"
                               x-on:dragleave="$el.classList.remove('active')"
                               x-on:drop="$el.classList.remove('active')"
                               wire:model="importFile"
                        >
                        <template x-if="files !== null">
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-center justify-center w-full" id="dropzone-file">
                                    <label for="dropzone-file"
                                           class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fa-solid fa-file-excel text-5xl mb-4"></i>
                                            <p class="font-sm text-gray-500" x-text="files[0].name"></p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </template>
                        <template x-if="files === null">
                            <div class="flex items-center justify-center w-full" id="dropzone-file">
                                <label for="dropzone-file"
                                       class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fa-solid fa-cloud-arrow-up text-5xl mb-4"></i>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span>
                                            or drag and drop</p>
                                        <p class="text-sm text-gray-500">exported transactions</p>
                                    </div>
                                </label>
                            </div>
                        </template>
                    </div>

                </div>
            </div>
        </div>


        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button class="w-1/2 sm:w-auto" outline red flat label="Cancel" x-on:click="close"/>
                <x-button class="w-1/2 sm:w-auto" primary label="Save" wire:click="saveTransaction"/>
            </div>
        </x-slot>
    </x-modal.card>
</div>




