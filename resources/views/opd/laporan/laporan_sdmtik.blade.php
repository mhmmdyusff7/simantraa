<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA SDM TIK OPD KETAPANG</h2>
        <p>Tanggal : {{ now()->format('d-m-Y') }}</p>
    </div>
    <div class="dooted_bold"></div>
    <div class="dooted_sm"></div>
    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama SDM TIK</th>
                <th class="text-center">Status Pegawai</th>
                <th class="text-center">Status Reviu Pegawai</th>
                <th class="text-center">Alasan Pindah</th>
                <th class="text-center">Kompetensi Pekerjaan</th>
                <th class="text-center">Sertifikasi</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($listSdmtik as $sdmtik)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $sdmtik->nama_sdm_tik }}</td>
                    <td class="text-center">{{ $sdmtik->tik_status_pegawai }}</td>
                    <td class="text-center">{{ $sdmtik->status_reviu_pegawai }}</td>
                    <td class="text-center">{{ $sdmtik->alasan_pindah ?: '-' }}</td>
                    <td class="text-center">{{ $sdmtik->kompetensi_pekerjaan }}</td>
                    <td class="text-center">{{ $sdmtik->sertifikasi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
