@php
    // Menu utama
    $isDashboard = request()->is('admin/dashboard');
    $isDataOPD = request()->is('admin/data_opd');
    // Menu Manajemen Jaringan dan submenu-nya
    $isDataPerangkat = request()->is('admin/perangkatjaringan')|| request()->is('admin/perangkatkeras') || request()->is('admin/perangkatkeamanan');
    $isDataBandwidth = request()->is('admin/perangkatbandwidth');
    $isSdmtik = request()->is('admin/sdmtik');
@endphp

<aside class="sidebars">
    <div class="sidebars-user">
        <div class="user-img">
            <img src="{{ asset('public/assets/img/yusuf.jpg') }}" alt="" class="w-full h-full">
        </div>
        <div class="user-caption">
            <span class="name">Yusuf</span>
            <span class="status">yusuf@gmail.com</span>
        </div>
    </div>

    <ul class="sidebar-menu" id="metismenu">
        <li class="{{ $isDashboard ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}">
                <i class="bi bi-house-door"></i> {{-- ICON DIGANTI: bi-house menjadi bi-house-door --}}
                <span>Dashboard</span>
            </a>
        </li>

        <li class="{{ $isDataOPD ? 'active' : '' }}">
            <a href="{{ url('admin/data_opd') }}">
                <i class="bi bi-buildings"></i>
                <span>Data OPD</span>
            </a>
        </li>
        <li class="{{ $isDataBandwidth ? 'active' : '' }}">
            <a href="{{ url('admin/perangkatbandwidth') }}">
                <i class="bi bi-wifi"></i>
                <span>Data Bandwidth</span>
            </a>
        </li>
        <li class="{{ $isDataPerangkat? 'mm-active' : '' }}">
            <a href="#" class="has-arrow">
                <i class="bi bi-hdd-stack"></i>
                <span>Aset TIK</span>
            </a>
            <ul class="submenu">
                {{-- <li class="{{ request()->is('admin/perangkat') ? 'active' : '' }}">
                    <a href="{{ url('admin/perangkat') }}">
                        <i class="bi bi-router"></i>
                        <span>Data Perangkat</span>
                    </a>
                </li> --}}
                <li class="{{ request()->is('admin/perangkatjaringan') ? 'active' : '' }}">
                    <a href="{{ url('admin/perangkatjaringan') }}">
                        <i class="bi bi-router"></i>
                        <span>Perangkat Jaringan</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/perangkatkeras') ? 'active' : '' }}">
                    <a href="{{ url('admin/perangkatkeras') }}">
                        <i class="bi bi-pc-display"></i>
                        <span>Perangkat Keras</span>
                    </a>
                </li>
                <li class="{{ request()->is('admin/perangkatkeamanan') ? 'active' : '' }}">
                    <a href="{{ url('admin/perangkatkeamanan') }}">
                        <i class="bi bi-shield-check"></i>
                        <span>Perangkat Keamanan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="{{ $isSdmtik ? 'active' : '' }}">
            <a href="{{ url('admin/sdmtik') }}">
                <i class="bi bi-people"></i> {{-- ICON DIGANTI: sebelumnya kosong, sekarang bi-people --}}
                <span>Data SDM TIK</span>
            </a>
        </li>
    </ul>
</aside>

@push('js')
<script>
    $("#metismenu").metisMenu();
</script>
@endpush