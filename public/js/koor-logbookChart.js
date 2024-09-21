document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');

    // Cek apakah logbookData ada
    if (!window.logbookData) {
           console.error('logbookData is not defined');
           return;
    }

    // Data Logbook Bimbingan
    var logbookData = window.logbookData;
    console.log('logbookData:', logbookData);

    var totalMahasiswa = window.totalMahasiswa; 

    // Define the categories explicitly
    var categories = ['BAB 1', 'BAB 2', 'BAB 3', 'BAB 4', 'BAB 5'];

    // Initialize data for each BAB
    var seriesData = categories.map((bab, index) => {
           var babNumber = index + 1;
           return {
                  value: logbookData[babNumber]?.total || 0,
                  name: bab
           };
    });

    console.log('seriesData:', seriesData);

    // Pastikan elemen logbookChart ada di DOM
    var logbookChartElement = document.getElementById('logbookChart');
    if (!logbookChartElement) {
           console.error('Element with ID logbookChart not found');
           return;
    }

    // Initialize ECharts
    var logbookChart = echarts.init(logbookChartElement);

    var option = {
           tooltip: {
                  trigger: 'item'
           },
           legend: {
                  top: '1%',
                  left: 'center'
           },
           series: [
                  {
                         name: 'Jumlah Mahasiswa yang Mengisi Bab',
                         type: 'pie',
                         radius: ['40%', '70%'],
                         avoidLabelOverlap: false,
                         padAngle: 5,
                         itemStyle: {
                                borderRadius: 10
                         },
                         label: {
                                show: true,
                                position: 'outside',
                                formatter: '{b}: {c}'
                         },
                         emphasis: {
                                label: {
                                       show: true,
                                       fontSize: 20,
                                       fontWeight: 'bold'
                                }
                         },
                         labelLine: {
                                show: true
                         },
                         data: seriesData
                  }
           ]
    };

    logbookChart.setOption(option);
});