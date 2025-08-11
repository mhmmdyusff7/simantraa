<?php

namespace App\Livewire\Opd;

use App\Models\{Perangkat, Opd};
use Carbon\Carbon;
use Livewire\Attributes\{Title, Layout};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Title('Umur Perangkat')]
#[Layout('components.layouts.opd.app')]
class PerangkatUmurOpdController extends Component
{
    use WithPagination;

    public $cari = '';
    public $limit_paginations = 5;
    public $opd_id;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->opd_id = Auth::guard('opd')->user()->id;
    }

    public function updatingCari()
    {
        $this->resetPage();
    }

    public function render()
    {
        $now = Carbon::now();

        // Ambil perangkat berdasarkan OPD login dan cari
        $perangkatQuery = Perangkat::where('opd_id', $this->opd_id)
            ->whereNull('deleted_at')
            ->when($this->cari, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('nama_perangkat_jaringan', 'like', '%' . $this->cari . '%')
                        ->orWhere('nama_perangkat_keras', 'like', '%' . $this->cari . '%')
                        ->orWhere('nama_perangkat_keamanan', 'like', '%' . $this->cari . '%');
                });
            });

        $perangkatPaginated = $perangkatQuery->orderBy('id', 'desc')->paginate($this->limit_paginations);

        $kategoriList = ['Perangkat Jaringan', 'Perangkat Keras', 'Perangkat Keamanan'];
        $umurData = [];

        foreach ($kategoriList as $kategori) {
            $grouped = Perangkat::where('opd_id', $this->opd_id)
                ->where('kategori_perangkat', $kategori)
                ->whereNull('deleted_at')
                ->get();

            $umurCount = [
                '>5' => 0,
                '1-5' => 0,
                '<1' => 0,
            ];

            foreach ($grouped as $item) {
                $tanggal = match ($kategori) {
                    'Perangkat Jaringan' => $item->tanggal_pembelian_jaringan,
                    'Perangkat Keras' => $item->tanggal_pembelian_keras,
                    'Perangkat Keamanan' => $item->tanggal_pembelian_keamanan,
                    default => null,
                };

                if ($tanggal) {
                    $diff = Carbon::parse($tanggal)->diffInYears($now);
                    if ($diff > 5) {
                        $umurCount['>5']++;
                    } elseif ($diff >= 1) {
                        $umurCount['1-5']++;
                    } else {
                        $umurCount['<1']++;
                    }
                }
            }

            $umurData[$kategori] = $umurCount;
        }

        return view('opd.perangkat_umur_opd.index', [
            'dataPerangkat' => $umurData,
            'perangkatList' => $perangkatPaginated,
            'opd_nama' => Opd::find($this->opd_id)?->nama ?? 'OPD Tidak Ditemukan',
        ]);
    }
}
