let delayed;
const contribution = document.getElementById("contribution");
const position = document.getElementById("position");

const contributionChart = new Chart(contribution, {
    type: 'line',
    data: {
        labels: contChartLabels,
        datasets: [{
            data: contChartData,
            backgroundColor: "rgba(48, 164, 255, 0.2)",
            borderColor: "rgba(48, 164, 255, 0.8)",
            fill: true,
            borderWidth: 1
        }]
    },
    options: {
        animations: {
            radius: {
                duration: 400,
                easing: 'linear',
                loop: (context) => context.active
            }
        },
        plugins: {
            legend: {
                display: false,
                position: 'right',
            },
            title: {
                display: true,
                text: 'Contributed Amounts',
                position: 'left',
            },
        },
    }
});

const positionChart = new Chart(position, {
    type: 'bar',
    data: {
        labels: posChartLabels,
        datasets: [{
            label: 'Income',
            data: posChartData,
            backgroundColor: "rgba(76, 175, 80, 0.5)",
            borderColor: "#6da252",
            borderWidth: 1,
        }]
    },
    options: {
        animation: {
            onComplete: () => {
                delayed = true;
            },
            delay: (context) => {
                let delay = 0;
                if (context.type === 'data' && context.mode === 'default' && !delayed) {
                    delay = context.dataIndex * 300 + context.datasetIndex * 100;
                }
                return delay;
            },
        },
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true
            }
        },
        plugins: {
            legend: {
                display: false,
                position: 'top',
            },
            title: {
                display: true,
                text: 'Number of Users',
                position: 'left',
            },
        },
    }
});
