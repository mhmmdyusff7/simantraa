<?php

namespace App\Livewire\Opd;

use Livewire\Attributes\{Title,Layout};
use Livewire\{Component};
use App\Models\{
    Opd,
    Perangkat,
    Sdmtik,
    
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Untuk logging error atau peringatan

class PrintdataController extends Component
{
    // Properti publik untuk menyimpan bagian yang aktif dan data terkait
    public $activeSection = 'opd'; // Bagian default yang akan dicetak
    public $listOpd = [];
    public $listJaringan = [];
    public $listKeras = [];
    public $listKeamanan = [];
    public $listBandwidth = []; // Anda perlu model/data untuk ini
    public $listSdmtik = [];    // Anda perlu model/data untuk ini


    public function mount($section = 'opd') // Mengambil parameter dari rute langsung
    {
        // Panggil metode showSection untuk memvalidasi dan memuat data yang sesuai.
        $this->showSection($section);
    }


    public function showSection($section)
    {
        // Daftar bagian yang valid untuk mencegah akses ke view yang tidak ada.
        $validSections = ['opd', 'jaringan', 'keras', 'keamanan', 'bandwidth', 'sdmtik'];

        if (in_array($section, $validSections)) {
            $this->activeSection = $section;
            $this->loadSectionData($section);
        } else {
            // Jika bagian tidak valid, berikan pesan error dan fallback ke default.
            session()->flash('error', 'Bagian cetak tidak valid. Menampilkan data OPD.');
            Log::warning("Bagian cetak tidak valid diminta: '{$section}'. Fallback ke 'opd'.");
            $this->activeSection = 'opd'; // Reset ke default
            $this->loadSectionData('opd'); // Muat data default
        }
    }

    /**
     * Metode pembantu untuk memuat data spesifik berdasarkan bagian yang aktif.
     *
     * @param string $section Nama bagian untuk memuat data.
     */
    protected function loadSectionData($section)
    {
        // dd("Memuat data untuk bagian: {$section}");
        // Ambil opd_id dari user yang sedang login (guard opd)
        $opd_id = Auth::guard('opd')->user()->id;
        switch ($section) {
            case 'opd':
                // Hanya ambil data OPD milik user
                $this->listOpd = Opd::where('id', $opd_id)->get();
                break;
            case 'jaringan':
                $this->listJaringan = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Perangkat Jaringan')
                                            ->where('opd_id', $opd_id)
                                            ->orderBy('id', 'asc')
                                            ->get();

                        

                
                break;
            case 'keras':
                $this->listKeras = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Perangkat Keras')
                                            ->where('opd_id', $opd_id)
                                            ->orderBy('id', 'asc')
                                            ->get();
                break;
            case 'keamanan':
                $this->listKeamanan = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Perangkat Keamanan')
                                            ->where('opd_id', $opd_id)
                                            ->orderBy('id', 'asc')
                                            ->get();
                break;
            case 'bandwidth':
                $this->listBandwidth = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Bandwidth')
                                            ->where('opd_id', $opd_id)
                                            ->orderBy('id', 'asc')
                                            ->get();
                                            
                break;
            case 'sdmtik':
                $this->listSdmtik = Sdmtik::where('opd_id', $opd_id)->get();
                break;
            default:
                $this->listOpd = Opd::where('id', $opd_id)->get();
                break;
        }
    }
    
    /**
     * Metode render akan menentukan view Blade mana yang akan ditampilkan.
     * Ini secara dinamis memuat partial view berdasarkan 'activeSection'.
     */

    #[Title('Cetak Data')]
    #[Layout('components.layouts.laporan.app')]
    public function render()
    {
        // Path view yang akan dirender (misal: 'opd.laporan.laporan_opd')
        // Nama file view harus mengikuti format 'laporan_{activeSection}.blade.php'
        $viewPath = 'opd.laporan.laporan_' . $this->activeSection; // Opd = OPD

     
        // Periksa apakah view Blade benar-benar ada sebelum mencoba merendernya
        if (!view()->exists($viewPath)) {
            // Jika view tidak ditemukan, fallback ke view default dan berikan pesan error.
            $viewPath = 'opd.laporan.not_found'; // Fallback view
            $this->activeSection = 'opd'; // Reset activeSection
            session()->flash('error', "View laporan untuk '{$this->activeSection}' tidak ditemukan. Menampilkan laporan OPD.");
            $this->loadSectionData('opd'); // Muat ulang data default jika ada perubahan activeSection
            
        }
        // Mengembalikan view yang sesuai dengan activeSection.
        // Pastikan Anda membuat file-file ini di resources/views/admin/laporan/
        return view($viewPath, [
            'activeSection' => $this->activeSection, // Teruskan activeSection
            'listJaringan' => $this->listJaringan,
            'listKeras' => $this->listKeras,
            'listKeamanan' => $this->listKeamanan,
            'listBandwidth' => $this->listBandwidth,
            'listSdmtik' => $this->listSdmtik,
            // Properti publik lainnya sudah tersedia secara otomatis di view
        ]);
    }
}