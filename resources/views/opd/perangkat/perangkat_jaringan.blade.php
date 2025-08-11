<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data Perangkat Jaringan</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>

            </button><a href="{{ url('opd/cetak', ['section' => 'jaringan']) }}" class="btn btn-secondary" target="_blank">
                <i class="bi bi-print"></i> Cetak Perangakat Jaringan
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
                            @foreach ($list as $perangkat_jaringan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ $perangkat_jaringan->tanggal_pembelian_jaringan
                                            ? \Carbon\Carbon::parse($perangkat_jaringan->tanggal_pembelian_jaringan)->format('d-m-Y')
                                            : '-' }}
                                    </td>
                                    <td class="text-center">{{ $perangkat_jaringan->kode_jaringan }}</td>
                                    <td class="text-center">{{ $perangkat_jaringan->nama_jaringan }}</td>
                                    <td class="text-center">{{ $perangkat_jaringan->spesifikasi_jaringan }}</td>
                                    <td class="text-center">{{ $perangkat_jaringan->status_jaringan }}</td>
                                    <td class="text-center">{{ $perangkat_jaringan->nama_ruangan_jaringan }}</td>
                                    <td class="text-center">{{ $perangkat_jaringan->penanggung_jawab_jaringan }}</td>
                                </tr>
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
            {{-- Hapus input OPD --}}
            <div class="col-md-12">
                <x-input.input model="tanggal_pembelian_jaringan" label="Tanggal Pembelian" type="date"
                    placeholder="Masukan Tanggal Pembelian..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="kode_jaringan" label="Kode Perangkat Jaringan"
                    placeholder="Masukan Kode perangkatjaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="nama_jaringan" label="Nama Perangkat Jaringan"
                    placeholder="Masukan Nama perangkat jaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="spesifikasi_jaringan" label="Spesifikasi Perangkat Jaringan"
                    placeholder="Masukan Spesifikasi perangkat jaringan..." />
            <div class="col-md-12">
                <x-input.select_live model="status_jaringan" label="Status Jaringan">
                    <option value="">Pilih Status Jaringan</option>
                    <option value="Baik">Baik</option>
                    <option value="Perlu Diperbaiki">Perlu Diperbaiki</option>
                    <option value="Rusak Berat">Rusak Berat</option>
                </x-input.select_live>
            </div>
            <div class="col-md-12">
                <x-input.input model="nama_ruangan_jaringan" label="Nama Ruangan"
                    placeholder="Masukan Nama Ruangan Jaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="penanggung_jawab_jaringan" label="Penanggung Jawab"
                    placeholder="Masukan Penanggung Jawab Jaringan..." />
            </div>
        </div>
    </x-modal.modal-post>
</div>
