<?php

namespace App\Livewire\Opd;

use Livewire\Attributes\Title;
use App\Models\{Opd, Sdmtik}; // Pastikan model Sdmtik diimpor dengan benar
use Illuminate\Support\Facades\Auth;
use Livewire\{Component, WithoutUrlPagination, WithPagination};
use Livewire\Attributes\Layout; // Tambahkan Layout attribute jika digunakan


class SdmtikController extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $cari;
    public $limit_paginations = 5;
    public $pagination = "default";

    public $id;
    public $opd_id;
    public $nama_sdm_tik;
    public $tik_status_pegawai;
    public $status_reviu_pegawai;
    public $alasan_pindah;
    public $pendidikan_terakhir;
    public $kompetensi_pekerjaan;
    public $tupoksi;
    public $pengalaman_training;
    public $sertifikasi;

    public function mount()
    {
        // Set opd_id dari pengguna yang sedang login
        $this->opd_id = Auth::guard('opd')->user()->id;
    }

    public function simpanData()
    {
        // Pindahkan validasi alasan_pindah ke sini karena ini adalah metode untuk menyimpan data
        if ($this->status_reviu_pegawai == "Pindah") {
            $this->validate([
                'alasan_pindah' => 'required',
            ], [
                'alasan_pindah.required' => 'Wajib diisi',
            ]);
        }

        // Lakukan validasi utama
        $this->validate(Sdmtik::$rules, Sdmtik::$message);

        // Pastikan opd_id disertakan dalam kondisi pencarian untuk updateOrCreate
        $updateorCreate = Sdmtik::updateOrCreate(
            ['id' => $this->id, 'opd_id' => $this->opd_id], // Tambahkan opd_id di kondisi pencarian
            [
                'nama_sdm_tik' => $this->nama_sdm_tik,
                'tik_status_pegawai' => $this->tik_status_pegawai,
                'status_reviu_pegawai' => $this->status_reviu_pegawai,
                'alasan_pindah' => $this->alasan_pindah,
                'pendidikan_terakhir' => $this->pendidikan_terakhir,
                'kompetensi_pekerjaan' => $this->kompetensi_pekerjaan,
                'tupoksi' => $this->tupoksi,
                'pengalaman_training' => $this->pengalaman_training,
                'sertifikasi' => $this->sertifikasi,
            ]
        );

        if ($updateorCreate->wasRecentlyCreated) {
            $this->notifSuccess('Data berhasil disimpan');
        } else {
            $this->notifSuccess('Data berhasil diupdate');
        }

        $this->resetData();
    }

    public function resetForm()
    {
        $this->resetData();
    }

    private function resetData()
    {
        $this->id = null;
        $this->opd_id = null; // Tetap set opd_id ke user yang login
        $this->nama_sdm_tik = '';
        $this->tik_status_pegawai = '';
        $this->status_reviu_pegawai = '';
        $this->alasan_pindah = '';
        $this->pendidikan_terakhir = '';
        $this->kompetensi_pekerjaan = '';
        $this->tupoksi = '';
        $this->pengalaman_training = '';
        $this->sertifikasi = '';
        $this->resetErrorBag();
    }

    public function editData($id)
    {
        // Ambil data berdasarkan ID DAN opd_id yang sedang login
        $sdmtik = Sdmtik::where('id', $id)
                        ->where('opd_id', $this->opd_id)
                        ->firstOrFail(); // Akan throw 404 jika tidak ditemukan atau bukan milik OPD ini

        $this->id = $sdmtik->id;
        $this->opd_id = $sdmtik->opd_id;
        $this->nama_sdm_tik = $sdmtik->nama_sdm_tik;
        $this->tik_status_pegawai = $sdmtik->tik_status_pegawai;
        $this->status_reviu_pegawai = $sdmtik->status_reviu_pegawai;
        $this->alasan_pindah = $sdmtik->alasan_pindah;
        $this->pendidikan_terakhir = $sdmtik->pendidikan_terakhir;
        $this->kompetensi_pekerjaan = $sdmtik->kompetensi_pekerjaan;
        $this->tupoksi = $sdmtik->tupoksi;
        $this->pengalaman_training = $sdmtik->pengalaman_training;
        $this->sertifikasi = $sdmtik->sertifikasi;
    }

    public function hapusData(Sdmtik $id)
    {
        // Periksa apakah data yang akan dihapus milik OPD yang sedang login
        if ($id->opd_id !== $this->opd_id) {
            $this->notifError('Anda tidak memiliki izin untuk menghapus data ini.');
            return; // Hentikan eksekusi jika bukan milik OPD ini
        }

        $hapus = $id->delete();
        if ($hapus) {
            $this->resetPage(); // Reset halaman setelah penghapusan
            $this->notifSuccess('Data berhasil dihapus');
        } else {
            $this->resetPage(); // Reset halaman meskipun gagal
            $this->notifError('Data gagal dihapus');
        }
    }
    #[Title('Opd || Data SDM TIK')] // Tambahkan Title dan Layout di tingkat kelas
    #[Layout('components.layouts.opd.app')] // Sesuaikan dengan layout aplikasi OPD Anda
    public function render()
    {
        // Filter data berdasarkan opd_id dari pengguna yang sedang login
        $query = Sdmtik::with('opd')
            ->where('opd_id', '=', $this->opd_id) // Filter berdasarkan opd_id
            ->orderBy('id', 'desc');

        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('nama_sdm_tik', 'like', '%' . $this->cari . '%')
                    ->orWhere('tik_status_pegawai', 'like', '%' . $this->cari . '%')
                    ->orWhere('status_reviu_pegawai', 'like', '%' . $this->cari . '%')
                    ->orWhere('alasan_pindah', 'like', '%' . $this->cari . '%')
                    ->orWhere('pendidikan_terakhir', 'like', '%' . $this->cari . '%')
                    ->orWhere('kompetensi_pekerjaan', 'like', '%' . $this->cari . '%')
                    ->orWhere('tupoksi', 'like', '%' . $this->cari . '%')
                    ->orWhere('pengalaman_training', 'like', '%' . $this->cari . '%')
                    ->orWhere('sertifikasi', 'like', '%' . $this->cari . '%')
                    ->orWhereHas('opd', function ($q2) {
                        $q2->where('nama', 'like', "%{$this->cari}%");
                    });
            });
        }
        
        $data['list'] = $query->paginate($this->limit_paginations);

        // Perbaiki view path agar mengacu pada folder opd
        return view('opd.sdmtik.index', $data);
    }

    public function updatingCari()
    {
        $this->resetPage();
    }

    public function updatingLimitPaginations()
    {
        $this->resetPage();
    }

    private function notifSuccess($pesan)
    {
        $this->js("
            $('.modal').modal('hide');
            Swal.fire({
                title: '$pesan',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
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
                showConfirmButton: false,
            });
        ");
    }
}
