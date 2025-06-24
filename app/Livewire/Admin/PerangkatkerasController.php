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
    public $kategori_perangkat = 'Perangkat keras';
    public $nama_perangkat_keras;
    public $keras_lebihdari5_tahun;
    public $keras_satusampai5_tahun;
    public $keras_kurangdari1_tahun;
    public $keras_jumlah;
    public $keras_digunakan;
    public $keras_tidakdigunakan;
    public $keras_alasan_tidakdigunakan;

    // === PERANGKAT KEAMANAN ===
    public $nama_perangkat_keamanan = null;
    public $keamanan_jumlah_perangkat = null;
    public $keamanan_status_reviu = null;
    public $keamanan_alasan_tidakdigunakan = null;
    public $keamanan_status_kepemilikan = null;
    public $keamanan_pengelola = null;

    // === BANDWIDTH ===
    public $bandwidth_nama_keras = null;
    public $bandwidth_mbps = null;
    public $bandwidth_jumlah_pemasangan = null;
    public $bandwidth_alasan_pengadaan = null;
    public $bandwidth_status_reviu = null;
    public $bandwidth_penyesuaian_operasional = null;

    // Simpan or update data
    public function simpanData()
    {

        // Validasi alasan tidak digunakan
        if ((int) $this->keras_tidakdigunakan > 0) {
            $this->validate([
                'keras_alasan_tidakdigunakan' => 'required',
            ], [
                'keras_alasan_tidakdigunakan.required' => 'Wajib diisi',
            ]);
        }

        $this->validate(Perangkat::$ruleskeras, Perangkat::$messageskeras);
        $updateorCreate = Perangkat::updateOrCreate(
            ['id' => $this->id], 
            [ 
                'opd_id' => $this->opd_id,
                'kategori_perangkat' => $this->kategori_perangkat,
                'nama_perangkat_keras' => $this->nama_perangkat_keras,
                'keras_lebihdari5_tahun' => (int)$this->keras_lebihdari5_tahun,
                'keras_satusampai5_tahun' => (int)$this->keras_satusampai5_tahun,
                'keras_kurangdari1_tahun' => (int)$this->keras_kurangdari1_tahun,
                'keras_jumlah' => (int)$this->keras_jumlah,
                'keras_digunakan' => (int)$this->keras_digunakan,
                'keras_tidakdigunakan' => (int)$this->keras_tidakdigunakan,
                'keras_alasan_tidakdigunakan' => $this->keras_alasan_tidakdigunakan,
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

        // keras
        $this->nama_perangkat_keras = $Perangkat->nama_perangkat_keras;
        $this->keras_lebihdari5_tahun = $Perangkat->keras_lebihdari5_tahun;
        $this->keras_satusampai5_tahun = $Perangkat->keras_satusampai5_tahun;
        $this->keras_kurangdari1_tahun = $Perangkat->keras_kurangdari1_tahun;
        $this->keras_jumlah = $Perangkat->keras_jumlah;
        $this->keras_digunakan = $Perangkat->keras_digunakan;
        $this->keras_tidakdigunakan = $Perangkat->keras_tidakdigunakan;
        $this->keras_alasan_tidakdigunakan = $Perangkat->keras_alasan_tidakdigunakan;    
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
    #[Title('Perangkat Keras')]
    public function render()
    {

        // Hitung otomatis keras
        if ((int) $this->keras_lebihdari5_tahun && (int) $this->keras_satusampai5_tahun && (int) $this->keras_kurangdari1_tahun) {
            $this->keras_jumlah = $this->calculatePlus((int) $this->keras_lebihdari5_tahun, (int) $this->keras_satusampai5_tahun, (int) $this->keras_kurangdari1_tahun);
            $this->keras_tidakdigunakan = $this->calculateMinus((int) $this->keras_jumlah, (int) $this->keras_digunakan);
        }

        $query = Perangkat::with('opd')
    ->where('kategori_perangkat', '=', 'Perangkat keras')
    ->orderBy('id', 'desc');

if (!empty($this->cari)) {
    $query->where(function ($q) {
        $q->where('nama_perangkat_keras', 'like', "%{$this->cari}%")
            ->orWhere('keras_lebihdari5_tahun', 'like', "%{$this->cari}%")
            ->orWhere('keras_satusampai5_tahun', 'like', "%{$this->cari}%")
            ->orWhere('keras_kurangdari1_tahun', 'like', "%{$this->cari}%")
            ->orWhere('keras_jumlah', 'like', "%{$this->cari}%")
            ->orWhere('keras_digunakan', 'like', "%{$this->cari}%")
            ->orWhere('keras_tidakdigunakan', 'like', "%{$this->cari}%")
            ->orWhere('keras_alasan_tidakdigunakan', 'like', "%{$this->cari}%")
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
        $this->nama_perangkat_keras = '';
        $this->keras_lebihdari5_tahun = '';
        $this->keras_satusampai5_tahun = '';
        $this->keras_kurangdari1_tahun = '';
        $this->keras_jumlah = '';
        $this->keras_digunakan = '';
        $this->keras_tidakdigunakan = '';
        $this->keras_alasan_tidakdigunakan = '';
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
