<canvas id="{{$id}}"></canvas>
<script>
    const ctx = document.getElementById({{Js::from($id)}});

    const chartOptions = {
        maintainAspectRatio: false,
        legend: {
            display: false,
        },
        tooltips: {
            enabled: false,
        },
        elements: {
            point: {
                radius: 0
            },
        },
        scales: {
            xAxes: [{
                gridLines: false,
                scaleLabel: false,
                ticks: {
                    display: false
                }
            }],
            yAxes: [{
                gridLines: false,
                scaleLabel: false,
                ticks: {
                    display: false,
                    suggestedMin: 0,
                    suggestedMax: 10
                }
            }]
        }
    };

    new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                borderColor: "rgba(147,51,234, 1)",
                borderWidth: 2,
                tension: 0.25,
                data: {{Js::from($data)}},
            }]
        },
        options: {
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
                    radius: 2
                },
            },
            scales: {
                x: {
                    scaleLabel: false,
                    ticks:{
                        display:false,
                    },
                    grid: {
                        display: false
                    }
                },
                y: {

                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
