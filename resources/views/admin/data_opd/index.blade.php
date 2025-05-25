<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data OPD</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
            Tambah Data
        </button>
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
                            {{-- <option value="5">5</option> --}}
                            <option value="10">10</option>
                            {{-- <option value="15">15</option> --}}
                            <option value="20">20</option>
                            {{-- <option value="25">25</option> --}}
                            <option value="30">30</option>
                            {{-- <option value="35">35</option> --}}
                            <option value="40">40</option>
                            {{-- <option value="45">45</option> --}}
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Kantor</th>
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
                                <td class="text-left">{{ $pengguna->alamat}}</td>
                                <td class="text-left">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah" wire:click="editData({{ $pengguna->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $pengguna->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <x-modal.modal-delete id="hapus{{ $pengguna->id }}" aksi="hapusData({{ $pengguna->id }})" />
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

     <!-- Modal -->
    
     <!-- ENDModal -->

   <!-- Modal -->
   <x-modal.modal-post id="tambah" title="{{ $id ? 'FORM EDIT DATA OPD' : 'FORM TAMBAH DATA OPD' }}" btnTitle="{{ $id ? 'UPDATE' : 'SIMPAN' }}"  aksi="simpanData">
    <x-input.input model="nama" label="Nama Kantor" placeholder="Masukan nama kantor..." />
    <x-input.input model="telepon" label="No.Telepon / HP" placeholder="Masukan nomor telepon ..." />
    <x-input.input model="email" label="Email Kantor" placeholder="Masukan nomor email ..." />
    <x-input.input model="alamat" label="Alamat Kantor" placeholder="Masukan alamat kantor ..." />
    <x-input.input model="original_password" label="Password" placeholder="Masukan password ..." />
   </x-modal.modal-post>
   <!-- END Modal -->


   
</div>

