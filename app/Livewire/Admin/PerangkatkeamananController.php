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

    public $id;
    public $opd_id;
    public $kategori_perangkat = 'Perangkat keamanan';
    public $nama_perangkat_keamanan;
    public $keamanan_jumlah_perangkat;
    public $keamanan_status_reviu;
    public $keamanan_alasan_tidakdigunakan;
    public $keamanan_status_kepemilikan;
    public $keamanan_pengelola;

    public function simpanData()
    {
        if ($this->keamanan_status_reviu === "Tidak Digunakan") {
            $this->validate([
                'keamanan_alasan_tidakdigunakan' => 'required',
            ], [
                'keamanan_alasan_tidakdigunakan.required' => 'Wajib diisi',
            ]);
        }

        $this->validate(Perangkat::$ruleskeamanan, Perangkat::$messageskeamanan);

        $updateorCreate = Perangkat::updateOrCreate(
            ['id' => $this->id],
            [
                'opd_id' => $this->opd_id,
                'kategori_perangkat' => $this->kategori_perangkat,
                'nama_perangkat_keamanan' => $this->nama_perangkat_keamanan,
                'keamanan_jumlah_perangkat' => $this->keamanan_jumlah_perangkat,
                'keamanan_status_reviu' => $this->keamanan_status_reviu,
                'keamanan_alasan_tidakdigunakan' => $this->keamanan_alasan_tidakdigunakan,
                'keamanan_status_kepemilikan' => $this->keamanan_status_kepemilikan,
                'keamanan_pengelola' => $this->keamanan_pengelola,
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
        $Perangkat = Perangkat::findOrFail($id);
        $this->id = $Perangkat->id;
        $this->opd_id = $Perangkat->opd_id;
        $this->kategori_perangkat = $Perangkat->kategori_perangkat;
        $this->nama_perangkat_keamanan = $Perangkat->nama_perangkat_keamanan;
        $this->keamanan_jumlah_perangkat = $Perangkat->keamanan_jumlah_perangkat;
        $this->keamanan_status_reviu = $Perangkat->keamanan_status_reviu;
        $this->keamanan_alasan_tidakdigunakan = $Perangkat->keamanan_alasan_tidakdigunakan;
        $this->keamanan_status_kepemilikan = $Perangkat->keamanan_status_kepemilikan;
        $this->keamanan_pengelola = $Perangkat->keamanan_pengelola;
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

    #[Title('Perangkat Keamanan')]
    public function render()
    {
        $query = Perangkat::with('opd')
            ->where('kategori_perangkat', '=', 'Perangkat keamanan')
            ->orderBy('id', 'asc');

        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('nama_perangkat_keamanan', 'like', "%{$this->cari}%")
                    ->orWhere('keamanan_jumlah_perangkat', 'like', "%{$this->cari}%")
                    ->orWhere('keamanan_status_reviu', 'like', "%{$this->cari}%")
                    ->orWhere('keamanan_alasan_tidakdigunakan', 'like', "%{$this->cari}%")
                    ->orWhere('keamanan_status_kepemilikan', 'like', "%{$this->cari}%")
                    ->orWhere('keamanan_pengelola', 'like', "%{$this->cari}%")
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

    private function resetData()
    {
        $this->reset([
            'id',
            'opd_id',
            'nama_perangkat_keamanan',
            'keamanan_jumlah_perangkat',
            'keamanan_status_reviu',
            'keamanan_alasan_tidakdigunakan',
            'keamanan_status_kepemilikan',
            'keamanan_pengelola',
        ]);

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
