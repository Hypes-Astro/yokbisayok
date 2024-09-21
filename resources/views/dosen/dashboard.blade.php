@extends('dosen.layouts.main')
@section('title', 'Dashboard Dosen')
@section('content')
    <main>
        <div class="wrapper d-flex flex-column min-vh-100">
            <nav class="sb-topnav navbar navbar-expand">
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."
                            aria-describedby="btnNavbarSearch" />
                        <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                 <!-- Notification -->
                <div class="navbar-nav px-1">
                    <div class="nav-item dropdown position-relative">
                        <a class="nav-link" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span id="notificationCount" class="badge bg-danger"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" id="notificationList">
                            <li class="dropdown-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Notifications</span>
                                <button class="btn btn-sm fw-medium" onclick="markAllAsRead()">Sudah dibaca</button>
                            </li>
                            <!-- Notifications will be inserted here -->
                        </ul>
                    </div>
                </div>
                <!-- Navbar Profile-->
                <div class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <div class="nav-item">
                        <a class="nav-link" id="navbarDropdown" href="/profile" role="button" aria-expanded="false">
                            <img src="https://via.placeholder.com/200x200" alt="Profile Picture" class="rounded-circle" width="30" height="30">
                        </a>
                    </div>
                </div>
            </nav>
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><b>Welcome, {{ $dosen->nama }}</b></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>

                    @if(session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($checkNull)
                        <div class="container">
                            <form action="{{ route('updateDataDosen') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h4 class="text-center">Lengkapi Data Diri</h4>
                                <hr>
                                <div class="form-group row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email<span class="required">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" placeholder="Masukkan Email Anda" value="{{ old('email') ? old('email') : $dosen->email }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-10 offset-sm-2 text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" id="card-view">
                                    <div class="card-body"><b>Mahasiswa Bimbingan</b></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('pageDaftarMhsBimbingan') }}">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" id="card-view">
                                    <div class="card-body"><b>Logbook Mahasiswa</b></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('dosbing-logbook') }}">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" id="card-view">
                                    <div class="card-body"><b>Mahasiswa Sidang</b></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('pagePengajuanSidang') }}">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card text-white mb-4" id="card-view">
                                    <div class="card-body"><b>Tentang Kami</b></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/about">See Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Chart Mahasiswa KP -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Chart Logbook Mahasiswa
                                    </div>
                                    <div class="card-body">
                                        <div id="logbookChart" class="chart-canvas" width="100%" height="40"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Chart Mahasiswa KP
                                    </div>
                                    <div class="card-body">
                                        <div id="chartMahasiswaKP" class="chart-canvas" width="100%" height="40"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Informasi Kuota Bimbingan -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-regular fa-address-book me-1"></i>
                                        Informasi Kuota Bimbingan
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered text-center" style="width: 100%; table-layout: fixed; font-size: 0.9vw;">
                                            <thead>
                                                <tr>
                                                    <th style="padding: 5px; white-space: nowrap;">Total Kuota</th>
                                                    <th style="padding: 5px; white-space: nowrap;">Jumlah Ajuan</th>
                                                    <th style="padding: 5px; white-space: nowrap;">Jumlah Diterima</th>
                                                    <th style="padding: 5px; white-space: nowrap;">Jumlah Ditolak</th>
                                                    <th style="padding: 5px; white-space: nowrap;">Sisa Kuota</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 5px;">{{ $dosen->dosen->kuota }}</td>
                                                    <td style="padding: 5px;">{{ $jumlahAjuan }}</td>
                                                    <td style="padding: 5px;">{{ $ajuanDiterima }}</td>
                                                    <td style="padding: 5px;">{{ $ajuanDitolak }}</td>
                                                    <td style="padding: 5px;">{{ $dosen->dosen->sisa_kuota }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa-regular fa-calendar-check"></i>
                                        Log Aktivitas
                                    </div>
                                    <div class="card-body" style="max-height: 137px; overflow-y: auto;">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Aktivitas</th>
                                            </tr>
                                            </thead>
                                            <tbody class="centered-column">
                                            @foreach($activities as $act)
                                                <tr>
                                                    <td>{{ $act->created_at->format('d/m/Y') }}</td>
                                                    <td>{{ $act->description }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </main>

            <footer class="py-4 mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Kerja Praktek</div>
                        <div>
                            <a href="#" class="text-secondary">Privacy Policy</a>
                            &middot;
                            <a href="#" class="text-secondary">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.pusherKey = '{{ env('PUSHER_APP_KEY') }}';
        window.pusherCluster = '{{ env('PUSHER_APP_CLUSTER') }}';
    </script>

    <!-- ApexCharts JS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

            // Inisialisasi dropdown
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
            dropdownElementList.forEach(function(dropdownToggleEl) {
                new bootstrap.Dropdown(dropdownToggleEl);
            });

            const notificationDropdown = document.getElementById('navbarDropdown');
            notificationDropdown.addEventListener('onclick', function(e) {
                // Menghentikan default behavior agar dropdown tidak tertutup otomatis
                e.preventDefault();

                // Tampilkan atau sembunyikan dropdown
                const notificationList = document.getElementById('notificationList');
                notificationList.classList.toggle('show');
            });

            if (window.Echo) {
                console.log('Echo tersedia');
                window.Echo.private(`App.Models.User.${userId}`)
                    .listen('UploadLogbook', (e) => {
                        console.log('Notifikasi UploadLogbook:', e);
                        addNotification(e);
                        updateNotificationCount();
                    })
                    .listen('PengajuanTA', (e) => {
                        console.log('Notifikasi PengajuanTA:', e);
                        addNotification(e);
                        updateNotificationCount();
                    });
            }

            // Load notifikasi yang sudah ada saat halaman dimuat
            loadExistingNotifications();

            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }

                var errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 3000);
        });

        function addNotification(notification) {
            const notificationList = document.getElementById('notificationList');
            const notificationItem = document.createElement('li');
            notificationItem.className = 'dropdown-item';
            notificationItem.innerHTML = `
                <a href="${notification.data.link}" class="notification-link" data-id="${notification.id}">
                    ${notification.data.message}
                </a>
            `;
            notificationList.insertBefore(notificationItem, notificationList.querySelector('.dropdown-header').nextSibling);

            notificationItem.querySelector('.notification-link').addEventListener('click', function(e) {
                e.preventDefault();
                markAsRead(this.dataset.id);
                window.location.href = this.href;
            });

            updateNotificationCount();
        }

        function markAllAsRead() {
            fetch('/notifikasi/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => {
                const notificationList = document.getElementById('notificationList');
                const notifications = notificationList.querySelectorAll('.dropdown-item:not(.dropdown-header)');
                notifications.forEach(notification => notification.remove());
                updateNotificationCount();
            });
        }

        function updateNotificationCount() {
            const count = document.querySelectorAll('#notificationList .dropdown-item:not(.dropdown-header)').length;
            const countElement = document.getElementById('notificationCount');
            countElement.textContent = count > 0 ? count : '';
            countElement.style.display = count > 0 ? 'inline-block' : 'none';
        }

        function markAsRead(notificationId) {
            fetch(`/notifikasi/${notificationId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => {
                const notificationElement = document.querySelector(`[data-id="${notificationId}"]`).closest(
                    '.dropdown-item');
                if (notificationElement) notificationElement.remove();
                updateNotificationCount();
            });
        }

        function loadExistingNotifications() {
            fetch('/load-notifikasi')
                .then(response => response.json())
                .then(notifications => {
                    notifications.forEach(addNotification);
                    updateNotificationCount();
                });
        }

        window.markAllAsRead = markAllAsRead;
        window.markAsRead = markAsRead;

        document.addEventListener('DOMContentLoaded', function () {
            // Chart Logbook Bimbingan (using ApexCharts)
            var logbookData = @json($logbooks);

            // Define the categories explicitly
            var categories = ['BAB 1', 'BAB 2', 'BAB 3', 'BAB 4', 'BAB 5'];

            // Initialize data for each BAB
            var seriesData = [{
                name: 'Jumlah Mahasiswa',
                data: categories.map((bab, index) => {
                    var babNumber = index + 1;
                    return logbookData.find(item => item.bab === babNumber)?.total || 0;
                })
            }];

            // Define individual colors for each bar
            var colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'];

            var logbookOptions = {
                series: seriesData,
                chart: {
                    type: 'bar',
                    height: 300,  // Adjusted height for better visibility
                    width: '100%'  // Set width to 100% to use full container width
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '80%',  // Adjust column width for better appearance
                        endingShape: 'rounded', // Optional: for better aesthetics
                        distributed: true  // Enable distributed colors
                    }
                },
                dataLabels: {
                    enabled: false,  // Disable data labels to show values on bars
                },
                xaxis: {
                    categories: categories,
                    title: {
                        text: 'Logbook Bimbingan'
                    },
                    labels: {
                        style: {
                            colors: '#000',  // Set color of x-axis labels for readability
                            fontSize: '12px'  // Adjust font size for better visibility
                        }
                    }
                },
                yaxis: {
                    min: 0,  // Minimum value to display on y-axis
                    max: Math.max(...seriesData[0].data) + 4,  // Dynamic max value based on data
                    tickAmount: 5,  // Number of ticks on y-axis
                    title: {
                        text: 'Jumlah Mahasiswa'
                    },
                    labels: {
                        formatter: function (value) {
                            return value.toFixed(0); // Ensure no decimal places
                        }
                    }
                },
                colors: colors,  // Set the colors for the bars
                legend: {
                    position: 'bottom',  // Moved legend to the bottom for better layout
                    horizontalAlign: 'center',  // Center the legend horizontally
                    offsetY: 10  // Offset legend slightly down from the bottom
                },
                tooltip: {
                    theme: 'dark',  // Dark theme for tooltips for better contrast
                    x: {
                        show: true,
                        formatter: function (value) {
                            return categories[value] || '';
                        }
                    }
                }
            };

            var logbookChart = new ApexCharts(document.querySelector("#logbookChart"), logbookOptions);
            logbookChart.render();

            // Mahasiswa KP chart (using ApexCharts)
            var kpOptions = {
                series: [{{ $kpCount }}],
                chart: {
                    type: 'donut',
                    height: 312
                },
                labels: ['KP'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200,
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                colors: ['#36A2EB'],
            };

            var kpChart = new ApexCharts(document.querySelector("#chartMahasiswaKP"), kpOptions);
            kpChart.render();
        });
    </script>
@endsection