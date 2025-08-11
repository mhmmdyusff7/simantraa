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
        'tanggal_pembelian_jaringan',
        'kode_jaringan',
        'nama_jaringan',
        'spesifikasi_jaringan',
        'status_jaringan',
        'nama_ruangan_jaringan',
        'penanggung_jawab_jaringan',
    

        // Perangkat Keras
        'tanggal_pembelian_keras',
        'kode_keras',
        'nama_keras',
        'spesifikasi_keras',
        'status_keras',
        'nama_ruangan_keras',
        'penanggung_jawab_keras',
        

        // Perangkat Keamanan
        'tanggal_pembelian_keamanan',  
        'kode_keamanan',
        'nama_keamanan',
        'spesifikasi_keamanan',
        'status_keamanan',
        'nama_ruangan_keamanan',
        'penanggung_jawab_keamanan',
        

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
        'tanggal_pembelian_jaringan' => 'required|date|before_or_equal:today',
        'kode_jaringan' => 'required|string|max:255',
        'nama_jaringan' => 'required|string|max:255',
        'spesifikasi_jaringan' => 'required|string|max:255',
        'status_jaringan' => 'required|in:Baik,Perlu Diperbaiki,Rusak Berat',
        'nama_ruangan_jaringan' => 'required|string|max:255',
        'penanggung_jawab_jaringan' => 'required|string|max:255',
    ];
    static $messagesjaringan = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD tidak valid.',
        'kategori_perangkat.in' => 'Kategori perangkat tidak valid.',
        'tanggal_pembelian_jaringan.required' => 'Tanggal pembelian harus diisi.',
        'tanggal_pembelian_jaringan.date' => 'Tanggal pembelian harus berupa tanggal.',
        'tanggal_pembelian_jaringan.before_or_equal' => 'Tanggal pembelian tidak boleh lebih dari hari ini.',
        'kode_jaringan.required' => 'Kode jaringan harus diisi.',
        'kode_jaringan.string' => 'Kode jaringan harus berupa teks.',
        'kode_jaringan.max' => 'Kode jaringan maksimal :max karakter.',
        'nama_jaringan.required' => 'Nama jaringan harus diisi.',
        'nama_jaringan.string' => 'Nama jaringan harus berupa teks.',
        'nama_jaringan.max' => 'Nama jaringan maksimal :max karakter.',
        'spesifikasi_jaringan.required' => 'Spesifikasi jaringan harus diisi.',
        'spesifikasi_jaringan.string' => 'Spesifikasi jaringan harus berupa teks.',
        'spesifikasi_jaringan.max' => 'Spesifikasi jaringan maksimal :max karakter.',
        'status_jaringan.required' => 'Status jaringan harus dipilih.',
        'nama_ruangan_jaringan.required' => 'Nama ruangan jaringan harus diisi.',
        'nama_ruangan_jaringan.string' => 'Nama ruangan jaringan harus berupa teks.',
        'nama_ruangan_jaringan.max' => 'Nama ruangan jaringan maksimal :max karakter.',
        'penanggung_jawab_jaringan.required' => 'Penanggung jawab jaringan harus diisi.',
        'penanggung_jawab_jaringan.string' => 'Penanggung jawab jaringan harus berupa teks.',
        'penanggung_jawab_jaringan.max' => 'Penanggung jawab jaringan maksimal :max karakter.',
    ];

    static $ruleskeras = [
        'opd_id' => 'required',
        'kategori_perangkat' => 'required',
        'tanggal_pembelian_keras' => 'required|date|before_or_equal:today',
        'kode_keras' => 'required|string|max:255',
        'nama_keras' => 'required|string|max:255',
        'spesifikasi_keras' => 'required|string|max:255',
        'status_keras' => 'required|in:Baik,Perlu Diperbaiki,Rusak Berat',
        'nama_ruangan_keras' => 'required|string|max:255',
        'penanggung_jawab_keras' => 'required|string|max:255',
       
    ];

    static $messageskeras = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD tidak valid.',
        'kategori_perangkat.in' => 'Kategori perangkat tidak valid.',
        'tanggal_pembelian_keras.required' => 'Tanggal pembelian harus diisi.',
        'tanggal_pembelian_keras.date' => 'Tanggal pembelian harus berupa tanggal.',
        'tanggal_pembelian_keras.before_or_equal' => 'Tanggal pembelian tidak boleh lebih dari hari ini.',
        'kode_keras.required' => 'Kode keras harus diisi.',
        'nama_keras.string' => 'Nama keras harus berupa teks.',
        'nama_keras.required' => 'Nama keras harus diisi.',
        'nama_keras.max' => 'Nama keras maksimal :max karakter.',
        'spesifikasi_keras.required' => 'Spesifikasi keras harus diisi.',
        'spesifikasi_keras.string' => 'Spesifikasi keras harus berupa teks.',
        'spesifikasi_keras.max' => 'Spesifikasi keras maksimal :max karakter.',
        'status_keras.required' => 'Status keras harus dipilih.',
        'status_keras.in' => 'Status keras harus "Baik", "Perlu Diperbaiki", atau "Rusak Berat".',
        'nama_ruangan_keras.required' => 'Nama ruangan keras harus diisi.',
        'nama_ruangan_keras.string' => 'Nama ruangan keras harus berupa teks.',
        'nama_ruangan_keras.max' => 'Nama ruangan keras maksimal :max karakter.',
        'penanggung_jawab_keras.required' => 'Penanggung jawab keras harus diisi.',
        'penanggung_jawab_keras.string' => 'Penanggung jawab keras harus berupa teks.',
        'penanggung_jawab_keras.max' => 'Penanggung jawab keras maksimal :max karakter.',
    ];

    static $ruleskeamanan = [
        'opd_id' => 'required',
        'kategori_perangkat' => 'required',
        'tanggal_pembelian_keamanan' => 'required|date|before_or_equal:today',
        'kode_keamanan' => 'required|string|max:255',
        'nama_keamanan' => 'required|string|max:255',
        'spesifikasi_keamanan' => 'required|string',
        'status_keamanan' => 'required|in:Baik,Perlu Diperbaiki,Rusak Berat',
        'nama_ruangan_keamanan' => 'required|string',
        'penanggung_jawab_keamanan' => 'required|string',
    
    ];
    static $messageskeamanan = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD tidak valid.',
        'tanggal_pembelian_keamanan.required' => 'Tanggal pembelian harus diisi.',
        'tanggal_pembelian_keamanan.date' => 'Tanggal pembelian harus berupa tanggal.',
        'tanggal_pembelian_keamanan.before_or_equal' => 'Tanggal pembelian tidak boleh lebih dari hari ini.',
        'kode_keamanan.numeric' => 'Kode keamanan harus berupa angka.',
        'kode_keamanan.required' => 'Kode keamanan harus diisi.',
        'kode_keamanan.min' => 'Kode keamanan harus minimal 0.',
        'nama_keamanan.string' => 'Nama keamanan harus berupa teks.',
        'nama_keamanan.required' => 'Nama keamanan harus diisi.',
        'nama_keamanan.max' => 'Nama keamanan maksimal :max karakter.',
        'spesifikasi_keamanan.required' => 'Spesifikasi keamanan harus diisi.',
        'spesifikasi_keamanan.string' => 'Spesifikasi keamanan harus berupa teks.',
        'status_keamanan.required' => 'Status keamanan harus dipilih.',
        'status_keamanan.in' => 'Status keamanan harus "Baik", "Perlu Diperbaiki", atau "Rusak Berat".',
        'nama_ruangan_keamanan.required' => 'Nama ruangan keamanan harus diisi.',
        'nama_ruangan_keamanan.string' => 'Nama ruangan keamanan harus berupa teks.',
        'penanggung_jawab_keamanan.required' => 'Penanggung jawab keamanan harus diisi.',
        'penanggung_jawab_keamanan.string' => 'Penanggung jawab keamanan harus berupa teks.',
       
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
