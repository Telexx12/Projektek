<div class="border border-2 w-full rounded-lg p-3"
     wire:ignore
     x-data="{

            chartDatas:@entangle('chartDatas'),

            init(){
                const myChart = new Chart(this.$refs.canvas,{
                    type: 'line',
                    data: {
                        datasets: [{
                            borderColor: 'rgba(147,51,234, 1)',
                            borderWidth: 2,
                            tension: 0.25,
                            data: this.chartDatas,
                            }]
                    },
                    options: {
                            responsive:true,
                            maintainAspectRatio: false,
                            plugins:{
                                legend:{
                                    display:false,
                                },
                                tooltip:{
                                    enabled:true,
                                },
                            },
                            elements: {
                                point: {
                                    radius: 0.1
                                },
                                line:{

                                }
                            },
                            scales: {
                                x: {
                                    scaleLabel: false,
                                    ticks:{
                                        display:false,
                                        sampleSize: 20,
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    ticks:{
                                        display:true,
                                        padding:10,
                                        sampleSize: 20,
                                    },
                                    border: {
                                        dash: [10, 10],
                                        display: true
                                    },
                                    grid: {
                                        drawTicks: false,
                                        display: true
                                    }
                                }
                            }
                    }
                });

                Livewire.on('updateChart', () => {


                    myChart.data.datasets[0].data =  this.chartDatas;

                    myChart.update();
                });
            }
        }"



>
    <h1 class="text-center font-bold">Chart</h1>
    <div class="w-full relative h-60 md:h-80">
        <canvas id="cash-line-chart" class="w-100" x-ref="canvas"></canvas>
    </div>
    <div class="flex justify-between border rounded-lg">
        <div class="flex flex-1 items-center rounded-l-lg border-r">
            <input id="chartRadioWeek" type="radio" class="hidden peer" value="week"
                   name="chartRadio" wire:model="selectedRadio"
            >
            <label for="chartRadioWeek"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">1
                Week</label>
        </div>
        <div class="flex flex-1 items-center border-r">
            <input id="chartRadioMonth" type="radio" class="hidden peer" value="month"
                   name="chartRadio" wire:model="selectedRadio">
            <label for="chartRadioMonth"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">1
                Month</label>
        </div>
        <div class="flex flex-1 items-center border-r">
            <input id="chartRadioMonths" type="radio" class="hidden peer" value="months"
                   name="chartRadio" wire:model="selectedRadio">
            <label for="chartRadioMonths"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">3
                Month</label>
        </div>
        <div class="flex flex-1 items-center border-r">
            <input id="chartRadioYear" type="radio" class="hidden peer" value="year"
                   name="chartRadio" wire:model="selectedRadio">
            <label for="chartRadioYear"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">1
                Year</label>
        </div>
        <div class="flex flex-1 items-center">
            <input id="chartRadioAll" type="radio" class="hidden peer" value="all"
                   name="chartRadio" wire:model="selectedRadio">
            <label for="chartRadioAll"
                   class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">All</label>
        </div>
    </div>
</div>
