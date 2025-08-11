<?php

namespace App\Livewire\Opd;

use Livewire\Attributes\Title;
use App\Models\{Opd, Perangkat};
use Illuminate\Support\Facades\Auth;
use Livewire\{Component, WithoutUrlPagination, WithPagination};
use Livewire\Attributes\Layout;


class PerangkatjaringanController extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $limit_paginations = 5;
    public $pagination = "default";
    public $cari;
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
    

    public function mount()
    {
        $this->opd_id = Auth::guard('opd')->user()->id;
    }

    public function simpanData()
    {

        $this->validate(Perangkat::$rulesjaringan, Perangkat::$messagesjaringan);

        $updateorCreate = Perangkat::updateOrCreate(
            ['id' => $this->id, 'opd_id' => $this->opd_id],
            [
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

        if ($updateorCreate->wasRecentlyCreated) {
            $this->notifSuccess('Data berhasil disimpan');
        } else {
            $this->notifSuccess('Data berhasil diupdate');
        }
        $this->resetData();
    }

    public function editData($id)
    {
        $Perangkat = Perangkat::where('id', $id)
                                ->where('opd_id', $this->opd_id)
                                ->firstOrFail();

        $this->id = $Perangkat->id;
        $this->opd_id = $Perangkat->opd_id;
        $this->kategori_perangkat = $Perangkat->kategori_perangkat;
        $this->tanggal_pembelian_jaringan = $Perangkat->tanggal_pembelian_jaringan;
        $this->kode_jaringan = $Perangkat->kode_jaringan;
        $this->nama_jaringan = $Perangkat->nama_jaringan;
        $this->spesifikasi_jaringan = $Perangkat->spesifikasi_jaringan;
        $this->status_jaringan = $Perangkat->status_jaringan;
        $this->nama_ruangan_jaringan = $Perangkat->nama_ruangan_jaringan;
        $this->penanggung_jawab_jaringan = $Perangkat->penanggung_jawab;
         
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
        #[Title('Opd || Data Perangkat Jaringan')]
        #[Layout('components.layouts.opd.app')]
    public function render()
    {
        $query = Perangkat::with('opd')
            ->where('kategori_perangkat', '=', 'Perangkat Jaringan')
            ->where('opd_id', '=', $this->opd_id)
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

        // Ambil semua data OPD untuk dropdown
        $data['list_opd'] = Opd::orderBy('nama')->get();
        $data['opd'] = Opd::find($this->opd_id);
        $data['list'] = $query->paginate($this->limit_paginations);

        return view('opd.perangkat.perangkat_jaringan', $data);
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
            }).then(() => {
                window.Livewire.navigate('/simantra/opd/perangkatjaringan');
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
            }).then(() => {
                window.Livewire.navigate('/simantra/opd/perangkatjaringan');
            });
        ");
    }
}
