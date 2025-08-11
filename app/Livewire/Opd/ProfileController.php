<?php

namespace App\Livewire\Opd;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;

class ProfileController extends Component
{

    #[Layout('components.layouts.opd.app')]

    #[Validate('nullable|string|max:255')]
    public $name;

    public $email;

    public $opd_id; 

    #[Validate('nullable|string|min:8')]
    public $password;

    #[Title('Opd || Logout ')]
    public function render()
    {
        return view('opd.profile.index');
    }

    public function mount()
    {

      

        $user =Auth::guard('opd')->user();  
        
           
        $this->name = $user->nama;
        $this->email = $user->email;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
        ]);

        $emailChanged = false;
        $passwordChanged = false;

        if ($this->name !== null && $this->name !== $user->name) {
            $user->name = $this->name;
        }

        if ($this->email !== null && $this->email !== $user->email) {
            $user->email = $this->email;
            $emailChanged = true;
        }

        if ($this->password !== null) {
            $user->password = Hash::make($this->password);
            $passwordChanged = true;
        }

        

        if ($emailChanged || $passwordChanged) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();

            $this->redirectRoute('login');
        } else {
            $this->notifSuccess('Profil berhasil diperbarui!, Silahkan login kembali!');
            $this->password = null;
            $this->resetErrorBag();
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->notifSuccess('Berhasil logout!');
        $this->redirectRoute('login');
    }

    private function resetData()
    {
        $this->password = '';

        $this->resetErrorBag();
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
