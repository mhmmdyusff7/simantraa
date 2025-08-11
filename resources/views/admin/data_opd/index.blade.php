
<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data OPD</h2>
        <div class="d-flex align-items-center gap-2">
            <!-- Tombol Import Excel -->
            <button type="button" class="btn btn-info mr-1" data-bs-toggle="modal" data-bs-target="#importExcel">
                <i class="bi bi-upload"></i> Import Excel
            </button>
            <!-- Tombol Tambah Data -->
            <button type="button" class="btn btn-success mr-1" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>
            <!-- Tombol Cetak -->
            <a href="{{ url('admin/cetak', ['section' => 'opd']) }}" class="btn btn-secondary" target="_blank">
                <i class="fa fa-print"></i> Cetak Data OPD
            </a>
        </div>
    </div>
    <div class="row">
        {{-- box table col 4-12 --}}
        <div class="col-12">
            <div class="bg-white rounded-md custom-shadow p-4">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <input type="search" wire:model.live="cari" class="form-control" placeholder="Cari Data ...">
                    </div>
                    <div>
                        <select wire:model.live="limit_paginations" class="form-select">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered custom-table">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama OPD</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Alamat Kantor</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $pengguna)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-left">{{ $pengguna->nama }}</td>
                                    <td class="text-left">{{ $pengguna->telepon }}</td>
                                    <td class="text-left">{{ $pengguna->email }}</td>
                                    <td class="text-left">{{ Str::limit($pengguna->alamat, 20) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"
                                            wire:click="editData({{ $pengguna->id }})">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $pengguna->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <x-modal.modal-delete id="hapus{{ $pengguna->id }}"
                                    aksi="hapusData({{ $pengguna->id }})" />
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{-- show of entries 1-20 data --}}
                    {{ $list->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import Excel -->
    <div wire:ignore.self class="modal fade" id="importExcel" tabindex="-1" aria-labelledby="importExcelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="importExcel" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelLabel">Import Data OPD dari Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" wire:model="file_excel" class="form-control" accept=".xlsx,.xls" required>
                    </div>
                    <div class="modal-footer">
                      <button  wire:loading.attr="disabled" type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah/Edit Data -->
    <x-modal.modal-post id="tambah" title="{{ $id ? 'FORM EDIT DATA OPD' : 'FORM TAMBAH DATA OPD' }}"
        btnTitle="{{ $id ? 'UPDATE' : 'SIMPAN' }}" aksi="simpanData">
        <x-input.input model="nama" label="Nama OPD" placeholder="Masukan nama OPD ..." />
        <x-input.input model="telepon" label="No.Telepon / HP" placeholder="Masukan nomor telepon ..." />
        <x-input.input model="email" label="Email Kantor" placeholder="Masukan nomor email ..." />
        <x-input.input model="alamat" label="Alamat Kantor" placeholder="Masukan alamat kantor ..." />
        <x-input.input model="password" label="Password" placeholder="Masukan password ..." />
    </x-modal.modal-post>
</div>