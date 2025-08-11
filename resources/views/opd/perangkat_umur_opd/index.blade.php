<div>
    {{-- HEADER HALAMAN --}}
    <div class="sectioncontent-header justify-between mb-3 d-flex align-items-center">
        <h2 class="sectioncontentheader-title">DaftarPerangkat </h2>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="bg-white rounded-md custom-shadow p-4">

                <table class="table table-bordered custom-table text-center">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">No.</th>

                            <th colspan="3">Perangkat Jaringan</th>
                            <th colspan="3">Perangkat Keras</th>
                            <th colspan="3">Perangkat Keamanan</th>
                        </tr>
                        <tr>
                            <th>&lt; 1 Tahun</th>
                            <th>1 - 5 Tahun</th>
                            <th>&gt; 5 Tahun</th>
                            <th>&lt; 1 Tahun</th>
                            <th>1 - 5 Tahun</th>
                            <th>&gt; 5 Tahun</th>
                            <th>&lt; 1 Tahun</th>
                            <th>1 - 5 Tahun</th>
                            <th>&gt; 5 Tahun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($dataPerangkat))
                            <tr>
                                <td>1</td>


                                {{-- Perangkat Jaringan --}}
                                <td>{{ $dataPerangkat['Perangkat Jaringan']['<1'] ?? '-' }}</td>
                                <td>{{ $dataPerangkat['Perangkat Jaringan']['1-5'] ?? '-' }}</td>
                                <td>{{ $dataPerangkat['Perangkat Jaringan']['>5'] ?? '-' }}</td>

                                {{-- Perangkat Keras --}}
                                <td>{{ $dataPerangkat['Perangkat Keras']['<1'] ?? '-' }}</td>
                                <td>{{ $dataPerangkat['Perangkat Keras']['1-5'] ?? '-' }}</td>
                                <td>{{ $dataPerangkat['Perangkat Keras']['>5'] ?? '-' }}</td>

                                {{-- Perangkat Keamanan --}}
                                <td>{{ $dataPerangkat['Perangkat Keamanan']['<1'] ?? '-' }}</td>
                                <td>{{ $dataPerangkat['Perangkat Keamanan']['1-5'] ?? '-' }}</td>
                                <td>{{ $dataPerangkat['Perangkat Keamanan']['>5'] ?? '-' }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="11" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
