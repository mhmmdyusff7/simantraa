<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sdmtik extends Model
{
    use SoftDeletes;

    protected $table = 'tb_sdm_tik';
    // penamaan yang boleh diinput banyak2
    protected $fillable = [
        'opd_id',
        'nama_sdm_tik',
        'tik_status_pegawai',
        'status_reviu_pegawai',
        'alasan_pindah',
        'pendidikan_terakhir',
        'kompetensi_pekerjaan',
        'tupoksi',
        'pengalaman_training',
        'sertifikasi',
    ];

    static $rules = [
        'opd_id' => 'required',
        'nama_sdm_tik' => 'required',
        'tik_status_pegawai' => 'required',
        'status_reviu_pegawai' => 'required',
        'alasan_pindah' => 'nullable',
        'pendidikan_terakhir' => 'nullable',
        'kompetensi_pekerjaan' => 'nullable',
        'tupoksi' => 'nullable',
        'pengalaman_training' => 'nullable',
        'sertifikasi' => 'nullable',
    ];

    static $message = [
        'opd_id.required' => 'OPD harus dipilih.',
        'opd_id.exists' => 'OPD tidak valid.',
        'nama_sdm_tik.required' => 'Nama SDM TIK harus diisi.',
        'tik_status_pegawai.required' => 'TIK Status Pegawai harus dipilih.',
        'status_reviu_pegawai.required' => 'Status Reviu Pegawai harus dipilih.',
        'alasan_pindah.nullable' => 'Alasan pindah harus diisi.',
        'pendidikan_terakhir.nullable' => 'Pendidikan terakhir harus diisi.',
        'kompetensi_pekerjaan.nullable' => 'Kompetensi Pekerjaan harus diisi.',
        'tupoksi.nullable' => 'TUPOKSI harus diisi.',
        'pengalaman_training.nullable' => 'Pengalaman Training harus diisi.',
        'sertifikasi.nullable' => 'Sertifikasi harus diisi.',
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
