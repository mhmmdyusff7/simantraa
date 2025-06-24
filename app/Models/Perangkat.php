<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perangkat extends Model
{
    use SoftDeletes;

    protected $table = 'tb_perangkat';
    // penamaan yang boleh diinput banyak2
    protected $fillable = [
        'opd_id',
        'kategori_perangkat',

        // Perangkat Jaringan
        'nama_perangkat_jaringan',
        'jaringan_lebihdari5_tahun',
        'jaringan_satusampai5_tahun',
        'jaringan_kurangdari1_tahun',
        'jaringan_jumlah',
        'jaringan_digunakan',
        'jaringan_tidakdigunakan',
        'jaringan_alasan_tidakdigunakan',

        // Perangkat Keras
        'nama_perangkat_keras',
        'keras_lebihdari5_tahun',
        'keras_satusampai5_tahun',
        'keras_kurangdari1_tahun',
        'keras_jumlah',
        'keras_digunakan',
        'keras_tidakdigunakan',
        'keras_alasan_tidakdigunakan',

        // Perangkat Keamanan
        'nama_perangkat_keamanan',
        'keamanan_jumlah_perangkat',
        'keamanan_status_reviu',
        'keamanan_alasan_tidakdigunakan',
        'keamanan_status_kepemilikan',
        'keamanan_pengelola',

        // Bandwidth
        'bandwidth_nama_jaringan',
        'bandwidth_mbps',
        'bandwidth_jumlah_pemasangan',
        'bandwidth_alasan_pengadaan',
        'bandwidth_status_reviu',
        'bandwidth_penyesuaian_operasional',
    ];

    static $rulesjaringan = [
        'opd_id' => 'required',
        'kategori_perangkat' => 'required',
        'nama_perangkat_jaringan' => 'required|string|max:255',
        'jaringan_lebihdari5_tahun' => 'required|numeric|min:0',
        'jaringan_satusampai5_tahun' => 'required|numeric|min:0',
        'jaringan_kurangdari1_tahun' => 'required|numeric|min:0',
        'jaringan_jumlah' => 'required|numeric|min:0',
        'jaringan_digunakan' => 'required|numeric|min:0',
        'jaringan_tidakdigunakan' => 'required|numeric|min:0',
    ];
    static $messagesjaringan = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD tidak valid.',
        'kategori_perangkat.in' => 'Kategori perangkat tidak valid.',
        'nama_perangkat_jaringan.string' => 'Nama perangkat jaringan harus berupa teks.',
        'nama_perangkat_jaringan.required' => 'Nama perangkat jaringan harus diisi.',
        'nama_perangkat_jaringan.max' => 'Nama perangkat jaringan maksimal :max karakter.',
        'jaringan_lebihdari5_tahun.numeric' => 'Harus berupa angka.',
        'jaringan_lebihdari5_tahun.required' => 'Jumlah Jaringan Lebih Dari 5 Tahun harus diisi.',
        'jaringan_satusampai5_tahun.numeric' => 'Harus berupa angka.',
        'jaringan_satusampai5_tahun.required' => 'Jumlah Jaringan Status Sampai 5 Tahun harus diisi.',
        'jaringan_kurangdari1_tahun.numeric' => 'Harus berupa angka.',
        'jaringan_kurangdari1_tahun.required' => 'Jumlah Jaringan Kurangdari 1 Tahun harus diisi.',
        'jaringan_jumlah.required' => 'Jumlah Jaringan harus diisi.',
        'jaringan_digunakan.numeric' => 'Jumlah digunakan harus berupa angka.',
        'jaringan_digunakan.required' => 'Jumlah digunakan harus diisi.',
        'jaringan_tidakdigunakan.required' => 'Jumlah tidak digunakan harus diisi.',
        'jaringan_tidakdigunakan.min' => 'jumlah perangkat yang tidak digunakan tidak boleh lebih dari jumlah perangkat',
    ];

    static $ruleskeras = [
        'opd_id' => 'required',
        'kategori_perangkat' => 'required',
        'nama_perangkat_keras' => 'required|string|max:255',
        'keras_lebihdari5_tahun' => 'required|numeric|min:0',
        'keras_satusampai5_tahun' => 'required|numeric|min:0',
        'keras_kurangdari1_tahun' => 'required|numeric|min:0',
        'keras_jumlah' => 'required|numeric|min:0',
        'keras_digunakan' => 'required|numeric|min:0',
        'keras_tidakdigunakan' => 'required|numeric|min:0',
    ];

    static $messageskeras = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD tidak valid.',
        'kategori_perangkat.in' => 'Kategori perangkat tidak valid.',
        'nama_perangkat_keras.string' => 'Nama perangkat keras harus berupa teks.',
        'nama_perangkat_keras.required' => 'Nama perangkat keras harus diisi.',
        'nama_perangkat_keras.max' => 'Nama perangkat keras maksimal :max karakter.',
        'keras_lebihdari5_tahun.numeric' => 'Harus berupa angka.',
        'keras_lebihdari5_tahun.required' => 'Jumlah keras Lebih Dari 5 Tahun harus diisi.',
        'keras_satusampai5_tahun.numeric' => 'Harus berupa angka.',
        'keras_satusampai5_tahun.required' => 'Jumlah keras Status Sampai 5 Tahun harus diisi.',
        'keras_kurangdari1_tahun.numeric' => 'Harus berupa angka.',
        'keras_kurangdari1_tahun.required' => 'Jumlah keras Kurangdari 1 Tahun harus diisi.',
        'keras_jumlah.required' => 'Jumlah keras harus diisi.',
        'keras_digunakan.numeric' => 'Jumlah digunakan harus berupa angka.',
        'keras_digunakan.required' => 'Jumlah digunakan harus diisi.',
        'keras_tidakdigunakan.required' => 'Jumlah tidak digunakan harus diisi.',
        'keras_tidakdigunakan.min' => 'jumlah perangkat yang tidak digunakan tidak boleh lebih dari jumlah perangkat',
    ];

    static $ruleskeamanan = [
        'opd_id' => 'required',
        'kategori_perangkat' => 'required',
        'nama_perangkat_keamanan' => 'required|string|max:255',
        'keamanan_jumlah_perangkat' => 'required|numeric|min:0',
        'keamanan_status_reviu' => 'required',
        'keamanan_alasan_tidakdigunakan' => 'nullable|string',
        'keamanan_status_kepemilikan' => 'required|string|max:255',
        'keamanan_pengelola' => 'required|string|max:255',

    ];
    static $messageskeamanan = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD tidak valid.',
        'nama_perangkat_keamanan.required' => 'Nama perangkat keamanan harus diisi.',
        'keamanan_jumlah_perangkat.required' => 'Jumlah keamanan harus diisi.',
        'keamanan_jumlah_perangkat.numeric' => 'Jumlah keamanan harus berupa angka.',
        'keamanan_jumlah_perangkat.min' => 'Jumlah keamanan harus minimal 1.',
        'keamanan_status_reviu.required' => 'Status Reviu harus dipilih.',
        'keamanan_status_kepemilikan.required' => 'Kepemilikan harus diisi.',
        'keamanan_pengelola.required' => 'Pengelola harus diisi.',
        'keamanan_pengelola.string' => 'Pengelola harus berupa teks.',
    ];
    static $rulesbandwidth = [
        // --- PERBAIKAN DI SINI ---
        'opd_id' => 'required', // Digabungkan menjadi satu baris untuk 'opd_id'
        // --- AKHIR PERBAIKAN ---

        'bandwidth_nama_jaringan' => 'required|string|max:255',
        'bandwidth_mbps' => 'required|numeric', // Diperbaiki dari 'string' ke 'numeric' sesuai rekomendasi sebelumnya
        'bandwidth_jumlah_pemasangan' => 'required|numeric', // Diperbaiki dari 'string' ke 'numeric'
        'bandwidth_alasan_pengadaan' => 'required|string|max:255',
        'bandwidth_status_reviu' => 'required|in:Digunakan,Tidak Digunakan',
        'bandwidth_penyesuaian_operasional' => 'required|string',
    ];

    static $messagesbandwidth = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD yang dipilih tidak valid.', // Menambahkan pesan khusus untuk exists
        'bandwidth_nama_jaringan.required' => 'Nama jaringan harus diisi.',
        'bandwidth_mbps.required' => 'Bandwidth/Mbps harus diisi.',
        'bandwidth_mbps.numeric' => 'Bandwidth/Mbps harus berupa angka.', // Menyesuaikan pesan
        'bandwidth_jumlah_pemasangan.required' => 'Jumlah pemasangan harus diisi.',
        'bandwidth_jumlah_pemasangan.numeric' => 'Jumlah pemasangan harus berupa angka.', // Menyesuaikan pesan
        'bandwidth_alasan_pengadaan.required' => 'Alasan pengadaan harus diisi.',
        'bandwidth_alasan_pengadaan.string' => 'Alasan pengadaan harus berupa teks.',
        'bandwidth_status_reviu.required' => 'Status Reviu harus dipilih.',
        'bandwidth_status_reviu.in' => 'Status harus "Digunakan" atau "Tidak Digunakan".',
        'bandwidth_penyesuaian_operasional.required' => 'Penyesuaian operasional harus diisi.',
        'bandwidth_penyesuaian_operasional.string' => 'Penyesuaian harus berupa teks.',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
}
