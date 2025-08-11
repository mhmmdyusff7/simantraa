<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data Perangkat Jaringan</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>
            <a href="{{ url('admin/cetak', ['section' => 'jaringan']) }}" class="btn btn-secondary" target="_blank">
                <i class="bi bi-print"></i> Cetak Perangkat Jaringan
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="bg-white rounded-md custom-shadow p-4">
                <x-table.table-search tableHeader :tableFooter="$list">
                    <table id="data-table" class="table table-bordered custom-table">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama OPD</th>
                                <th class="text-center">Tanggal Pembelian</th>
                                <th class="text-center">Kode Perangkat</th>
                                <th class="text-center">Nama Perangkat</th>
                                <th class="text-center">Spesifikasi</th>
                                <th class="text-center">Status </th>
                                <th class="text-center">Nama Ruangan</th>
                                <th class="text-center">Penanggung Jawab</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $perangkat_jaringan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-left">{{ $perangkat_jaringan->opd->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        {{ $perangkat_jaringan->tanggal_pembelian_jaringan
                                            ? \Carbon\Carbon::parse($perangkat_jaringan->tanggal_pembelian_jaringan)->format('d-m-Y')
                                            : '-' }}
                                    </td>
                                    <td class="text-left">{{ $perangkat_jaringan->kode_jaringan }}</td>
                                    <td class="text-left">{{ $perangkat_jaringan->nama_jaringan }}</td>
                                    <td class="text-left">{{ $perangkat_jaringan->spesifikasi_jaringan }}</td>
                                    <td class="text-center">{{ $perangkat_jaringan->status_jaringan }}</td>
                                    <td class="text-left">{{ $perangkat_jaringan->nama_ruangan_jaringan }}</td>
                                    <td class="text-left">{{ $perangkat_jaringan->penanggung_jawab_jaringan }}</td>
                                    <td class="text-center" style="width: 150px;">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah" wire:click="editData({{ $perangkat_jaringan->id }})">
    
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $perangkat_jaringan->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <x-modal.modal-delete id="hapus{{ $perangkat_jaringan->id }}"
                                    aksi="hapusData({{ $perangkat_jaringan->id }})" />
                            @endforeach
                        </tbody>
                    </table>
                </x-table.table-search>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Data -->
    <x-modal.modal-post id="tambah"
        title="{{ $id ? 'FORM EDIT DATA PERANGKAT JARINGAN' : 'FORM TAMBAH DATA PERANGKAT JARINGAN' }}"
        btnTitle="{{ $id ? 'UPDATE' : 'SIMPAN' }}" aksi="simpanData">
        <div class="row">
            <div class="col-md-12">
                <x-input.select model="opd_id" label="Nama OPD">
                    <option value="">-- Pilih --</option>
                    @foreach ($list_opd as $opd)
                        <!-- -->
                        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div class="col-md-12">
                <x-input.input model="tanggal_pembelian_jaringan" label="Tanggal Pembelian Perangkat" type="date" />
            </div>
            <div class="col-md-12">
                <x-input.input model="kode_jaringan" label="Kode Perangkat"
                    placeholder="Masukan Kode Perangkat jaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="nama_jaringan" label="Nama Perangkat"
                    placeholder="Masukan Nama Perangkat jaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="spesifikasi_jaringan" label="Spesifikasi Perangkat"
                    placeholder="Masukan Spesifikasi Perangkat jaringan..." />
            </div>
            <div class="col-md-12"></div>
            <x-input.select_live model="status_jaringan" label="Status Pengunaan">
                <option value="">-- Pilih --</option>
                <option value="Baik">Baik</option>
                <option value="Perlu Diperbaiki">Perlu Diperbaiki</option>
                <option value="Rusak Berat">Rusak Berat</option>
            </x-input.select_live>
        </div>
        <div class="col-md-12">
            <x-input.input model="nama_ruangan_jaringan" label="Nama Ruangan"
                placeholder="Masukan Nama Ruangan Perangkat jaringan..." />
        </div>
        <div class="col-md-12">
            <x-input.input model="penanggung_jawab_jaringan" label="Penanggung Jawab"
                placeholder="Masukan Penanggung Jawab Perangkat jaringan..." />
        </div>
        
        {{-- <div class="col-md-12">
                <x-input.input model="status_kepemilikan_jaringan" label="Status Kepemilikan"
                    placeholder="Masukan Status Kepemilikan Perangkat jaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="pengelola_jaringan" label="Pengelola Perangkat jaringan"
                    placeholder="Masukan Pengelola Perangkat jaringan..." />
            </div> --}}
    </x-modal.modal-post>
</div>
