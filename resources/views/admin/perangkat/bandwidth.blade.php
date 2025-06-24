<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data Bandwidth</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>
            <a href="{{ url('admin/cetak', ['section' => 'bandwidth']) }}" class="btn btn-secondary" target="_blank">
                <i class="bi bi-print"></i> Cetak Bandwidth
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
                                <th class="text-center">Nama Jaringan</th>
                                <th class="text-center">Bandwidth/Mbps</th>
                                <th class="text-center">Jumlah pemasangan</th>
                                <th class="text-center">Alasan pengadaan</th>
                                <th class="text-center">Status Reviu</th>
                                <th class="text-center">Penyesuaian operasional</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $bandwidth)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $bandwidth->opd->nama ?? '-' }}</td>
                                    <td>{{ $bandwidth->bandwidth_nama_jaringan }}</td>
                                    <td>{{ $bandwidth->bandwidth_mbps }}</td>
                                    <td>{{ $bandwidth->bandwidth_jumlah_pemasangan }}</td>
                                    <td>{{ $bandwidth->bandwidth_alasan_pengadaan ?? '-' }}</td>
                                    <td>{{ $bandwidth->bandwidth_status_reviu }}</td>
                                    <td>{{ $bandwidth->bandwidth_penyesuaian_operasional ?? '-' }}</td>
                            
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"
                                            wire:click="editData({{ $bandwidth->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $bandwidth->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                 <x-modal.modal-delete id="hapus{{ $bandwidth->id }}"
                                    aksi="hapusData({{ $bandwidth->id }})" />
                            @endforeach
                        </tbody>
                    </table>
                </x-table.table-search>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Data -->
    <x-modal.modal-post id="tambah" title="{{ $id ? 'FORM EDIT DATA BANDWIDTH' : 'FORM TAMBAH DATA BANDWIDTH' }}"
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
                <x-input.input model="bandwidth_nama_jaringan" label="Nama Jaringan"
                    placeholder="Masukan nama jaringan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="bandwidth_mbps" label="Bandwidth(Mbps)"
                    placeholder="Masukan jumlah mbps yang diperlukan..." /> 
            </div>
            <div class="col-md-12">
                <x-input.input model="bandwidth_jumlah_pemasangan" label="Jumlah pemasangan"
                    placeholder="Masukan jumlah pemasangan..." />
            </div>
            <div class="col-md-12">
                <x-input.input model="bandwidth_alasan_pengadaan" label="Alasan pengadaan"
                    placeholder="Masukan alasan pengadaan..." />
      
            <div class="col-md-12">
                <x-input.select model="bandwidth_status_reviu" label="Status Reviu">
                    <option value="">-- Pilih --</option>
                    <option value="Digunakan">Digunakan</option>
                    <option value="Tidak Digunakan">Tidak Digunakan</option>
                </x-input.select>
            </div>
            <div class="col-md-12">
                <x-input.input model="bandwidth_penyesuaian_operasional" label="Penyesuaian operasional"
                    placeholder="Masukan penyesuaian operasional..." />
        </div>
    </x-modal.modal-post>
</div>

