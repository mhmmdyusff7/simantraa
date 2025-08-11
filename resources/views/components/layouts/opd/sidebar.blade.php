@php
    // Menu utama
    $isDashboard = request()->is('opd/dashboard');
    $isDataOPD = request()->is('opd/data_opd');
    // Menu Manajemen Jaringan dan submenu-nya
    $isDataPerangkat = request()->is('opd/perangkatjaringan')|| request()->is('opd/perangkatkeras') || request()->is('opd/perangkatkeamanan');
    $isDataBandwidth = request()->is('opd/perangkatbandwidth');
    $isSdmtik = request()->is('opd/sdmtik');
    $isProfile = request()->is('opd/profile');
    $isPerangkatUmurOpd = request()->is('opd/perangkat_umur_opd');
@endphp

<aside class="sidebars">
    <div class="sidebars-user">
        <div class="user-img">
            <img src="{{ asset('public/assets/img/yusuf.jpg') }}" class="w-full h-full">
        </div>
        <div class="user-caption">
            <span class="name">{{ Str::limit(Auth::guard('opd')->user()->nama, 15) }}</span>
               <span class="status">{{ Str::limit(Auth::guard('opd')->user()->email, 15) }}</span>
        </div>
    </div>

    <ul class="sidebar-menu" id="metismenu">
        <li class="{{ $isDashboard ? 'active' : '' }}">
            <a href="{{ url('opd/dashboard') }}">
                <i class="bi bi-house-door"></i> {{-- ICON DIGANTI: bi-house menjadi bi-house-door --}}
                <span>Dashboard</span>
            </a>
        </li>
        <li class="{{ $isDataBandwidth ? 'active' : '' }}">
            <a href="{{ url('opd/perangkatbandwidth') }}">
                <i class="bi bi-wifi"></i>
                <span>Data Bandwidth</span>
            </a>
        </li>
        <li class="{{ $isDataPerangkat? 'mm-active' : '' }}">
            <a href="#" class="has-arrow">
                <i class="bi bi-hdd-stack"></i>
                <span>Perangkat Terlihat</span>
            </a>
            <ul class="submenu">
                <li class="{{ request()->is('opd/perangkatjaringan') ? 'active' : '' }}">
                    <a href="{{ url('opd/perangkatjaringan') }}">
                        <i class="bi bi-router"></i>
                        <span>Perangkat Jaringan</span>
                    </a>
                </li>
                <li class="{{ request()->is('opd/perangkatkeras') ? 'active' : '' }}">
                    <a href="{{ url('opd/perangkatkeras') }}">
                        <i class="bi bi-pc-display"></i>
                        <span>Perangkat Keras</span>
                    </a>
                </li>
                <li class="{{ request()->is('opd/perangkatkeamanan') ? 'active' : '' }}">
                    <a href="{{ url('opd/perangkatkeamanan') }}">
                        <i class="bi bi-shield-check"></i>
                        <span>Perangkat Keamanan</span>
                    </a>
                </li>
            </ul>
            <li class="{{ $isPerangkatUmurOpd ? 'active' : '' }}">
            <a href="{{ url('opd/perangkat_umur_opd') }}">
                <i class="bi bi-pci-card-network"></i>
                <span> Usia Perangkat</span>
            </a>
        </li>
            <li class="{{ $isSdmtik ? 'active' : '' }}">
                <a href="{{ url('opd/sdmtik') }}">
                    <i class="bi bi-people"></i> 
                    <span>Data SDM TIK</span>
                </a>
            </li>
            <li class="{{ $isProfile ? 'active' : '' }}">
                    <a href="{{ url('opd/profile') }}">
                        <i class="bi bi-box-arrow-left"></i> 
                        <span>Logout</span>
                    </a>
                </li>  
        </li> 
    </ul>
</aside>
@push('js')
<script>
    $("#metismenu").metisMenu();
</script>
@endpush