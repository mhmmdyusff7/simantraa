

<div>
    {{-- HEADER HALAMAN --}}
    <div class="sectioncontent-header justify-between mb-3 d-flex align-items-center">
        <h2 class="sectioncontentheader-title">Daftar Perangkat OPD</h2>
        {{-- Bisa tambah search jika dibutuhkan --}}
    </div>

    <div class="row">
        <div class="col-12">
            <div class="bg-white rounded-md custom-shadow p-4">
                {{-- Cek apakah sedang pakai paginasi atau tidak --}}
                @if (isset($opds))
                    <x-table.table-search tableHeader :tableFooter="$opds">
                @endif

                <table class="table table-bordered custom-table text-center">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">No.</th>
                            <th rowspan="2" class="align-middle">Nama OPD</th>
                            <th colspan="3">Perangkat Jaringan</th>
                            <th colspan="3">Perangkat Keras</th>
                            <th colspan="3">Perangkat Keamanan</th>
                        </tr>
                        <tr>
                            <th>< 1 Tahun</th>
                            <th>1 - 5 Tahun</th>
                            <th>> 5 Tahun</th>
                            <th>< 1 Tahun</th>
                            <th>1 - 5 Tahun</th>
                            <th>> 5 Tahun</th>
                            <th>< 1 Tahun</th>
                            <th>1 - 5 Tahun</th>
                            <th>> 5 Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataPerangkat as $index => $data)
                            <tr>
                                <td>
                                    {{-- Cek jika paginasi ada, hitung nomor, kalau tidak ya 1 --}}
                                    {{ isset($opds) ? ($opds->currentPage() - 1) * $opds->perPage() + $index + 1 : $index + 1 }}
                                </td>
                                <td class="text-start">{{ $data['opd_nama'] }}</td>

                                {{-- Perangkat Jaringan --}}
                                <td>{{ $data['Perangkat Jaringan']['<1'] ?? '-' }}</td>
                                <td>{{ $data['Perangkat Jaringan']['1-5'] ?? '-' }}</td>
                                <td>{{ $data['Perangkat Jaringan']['>5'] ?? '-' }}</td>

                                {{-- Perangkat Keras --}}
                                <td>{{ $data['Perangkat Keras']['<1'] ?? '-' }}</td>
                                <td>{{ $data['Perangkat Keras']['1-5'] ?? '-' }}</td>
                                <td>{{ $data['Perangkat Keras']['>5'] ?? '-' }}</td>

                                {{-- Perangkat Keamanan --}}
                                <td>{{ $data['Perangkat Keamanan']['<1'] ?? '-' }}</td>
                                <td>{{ $data['Perangkat Keamanan']['1-5'] ?? '-' }}</td>
                                <td>{{ $data['Perangkat Keamanan']['>5'] ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if (isset($opds))
                    </x-table.table-search>
                @endif
            </div>
        </div>
    </div>
</div>
