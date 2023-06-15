
<div class="px-3">
    <script src="{{ asset('assets/js/chart.umd.js') }}"></script>
    <x-dashboard-cards
        :total_income="$total_income"
        :monthly_income="$monthly_income"
        :last_month_income="$last_month_income"
        :income_monthly_change="$income_monthly_change"
        :averaga_income="$average_income"
        :total_expens="$total_expens"
        :monthly_expens="$monthly_expens"
        :last_month_expens="$last_month_expens"
        :expens_monthly_change="$expens_monthly_change"
        :average_expens="$average_expens"
        :average_expens_change="$average_expense_change"
        :current_balance="$current_balance"
        :last_month_balance="$last_month_balance"
        :balance_change="$balance_change"
    />


    <div class="flex flex-col lg:flex-row gap-1 md:pl-3">
        <div class="lg:w-5/12">
            <livewire:components.dashboard-cash-line-chart/>
        </div>
        <div class=" lg:w-5/12">
            <livewire:components.dashboard-pie-chart/>
        </div>
        <div class="lg:w-2/12">
            <livewire:components.dashboard-bar-chart/>
        </div>
    </div>

    <livewire:components.dashboard-transactions/>

    <livewire:components.ai-section
        :total_income="$total_income"
        :monthly_income="$monthly_income"
        :last_month_income="$last_month_income"
        :income_monthly_change="$income_monthly_change"
        :average_income="$average_income"
        :average_income_change="$average_income_change"
        :total_expens="$total_expens"
        :monthly_expens="$monthly_expens"
        :last_month_expens="$last_month_expens"
        :expens_monthly_change="$expens_monthly_change"
        :average_expens="$average_expens"
        :average_expens_change="$average_expense_change"
        :current_balance="$current_balance"
        :last_month_balance="$last_month_balance"
        :balance_change="$balance_change"
    />
</div>

