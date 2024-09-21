document.addEventListener('DOMContentLoaded', function () {
    console.log("Mahasiswa chart JS loaded");
    const mahasiswaData = window.mahasiswaData;

    // Objek untuk menyimpan jumlah mahasiswa berdasarkan angkatan dan jurusan
    const mahasiswaPerAngkatan = {};
    const mahasiswaPerJurusan = {};
    const allAngkatan = new Set();

    // Memproses data mahasiswa
    mahasiswaData.forEach(m => {
           const nimParts = m.nim.split('.');
           const jurusan = nimParts[0];
           const angkatan = nimParts[1];

           allAngkatan.add(angkatan);

           // Menghitung jumlah mahasiswa per jurusan
           if (!mahasiswaPerJurusan[jurusan]) {
                  mahasiswaPerJurusan[jurusan] = {};
           }
           if (!mahasiswaPerJurusan[jurusan][angkatan]) {
                  mahasiswaPerJurusan[jurusan][angkatan] = 0;
           }
           mahasiswaPerJurusan[jurusan][angkatan]++;

           // Menghitung jumlah mahasiswa per angkatan
           if (!mahasiswaPerAngkatan[angkatan]) {
                  mahasiswaPerAngkatan[angkatan] = 0;
           }
           mahasiswaPerAngkatan[angkatan]++;
    });

    // Mendapatkan label dan data untuk chart
    const angkatanLabels = Array.from(allAngkatan).sort();
    const angkatanData = angkatanLabels.map(angkatan => mahasiswaPerAngkatan[angkatan] || 0);

    const jurusanSeries = Object.keys(mahasiswaPerJurusan).map(jurusan => {
           return {
                  name: jurusan,
                  data: angkatanLabels.map(angkatan => mahasiswaPerJurusan[jurusan][angkatan] || 0)
           };
    });

    // Hitung total mahasiswa
    const totalMahasiswa = angkatanData.reduce((acc, val) => acc + val, 0);

    // Konfigurasi chart
    var mahasiswaChartOptions = {
           series: [{
                  name: 'Jumlah Mahasiswa per Angkatan',
                  data: angkatanData
           }, ...jurusanSeries],
           chart: {
                  type: 'area',
                  height: 350,
                  toolbar: {
                         show: false
                  }
           },
           dataLabels: {
                  enabled: true,
                  formatter: function (val) {
                         return val;
                  }
           },
           stroke: {
                  curve: 'smooth',
                  width: 2
           },
           xaxis: {
                  categories: angkatanLabels, // Menggunakan label angkatan untuk x-axis
                  title: {
                         text: 'Angkatan'
                  }
           },
           yaxis: {
                  title: {
                         text: 'Jumlah Mahasiswa'
                  }
           },
           tooltip: {
                  shared: true,
                  intersect: false,
                  y: {
                         formatter: function (val) {
                                return val + ' Mahasiswa';
                         }
                  }
           },
           fill: {
                  type: 'gradient',
                  gradient: {
                         shadeIntensity: 1,
                         opacityFrom: 0.7,
                         opacityTo: 0.9,
                  }
           },
           colors: ['#00E396', '#008FFB', '#FEB019', '#FF4560', '#775DD0'],
           legend: {
                  position: 'top',
                  horizontalAlign: 'left'
           },
           annotations: {
                  yaxis: angkatanData.map((value, index) => ({
                         y: value,
                         borderColor: '#999',
                         label: {
                                show: true,
                                // text: `${value} Mahasiswa`,
                                style: {
                                       color: '#fff',
                                       background: '#00E396'
                                }
                         }
                  }))
           }
    };

    // Render chart
    var mahasiswaChart = new ApexCharts(document.querySelector("#mahasiswaChart"), mahasiswaChartOptions);
    mahasiswaChart.render();

    // Tambahkan total mahasiswa di pojok chart
    const totalElement = document.createElement('div');
    totalElement.style.position = 'absolute';
    totalElement.style.top = '10px';
    totalElement.style.right = '10px';
    totalElement.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    totalElement.style.color = 'white';
    totalElement.style.padding = '5px 10px';
    totalElement.style.borderRadius = '5px';
    totalElement.style.fontSize = '14px';
    totalElement.innerText = `Total Mahasiswa: ${totalMahasiswa}`;
    document.querySelector("#mahasiswaChart").appendChild(totalElement);
});