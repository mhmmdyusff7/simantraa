@php
    $dashboard = request()->is('admin/dashboard') ? 'active' : '';
    $data_opd = request()->is('admin/data_opd') ? 'active' : '';
    $metismenu = request()->is('admin/data_opd') ? 'mm-active' : '';
    // $dashboard = request()->is('admin/dashboard') ? 'active' : '';
    // $dashboard = request()->is('admin/dashboard') ? 'active' : '';
@endphp
<aside class="sidebars">
    <div class="sidebars-user">
        <div class="user-img">
            <img src="{{ asset('public/assets/img/yusuf.jpg') }}" alt="" class="w-full h-full">
        </div>
        <div class="user-caption">
            <span class="name">Bang Alex</span>
            <span class="status">Admin </span>
        </div>
    </div>
    <ul class="sidebar-menu" id="metismenu">
        <li class="{{ $dashboard }}">
            <a href="{{ url('admin/dashboard') }}">
                <i class="bi bi-house"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class= "{{ $data_opd }}">
            <a href="{{ url('admin/data_opd') }}">
                <i class="bi bi-buildings"></i>
                <span>Data OPD</span>
            </a>
        </li>
        <li class="metismenu">
            <a href="#" aria-expanded="true" class="dd">
                <i class="bi bi-hdd-stack"></i>
                <span>Manajemen Jaringan</span>
            </a>
            <ul>
                <li>
                    <a href="{{ url('admin/status') }}">Perangkat Jaringan</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

@push('js')
<script>
    $("#metismenu").metisMenu();
</script>
@endpush