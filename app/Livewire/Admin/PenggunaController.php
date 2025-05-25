<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use App\Models\Pengguna;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class PenggController extends Component
{
    public $id,$nama,$telepon,$email,$original_password;

    public function simpanData(){
      
        
        if ($this->id == null) {
            $validated = $this->validate(Pengguna::$rules,Pengguna::$message);
            $pengguna = new Pengguna();
            $pengguna->nama = $this->nama;
            $pengguna->telepon = $this->telepon;    
            $pengguna->email = $this->email;
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

    #[Title('Pengguna')] 
    public function render(){
        $data['list'] = Pengguna::paginate(10);
        return view('admin.pengguna.index', $data);
    }

    public function resetData(){
        $this->resetPage();
    }

    private  function resetPage(){
        $this->id = '';
        $this->nama = '';
        $this->telepon = '';
        $this->email = '';
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
