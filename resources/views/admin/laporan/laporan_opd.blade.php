<div class="container_laporan">
    <div class="header">
        <h2>LAPORAN DATA OPD</h2>
        <p>Tanggal : {{ now()->format('d-m-Y') }}</p>
    </div>
    <div class="dooted_bold"></div>
    <div class="dooted_sm"></div>
    <table>
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama Kantor</th>
                <th class="text-center">Telepon</th>
                <th class="text-center">Email</th>
                <th class="text-center">Alamat Kantor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($listOpd as $opd)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $opd->nama }}</td>
                    <td class="text-left">{{ $opd->telepon }}</td>
                    <td class="text-left">{{ $opd->email }}</td>
                    <td class="text-left">{{ $opd->alamat }}</td>
                </tr>
            @empty
                <tr>
                    <td>Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
