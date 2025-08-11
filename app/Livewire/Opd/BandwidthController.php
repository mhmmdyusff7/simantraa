<?php

namespace App\Livewire\Opd;

use Livewire\Attributes\Title;
use App\Models\{Opd, Perangkat}; // Pastikan Perangkat adalah model yang benar untuk data bandwidth
use Illuminate\Support\Facades\Auth;
use Livewire\{Component, WithoutUrlPagination, WithPagination};
use Livewire\Attributes\Layout;

class BandwidthController extends Component
{
    use WithPagination, WithoutUrlPagination;

    // Properti untuk pengaturan pagination dan pencarian
    public $limit_paginations = 5;
    public $pagination = "default";
    public $cari;

    // Properti publik yang mengikat ke input form (untuk tambah/edit)
    public $id; // Digunakan untuk identifikasi data saat edit
    public $opd_id;
    public $kategori_perangkat = 'Bandwidth'; // Nilai default untuk kategori perangkat
    public $bandwidth_nama_jaringan;
    public $bandwidth_mbps;
    public $bandwidth_jumlah_pemasangan;
    public $bandwidth_alasan_pengadaan;
    public $bandwidth_status_reviu;
    public $bandwidth_penyesuaian_operasional;

    
    public function mount()
    {
        $this->opd_id = Auth::guard('opd')->user()->id;
    }

    
    // Metode untuk menampilkan data ke view
    #[Title('Opd || Data Bandwidth')]
    #[Layout('components.layouts.opd.app')]
    public function render()
    {
        // Query untuk mengambil data perangkat dengan kategori 'Bandwidth'
        $query = Perangkat::with('opd')
                          ->where('kategori_perangkat', '=', 'Bandwidth')
                          ->where('opd_id', '=', $this->opd_id)
                          ->orderBy('id', 'desc');

        // Logika pencarian
        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('bandwidth_nama_jaringan', 'like', "%{$this->cari}%")
                  ->orWhere('bandwidth_mbps', 'like', "%{$this->cari}%")
                  ->orWhere('bandwidth_jumlah_pemasangan', 'like', "%{$this->cari}%")
                  ->orWhere('bandwidth_alasan_pengadaan', 'like', "%{$this->cari}%")
                  ->orWhere('bandwidth_status_reviu', 'like', "%{$this->cari}%")
                  ->orWhere('bandwidth_penyesuaian_operasional', 'like', "%{$this->cari}%")
                  ->orWhereHas('opd', function ($q2) {
                $q2->where('nama', 'like', "%{$this->cari}%");
            });
    });
}

        // Mengirim data ke view

        $data['list'] = $query->paginate($this->limit_paginations);

        return view('opd.perangkat.bandwidth', $data);
    }

    // Metode untuk menyimpan atau memperbarui data
    public function simpanData()
    {
        
        $rules = Perangkat::$rulesbandwidth;
        
        $this->validate($rules, Perangkat::$messagesbandwidth);

        // Menggunakan updateOrCreate untuk menambah atau memperbarui data
        $updateorCreate = Perangkat::updateOrCreate(
            ['id' => $this->id], // Kriteria untuk mencari data yang ada
            [
                'opd_id' => $this->opd_id,
                'kategori_perangkat' => $this->kategori_perangkat, // PERBAIKAN: Pastikan kategori_perangkat disimpan
                'bandwidth_nama_jaringan' => $this->bandwidth_nama_jaringan,
                'bandwidth_mbps' => $this->bandwidth_mbps,
                'bandwidth_jumlah_pemasangan' => $this->bandwidth_jumlah_pemasangan,
                'bandwidth_alasan_pengadaan' => $this->bandwidth_alasan_pengadaan,
                'bandwidth_status_reviu' => $this->bandwidth_status_reviu,
                'bandwidth_penyesuaian_operasional' => $this->bandwidth_penyesuaian_operasional,
           
            ]
        );

        // Memberikan notifikasi sukses berdasarkan apakah data baru dibuat atau diperbarui
        if ($updateorCreate->wasRecentlyCreated) {
            $this->notifSuccess('Data berhasil disimpan');
        } else {
            $this->notifSuccess('Data berhasil diupdate');
        }

        $this->resetData(); // Reset form setelah operasi
    }

    // Metode untuk mengisi form saat mengedit data
    public function editData($id)
    {
        $perangkat = Perangkat::findOrFail($id); // PERBAIKAN: Konsistensi nama variabel ($perangkat)
        $this->id = $perangkat->id;
        $this->kategori_perangkat = $perangkat->kategori_perangkat;
        $this->bandwidth_nama_jaringan = $perangkat->bandwidth_nama_jaringan;
        $this->bandwidth_mbps = $perangkat->bandwidth_mbps;
        $this->bandwidth_jumlah_pemasangan = $perangkat->bandwidth_jumlah_pemasangan;
        $this->bandwidth_alasan_pengadaan = $perangkat->bandwidth_alasan_pengadaan;
        $this->bandwidth_status_reviu = $perangkat->bandwidth_status_reviu;
        $this->bandwidth_penyesuaian_operasional = $perangkat->bandwidth_penyesuaian_operasional;
        
    }

    // Metode untuk menghapus data
    public function hapusData(Perangkat $id) // Menggunakan model binding
    {
        $hapus = $id->delete();
        if ($hapus) {
            $this->notifSuccess('Data berhasil dihapus');
        } else {
            $this->notifError('Data gagal dihapus');
        }
        $this->resetData(); // Reset form setelah operasi
    }

    // Hooks Livewire untuk mereset pagination saat pencarian atau limit berubah
    public function updatingCari()
    {
        $this->resetPage(); // Reset halaman ke 1 saat mencari
    }

    public function updatingLimitPaginations()
    {
        $this->resetPage(); // Reset halaman ke 1 saat limit berubah
    }

    // Metode untuk mereset form (digunakan juga oleh tombol resetForm)
    public function resetForm()
    {
        $this->resetData();
    }

    // Metode private untuk mereset semua properti form
    private function resetData()
    {
        $this->id = null; // PERBAIKAN: Reset ID juga agar mode tambah berfungsi dengan benar

        $this->kategori_perangkat = 'Bandwidth'; // PERBAIKAN: Pastikan ini kembali ke default 'Bandwidth'
        $this->bandwidth_nama_jaringan = '';
        $this->bandwidth_mbps = '';
        $this->bandwidth_jumlah_pemasangan = '';
        $this->bandwidth_alasan_pengadaan = '';
        $this->bandwidth_status_reviu = '';
        $this->bandwidth_penyesuaian_operasional = '';
        $this->resetErrorBag(); // Reset pesan error validasi
    }

    // Metode private untuk notifikasi sukses (menggunakan JavaScript SweetAlert)
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

    // Metode private untuk notifikasi error (menggunakan JavaScript SweetAlert)
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