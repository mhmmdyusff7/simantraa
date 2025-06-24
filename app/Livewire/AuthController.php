<?php

namespace App\Livewire;

use App\Livewire\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class AuthController extends Component
{
    public $show_password = false; 
    public $email,$password;

    #[Title('Login')]
    #[Layout('components.layouts.auth.app')]
    public function render()
    {
        return view('login');
    }

    public function login(){
    
    
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        // Validasi cek data admin / model user
        if(Auth::attempt($credentials)){
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
}
