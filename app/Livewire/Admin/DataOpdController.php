<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use App\Models\Pengguna;
use GuzzleHttp\Psr7\Request;
use Livewire\{
    Component,
    WithoutUrlPagination,
    WithPagination
};

class DataOpdController extends Component
{
    use WithPagination, WithoutUrlPagination; 
    public $id,$nama,$telepon,$email,$original_password,$alamat;
    public $cari;
    public $limit_paginations = 10; // default nilai

    public $pagination = "default";

    public function simpanData(){
      
        
        if ($this->id == null) {
            $validated = $this->validate(Pengguna::$rules,Pengguna::$message);
            $pengguna = new Pengguna();
            $pengguna->nama = $this->nama;
            $pengguna->telepon = $this->telepon;    
            $pengguna->email = $this->email;
            $pengguna->alamat= $this->alamat;
            $pengguna->original_password = $this->original_password;
            $pengguna->encrypt_password = bcrypt($this->original_password);
            $pengguna->role = "Pengguna";
            $simpanPengguna = $pengguna->save();
            if($simpanPengguna){
                $this->resetPage();
                $this->notifSuccess('Data berhasil disimpan');
            }else{
                $this->resetPage();
                $this->notifError('Data gagal disimpan');
            }
        }else{
            $pengguna = Pengguna::findOrFail($this->id);
            if($this->original_password == null){
                $pengguna->nama = $this->nama;
                $pengguna->telepon = $this->telepon;    
                $pengguna->email = $this->email;
                $pengguna->alamat= $this->alamat;
                $simpanPengguna = $pengguna->update();
                if($simpanPengguna){
                    $this->resetPage();
                    $this->notifSuccess('Data berhasil diupdate');
                }else{
                    $this->resetPage();
                    $this->notifError('Data gagal diupdate');
                }
            }else{
                $pengguna->nama = $this->nama;
                $pengguna->telepon = $this->telepon;    
                $pengguna->email = $this->email;
                $pengguna->alamat = $this->alamat;
                $pengguna->original_password = $this->original_password;
                $pengguna->encrypt_password = bcrypt($this->original_password);
                $simpanPengguna = $pengguna->update();
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

    public function editData($id){
        $pengguna = Pengguna::findOrFail($id);
        $this->id = $pengguna->id;
        $this->nama =  $pengguna->nama;
        $this->telepon = $pengguna->telepon;
        $this->email = $pengguna->email;
        $this->alamat = $pengguna->alamat;
    }
    public function hapusData(Pengguna $id)
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
        $query = Pengguna::query();

        if (!empty($this->cari)) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->cari . '%')
                  ->orWhere('telepon', 'like', '%' . $this->cari . '%')
                  ->orWhere('email', 'like', '%' . $this->cari . '%'); // sesuaikan kolom yang ingin dicari
            });
        }

        $data['list'] = $query->paginate($this->limit_paginations);
        return view('admin.data_opd.index', $data);
    }

    public function resetData(){
        $this->resetPage();
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

    private  function resetPage(){
        $this->id = '';
        $this->nama = '';
        $this->telepon = '';
        $this->email = '';
        $this->alamat = '';
        $this->original_password = '';
        
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
