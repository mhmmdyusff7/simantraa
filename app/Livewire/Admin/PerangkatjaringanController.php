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
    public $nama_perangkat_jaringan;
    public $jaringan_lebihdari5_tahun;
    public $jaringan_satusampai5_tahun;
    public $jaringan_kurangdari1_tahun;
    public $jaringan_jumlah;
    public $jaringan_digunakan;
    public $jaringan_tidakdigunakan;
    public $jaringan_alasan_tidakdigunakan;
    // Simpan or update data
    public function simpanData()
    {

        // Validasi alasan tidak digunakan
        if ((int) $this->jaringan_tidakdigunakan > 0) {
            $this->validate([
                'jaringan_alasan_tidakdigunakan' => 'required',
            ], [
                'jaringan_alasan_tidakdigunakan.required' => 'Wajib diisi',
                
            ]);
        }

        $this->validate(Perangkat::$rulesjaringan, Perangkat::$messagesjaringan);
        $updateorCreate = Perangkat::updateOrCreate(
            ['id' => $this->id], // Ini adalah array pertama: Kondisi pencarian
            [ // Ini adalah array kedua: Data yang akan dibuat atau diperbarui
                'opd_id' => $this->opd_id,
                'kategori_perangkat' => $this->kategori_perangkat,
                'nama_perangkat_jaringan' => $this->nama_perangkat_jaringan,
                'jaringan_lebihdari5_tahun' => (int)$this->jaringan_lebihdari5_tahun,
                'jaringan_satusampai5_tahun' => (int)$this->jaringan_satusampai5_tahun,
                'jaringan_kurangdari1_tahun' => (int)$this->jaringan_kurangdari1_tahun,
                'jaringan_jumlah' => (int)$this->jaringan_jumlah,
                'jaringan_digunakan' => (int)$this->jaringan_digunakan,
                'jaringan_tidakdigunakan' => (int)$this->jaringan_tidakdigunakan,
                'jaringan_alasan_tidakdigunakan' => $this->jaringan_alasan_tidakdigunakan,
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

        // Jaringan
        $this->nama_perangkat_jaringan = $Perangkat->nama_perangkat_jaringan;
        $this->jaringan_lebihdari5_tahun = $Perangkat->jaringan_lebihdari5_tahun;
        $this->jaringan_satusampai5_tahun = $Perangkat->jaringan_satusampai5_tahun;
        $this->jaringan_kurangdari1_tahun = $Perangkat->jaringan_kurangdari1_tahun;
        $this->jaringan_jumlah = $Perangkat->jaringan_jumlah;
        $this->jaringan_digunakan = $Perangkat->jaringan_digunakan;
        $this->jaringan_tidakdigunakan = $Perangkat->jaringan_tidakdigunakan;
        $this->jaringan_alasan_tidakdigunakan = $Perangkat->jaringan_alasan_tidakdigunakan;    
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
        // Hitung otomatis jaringan
        if ((int) $this->jaringan_lebihdari5_tahun && (int) $this->jaringan_satusampai5_tahun && (int) $this->jaringan_kurangdari1_tahun) {
            $this->jaringan_jumlah = $this->calculatePlus((int) $this->jaringan_lebihdari5_tahun, (int) $this->jaringan_satusampai5_tahun, (int) $this->jaringan_kurangdari1_tahun);
            $this->jaringan_tidakdigunakan = $this->calculateMinus((int) $this->jaringan_jumlah, (int) $this->jaringan_digunakan);
        }

        $query = Perangkat::with('opd')
    ->where('kategori_perangkat', '=', 'Perangkat Jaringan')
    ->orderBy('id', 'asc');

if (!empty($this->cari)) {
    $query->where(function ($q) {
        $q->where('nama_perangkat_jaringan', 'like', "%{$this->cari}%")
            ->orWhere('jaringan_lebihdari5_tahun', 'like', "%{$this->cari}%")
            ->orWhere('jaringan_satusampai5_tahun', 'like', "%{$this->cari}%")
            ->orWhere('jaringan_kurangdari1_tahun', 'like', "%{$this->cari}%")
            ->orWhere('jaringan_jumlah', 'like', "%{$this->cari}%")
            ->orWhere('jaringan_digunakan', 'like', "%{$this->cari}%")
            ->orWhere('jaringan_tidakdigunakan', 'like', "%{$this->cari}%")
            ->orWhere('jaringan_alasan_tidakdigunakan', 'like', "%{$this->cari}%")
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
        $this->resetData();
    }
    public function updatingLimitPaginations()
    {
        $this->resetData();
    }
    public function resetForm()
    {
        $this->resetData();
    }

    // Reset semua properti setelah simpan/edit
    private function resetData()
    {
        $this->id = null; 
        $this->opd_id = null;
        $this->nama_perangkat_jaringan = '';
        $this->jaringan_lebihdari5_tahun = '';
        $this->jaringan_satusampai5_tahun = '';
        $this->jaringan_kurangdari1_tahun = '';
        $this->jaringan_jumlah = '';
        $this->jaringan_digunakan = '';
        $this->jaringan_tidakdigunakan = '';
        $this->jaringan_alasan_tidakdigunakan = '';
        $this->resetErrorBag();
    }

    private function calculatePlus($a, $b, $c)
    {
        return  $a + $b + $c;
    }
    private function calculateMinus($a, $b)
    {
        return  $a - $b;
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
