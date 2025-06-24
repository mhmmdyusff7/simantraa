<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data Perangkat Keamanan</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>
            <a href="{{ url('admin/cetak', ['section' => 'keamanan']) }}" class="btn btn-secondary" target="_blank">
                <i class="bi bi-print"></i> Cetak Perangkat Keamanan
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
                                <th class="text-center">Nama Perangkat</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Status Reviu</th>
                                <th class="text-center">Alasan Tidak Digunakan</th>
                                <th class="text-center">Kepemilikan</th>
                                <th class="text-center">Pengelola</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $perangkat_keamanan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $perangkat_keamanan->opd->nama ?? '-' }}</td>
                                    <td>{{ $perangkat_keamanan->nama_perangkat_keamanan }}</td>
                                    <td>{{ $perangkat_keamanan->keamanan_jumlah_perangkat }}</td>
                                    <td>{{ $perangkat_keamanan->keamanan_status_reviu }}</td>
                                    <td>{{ $perangkat_keamanan->keamanan_alasan_tidakdigunakan ?: '-' }}</td>
                                    <td>{{ $perangkat_keamanan->keamanan_status_kepemilikan}}</td>
                                    <td>{{ $perangkat_keamanan->keamanan_pengelola}}</td>
                            
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"
                                            wire:click="editData({{ $perangkat_keamanan->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $perangkat_keamanan->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                 <x-modal.modal-delete id="hapus{{ $perangkat_keamanan->id }}"
                                    aksi="hapusData({{ $perangkat_keamanan->id }})" />
                            @endforeach
                        </tbody>
                    </table>
                </x-table.table-search>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Data -->
    <x-modal.modal-post id="tambah" title="{{ $id ? 'FORM EDIT DATA PERANGKAT KEAMANAN' : 'FORM TAMBAH DATA PERANGKAT KEAMANAN' }}"
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
                <x-input.input model="nama_perangkat_keamanan" label="Nama Perangkat Keamanan"
                    placeholder="Masukan nama perangkat keamanan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="keamanan_jumlah_perangkat" label="Jumlah"
                    placeholder="Jumlah perangkat keamanan ..."  />
            </div>
      
            <div class="col-md-12">
                <x-input.select_live model="keamanan_status_reviu" label="Status Reviu">
                    <option value="">-- Pilih --</option>
                    <option value="Digunakan">Digunakan</option>
                    <option value="Tidak Digunakan">Tidak Digunakan</option>
                </x-input.select_live>
            </div>
            @if ($keamanan_status_reviu == 'Tidak Digunakan')
            <div class="col-md-12">
                <x-input.input_live model="keamanan_alasan_tidakdigunakan" label="Alasan Tidak Digunakan" placeholder="Alasan tidak digunakannya perangkat keamanan..."/> 
            </div>
            @endif
            
            <div class="col-md-12">
                <x-input.input model="keamanan_status_kepemilikan" label="Kepemilikan"
                    placeholder="Kepemilikan perangkat keamanan ..."  />
            </div>
            <div class="col-md-12">
                <x-input.input model="keamanan_pengelola" label="Pengelola"
                    placeholder="Pengelola perangkat keamanan ..."  />
            </div>
        </div>
    </x-modal.modal-post>
</div>
