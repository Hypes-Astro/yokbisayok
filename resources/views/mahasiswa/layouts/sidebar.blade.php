<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-list"></i>
            </button>
            <div class="sidebar-logo">
                <a href="{{ route('dashboardMahasiswa') }}">kerja praktek</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('dashboardMahasiswa') }}" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('pengajuan-mahasiswa') }}" class="sidebar-link">
                    <i class="lni lni-pencil-alt"></i>
                    <span>Pengajuan kerja praktek</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a href="{{ route('mahasiswa-logbook') }}" class="sidebar-link">
                    <i class="lni lni-notepad"></i>
                    <span>Logbook Bimbingan KP</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('profile_penyelia') }}" class="sidebar-link">
                    <i class="fas fa-chalkboard-teacher me-1"></i>
                    <span>Review Penyelia</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('form_pengajuan') }}" class="sidebar-link">
                    <i class="fas fa-certificate"></i>
                    <span>Pengajuan Sidang</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('detail_penyelia') }}" class="sidebar-link">
                    <i class="fas fa-chalkboard-teacher me-1"></i>
                    <span>Upload Penyelia</span>
                </a>
            </li>
            {{-- <li class="sidebar-item">
                <a href="{{ route('riwayatPengajuan') }}" class="sidebar-link">
                    <i class="lni lni-folder"></i>
                    <span>Riwayat Pengajuan</span>
                </a>
            </li> --}}
            {{-- @foreach ($mahasiswas as $mahasiswa)
                <li class="sidebar-item">
                    <a href="{{ route('halamanProfil', ['id' => $mahasiswa->id]) }}" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profil Mahasiswa</span>
                    </a>
                </li>
            @endforeach --}}
        </ul>
        <div class="sidebar-footer">
            <a href="/profilmhs" class="sidebar-link">
                <i class="fas fa-user"></i>
                <span>Profil Mahasiswa</span>
            </a>
        </div>
        <div class="sidebar-footer">
            <a href="{{ route('halamanTentang') }}" class="sidebar-link">
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