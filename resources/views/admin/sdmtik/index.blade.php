<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">Data SDM TIK</h2>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Data
            </button>
            <a href="{{ url('admin/cetak', ['section' => 'sdmtik']) }}" class="btn btn-secondary" target="blank">
                <i class="bi bi-print"></i> Cetak SDM TIK
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
                            {{-- <option value="5">5</option> --}}
                            <option value="5">5</option>
                            {{-- <option value="15">15</option> --}}
                            <option value="10">10</option>
                            {{-- <option value="25">25</option> --}}
                            <option value="15">15</option>
                            {{-- <option value="35">35</option> --}}
                            <option value="20">20</option>
                            {{-- <option value="45">45</option> --}}
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered custom-table">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">OPD</th>
                                <th class="text-center">Nama SDM TIK</th>
                                <th class="text-center">TIK Status Pegawai</th>
                                <th class="text-center">Status Reviu Pegawai</th>
                                <th class="text-center">Alasan Pindah</th>
                                <th class="text-center">Kompetensi Pekerjaan</th>
                                <th class="text-center">Sertifikasi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $sdmtik)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $sdmtik->opd->nama ?? '-' }}</td>
                                <td class="text-center">{{ $sdmtik->nama_sdm_tik }}</td>
                                <td class="text-center">{{ $sdmtik->tik_status_pegawai }}</td>
                                <td class="text-center">{{ $sdmtik->status_reviu_pegawai }}</td>
                                <td class="text-center">{{ $sdmtik->alasan_pindah ?: '-' }}</td>
                                <td class="text-center">{{ $sdmtik->kompetensi_pekerjaan }}</td>
                                <td class="text-center">{{ $sdmtik->sertifikasi }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah" wire:click="editData({{ $sdmtik->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $sdmtik->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <x-modal.modal-delete id="hapus{{ $sdmtik->id }}" aksi="hapusData({{ $sdmtik->id }})" />
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
   <x-modal.modal-post id="tambah" title="{{ $id ? 'FORM EDIT DATA SDM TIK' : 'FORM TAMBAH DATA SDM TIK' }}" btnTitle="{{ $id ? 'UPDATE' : 'SIMPAN' }}"  aksi="simpanData">
        <x-input.select_live model="opd_id" label="OPD">
            <option value="">-- Pilih --</option>
            @foreach ($list_opd as $opd)
                <!-- -->
                <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
            @endforeach
        </x-input.select_live>
        <x-input.input model="nama_sdm_tik" label="Nama SDM TIK" placeholder="Masukan nama sdm tik..." />
        <x-input.select model="tik_status_pegawai" label="Status Pegawai" placeholder="Masukan status pegawai...">
            <option value="">-- Pilih --</option>
            <option value="PNS">PNS</option>
            <option value="CPNS">CPNS</option>
            <option value="P3K">P3K</option>
            <option value="Outsourcing (OS)">Outsourcing (OS)</option>
        </x-input.select>
        <x-input.select_live model="status_reviu_pegawai" label="Status Reviu Pegawai">
            <option value="">-- Pilih --</option>
            <option value="Tetap">Tetap</option>
            <option value="Pindah">Pindah</option>
        </x-input.select_live>
        
        @if ($status_reviu_pegawai == 'Pindah')
            <x-input.input model="alasan_pindah" label="Alasan Pindah" placeholder="Masukan alasan pindah..." />
        @endif
        <x-input.input model="pendidikan_terakhir" label="Pendidikan Terakhir" placeholder="Masukan pendidikan terakhir..." />
        <x-input.input model="kompetensi_pekerjaan" label="Kompetensi Pekerjaan" placeholder="Masukan kompetensi pekerjaan..." />
        <x-input.input model="tupoksi" label="Tupoksi" placeholder="Masukan tupoksi..." />
        <x-input.input model="pengalaman_training" label="Pengalaman Training" placeholder="Masukan pengalaman training..." />
        <x-input.textarea model="sertifikasi" label="Sertifikasi" placeholder="Masukan sertifikasi..." />
   </x-modal.modal-post>
   <!-- END Modal -->


   
</div>

