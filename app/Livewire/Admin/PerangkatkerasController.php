<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use App\Models\{Opd, Perangkat};
use Livewire\{Component, WithoutUrlPagination, WithPagination};


class PerangkatkerasController extends Component
{

    use WithPagination, WithoutUrlPagination;


    public $limit_paginations = 5;
    public $pagination = "default";
    public $cari;
    // === PERANGKAT keras ===
    public $id;
    public $opd_id;
    public $kategori_perangkat = 'Perangkat Keras';
    public $tanggal_pembelian_keras;
    public $kode_keras;
    public $nama_keras;
    public $spesifikasi_keras;
    public $status_keras;
    public $nama_ruangan_keras;
    public $penanggung_jawab_keras;
    // Simpan or update data
    public function simpanData()
    
    {
        
        
        $this->validate(Perangkat::$ruleskeras, Perangkat::$messageskeras);
        $updateorCreate =Perangkat::updateOrCreate(
            ['id' => $this->id], // Ini adalah array pertama: Kondisi pencarian
            [ // Ini adalah array kedua: Data yang akan dibuat atau diperbarui
                'opd_id' => $this->opd_id,
                'kategori_perangkat' => $this->kategori_perangkat,
                'tanggal_pembelian_keras' => $this->tanggal_pembelian_keras,
                'kode_keras' => $this->kode_keras,
                'nama_keras' => $this->nama_keras,
                'spesifikasi_keras' => $this->spesifikasi_keras,
                'status_keras' => $this->status_keras,
                'nama_ruangan_keras' => $this->nama_ruangan_keras,
                'penanggung_jawab_keras' => $this->penanggung_jawab_keras
            
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
        $this->tanggal_pembelian_keras = $Perangkat->tanggal_pembelian_keras;
        $this->kode_keras = $Perangkat->kode_keras;
        $this->nama_keras = $Perangkat->nama_keras;
        $this->spesifikasi_keras = $Perangkat->spesifikasi_keras;
        $this->status_keras = $Perangkat->status_keras;
        $this->nama_ruangan_keras = $Perangkat->nama_ruangan_keras;
        $this->penanggung_jawab_keras = $Perangkat->penanggung_jawab_keras;    
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
    #[Title('Perangkat keras')]
    public function render()
    {
        $query = Perangkat::with('opd')
            ->where('kategori_perangkat', '=', 'Perangkat keras')
            ->orderBy('id', 'asc');
        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('kode_keras', 'like', "%{$this->cari}%")
                    ->orWhere('nama_keras', 'like', "%{$this->cari}%")
                    ->orWhere('tanggal_pembelian_keras', 'like', "%{$this->cari}%")
                    ->orWhere('spesifikasi_keras', 'like', "%{$this->cari}%")
                    ->orWhere('status_keras', 'like', "%{$this->cari}%")
                    ->orWhere('nama_ruangan_keras', 'like', "%{$this->cari}%")
                    ->orWhere('penanggung_jawab_keras', 'like', "%{$this->cari}%")
                    ->orWhereHas('opd', function ($q2) {
                        $q2->where('nama', 'like', "%{$this->cari}%");
                    });
            });
        }
        $data['list_opd'] = Opd::get();
        $data['list'] = $query->paginate($this->limit_paginations);
        return view('admin.perangkat.perangkat_keras', $data);
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
        $this->tanggal_pembelian_keras = '';
        $this->kode_keras = '';
        $this->nama_keras = '';
        $this->spesifikasi_keras = '';
        $this->status_keras = '';
        $this->nama_ruangan_keras = '';
        $this->penanggung_jawab_keras = '';
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

