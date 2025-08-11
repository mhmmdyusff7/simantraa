<?php

namespace App\Livewire\Admin;

use App\Models\{Perangkat, Opd};
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class PerangkatUmurController extends Component
{
    use WithPagination;

    #[Title('Umur Perangkat')]

    public $cari = '';
    public $limit_paginations = 5;

    protected $paginationTheme = 'bootstrap'; // optional: gunakan jika pakai bootstrap

    public function updatingCari()
    {
        $this->resetPage(); // reset ke halaman 1 saat search berubah
    }

    public function render()
    {
        $now = Carbon::now();

        $opds = Opd::select('id', 'nama')
            ->when($this->cari, function ($query) {
                $query->where('nama', 'like', '%' . $this->cari . '%');
            })
            ->orderBy('nama')
            ->paginate($this->limit_paginations);

        $dataPerangkat = $opds->map(function ($opd) use ($now) {
            $perangkat = Perangkat::where('opd_id', $opd->id)
                ->whereNull('deleted_at')
                ->get()
                ->groupBy('kategori_perangkat');

            $kategoriList = ['Perangkat Jaringan', 'Perangkat Keras', 'Perangkat Keamanan'];

            $result = [
                'opd_nama' => $opd->nama,
            ];

            foreach ($kategoriList as $kategori) {
                $grouped = $perangkat[$kategori] ?? collect();

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
                        } elseif ($diff >= 1 && $diff <= 5) {
                            $umurCount['1-5']++;
                        } elseif ($diff < 1) {
                            $umurCount['<1']++;
                        }
                    }
                }

                $result[$kategori] = $umurCount;
            }

            return $result;
        });

        return view('admin.perangkat_umur.index', [
            'dataPerangkat' => $dataPerangkat,
            'opds' => $opds,
        ]);
    }
}
