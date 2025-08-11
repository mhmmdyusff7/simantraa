<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA PERANGKATJARINGAN</h2>
        <p>Tanggal : {{ now()->format('d-m-Y') }}</p>
    </div>
    <div class="dooted_bold"></div>
    <div class="dooted_sm"></div>
    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama OPD</th>
                <th class="text-center">Tanggal Pembelian</th>
                <th class="text-center">Nama Perangkat Jaringan</th>
                <th class="text-center">Kode Perangkat Jaringan</th>
                <th class="text-center">Spesifikasi</th>
                <th class="text-center">Status Perangkat Jaringan</th>
                <th class="text-center">Nama Ruangan</th>
                <th class="text-center">Penanggung Jawab</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($listJaringan as $jaringan)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $jaringan->opd->nama }}</td>
                    <td class="text-center">{{ $jaringan->tanggal_pembelian_jaringan }}</td>
                    <td class="text-center">{{ $jaringan->nama_jaringan }}</td>
                    <td class="text-center">{{ $jaringan->kode_jaringan }}</td>
                    <td class="text-center">{{ $jaringan->spesifikasi_jaringan }}</td>
                    <td class="text-center">{{ $jaringan->status_jaringan }}</td>
                    <td class="text-center">{{ $jaringan->nama_ruangan_jaringan }}</td>
                    <td class="text-center">{{ $jaringan->penanggung_jawab_jaringan }}</td>
                     
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
