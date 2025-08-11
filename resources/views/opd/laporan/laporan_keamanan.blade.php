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
                <th class="text-center">Tanggal Pembelian</th>
                <th class="text-center">Kode Perangkat</th>
                <th class="text-center">Nama Perangkat</th>
                <th class="text-center">Spesifikasi</th>
                <th class="text-center">Status</th>
                <th class="text-center">Nama Ruangan</th>
                <th class="text-center">Penanggung Jawab</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($listKeamanan as $keamanan)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $keamanan->tanggal_pembelian_keamanan }}</td>
                    <td class="text-center">{{ $keamanan->kode_keamanan }}</td>
                    <td class="text-center">{{ $keamanan->nama_keamanan }}</td>
                    <td class="text-center">{{ $keamanan->spesifikasi_keamanan }}</td>
                    <td class="text-center">{{ $keamanan->status_keamanan }}</td>
                    <td class="text-center">{{ $keamanan->nama_ruangan_keamanan }}</td>
                    <td class="text-center">{{ $keamanan->penanggung_jawab_keamanan }}</td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
