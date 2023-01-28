<div wire:ignore
    x-data="{
        selectedYear: @entangle('selectedYear'),
        lastYearOrders: @entangle('lastYearOrders'),
        thisYearOrders: @entangle('thisYearOrders'),
    }">

    <h2 class="text-white">Charts</h2>
    <div class="my-6">
        <div class="text-white"><span x-text="selectedYear - 1"></span>: <span x-text="lastYearOrders.reduce((a, b) => a + b)"></span></div>
        <div class="text-white"><span x-text="selectedYear"></span>: <span x-text="thisYearOrders.reduce((a,b) => a + b)"></span></div>
    </div>
    <div class="mt-4"
         x-data="{


        init(){
            const labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Last Year Orders',
                    backgroundColor: 'lightgray',
                    data: this.lastYearOrders
                },{
                    label: 'This Year Orders',
                    backgroundColor: 'lightgreen',
                    data: this.thisYearOrders
                }]
            };

            const config = {
                type:'bar',
                data: data,
                options:{
                }
            };

            const myChart = new Chart(this.$refs.canvas,config);

            Livewire.on('updateChart', () => {
                 myChart.data.datasets[0].label = `${this.selectedYear -1} Orders`;
                myChart.data.datasets[1].label = `${this.selectedYear} Orders`;
                myChart.data.datasets[0].data = this.lastYearOrders;
                myChart.data.datasets[1].data = this.thisYearOrders;

                myChart.update();

            })

        }
     }"

    >
        <label for="selectedYear" class="text-white mr-4">Year:</label>
        <select name="selectedYear" id="selectedYear" class="border" wire:model="selectedYear"
                wire:change="updateOrdersCount">
            @foreach($availableYears as $year)
                <option value="{{$year}}">{{$year}}</option>
            @endforeach

        </select>
        <div>
            <canvas id="myChart" x-ref="canvas"></canvas>
        </div>

    </div>
</div>
