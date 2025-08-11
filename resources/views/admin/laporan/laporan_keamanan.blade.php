<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA PERANGKAT KEAMANAN</h2>
        <p>Tanggal : {{ now()->format('d-m-Y') }}</p>
    </div>
    <div class="dooted_bold"></div>
    <div class="dooted_sm"></div>
    <table>
        <thead>
            <>
                <th class="text-center">No.</th>
                <th class="text-center">Nama OPD</th>
                <th class="text-center">Tanggal Pembelian</th>
                <th class="text-center">Kode Perangkat Keamanan</th>
                <th class="text-center">Nama Perangkat Keamanan</th>
                <th class="text-center">Spesifikasi</th>
                <th class="text-center">Status</th>
                <th class="text-center">Nama Ruangan</th>
                <th class="text-center">Penanggung Jawab</th>
               
            </tr>
        </thead>
        <tbody>
            @forelse ($listKeamanan as $perangkat_keamanan)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->opd->nama }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->tanggal_pembelian_keamanan }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->kode_keamanan }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->nama_keamanan }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->spesifikasi_keamanan }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->status_keamanan }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->nama_ruangan_keamanan }}</td>
                    <td class="text-center">{{ $perangkat_keamanan->penanggung_jawab_keamanan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
