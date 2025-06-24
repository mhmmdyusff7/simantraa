<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA PERANGKAT KEAMANAN</h2>
        <p>Tanggal : {{ now()->format('d-m-Y') }}</p>
    </div>
    <div class="dooted_bold"></div>
    <div class="dooted_sm"></div>
    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama OPD</th>
                <th class="text-center">Nama Perangkat</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Status Reviu</th>
                <th class="text-center">Alasan Tidak Digunakan</th>
                <th class="text-center">Kepemilikan</th>
                <th class="text-center">Pengelola</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listKeamanan as $perangkat_keamanan)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $perangkat_keamanan->opd->nama ?? '-' }}</td>
                    <td>{{ $perangkat_keamanan->nama_perangkat_keamanan }}</td>
                    <td>{{ $perangkat_keamanan->keamanan_jumlah_perangkat }}</td>
                    <td>{{ $perangkat_keamanan->keamanan_status_reviu }}</td>
                    <td>{{ $perangkat_keamanan->keamanan_alasan_tidakdigunakan ?: '-' }}</td>
                    <td>{{ $perangkat_keamanan->keamanan_status_kepemilikan}}</td>
                    <td>{{ $perangkat_keamanan->keamanan_pengelola}}</td>
                </tr>
            @empty
                <tr>
                    <td>Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
