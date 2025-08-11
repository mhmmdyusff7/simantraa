<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA BANDWIDTH</h2>
        <p>Tanggal : {{ now()->format('d-m-Y') }}</p>
    </div>
    <div class="dooted_bold"></div>
    <div class="dooted_sm"></div>
    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama OPD</th>
                <th class="text-center">Nama Jaringan</th>
                <th class="text-center">Bandwidth/Mbps</th>
                <th class="text-center">Jumlah pemasangan</th>
                <th class="text-center">Alasan pengadaan</th>
                <th class="text-center">Status Reviu</th>
                <th class="text-center">Penyesuaian operasional</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listBandwidth as $bandwidth)
                <tr>
                    <td class="text-center">{{$loop->iteration }}</td>
                    <td class="text-center">{{ $bandwidth->opd->nama }}</td>
                    <td class="text-center">{{ $bandwidth->bandwidth_nama_jaringan }}</td>
                    <td class="text-center">{{ $bandwidth->bandwidth_mbps }}</td>
                    <td class="text-center">{{ $bandwidth->bandwidth_jumlah_pemasangan }}</td>
                    <td class="text-center">{{ $bandwidth->bandwidth_alasan_pengadaan }}</td>
                    <td class="text-center">{{ $bandwidth->bandwidth_status_reviu }}</td>
                    <td class="text-center">{{ $bandwidth->bandwidth_penyesuaian_operasional }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
