<?php

namespace App\Livewire\Admin;

use App\Imports\OpdImport;
use Livewire\Attributes\Title;
use App\Models\Opd;
use Livewire\{
    Component,
    WithoutUrlPagination,
    WithPagination,
    WithFileUploads
};
use Maatwebsite\Excel\Facades\Excel; // Tambahkan baris ini

class OpdController extends Component
{
    use WithPagination, WithoutUrlPagination,WithFileUploads; 
    public $id,$nama,$telepon,$email,$password,$alamat;
    public $cari;
    public $limit_paginations = 5; // default nilai

    public $pagination = "default";
    public $file_excel;

//   fungsi import excel
    public function importExcel(){
        
    $this->validate([
        'file_excel' => 'required|file|max:10000',
    ],[
        'file_excel.required' => 'Silahkan pilih file excel',
        'file_excel.file' => 'Silahkan pilih file excel yang valid',
        'file_excel.max' => 'File excel tidak boleh lebih dari 10MB',
    ]);
    $file = $this->file_excel;
    Excel::import(new OpdImport , $file);
    $this->resetPage();
    $this->notifSuccess('Data berhasil diimpor');
}
    public function simpanData(){

         
        $data = [
            'nama' => $this->nama,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'alamat' => $this->alamat,
        ];

        if($this->id != null){
            $this->validate([
                'telepon' => 'numeric',
            ],[
                'telepon.numeric' => 'Nomor telepon harus berupa angka',
            ]);
             // hanya update password jika id tidak null    
        }
        $this->validate(Opd::$rules, Opd::$message);

        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }


        // Simpan atau update data
        $opd = Opd::updateOrCreate(
            ['id' => $this->id],
            $data
        );

        if ($opd) {
            $this->resetPage();
            $this->notifSuccess($this->id ? 'Data berhasil diupdate' : 'Data berhasil disimpan');
        } else {
            $this->resetPage();
            $this->notifError($this->id ? 'Data gagal diupdate' : 'Data gagal disimpan');
        }

        $this->resetData();
        
        
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




