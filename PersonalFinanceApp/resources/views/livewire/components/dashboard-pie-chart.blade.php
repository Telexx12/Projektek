<div class="border border-2 h-full w-full rounded-lg p-3"
     wire:ignore
     x-data="{
            chartDatas:@entangle('pieChartValues'),
            chartNames:@entangle('pieChartNames'),
            chartColors:@entangle('pieChartColors'),


            init(){

                let labels = [];
                let values = [];
                let colors = [];

                for (let key in this.chartDatas) {
                  if (this.chartDatas.hasOwnProperty(key)) {
                    labels.push(this.chartNames[key])
                  }
                }

                 for (let key in this.chartDatas) {
                  if (this.chartDatas.hasOwnProperty(key)) {
                    values.push(this.chartDatas[key]);
                  }
                }


                 for (let key in this.chartDatas) {
                  if (this.chartDatas.hasOwnProperty(key)) {
                    colors.push(this.chartColors[key]);
                  }
                }

                const myChart = new Chart(this.$refs.pieChartCanvas,{
                    type: 'pie',
                    data:{
                        labels: labels,
                        datasets: [
                            {
                                data: values,
                                backgroundColor: colors,
                            }]
                     },
                     options: {
                       responsive:true,
                       plugins:{
                            legend: {
                                display: false,
                                position: 'bottom'
                            },
                       }
                    }
                });

                Livewire.on('updateChart', () => {

                labels = [];
                values = [];
                colors = [];

                for (let key in this.chartDatas) {
                  if (this.chartDatas.hasOwnProperty(key)) {
                     labels.push(this.chartNames[key])
                     }
                  }

                 for (let key in this.chartDatas) {
                  if (this.chartDatas.hasOwnProperty(key)) {
                    values.push(this.chartDatas[key]);
                  }
                }


                 for (let key in this.chartDatas) {
                  if (this.chartDatas.hasOwnProperty(key)) {
                    colors.push(this.chartColors[key]);
                  }
                }


                    myChart.data.datasets[0].data =  values;
                    myChart.data.labels = labels;
                     myChart.data.datasets[0].backgroundColor =  colors;

                    myChart.update();
                });
            }
        }"
>
    <div class="flex justify-between border rounded-lg mb-2">
        <div class="flex flex-1 items-center rounded-l-lg border-r">
            <input id="pieMethodIncome" type="radio" class="hidden peer" value="1"
                   name="pieMethod" wire:model="pieMethod"
            >
            <label for="pieMethodIncome"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">Incomes</label>
        </div>
        <div class="flex flex-1 items-center border-r">
            <input id="pieMethodExpenses" type="radio" class="hidden peer" value="0"
                   name="pieMethod" wire:model="pieMethod">
            <label for="pieMethodExpenses"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">Expenses</label>
        </div>
    </div>


    <div class="w-full flex justify-center mb-2 relative h-60 md:h-80">
        <canvas id="category-pie-chart" class="w-full" x-ref="pieChartCanvas"></canvas>
    </div>
    <div class="flex justify-between border rounded-lg">
        <div class="flex flex-1 items-center rounded-l-lg border-r">
            <input id="pieChartRadioWeek" type="radio" class="hidden peer" value="week"
                   name="pieChartRadio" wire:model="selectedRadio"
            >
            <label for="pieChartRadioWeek"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">1
                Week</label>
        </div>
        <div class="flex flex-1 items-center border-r">
            <input id="pieChartRadioMonth" type="radio" class="hidden peer" value="month"
                   name="pieChartRadio" wire:model="selectedRadio">
            <label for="pieChartRadioMonth"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">1
                Month</label>
        </div>
        <div class="flex flex-1 items-center border-r">
            <input id="pieChartRadioMonths" type="radio" class="hidden peer" value="months"
                   name="pieChartRadio" wire:model="selectedRadio">
            <label for="pieChartRadioMonths"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">3
                Month</label>
        </div>
        <div class="flex flex-1 items-center border-r">
            <input id="pieChartRadioYear" type="radio" class="hidden peer" value="year"
                   name="pieChartRadio" wire:model="selectedRadio">
            <label for="pieChartRadioYear"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">1
                Year</label>
        </div>
        <div class="flex flex-1 items-center">
            <input id="pieChartRadioAll" type="radio" class="hidden peer" value="all"
                   name="pieChartRadio" wire:model="selectedRadio">
            <label for="pieChartRadioAll"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">All</label>
        </div>
    </div>
</div>
