<?php

namespace App\Livewire\Admin;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardController extends Component
{
    public $data = [];

    public function mount()
    {
        // Inisialisasi data
        $this->data = [45, 52, 38, 45, 19, 23, 2];
    }

    #[Title('Dashboard')]
    public function render() {
    
        $data['list'] = [];
       
        
        return view('admin.dashboard', $data);
    }
}
