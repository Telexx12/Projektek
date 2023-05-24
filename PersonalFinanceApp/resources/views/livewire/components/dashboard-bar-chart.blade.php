<div class="border border-2 w-full h-full rounded-lg p-3"
     wire:ignore
     x-data="{
          barChart:@entangle('data'),



            init(){

                  const monthNames = ['January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December'];

                   let showNames = [];
                   let values = [];

                 for (let key in this.barChart) {
                  if (this.barChart.hasOwnProperty(key)) {
                        showNames.push(monthNames[key-1]);
                        values.push(this.barChart[key]);
                  }
                }

                const data = {
                  labels: showNames,
                  datasets: [{
                    data: values,
                    backgroundColor: [
                      'rgba(255, 99, 132)',
                      'rgba(255, 159, 64)',
                      'rgba(255, 205, 86)'
                    ],
                    borderColor: [
                      'rgb(255, 99, 132)',
                      'rgb(255, 159, 64)',
                      'rgb(255, 205, 86)'
                    ],
                    borderWidth: 1
                  }]
                };

                const myChart = new Chart(this.$refs.transactionBarChart,{
                     type: 'bar',
                      data: data,
                      options: {
                        responsive:true,

                        maintainAspectRatio:false,
                        plugins:{
                                legend:{
                                    display:false,
                                },
                                tooltip:{
                                    enabled:true,
                                },
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

                Livewire.on('updateBarChart', () => {

                    showNames = [];
                    values = [];

                     for (let key in this.barChart) {
                      if (this.barChart.hasOwnProperty(key)) {
                            showNames.push(monthNames[key-1]);
                            values.push(this.barChart[key]);
                      }
                    }

                     myChart.data.datasets[0].data =  values;
                    myChart.data.labels = showNames;

                    myChart.update();
                });
            }
        }"
>
    <h1 class="text-center text-lg font-bold">Number of transactions</h1>
    <div class="w-full min-h-[40vh] h-[60%] flex justify-center mb-2 relative">

        <canvas id="transaction-bar-chart" x-ref="transactionBarChart"></canvas>
    </div>
</div>
