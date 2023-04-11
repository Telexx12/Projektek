<div class="flex flex-wrap justify-around mt-6 pb-12 md:mb-0 pl-3">
    <x-loading-icon/>
    <button wire:click="open" class="mb-6 mr-3 w-full sm:w-[46.5%] md:w-[46.5%] lg:w-[45%] 2xl:w-[30%]" wire:ignore>
        <x-card cardClasses="h-full">
            <div class="flex w-full h-full justify-center items-center flex-col">
                <div class="flex justify-center items-center">
                    <div class="p-6 px-7 rounded-full bg-blue-100">
                        <span class="text-5xl text-blue-600"><i class="fa-solid fa-plus"></i></span>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <h3 class="font-bold">Add account</h3>
                </div>
            </div>
        </x-card>
    </button>

    @foreach($accounts as $account)
        <div class="mb-6 mr-3 w-full sm:w-[46.5%] md:w-[46.5%] lg:w-[45%] 2xl:w-[30%]" id="{{$account->id}}">
            <x-card cardClasses="h-full">
                <div>
                    <div class="flex justify-between">
                        <div class="flex-1 overflow-hidden text-ellipsis">
                            <h3 class="font-semibold text-xl mb-3 max-w-lg overflow-hidden text-ellipsis whitespace-nowrap">{{$account->account_name}}</h3>
                        </div>
                        <div class="flex-2 flex justify-end">
                            <div class="mr-4 hidden xl:block">
                                <div class="flex border rounded-lg">
                                    <div
                                        class="flex items-center rounded-l-lg border-r {{$this->comparisonBasicChecked($account->id,'day') ? 'bg-blue-100' : ''}}">
                                        <input id="{{$account->id}}.1" type="radio" class="hidden"
                                               wire:model="comparisonBasic.{{$account->id}}" value="day"
                                        >
                                        <label for="{{$account->id}}.1"
                                               class="text-sm font-semibold w-full h-full flex items-center p-2">Day</label>
                                    </div>
                                    <div
                                        class="flex items-center border-r {{$this->comparisonBasicChecked($account->id,'week') ? 'bg-blue-100' : ''}}">
                                        <input id="{{$account->id}}.2" type="radio" class="hidden"
                                               wire:model="comparisonBasic.{{$account->id}}" value="week"
                                        >
                                        <label for="{{$account->id}}.2"
                                               class="text-sm font-semibold w-full h-full flex items-center p-2">Week</label>
                                    </div>
                                    <div
                                        class="flex items-center rounded-r-lg {{$this->comparisonBasicChecked($account->id,'month') ? 'bg-blue-100' : ''}}">
                                        <input id="{{$account->id}}.3" type="radio" class="hidden"
                                               wire:model="comparisonBasic.{{$account->id}}" value="month"
                                        >
                                        <label for="{{$account->id}}.3"
                                               class="text-sm font-semibold w-full h-full flex items-center p-2">Month</label>
                                    </div>
                                </div>
                            </div>
                            <button class="text-blue-700 mr-6 text-xl md:mr-2 md:text-base"
                                    wire:click="editAccount({{$account->id}})"><i
                                    class="fa-solid fa-pen"></i></button>
                            <button class="text-red-700 text-xl md:text-base"
                                    wire:click="confirmDelete({{$account->id}},'{{$account->account_name}}')"><i
                                    class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="flex w-full">
                        <div class="flex items-end w-16 sm:w-[20%] lg:w-1/5 ml-2">
                            @if(!is_null($account->bank))
                                <img src='{{asset("storage/{$account->bank->icon_name}")}}'>
                                <span class="font-bold md:text-xl ml-2 mb-6">{{$account->bank->bank_name}}</span>
                            @else
                                <img src='{{asset("storage/cash_icon.png")}}'>
                            @endif
                        </div>
                        <div class="flex flex-col items-end justify-end w-4/5">
                                <?php
                                if (array_key_exists($account->id, $this->comparisonBasic)) {
                                    if ($this->comparisonBasic[$account->id] == 'month') {
                                        $amount = $account->month_ago;
                                    } elseif ($this->comparisonBasic[$account->id] == 'week') {
                                        $amount = $account->week_ago;
                                    } else {
                                        $amount = $account->day_ago;
                                    }
                                } else {
                                    $amount = $account->month_ago;
                                }

                                $change = $this->calculateChange($account->transactions_sum_amount, $amount);
                                if ($change == '-' || $change == '0.00%') {
                                    $color = '';
                                } elseif ($change < 0) {
                                    $color = 'text-red-700';
                                } elseif ($change > 0) {
                                    $color = 'text-green-700';
                                } else {
                                    $color = "";
                                }

                                ?>
                            <p class="mr-2 font-bold text-xs md:text-sm {{$color}}">{{$change}}
                                @if($change == '0.00%')
                                    <i class="fa-solid fa-equals"></i>
                                @elseif($change != '-' && $change > 0)
                                    <i class="fa-solid fa-caret-up"></i>
                                @elseif($change < 0 && $change != '-')
                                    <i class="fa-solid fa-caret-down"></i>
                                @endif</p>
                            <p class="mr-2 font-bold md:text-lg lg:text-xl">{{is_null($account->transactions_sum_amount) ? '0': $account->transactions_sum_amount}}
                                RON</p>
                        </div>
                    </div>
                    <div class="block mt-3 xl:hidden">
                        <div class="flex justify-center">
                            <div class="flex border w-full lg:w-2/3 justify-between rounded-lg">
                                <div
                                    class="flex flex-1 items-center rounded-l-lg border-r {{$this->comparisonBasicChecked($account->id,'day') ? 'bg-blue-100' : ''}}">
                                    <input id="{{$account->id}}.1" type="radio" class="hidden"
                                           wire:model="comparisonBasic.{{$account->id}}" value="day"
                                    >
                                    <label for="{{$account->id}}.1"
                                           class="text-sm font-semibold w-full h-full flex justify-center items-center p-2">Day</label>
                                </div>
                                <div
                                    class="flex flex-1 items-center border-r {{$this->comparisonBasicChecked($account->id,'week') ? 'bg-blue-100' : ''}}">
                                    <input id="{{$account->id}}.2" type="radio" class="hidden"
                                           wire:model="comparisonBasic.{{$account->id}}" value="week"
                                    >
                                    <label for="{{$account->id}}.2"
                                           class="text-sm font-semibold w-full h-full flex justify-center items-center p-2">Week</label>
                                </div>
                                <div
                                    class="flex flex-1 items-center rounded-r-lg {{$this->comparisonBasicChecked($account->id,'month') ? 'bg-blue-100' : ''}}">
                                    <input id="{{$account->id}}.3" type="radio" class="hidden"
                                           wire:model="comparisonBasic.{{$account->id}}" value="month"
                                    >
                                    <label for="{{$account->id}}.3"
                                           class="text-sm font-semibold w-full h-full flex justify-center items-center p-2">Month</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    @endforeach





    <x-modal blur wire:model="createAccountModal" align="start">
        <x-card title="Create Account" class="text-base" x-init="details = false;">
            <div class="flex w-100 rounded-lg border"
                 x-data="{  types: @entangle('accountTypes'), selectedType: @entangle('selectedType')} ">
                @foreach($accountTypes as $type)
                    <div
                        class="flex flex-1 items-center {{$loop->iteration == 1 ? 'rounded-l-lg' : ''}} {{$loop->last ? 'rounded-r-lg' : ''}} border-r">
                        <input id="type_{{$loop->iteration}}" type="radio" class="peer hidden"
                               x-model="selectedType" value="{{$type->id}}"
                               x-on:change="if(selectedType == 2) details = true; else details = false;"
                        >
                        <label for="type_{{$loop->iteration}}"
                               class="text-sm {{$loop->iteration == 1 ? 'rounded-l-lg' : ''}} {{$loop->last ? 'rounded-r-lg' : ''}} font-semibold w-full h-full flex items-center justify-center p-2 bg-white-100 peer-checked:bg-blue-100">
                            <img class="rounded-full w-1/6 sm:w-1/12 mr-1" src="{{asset("storage/{$type->icon_name}")}}">
                            {{$type->account_type}}
                        </label>
                    </div>
                @endforeach
            </div>

            <x-input label="Account name" wire:model.lazy="accountName"></x-input>
            <div>
                <div x-show="details">
                    <div x-data="{selectedBank:@entangle('bank')}"
                         class="flex flex-wrap justify-around mt-3 mb-3 gap-y-3 gap-x-2">
                        @foreach($banks as $bank)
                            <div class="w-[30%] sm:w-1/6 rounded-lg border">
                                <input id="bank_{{$loop->iteration}}" type="radio" class="peer hidden"
                                       x-model="selectedBank" value="{{$bank->id}}">
                                <label for="bank_{{$loop->iteration}}"
                                       class="text-sm font-semibold w-full rounded-lg h-full flex items-center justify-center p-2 bg-white-100 peer-checked:bg-blue-100">
                                    <img class="w-1/3  mr-2" src="{{asset("storage/{$bank->icon_name}")}}">
                                    {{$bank->bank_name}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-col flex-grow mb-3">
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

            <x-errors only="importFile"/>

            <x-slot name="footer">
                <div class="flex justify-between sm:justify-end gap-x-4">
                    <x-button class="w-1/2 sm:w-auto" outline gray flat label="Cancel" x-on:click="close"/>
                    <x-button class="w-1/2 sm:w-auto" primary label="Save" wire:click="createAccount"/>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur wire:model="editAccountModal" align="start" wire:key="{{rand()}}">
        <x-card title="Edit Account" class="text-base"
                x-init="edit_details = {{$selectedType == 2 ? 'true' : 'false'}};">
            <div class="flex w-100 rounded-lg border"
                 x-data="{edit_selectedType: @entangle('selectedType')}">
                @foreach($accountTypes as $type)
                    <div
                        class="flex flex-1 items-center {{$loop->iteration == 1 ? 'rounded-l-lg' : ''}} {{$loop->last ? 'rounded-r-lg' : ''}} border-r">
                        <input id="edit_type_{{$loop->iteration}}" type="radio" class="peer hidden"
                               x-model="edit_selectedType" value="{{$type->id}}"
                               x-on:change="if(edit_selectedType == 2) edit_details = true; else edit_details = false;"
                        >
                        <label for="edit_type_{{$loop->iteration}}"
                               class="text-sm {{$loop->iteration == 1 ? 'rounded-l-lg' : ''}} {{$loop->last ? 'rounded-r-lg' : ''}} font-semibold w-full h-full flex items-center justify-center p-2 bg-white-100 peer-checked:bg-blue-100">
                            <img class="rounded-full w-1/12 mr-1" src="{{asset("storage/{$type->icon_name}")}}">
                            {{$type->account_type}}
                        </label>
                    </div>
                @endforeach
            </div>

            <x-input label="Account name" wire:model.lazy="accountName"></x-input>
            <div>
                <div x-show="edit_details">
                    <div x-data="{edit_selectedBank:@entangle('bank')}"
                         class="flex flex-wrap justify-around mt-3 mb-3 gap-y-3 gap-x-2">
                        @foreach($banks as $bank)
                            <div class="w-1/6 rounded-lg border">
                                <input id="edit_bank_{{$loop->iteration}}" type="radio" class="peer hidden"
                                       x-model="edit_selectedBank" value="{{$bank->id}}">
                                <label for="edit_bank_{{$loop->iteration}}"
                                       class="text-sm font-semibold w-full rounded-lg h-full flex items-center justify-center p-2 bg-white-100 peer-checked:bg-blue-100">
                                    <img class="w-1/3  mr-2" src="{{asset("storage/{$bank->icon_name}")}}">
                                    {{$bank->bank_name}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"/>
                    <x-button primary label="Edit" wire:click="saveEditedAccount({{$selectedAccount}})"/>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

</div>



