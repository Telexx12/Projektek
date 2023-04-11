<div class="flex flex-col items-center p-8 rounded-lg overflow-hidden">
    <div class="hidden flex-col items-center md:justify-between w-11/12 md:flex-row mb-6 lg:flex">
        <div class=" w-11/12 mb-6 md:w-1/3 md:mr-10">
            <x-card>
                <div class="flex">
                    <div class="w-8/12">
                        <h3 class="font-bold whitespace-nowrap">Total income</h3>
                        <h1 class="text-lg xl:text-3xl font-bold mt-2 mb-2 whitespace-nowrap">{{$total_income}} RON</h1>
                    </div>
                    <div class="w-4/12 flex items-center justify-center">
                        <div class="bg-green-100 p-3 rounded-full">
                            <span class="text-xl lg:text-4xl text-green-600">
                                    <i class="fa-solid fa-arrow-trend-up">
                                    </i>
                                </span>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
        <div class="w-11/12 mb-6 md:w-1/3 md:mr-10">
            <x-card>
                <div class="flex">
                    <div class="w-8/12">
                        <h3 class="font-bold whitespace-nowrap">Total Expens</h3>
                        <h1 class="text-lg xl:text-3xl font-bold mt-2 mb-2 whitespace-nowrap">{{$total_expens}} RON</h1>
                    </div>
                    <div class="w-4/12 flex items-center justify-center">
                        <div class="bg-red-100 p-3 rounded-full">
                            <span class="text-4xl text-red-600">
                            <i class="fa-solid fa-arrow-trend-down">
                            </i>
                                </span>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
        <div class="w-11/12 mb-6 md:w-1/3">
            <x-card>
                <div class="flex">
                    <div class="w-8/12">
                        <h3 class="font-bold whitespace-nowrap">Current Balance</h3>
                        <h1 class="text-lg xl:text-3xl font-bold mt-2 mb-2 whitespace-nowrap">{{$current_balance}} RON</h1>
                    </div>
                    <div class="w-4/12 flex items-center justify-center">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <span class="text-4xl text-blue-600">
                           <i class="fa-solid fa-wallet"></i>
                                </span>
                        </div>
                    </div>
                </div>
            </x-card>
        </div>
    </div>
    <div class="overflow-y-scroll soft-scrollbar w-11/12 mb-6" style="height: 70vh;">
        <x-card class="rounded-lg">
            @foreach($transactions as $transaction)
                <div class="flex justify-center items-center">
                    <div class="mb-6 w-11/12">
                        <x-card>
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
                    </div>
                </div>
            @endforeach
        </x-card>
    </div>

    <div>
        <label for="file-upload"
               class="inline-block px-4 py-2 leading-none text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-600">
            Import transactions
        </label>
        <input id="file-upload" type="file" class="hidden" wire:model="importFile"/>
        @error('importFile')
        <span> {{$message }}</span>
        @enderror
    </div>
</div>
