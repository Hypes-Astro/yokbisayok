<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-list"></i>
            </button>
            <div class="sidebar-logo">
                <a href="/mahasiswa">kerja praktek</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('dashboardKoor') }}" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('HalamanKoorDosen') }}" class="sidebar-link">
                    <i class="lni lni-pencil-alt"></i>
                    <span>Daftar Dosen Pembimbing</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('halamanKoorMhs') }}" class="sidebar-link">
                    <i class="lni lni-notepad"></i>
                    <span>Daftar Mahasiswa</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('penyeliaMhs') }}" class="sidebar-link">
                    <i class="fas fa-chalkboard-teacher me-1"></i>
                    <span>Review Penyelia</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('koor-pengumuman') }}" class="sidebar-link">
                    <i class="fas fa-newspaper"></i>
                    <span>Pengumuman</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('koor-monitoring-sidang') }}" class="sidebar-link">
                    <i class="lni lni-dashboard"></i>
                    <span>Monitoring Sidang Kp</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('koor-plotting') }}" class="sidebar-link">
                    <i class="fa fa-chart-bar"></i>
                    <span>Plotting Dosen</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('log_dosen') }}" class="sidebar-link">
                    <i class="fas fa-user-tie"></i>
                    <span>Log Dosen</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('log_mhs') }}" class="sidebar-link">
                    <i class="fas fa-user-graduate"></i>
                    <span>Log Mahasiswa</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('koor-list-mhs') }}" class="sidebar-link">
                    <i class="fas fa-chalkboard-teacher me-1"></i>
                    <span>Daftar Mahasiswa Pengajuan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('koor-history-mhs') }}" class="sidebar-link">
                    <i class="fas fa-chalkboard-teacher me-1"></i>
                    <span>History Mahasiswa</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="/tentang" class="sidebar-link">
                <i class="lni lni-code-alt"></i>
                <span>Tentang</span>
            </a>
        </div>
        <div class="sidebar-footer">
            <a href="{{ route('logout') }}" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    <div class="main p-3">
        @yield('content')
    </div>
</div>
