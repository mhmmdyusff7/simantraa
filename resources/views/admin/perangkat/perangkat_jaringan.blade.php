<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data Perangkat Jaringan</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>
            </button><a href="{{ url('admin/cetak', ['section' => 'jaringan']) }}" class="btn btn-secondary" target="_blank">
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
                                <th class="text-center">Nama OPD</th>
                                <th class="text-center">Nama Perangkat</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Digunakan</th>
                                <th class="text-center">Tidak Digunakan</th>
                                <th class="text-center">Alasan Tidak Digunakan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $perangkat_jaringan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $perangkat_jaringan->opd->nama }}</td>
                                    <td>{{ $perangkat_jaringan->nama_perangkat_jaringan }}</td>
                                    <td>{{ $perangkat_jaringan->jaringan_jumlah }}</td>
                                    <td>{{ $perangkat_jaringan->jaringan_digunakan }}</td>
                                    <td>{{ $perangkat_jaringan->jaringan_tidakdigunakan }}</td>
                                    <td>{{ $perangkat_jaringan->jaringan_alasan_tidakdigunakan ?: '-' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"
                                            wire:click="editData({{ $perangkat_jaringan->id }})">
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
    <x-modal.modal-post id="tambah" title="{{ $id ? 'FORM EDIT DATA PERANGKAT JARINGAN' : 'FORM TAMBAH DATA PERANGKAT JARINGAN' }}"
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
                <x-input.input model="nama_perangkat_jaringan" label="Nama Perangkat Jaringan"
                    placeholder="Masukan nama perangkat jaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="jaringan_lebihdari5_tahun" label="Penggunaan > 5 tahun"
                    placeholder="Penggunaan Lebih dari 5 tahun..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="jaringan_satusampai5_tahun" label="Penggunaan 1 - 5 Tahun"
                    placeholder="Penggunaan 1 - 5 Tahun ..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="jaringan_kurangdari1_tahun" label="Penggunaan  < 1 Tahun"
                    placeholder="Penggunaan  < 1 Tahun ..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="jaringan_jumlah" label="Jumlah" placeholder="Jumlah perangkat jaringan ..."
                    readonly />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="jaringan_digunakan" label="Digunakan"
                    placeholder="Perangkat jaringan yang digunakan ..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="jaringan_tidakdigunakan" label="Tidak Digunakan"
                    placeholder="Perangkat jaringan yang tidak digunakan ..." readonly />
            </div>
            <div class="col-md-12">
                <x-input.textarea model="jaringan_alasan_tidakdigunakan" label="Alasan Tidak Digunakan "
                    placeholder="Alasan tidak digunakannya perangkat jaringan ..." />
            </div>
        </div>
    </x-modal.modal-post>
</div>
