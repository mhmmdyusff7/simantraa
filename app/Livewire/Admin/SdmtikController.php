<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use App\Models\{
    Opd,
    Sdmtik
};
use Livewire\{
    Component,
    WithoutUrlPagination,
    WithPagination
};

class SdmtikController extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $cari;
    public $limit_paginations = 5; // default nilai
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
    

    public function mount(){
        if ($this->status_reviu_pegawai == "Pindah") {
            $this->validate([
                'alasan_pindah' => 'required',
            ], [
                'alasan_pindah.required' => 'Wajib diisi',
                
            ]);
        }
    }

    public function simpanData(){

       if ($this->status_reviu_pegawai== "Pindah") {
            $this->validate([
                'alasan_pindah' => 'required',
            ], [
                'alasan_pindah.required' => 'Wajib diisi',
                
            ]);
        }

        $this->validate(Sdmtik::$rules, Sdmtik::$message);
        $updateorCreate = Sdmtik::updateOrCreate(
            ['id' => $this->id], 
            [ 
                'opd_id' => $this->opd_id,
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
    // ketika klik batal di btn data akan kereset
   public function resetForm() { $this->resetData(); }
   private function resetData()
    {
        
        $this->id = null;
        $this->opd_id = null;
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

    public function editData($id){
        $sdmtik = Sdmtik::findOrFail($id);
        $this->id = $sdmtik->id;
        $this->opd_id = $sdmtik->opd_id;
        $this->nama_sdm_tik =  $sdmtik->nama_sdm_tik;
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
        $hapus = $id->delete();
        if($hapus){
            $this->resetPage();
            $this->notifSuccess('Data berhasil dihapus');
        }else{
            $this->resetPage();
            $this->notifError('Data gagal dihapus');
        }
    }

    #[Title('Data SDM TIK')] 
    public function render(){
        

        $query = Sdmtik::with('opd')->orderBy('id', 'desc');

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
        $data['list_opd'] = Opd::get();
        $data['list'] = $query->paginate($this->limit_paginations);
        return view('admin.sdmtik.index', $data);
    }
// fungsi dari tombol ketika klik batal
    

     // Reset halaman saat pencarian atau limit berubah
     public function updatingCari()
     {
         $this->resetPage();
     }
 
     public function updatingLimitPaginations()
     {
         $this->resetPage();
     }

    

    private  function notifSuccess($pesan){
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
    private  function notifError($pesan){
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
