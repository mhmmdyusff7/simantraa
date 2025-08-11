<div>
    {{-- Header dan Filter --}}
    <div class="sectioncontent-header flex flex-col md:flex-row justify-start md:justify-between mb-4">
        <h2 class="sectioncontentheader-title mb-2 md:mb-0">Dashboard</h2>
        <div class="flex space-x-4">


            {{-- Filter Kategori --}}
            <x-input.select_live model="filterKategori" label="Filter Kategori">
                <option value="">-- Semua Kategori --</option>
                @foreach ($listKategori as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                @endforeach
            </x-input.select_live>
        </div>
    </div>


    <div class="row">
        {{-- Box Umur Perangkat --}}
        <div class="col-md-6 mb-4">
            <div class="bg-white rounded-md shadow p-4">
                <h2 class="text-lg font-medium mb-4 text-center">
                    Indikator Umur {{ $filterKategori ?? 'Semua Perangkat' }} {{ $labelOpd }}
                </h2>

                <ul class="space-y-2">
                    <li class="flex justify-between">
                        <span class="text-red-500 font-semibold">> 5 Tahun</span>
                        <span class="font-bold">{{ $umur_perangkat['lebih_5_tahun'] ?? 0 }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-yellow-500 font-semibold">1 - 5 Tahun</span>
                        <span class="font-bold">{{ $umur_perangkat['antara_1_5_tahun'] ?? 0 }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-green-500 font-semibold">< 1 Tahun</span>
                        <span class="font-bold">{{ $umur_perangkat['kurang_1_tahun'] ?? 0 }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-slate-500 font-semibold">TOTAL PERANGKAT</span>
                        <span class="font-bold">{{ $total_perangkat }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Box Status Perangkat --}}
        <div class="col-md-6">
            <div class="bg-white rounded-md shadow p-4">
                <h2 class="text-lg font-medium mb-4 text-center">
                    Indikator Status {{ $filterKategori ?? 'Semua Perangkat' }} {{ $labelOpd }}
                </h2>
                
                <div id="chart"></div>

                <ul class="space-y-2 mt-4">
                    <li class="flex justify-between">
                        <span class="text-red-500 font-semibold">Rusak Berat</span>
                        <span class="font-bold">
                            {{ $status_perangkat['rusak_berat'] ?? 0 }} 
                            ({{ $total_perangkat > 0 ? round(($status_perangkat['rusak_berat']/$total_perangkat)*100, 1) : 0 }}%)
                        </span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-green-500 font-semibold">Baik</span>
                        <span class="font-bold">
                            {{ $status_perangkat['baik'] ?? 0 }}
                            ({{ $total_perangkat > 0 ? round(($status_perangkat['baik']/$total_perangkat)*100, 1) : 0 }}%)
                        </span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-yellow-500 font-semibold">Perlu Diperbaiki</span>
                        <span class="font-bold">
                            {{ $status_perangkat['perlu_diperbaiki'] ?? 0 }}
                            ({{ $total_perangkat > 0 ? round(($status_perangkat['perlu_diperbaiki']/$total_perangkat)*100, 1) : 0 }}%)
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('public/node_modules/apexcharts/dist/apexcharts.min.js') }}"></script>
    @endpush
</div>