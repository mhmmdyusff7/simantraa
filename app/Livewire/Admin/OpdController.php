<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use App\Models\Opd;
use Livewire\{
    Component,
    WithoutUrlPagination,
    WithPagination
};

class OpdController extends Component
{
    use WithPagination, WithoutUrlPagination; 
    public $id,$nama,$telepon,$email,$password,$alamat;
    public $cari;
    public $limit_paginations = 5; // default nilai

    public $pagination = "default";


  

    public function simpanData(){
      
        
        if ($this->id == null) {
            $validated = $this->validate(Opd::$rules,Opd::$message);
            $opd = new Opd();
            $opd->nama = $this->nama;
            $opd->telepon = $this->telepon;    
            $opd->email = $this->email;
            $opd->alamat= $this->alamat;
            $opd->password = bcrypt($this->password);
            $simpanPengguna = $opd->save();
            if($simpanPengguna){
                $this->resetPage();
                $this->notifSuccess('Data berhasil disimpan');
            }else{
                $this->resetPage();
                $this->notifError('Data gagal disimpan');
            }
        }else{
            $opd = Opd::findOrFail($this->id);
            if($this->password == null){
                $opd->nama = $this->nama;
                $opd->telepon = $this->telepon;    
                $opd->email = $this->email;
                $opd->alamat= $this->alamat;
                $simpanPengguna = $opd->update();
                if($simpanPengguna){
                    $this->resetPage();
                    $this->notifSuccess('Data berhasil diupdate');
                }else{
                    $this->resetPage();
                    $this->notifError('Data gagal diupdate');
                }
            }else{
                $opd->nama = $this->nama;
                $opd->telepon = $this->telepon;    
                $opd->email = $this->email;
                $opd->alamat = $this->alamat;
                $opd->password = bcrypt($this->password);
                $simpanPengguna = $opd->update();
                if($simpanPengguna){
                    $this->resetPage();
                    $this->notifSuccess('Data berhasil diupdate');
                }else{
                    $this->resetPage();
                    $this->notifError('Data gagal diupdate');
                }
            }
        }

        
    }
    // ketika klik batal di btn data akan kereset
   public function resetForm() { $this->resetData(); }
  

    public function editData($id){
        $opd = Opd::findOrFail($id);
        $this->id = $opd->id;
        $this->nama =  $opd->nama;
        $this->telepon = $opd->telepon;
        $this->email = $opd->email;
        $this->alamat = $opd->alamat;
    }
    public function hapusData(Opd $id)
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

    #[Title('Data OPD')] 
    public function render(){
        $query = Opd::query();

        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->cari . '%')
                  ->orWhere('telepon', 'like', '%' . $this->cari . '%')
                  ->orWhere('email', 'like', '%' . $this->cari . '%')
                  ->orWhere('alamat', 'like', '%' . $this->cari . '%'); 
            });
        }
        $data['list'] = $query->paginate($this->limit_paginations);
        return view('admin.data_opd.index', $data);
    }


     // Reset halaman saat pencarian atau limit berubah
     public function updatingCari()
     {
         $this->resetPage();
     }
 
     public function updatingLimitPaginations()
     {
         $this->resetPage();
     }

    // Reset semua properti setelah simpan/edit
    private function resetData()
    {
        $this->id = '';
        $this->nama = '';
        $this->telepon = '';
        $this->email = '';  
        $this->alamat = '';
        $this->password = '';

        $this->resetErrorBag();
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
