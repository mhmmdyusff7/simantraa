<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class StatusController extends Component
{
    public $data = [];

    public function mount()
    {
        // Inisialisasi data
        $this->data = [45, 52, 38, 45, 19, 23, 2];
    }

    public function updateData()
    {
        // Menghasilkan data acak
        $this->data = array_map(function() {
            return rand(0, 100);
        }, $this->data);
    }
    public function render(){

        
        return view('admin.status.index');
    }
}
