<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data Perangkat Keras</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>
            </button><a href="{{ url('admin/cetak', ['section' => 'keras']) }}" class="btn btn-secondary" target="_blank">
                <i class="bi bi-print"></i> Cetak Perangkat Keras
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
                            @foreach ($list as $perangkat_keras)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $perangkat_keras->opd->nama ?? '-' }}</td>
                                    <td>{{ $perangkat_keras->nama_perangkat_keras }}</td>
                                    <td>{{ $perangkat_keras->keras_jumlah }}</td>
                                    <td>{{ $perangkat_keras->keras_digunakan }}</td>
                                    <td>{{ $perangkat_keras->keras_tidakdigunakan }}</td>
                                    <td>{{ $perangkat_keras->keras_alasan_tidakdigunakan ?: '-' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"
                                            wire:click="editData({{ $perangkat_keras->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $perangkat_keras->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <x-modal.modal-delete id="hapus{{ $perangkat_keras->id }}"
                                    aksi="hapusData({{ $perangkat_keras->id }})" />
                            @endforeach
                        </tbody>
                    </table>
                </x-table.table-search>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Data -->
    <x-modal.modal-post id="tambah" title="{{ $id ? 'FORM EDIT DATA PERANGKAT KERAS' : 'FORM TAMBAH DATA PERANGKAT KERAS' }}"
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
                <x-input.input model="nama_perangkat_keras" label="Nama Perangkat Keras"
                    placeholder="Masukan nama perangkat keras..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="keras_lebihdari5_tahun" label="Penggunaan > 5 tahun"
                    placeholder="Penggunaan lebih dari 5 tahun..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="keras_satusampai5_tahun" label="Penggunaan 1 - 5 Tahun"
                    placeholder="Penggunaan 1 - 5 tahun ..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="keras_kurangdari1_tahun" label="Penggunaan  < 1 Tahun"
                    placeholder="Penggunaan  < 1 tahun ..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="keras_jumlah" label="Jumlah " placeholder="Jumlah perangkat keras ..." readonly />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="keras_digunakan" label="Digunakan"
                    placeholder="Perangkat keras yang digunakan ..." />
            </div>
            <div class="col-md-12">
                <x-input.input_live model="keras_tidakdigunakan" label="Tidak Digunakan"
                    placeholder="Perangkat keras yang tidak digunakan ..." readonly />
            </div>
            <div class="col-md-12">
                <x-input.textarea model="keras_alasan_tidakdigunakan" label="Alasan Tidak Digunakan "
                    placeholder="Alasan tidak digunakannya perangkat keras ..." />
            </div>
        </div>
    </x-modal.modal-post>
</div>
