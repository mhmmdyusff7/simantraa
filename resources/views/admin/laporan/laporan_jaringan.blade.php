<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA PERANGKAT JARINGAN</h2>
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
                <th class="text-center">Digunakan</th>
                <th class="text-center">Tidak Digunakan</th>
                <th class="text-center">Alasan Tidak Digunakan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listJaringan as $jaringan)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $jaringan->opd->nama }}</td>
                    <td class="text-left">{{ $jaringan->nama_perangkat_jaringan }}</td>
                    <td class="text-left">{{ $jaringan->jaringan_jumlah }}</td>
                    <td class="text-left">{{ $jaringan->jaringan_digunakan }}</td>
                    <td class="text-left">{{ $jaringan->jaringan_tidakdigunakan }}</td>
                    <td class="text-left">{{ $jaringan->jaringan_alasan_tidakdigunakan ?: '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td>Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
