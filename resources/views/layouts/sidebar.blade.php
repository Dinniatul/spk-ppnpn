<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-warning">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link " style="text-decoration: none">
        <img src="{{ asset('AdminLTE') }}/dist/img/logo_ptun.png" width="100px" alt="AdminLTE Logo"
            class="brand-image img-circle">
        <span class="brand-text font-weight-bold mx-3">SPK PPNPN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 text-center fw-bold">
            @auth
                <p class="d-block text-center">Selamat Datang!! <b>{{ auth()->user()->name }}</b></p>
                <h6 href="#">{{ auth()->user()->username }}</h6>
            @endauth
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{ url('users') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ Request::is('kriteria', 'ppnpn', 'jenis-surat', 'periode', 'pengguna') ? 'menu-is-opening menu-open' : '' }}">
                        <a class="nav-link {{ Request::is('kriteria', 'ppnpn', 'jenis-surat', 'periode', 'pengguna') ? 'active' : '' }}"
                            onclick="toggleActive(this)"
                            style="background-color: {{ Request::is('kriteria', 'ppnpn', 'surat', 'periode') ? 'warning' : '' }}; color: dark;">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('kriteria') }}"
                                    class="nav-link {{ Request::is('kriteria') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Kriteria</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('ppnpn') }}"
                                    class="nav-link {{ Request::is('ppnpn') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        PPNPN
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('periode') }}"
                                    class="nav-link {{ Request::is('periode') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>
                                        Periode
                                        {{-- <span class="right badge badge-danger">New</span> --}}
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('nilai-triwulan') }}"
                            class="nav-link {{ Request::is('nilai-triwulan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-sort-numeric-up-alt"></i>
                            <p>Nilai Triwulan</p>
                        </a>
                    </li>
                    <li class="nav-header">SETTINGS</li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link">
                            <i class="fa-regular fas fa-right-from-bracket"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'Atasan Langsung' || Auth::user()->role == 'Kepegawaian')
                    <li class="nav-item">
                        <a href="{{ url('nilai-triwulan') }}"
                            class="nav-link {{ Request::is('nilai-triwulan') ? 'active' : '' }}">
                            <i class=" nav-icon fas fa-sort-numeric-up-alt"></i>
                            <p>Nilai Triwulan</p>
                        </a>
                    </li>
                    <li class="nav-header">SETTINGS</li>
                    <li class="nav-item">
                        <a href="{{ url('/logout') }}" class="nav-link">
                            <i class="fa-regular fas fa-right-from-bracket"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
