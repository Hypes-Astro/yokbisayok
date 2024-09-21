<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-list"></i>
            </button>
            <div class="sidebar-logo">
                <a href="{{ route('dashboardAdmin') }}">kerja praktek</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('dashboardAdmin') }}" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            {{-- <li class="sidebar-item">
                <a href="{{ route('DataDosbing') }}" class="sidebar-link">
                    <i class="lni lni-folder"></i>
                    <span>Data Dosen</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('DataMahasiswa') }}" class="sidebar-link">
                    <i class="lni lni-notepad"></i>
                    <span>Data Mahasiswa </span>
                </a>
            </li> --}}
            {{-- <li class="sidebar-item">
                <a href="{{ route('dataKoor') }}" class="sidebar-link">
                    <i class="lni lni-library"></i>
                    <span>Data Koor</span>
                </a>
            </li> --}}
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
            <a href="{{ route('logout')}}" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    <div class="main p-3">
        @yield('content')
    </div>
</div>