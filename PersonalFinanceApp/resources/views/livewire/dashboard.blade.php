<div class="px-3">
    <script src="{{ asset('assets/js/chart.umd.js') }}"></script>
    <livewire:components.dashboard-cards/>
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

    <livewire:components.ai-section/>
</div>

