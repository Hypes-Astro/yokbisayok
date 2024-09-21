<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-list"></i>
            </button>
            <div class="sidebar-logo">
                <a href="{{ route('dashboardDosen') }}">kerja praktek</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('dashboardDosen') }}" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('pageDaftarMhsBimbingan') }}" class="sidebar-link">
                    <i class="lni lni-consulting"></i>
                    <span>Mahasiswa Bimbingan</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('pageLogbook') }}" class="sidebar-link">
                    <i class="lni lni-notepad"></i>
                    <span>Logbook Mahasiswa </span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('pageReviewPenyelia') }}" class="sidebar-link">
                    <i class="fas fa-star"></i>
                    <span>Review Penyelia</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('pagePengajuanSidang') }}" class="sidebar-link">
                    <i class="fas fa-calendar-check"></i>
                    <span>Pengajuan Sidang Mhs</span>
                </a>
            </li>
            {{-- <li class="sidebar-item">
                <a href="/Profil" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profil Mahasiswa</span>
                </a>
            </li> --}}
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