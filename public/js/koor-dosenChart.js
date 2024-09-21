document.addEventListener('DOMContentLoaded', function () {
    console.log("Dosen chart JS loaded");
    const dosenData = window.dosenData;

    console.log(dosenData);

    const dosenLabels = dosenData.map(d => d.nama);
    const dosenKuotas = dosenData.map(d => {
        const pembimbing = d.dosen_pembimbing;
        return pembimbing ? pembimbing.kuota : 0;
    });

    var dosenChartOptions = {
        series: [{
            name: 'Kuota Mahasiswa TA',
            data: dosenKuotas
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: dosenLabels,
        },
        yaxis: {
            title: {
                text: 'Kuota'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val;
                }
            }
        }
    };

    var dosenChart = new ApexCharts(document.querySelector("#dosenChart"), dosenChartOptions);
    dosenChart.render();
});