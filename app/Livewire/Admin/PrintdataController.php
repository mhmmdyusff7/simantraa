<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\{Title,Layout};
use Livewire\{Component};
use App\Models\{
    Opd,
    Perangkat,
    Sdmtik
};
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

    /**
     * Metode mount akan dijalankan saat komponen pertama kali diinisialisasi.
     * Ini akan mengambil parameter 'section' dari segmen URL.
     *
     * @param string $section Nilai segmen URL untuk 'section' (misal: 'opd', 'jaringan').
     * Nilai default 'opd' akan digunakan jika segmen tidak ada.
     */
    public function mount($section = 'opd') // Mengambil parameter dari rute langsung
    {
        // Panggil metode showSection untuk memvalidasi dan memuat data yang sesuai.
        $this->showSection($section);
    }

    /**
     * Mengubah bagian aktif dan memuat data yang relevan untuk bagian tersebut.
     *
     * @param string $section Nama bagian yang akan ditampilkan (misal: 'opd', 'jaringan').
     */
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
            $this->activeSection = 'opd'; // Reset ke d;efault
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
        switch ($section) {
            case 'opd':
                $this->listOpd = Opd::all(); // Mengambil semua data OPD
                break;
            case 'jaringan':
                // Mengambil perangkat jaringan, termasuk data OPD yang terkait
                $this->listJaringan = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Perangkat Jaringan')
                                            ->orderBy('id', 'asc')
                                            ->get();
                break;
            case 'keras':
                // Mengambil perangkat keras, termasuk data OPD yang terkait
                $this->listKeras = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Perangkat Keras')
                                            ->orderBy('id', 'asc')
                                            ->get();
                break;
            case 'keamanan':
                // Mengambil perangkat keamanan, termasuk data OPD yang terkait
                $this->listKeamanan = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Perangkat Keamanan')
                                            ->orderBy('id', 'asc')
                                            ->get();
                break;
            case 'bandwidth':
                $this->listBandwidth = Perangkat::with('opd')
                                            ->where('kategori_perangkat', 'Bandwidth')
                                            ->orderBy('id', 'asc')
                                            ->get();
                break;
            case 'sdmtik':
                // TODO: Ganti ini dengan logika pengambilan data SDM TIK Anda yang sebenarnya
                // Contoh: $this->listSdmtik = Sdmtik::all();
                $this->listSdmtik = Sdmtik::all();
               
                break;
            default:
                // Fallback jika ada kasus yang tidak terduga, meski seharusnya sudah divalidasi di showSection
                $this->listOpd = Opd::all();
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
        // Path view yang akan dirender (misal: 'admin.laporan.laporan_opd')
        // Nama file view harus mengikuti format 'laporan_{activeSection}.blade.php'
        $viewPath = 'admin.laporan.laporan_' . $this->activeSection;

        // Periksa apakah view Blade benar-benar ada sebelum mencoba merendernya
        if (!view()->exists($viewPath)) {
            // Jika view tidak ditemukan, fallback ke view default dan berikan pesan error.
            $viewPath = 'admin.laporan.laporan_opd'; // Fallback view
            $this->activeSection = 'opd'; // Reset activeSection
            session()->flash('error', "View laporan untuk '{$this->activeSection}' tidak ditemukan. Menampilkan laporan OPD.");
            $this->loadSectionData('opd'); // Muat ulang data default jika ada perubahan activeSection
            Log::error("View laporan tidak ditemukan: '{$viewPath}'. Fallback ke 'admin.laporan.laporan_opd'.");
        }

        // Mengembalikan view yang sesuai dengan activeSection.
        // Pastikan Anda membuat file-file ini di resources/views/admin/laporan/
        return view($viewPath, [
            'activeSection' => $this->activeSection, // Teruskan activeSection
            'listOpd' => $this->listOpd,
            'listJaringan' => $this->listJaringan,
            'listKeras' => $this->listKeras,
            'listKeamanan' => $this->listKeamanan,
            'listBandwidth' => $this->listBandwidth,
            'listSdmtik' => $this->listSdmtik,
            // Properti publik lainnya sudah tersedia secara otomatis di view
        ]);
    }
}