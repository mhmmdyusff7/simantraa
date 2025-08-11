<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use App\Models\{Opd, Perangkat};
use Livewire\{Component, WithoutUrlPagination, WithPagination};


class PerangkatkeamananController extends Component
{

    use WithPagination, WithoutUrlPagination;


    public $limit_paginations = 5;
    public $pagination = "default";
    public $cari;
    // === PERANGKAT keamanan ===
    public $id;
    public $opd_id;
    public $kategori_perangkat = 'Perangkat Keamanan';
    public $tanggal_pembelian_keamanan;
    public $kode_keamanan;
    public $nama_keamanan;
    public $spesifikasi_keamanan;
    public $status_keamanan;
    public $nama_ruangan_keamanan;
    public $penanggung_jawab_keamanan;
    // Simpan or update data
    public function simpanData()
    
    {
        
        
        $this->validate(Perangkat::$ruleskeamanan, Perangkat::$messageskeamanan);
        $updateorCreate =Perangkat::updateOrCreate(
            ['id' => $this->id], // Ini adalah array pertama: Kondisi pencarian
            [ // Ini adalah array kedua: Data yang akan dibuat atau diperbarui
                'opd_id' => $this->opd_id,
                'kategori_perangkat' => $this->kategori_perangkat,
                'tanggal_pembelian_keamanan' => $this->tanggal_pembelian_keamanan,
                'kode_keamanan' => $this->kode_keamanan,
                'nama_keamanan' => $this->nama_keamanan,
                'spesifikasi_keamanan' => $this->spesifikasi_keamanan,
                'status_keamanan' => $this->status_keamanan,
                'nama_ruangan_keamanan' => $this->nama_ruangan_keamanan,
                'penanggung_jawab_keamanan' => $this->penanggung_jawab_keamanan
            
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
        $this->tanggal_pembelian_keamanan = $Perangkat->tanggal_pembelian_keamanan;
        $this->kode_keamanan = $Perangkat->kode_keamanan;
        $this->nama_keamanan = $Perangkat->nama_keamanan;
        $this->spesifikasi_keamanan = $Perangkat->spesifikasi_keamanan;
        $this->status_keamanan = $Perangkat->status_keamanan;
        $this->nama_ruangan_keamanan = $Perangkat->nama_ruangan_keamanan;
        $this->penanggung_jawab_keamanan = $Perangkat->penanggung_jawab_keamanan;    
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
    #[Title('Perangkat keamanan')]
    public function render()
    {
        $query = Perangkat::with('opd')
            ->where('kategori_perangkat', '=', 'Perangkat keamanan')
            ->orderBy('id', 'asc');
        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('kode_keamanan', 'like', "%{$this->cari}%")
                    ->orWhere('nama_keamanan', 'like', "%{$this->cari}%")
                    ->orWhere('tanggal_pembelian_keamanan', 'like', "%{$this->cari}%")
                    ->orWhere('spesifikasi_keamanan', 'like', "%{$this->cari}%")
                    ->orWhere('status_keamanan', 'like', "%{$this->cari}%")
                    ->orWhere('nama_ruangan_keamanan', 'like', "%{$this->cari}%")
                    ->orWhere('penanggung_jawab_keamanan', 'like', "%{$this->cari}%")
                    ->orWhereHas('opd', function ($q2) {
                        $q2->where('nama', 'like', "%{$this->cari}%");
                    });
            });
        }
        $data['list_opd'] = Opd::get();
        $data['list'] = $query->paginate($this->limit_paginations);
        return view('admin.perangkat.perangkat_keamanan', $data);
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
        $this->tanggal_pembelian_keamanan = '';
        $this->kode_keamanan = '';
        $this->nama_keamanan = '';
        $this->spesifikasi_keamanan = '';
        $this->status_keamanan = '';
        $this->nama_ruangan_keamanan = '';
        $this->penanggung_jawab_keamanan = '';
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

