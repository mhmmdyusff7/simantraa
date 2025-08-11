<?php

namespace App\Livewire;

use App\Livewire\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class AuthController extends Component
{
    // klas diagram
    public $show_password = false; 
    public $email,$password;

    #[Title('Login')]
    #[Layout('components.layouts.auth.app')]
    public function render()
    {
        // dd(bcrypt(12345));
        return view('login');
    }

    public function login(){
    
    
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'email.email' => 'Email salah format',
        ]);
        // Validasi cek data admin / model user 
        if(Auth::attempt($credentials)){
            $this->notifSuccess('Login Berhasil!');
            $this->redirect('admin/dashboard');
        }
        if (Auth::guard('opd')->attempt($credentials)) {
            $this->redirect('opd/dashboard');
        }
        session()->flash('error', 'Email atau password salah');
        
    }
    public function showPassword(){

        $this->show_password = !$this->show_password;
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

    
}
