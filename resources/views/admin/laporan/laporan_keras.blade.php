<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA PERANGKAT KERAS</h2>
        <p>Tanggal : {{ now()->format('d-m-Y') }}</p>
    </div>
    <div class="dooted_bold"></div>
    <div class="dooted_sm"></div>
    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama OPD</th>
                <th class="text-center">Tanggal Pembelian </th>
                <th class="text-center">Kode Perangkat </th>
                <th class="text-center">Nama Perangkat</th>
                <th class="text-center">Spesifikasi</th>
                <th class="text-center">Status</th>
                <th class="text-center">Nama Ruangan</th>
                <th class="text-center">Penanggung Jawab</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($listKeras as $keras)
                <tr>
                    <td class="text-center">{{$loop->iteration }}</td>
                    <td class="text-left">{{ $keras->opd->nama }}</td>
                    <td class="text-center">{{ $keras->tanggal_pembelian_keras }}</td>
                    <td class="text-center">{{ $keras->kode_keras }}</td>
                    <td class="text-center">{{ $keras->nama_keras }}</td>
                    <td class="text-center">{{ $keras->spesifikasi_keras }}</td>
                    <td class="text-center">{{ $keras->status_keras }}</td>
                    <td class="text-center">{{ $keras->nama_ruangan_keras }}</td>
                    <td class="text-center">{{ $keras->penanggung_jawab_keras }}</td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
