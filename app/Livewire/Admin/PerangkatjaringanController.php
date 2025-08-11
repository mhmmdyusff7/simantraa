<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use App\Models\{Opd, Perangkat};
use Livewire\{Component, WithoutUrlPagination, WithPagination};


class PerangkatjaringanController extends Component
{

    use WithPagination, WithoutUrlPagination;


    public $limit_paginations = 5;
    public $pagination = "default";
    public $cari;
    // === PERANGKAT JARINGAN ===
    public $id;
    public $opd_id;
    public $kategori_perangkat = 'Perangkat Jaringan';
    public $tanggal_pembelian_jaringan;
    public $kode_jaringan;
    public $nama_jaringan;
    public $spesifikasi_jaringan;
    public $status_jaringan;
    public $nama_ruangan_jaringan;
    public $penanggung_jawab_jaringan;
    // Simpan or update data
    public function simpanData()
    {
        $this->validate(Perangkat::$rulesjaringan, Perangkat::$messagesjaringan);
        $updateorCreate =Perangkat::updateOrCreate(
            ['id' => $this->id], // Ini adalah array pertama: Kondisi pencarian
            [ // Ini adalah array kedua: Data yang akan dibuat atau diperbarui
                'opd_id' => $this->opd_id,
                'kategori_perangkat' => $this->kategori_perangkat,
                'tanggal_pembelian_jaringan' => $this->tanggal_pembelian_jaringan,
                'kode_jaringan' => $this->kode_jaringan,
                'nama_jaringan' => $this->nama_jaringan,
                'spesifikasi_jaringan' => $this->spesifikasi_jaringan,
                'status_jaringan' => $this->status_jaringan,
                'nama_ruangan_jaringan' => $this->nama_ruangan_jaringan,
                'penanggung_jawab_jaringan' => $this->penanggung_jawab_jaringan
            
            ]
        );

        // Simpan atau update data
        if ($updateorCreate->wasRecentlyCreated) {
            // Jika data baru dibuat
            $this->notifSuccess('Data berhasil disimpan');
        } else {
            // Jika data yang sudah ada diperbarui
            $this->notifSuccess('Data berhasil diupdate');
        }
        $this->resetData();
    }


    public function editData($id)
    {
        $Perangkat = Perangkat::findOrFail($id);
        $this->id = $Perangkat->id;
        $this->opd_id = $Perangkat->opd_id;
        $this->kategori_perangkat = $Perangkat->kategori_perangkat;
        $this->tanggal_pembelian_jaringan = $Perangkat->tanggal_pembelian_jaringan;
        $this->kode_jaringan = $Perangkat->kode_jaringan;
        $this->nama_jaringan = $Perangkat->nama_jaringan;
        $this->spesifikasi_jaringan = $Perangkat->spesifikasi_jaringan;
        $this->status_jaringan = $Perangkat->status_jaringan;
        $this->nama_ruangan_jaringan = $Perangkat->nama_ruangan_jaringan;
        $this->penanggung_jawab_jaringan = $Perangkat->penanggung_jawab_jaringan;    
    }

    public function hapusData(Perangkat $id)
    {
        $hapus = $id->delete();
        if ($hapus) {
            $this->notifSuccess('Data berhasil dihapus');
        } else {
            $this->notifError('Data gagal dihapus');
        }
        $this->resetData();
    }

    // Render data
    #[Title('Perangkat Jaringan')]
    public function render()
    {
        $query = Perangkat::with('opd')
            ->where('kategori_perangkat', '=', 'Perangkat Jaringan')
            ->orderBy('id', 'asc');
        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('kode_jaringan', 'like', "%{$this->cari}%")
                    ->orWhere('nama_jaringan', 'like', "%{$this->cari}%")
                    ->orWhere('tanggal_pembelian_jaringan', 'like', "%{$this->cari}%")
                    ->orWhere('spesifikasi_jaringan', 'like', "%{$this->cari}%")
                    ->orWhere('status_jaringan', 'like', "%{$this->cari}%")
                    ->orWhere('nama_ruangan_jaringan', 'like', "%{$this->cari}%")
                    ->orWhere('penanggung_jawab_jaringan', 'like', "%{$this->cari}%")
                    ->orWhereHas('opd', function ($q2) {
                        $q2->where('nama', 'like', "%{$this->cari}%");
                    });
            });
        }
        $data['list_opd'] = Opd::get();
        $data['list'] = $query->paginate($this->limit_paginations);
        return view('admin.perangkat.perangkat_jaringan', $data);
    }
    public function updatingCari()
    {
        $this->resetPage();
    }
    public function updatingLimitPaginations()
    {
        $this->resetPage();
    }
    public function resetForm()
    {
        $this->resetData();
    }
    // data yang direset di form
    private function resetData()
    {
        $this->id = null; 
        $this->opd_id = null;
        $this->tanggal_pembelian_jaringan = '';
        $this->kode_jaringan = '';
        $this->nama_jaringan = '';
        $this->spesifikasi_jaringan = '';
        $this->status_jaringan = '';
        $this->nama_ruangan_jaringan = '';
        $this->penanggung_jawab_jaringan = '';
        $this->resetErrorBag();
    }

    private function notifSuccess($pesan)
    {
        $this->js("
        $('.modal').modal('hide');
        Swal.fire({
            title: '$pesan',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        });
        ");
    }

    private function notifError($pesan)
    {
        $this->js("
        $('.modal').modal('hide');
        Swal.fire({
            title: '$pesan',
            icon: 'error',
            timer: 1500,
            showConfirmButton: false
        });
        ");
    }
}

