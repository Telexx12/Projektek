<div class="flex flex-col justify-between mt-6 mb-2 md:mb-3  md:pl-3 rounded-lg overflow-hidden">
    <div class="flex md:justify-between w-full md:flex-row gap-1 md:gap-3">
        <div class="flex flex-col gap-2 mb-6 w-1/3">
            <x-card>
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="md:w-8/12">
                        <h3 class="text-sm font-bold whitespace-nowrap text-center md:text-left">Total income</h3>
                        <h1 class="text-sm md:text-lg xl:text-3xl font-bold mt-2 mb-2 whitespace-nowrap text-center md:text-left">{{$this->total_income}}
                            RON</h1>
                    </div>
                    <div class="md:w-4/12 flex items-center justify-center">
                        <div class="bg-green-100 p-3 px-4 md:px-3 rounded-full">
                            <span class="text-base md:text-xl lg:text-4xl text-green-600">
                                    <i class="fa-solid fa-arrow-trend-up">
                                    </i>
                                </span>
                        </div>
                    </div>
                </div>
            </x-card>

            <div class="flex gap-2">
                <x-card class="!px-1 2xl:!px-2">
                    <div class="flex flex-col justify-center items-center 2xl:flex-row gap-2">
                        <div class="flex items-center justify-center w-full 2xl:w-4/12">
                            <div>
                                <h3 class="text-sm font-bold whitespace-nowrap text-center 2xl:text-left">Monthly
                                    income</h3>
                                <h1 class="text-sm  md:text-lg xl:text-2xl font-bold mt-2 mb-2 whitespace-nowrap text-center 2xl:text-left">{{$this->monthly_income}}
                                    RON</h1>
                            </div>
                        </div>
                        <div class="w-full 2xl:w-8/12 flex flex-col items-baseline justify-center">
                            <div class="flex flex-col w-full justify-between items-center 2xl:flex-row mb-4">
                                <div class="ml-2">
                                    <h3 class="text-xs 2x font-extrabold md:whitespace-nowrap mb-1 text-center 2xl:text-left">Last month
                                        income</h3>
                                    <h1 class="text-sm md:text-lg xl:text-xl font-bold whitespace-nowrap text-center md:text-left">{{$this->last_month_income}}
                                        RON</h1>
                                </div>
                                <?php
                                if($this->income_monthly_change == "NaN")
                                    $color = "";
                                elseif($this->income_monthly_change > 0)
                                    $color = 'text-green-700';
                                elseif($this->income_monthly_change < 0)
                                    $color = 'text-red-700';
                                else{
                                    $color = "";
                                }
                                ?>
                                <h1 class="text-xs m-0 md:text-base font-extrabold md:font-bold whitespace-nowrap text-center md:text-left {{$color}} ">{{$this->income_monthly_change}}{{$this->income_monthly_change == "NaN" ? '' : '%'}}
                                    @if($this->income_monthly_change == "NaN")
                                    @elseif($this->income_monthly_change == '0.00%')
                                        <i class="fa-solid fa-equals"></i>
                                    @elseif($this->income_monthly_change != '-' && $this->income_monthly_change > 0)
                                        <i class="fa-solid fa-caret-up"></i>
                                    @elseif($this->income_monthly_change < 0 && $this->income_monthly_change != '-')
                                        <i class="fa-solid fa-caret-down"></i>
                                    @endif
                                </h1>
                            </div>


                            <div class="flex flex-col w-full justify-between items-center 2xl:flex-row mb-4">
                                <div class="ml-2">
                                    <h3 class="text-xs 2x font-extrabold md:whitespace-nowrap mb-1 text-center 2xl:text-left">Average monthly income</h3>
                                    <h1 class="text-sm md:text-lg xl:text-xl font-bold whitespace-nowrap text-center md:text-left">{{$this->average_income}} RON</h1>
                                </div>
                                <?php
                                if($this->average_income_change == "NaN")
                                    $color = "";
                                elseif($this->average_income_change > 0)
                                    $color = 'text-green-700';
                                elseif($this->average_income_change < 0)
                                    $color = 'text-red-700';
                                else{
                                    $color = "";
                                }
                                ?>
                                <h1 class="text-xs m-0 md:text-base font-extrabold md:font-bold whitespace-nowrap text-center md:text-left {{$color}} ">{{$this->average_income_change}}{{$this->average_income_change == "NaN" ? '' : '%'}}
                                    @if($this->average_income_change == "NaN")
                                    @elseif($this->average_income_change == '0.00%')
                                        <i class="fa-solid fa-equals"></i>
                                    @elseif($this->average_income_change != '-' && $this->average_income_change > 0)
                                        <i class="fa-solid fa-caret-up"></i>
                                    @elseif($this->average_income_change < 0 && $this->average_income_change != '-')
                                        <i class="fa-solid fa-caret-down"></i>
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>


        </div>
        <div class="flex flex-col gap-2 mb-6 w-1/3">
            <x-card>
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="md:w-8/12">
                        <h3 class="text-sm font-bold whitespace-nowrap text-center md:text-left">Total Expens</h3>
                        <h1 class="text-sm md:text-lg xl:text-3xl font-bold mt-2 mb-2 whitespace-nowrap text-center md:text-left">{{$this->total_expens}}
                            RON</h1>
                    </div>
                    <div class="md:w-4/12 flex items-center justify-center">
                        <div class="bg-red-100 p-3 px-4 md:px-3 rounded-full">
                            <span class="text-base md:text-xl lg:text-4xl text-red-600">
                            <i class="fa-solid fa-arrow-trend-down">
                            </i>
                                </span>
                        </div>
                    </div>
                </div>
            </x-card>




            <div class="flex gap-2">
                <x-card class="!px-1 2xl:!px-2">
                    <div class="flex flex-col justify-center items-center 2xl:flex-row gap-2">
                        <div class="flex items-center justify-center w-full 2xl:w-4/12">
                            <div>
                                <h3 class="text-sm font-bold whitespace-nowrap text-center 2xl:text-left">Monthly
                                    expens</h3>
                                <h1 class="text-sm md:text-lg xl:text-2xl font-bold mt-2 mb-2 whitespace-nowrap text-center 2xl:text-left">{{$this->monthly_expens}}
                                    RON</h1>
                            </div>
                        </div>
                        <div class="w-full 2xl:w-8/12 flex flex-col items-baseline justify-center">
                            <div class="flex flex-col w-full justify-between items-center 2xl:flex-row mb-4">
                                <div class="ml-2">
                                    <h3 class="text-xs 2x font-extrabold md:whitespace-nowrap mb-1 text-center 2xl:text-left">Last month
                                        expens</h3>
                                    <h1 class="text-sm md:text-lg xl:text-xl font-bold whitespace-nowrap text-center md:text-left">{{$this->last_month_expens}}
                                        RON</h1>
                                </div>
                                <?php
                                if($this->expens_monthly_change == "NaN")
                                    $color = "";
                                elseif($this->expens_monthly_change > 0)
                                    $color = 'text-red-700';
                                elseif($this->expens_monthly_change < 0)
                                    $color = 'text-green-700';
                                else{
                                    $color = "";
                                }
                                ?>
                                <h1 class="text-xs m-0 md:text-base font-extrabold md:font-bold whitespace-nowrap text-center md:text-left {{$color}} ">{{$this->expens_monthly_change}}{{$this->expens_monthly_change == "NaN" ? '' : '%'}}
                                    @if($this->expens_monthly_change == "NaN")
                                    @elseif($this->expens_monthly_change == '0.00%')
                                        <i class="fa-solid fa-equals"></i>
                                    @elseif($this->expens_monthly_change != '-' && $this->expens_monthly_change > 0)
                                        <i class="fa-solid fa-caret-up"></i>
                                    @elseif($this->expens_monthly_change < 0 && $this->expens_monthly_change != '-')
                                        <i class="fa-solid fa-caret-down"></i>
                                    @endif
                                </h1>
                            </div>


                            <div class="flex flex-col w-full justify-between items-center 2xl:flex-row mb-4">
                                <div class="ml-2">
                                    <h3 class="text-xs 2x font-extrabold md:whitespace-nowrap mb-1 text-center 2xl:text-left">Average monthly expens</h3>
                                    <h1 class="text-sm md:text-lg xl:text-xl font-bold whitespace-nowrap text-center md:text-left">{{$this->average_expens}} RON</h1>
                                </div>
                                <?php
                                if($this->average_expense_change == "NaN")
                                    $color = "";
                                elseif($this->average_expense_change > 0)
                                    $color = 'text-red-700';
                                elseif($this->average_expense_change < 0)
                                    $color = 'text-green-700';
                                else{
                                    $color = "";
                                }
                                ?>
                                <h1 class="text-xs m-0 md:text-base font-extrabold md:font-bold whitespace-nowrap text-center md:text-left {{$color}} ">{{$this->average_expense_change}}{{$this->average_expense_change == "NaN" ? '' : '%'}}
                                    @if($this->average_expense_change == "NaN")
                                    @elseif($this->average_expense_change == '0.00%')
                                        <i class="fa-solid fa-equals"></i>
                                    @elseif($this->average_expense_change != '-' && $this->average_expense_change > 0)
                                        <i class="fa-solid fa-caret-up"></i>
                                    @elseif($this->average_expense_change < 0 && $this->average_expense_change != '-')
                                        <i class="fa-solid fa-caret-down"></i>
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>

        </div>
        <div class="flex flex-col gap-2 mb-6 w-1/3">
            <x-card>
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="md:w-8/12">
                        <h3 class="text-sm font-bold whitespace-nowrap text-center md:text-left">Current Balance</h3>
                        <h1 class="text-sm md:text-lg xl:text-3xl font-bold mt-2 mb-2 whitespace-nowrap text-center md:text-left">{{$this->current_balance}}
                            RON</h1>
                    </div>
                    <div class="md:w-4/12 flex items-center justify-center">
                        <div class="bg-blue-100 p-3 px-4 rounded-full">
                            <span class="text-base md:text-xl lg:text-4xl text-blue-600">
                           <i class="fa-solid fa-wallet"></i>
                                </span>
                        </div>
                    </div>
                </div>
            </x-card>

            <div class="flex gap-2 flex-1">
                <x-card class="!px-1 2xl:!px-2">
                    <div class="flex flex-col justify-center h-full items-center 2xl:flex-row gap-2">
                        <div class="flex items-center justify-center w-full 2xl:w-4/12">
                            <div>
                                <h3 class="text-xs 2x font-extrabold md:whitespace-nowrap mb-1 text-center 2xl:text-left">Last month balance</h3>
                                <h1 class="text-sm md:text-lg xl:text-2xl font-bold mt-2 mb-2 whitespace-nowrap text-center 2xl:text-left">{{$this->last_month_balance}}
                                    RON</h1>
                            </div>
                        </div>
                        <div class="w-full 2xl:w-8/12 flex flex-col items-center justify-center">
                            <div class="flex flex-col w-full justify-center items-center 2xl:flex-row">
                                <?php
                                if($this->balance_change == "NaN")
                                    $color = "";
                                elseif($this->balance_change > 0)
                                    $color = 'text-green-700';
                                elseif($this->balance_change < 0)
                                    $color = 'text-red-700';
                                else{
                                    $color = "";
                                }
                                ?>
                                <h1 class="text-xs m-0 md:text-base font-extrabold md:font-bold whitespace-nowrap text-center md:text-left {{$color}} ">{{$this->balance_change}}{{$this->balance_change == "NaN" ? '' : '%'}}
                                    @if($this->balance_change == "NaN")
                                    @elseif($this->balance_change == '0.00%')
                                        <i class="fa-solid fa-equals"></i>
                                    @elseif($this->balance_change != '-' && $this->balance_change > 0)
                                        <i class="fa-solid fa-caret-up"></i>
                                    @elseif($this->balance_change < 0 && $this->balance_change != '-')
                                        <i class="fa-solid fa-caret-down"></i>
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</div>
