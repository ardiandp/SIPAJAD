<header class="navbar navbar-expand-md navbar-dark bg-dark d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('dashboard') }}">
                SIPAJAD
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="avatar avatar-xs" style="background-image: url(https://ui-avatars.com/api/?name={{ auth()->user()->name }})"></span>
                        <span class="ms-2">{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="ti ti-user ti-sm me-2"></i> Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="ti ti-logout ti-sm me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>

<aside class="navbar navbar-vertical navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="ti ti-dashboard nav-icon"></i> Dashboard
                </a>
            </li>

            @can('admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.jurusan*') ? 'active' : '' }}" href="{{ route('master.jurusan.index') }}">
                    <i class="ti ti-building-community nav-icon"></i> Jurusan
                </a>
            </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.guru*') ? 'active' : '' }}" href="{{ route('master.guru.index') }}">
                    <i class="ti ti-users nav-icon"></i> Guru
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.mapel*') ? 'active' : '' }}" href="{{ route('master.mapel.index') }}">
                    <i class="ti ti-book nav-icon"></i> Mata Pelajaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.kelas*') ? 'active' : '' }}" href="{{ route('master.kelas.index') }}">
                    <i class="ti ti-backpack nav-icon"></i> Kelas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.ruangan*') ? 'active' : '' }}" href="{{ route('master.ruangan.index') }}">
                    <i class="ti ti-door nav-icon"></i> Ruangan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.hari*') ? 'active' : '' }}" href="{{ route('master.hari.index') }}">
                    <i class="ti ti-calendar nav-icon"></i> Hari
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.jam*') ? 'active' : '' }}" href="{{ route('master.jam.index') }}">
                    <i class="ti ti-clock nav-icon"></i> Jam Pelajaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('master.beban*') ? 'active' : '' }}" href="{{ route('master.beban.index') }}">
                    <i class="ti ti-clipboard-list nav-icon"></i> Beban Mengajar
                </a>
            </li>

            <li class="nav-divider my-2"></li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jadwal.versi') ? 'active' : '' }}" href="{{ route('jadwal.versi') }}">
                    <i class="ti ti-versions nav-icon"></i> Versi Jadwal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jadwal.keseluruhan') ? 'active' : '' }}" href="{{ route('jadwal.keseluruhan') }}">
                    <i class="ti ti-calendar-stats nav-icon"></i> Jadwal Keseluruhan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jadwal.kelas*') ? 'active' : '' }}" href="{{ route('jadwal.kelas') }}">
                    <i class="ti ti-calendar-stats nav-icon"></i> Jadwal Per Kelas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jadwal.guru*') ? 'active' : '' }}" href="{{ route('jadwal.guru') }}">
                    <i class="ti ti-calendar-user nav-icon"></i> Jadwal Per Guru
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('jadwal.ruangan*') ? 'active' : '' }}" href="{{ route('jadwal.ruangan') }}">
                    <i class="ti ti-calendar-event nav-icon"></i> Jadwal Per Ruangan
                </a>
            </li>
        </ul>
    </div>
</aside>
