<?php

namespace App\Livewire\Admin;

use App\Models\{Perangkat, Opd};
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardController extends Component
{
    public $filterOpd;
    public $filterKategori;
    public $labelFilter = '';

    #[Title('Dashboard')]
    public function render()
    {
        // Ambil semua OPD dan daftar kategori perangkat
        $data['dataOpd'] = Opd::orderBy('id', 'desc')->get();
        $data['listKategori'] = Perangkat::select('kategori_perangkat')
            ->whereNotNull('kategori_perangkat')
            ->distinct()
            ->pluck('kategori_perangkat');

        // Jika filter OPD aktif, ambil nama OPD untuk ditampilkan
        if ($this->filterOpd) {
            $opd = Opd::find($this->filterOpd);
            $this->labelFilter = $opd?->nama ?? '';
        }

        // Gunakan kategori filter jika tersedia, default ke 'Perangkat Jaringan'
        $kategori = $this->filterKategori ?: 'Perangkat Jaringan';

        // Hitung jumlah perangkat berdasarkan usia
        $sumLebih5 = Perangkat::where('kategori_perangkat', $kategori)
            ->when($this->filterOpd, fn($q) => $q->where('opd_id', $this->filterOpd))
            ->sum('jaringan_lebihdari5_tahun');

        $sum1sampai5 = Perangkat::where('kategori_perangkat', $kategori)
            ->when($this->filterOpd, fn($q) => $q->where('opd_id', $this->filterOpd))
            ->sum('jaringan_satusampai5_tahun');

        $sumKurang1 = Perangkat::where('kategori_perangkat', $kategori)
            ->when($this->filterOpd, fn($q) => $q->where('opd_id', $this->filterOpd))
            ->sum('jaringan_kurangdari1_tahun');

        // Hitung total
        $total = $sumLebih5 + $sum1sampai5 + $sumKurang1;

        // Hitung persentase
        $data['jaringanlebih5tahun'] = $this->persentase($sumLebih5, $total);
        $data['jaringan1sampai5tahun'] = $this->persentase($sum1sampai5, $total);
        $data['jaringankurang1tahun'] = $this->persentase($sumKurang1, $total);

        return view('admin.dashboard', $data);
    }

    private function persentase($a, $b)
    {
        return $b == 0 ? 0 : round(($a / $b) * 100, 2);
    }
}
