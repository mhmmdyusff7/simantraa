<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'tb_pengguna';
    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'original_password',
        'alamat',
        'encrypt_password',
        'role',
    ];

    static $rules = [
        'nama' => 'required',
        'telepon' => 'required|numeric|unique:tb_pengguna',
        'email' => 'required|email|unique:tb_pengguna',
        'original_password' => 'required|min:8',
        'alamat' => 'required',
    ];
    static $message = [
        'nama.required' => 'Nama tidak boleh kosong',
        'telepon.required' => 'Telepon tidak boleh kosong',
        'telepon.numeric' => 'Telepon harus berupa angka',
        'telepon.unique' => 'Nomor telepon sudah digunakan',
        'email.required' => 'Email tidak boleh kosong',
        'email.email' => 'Email tidak valid',
        'email.unique' => 'Email sudah digunakan',
        'original_password.required' => 'Password tidak boleh kosong',
        'original_password.min' => 'Password minimal 8 karakter',
        'alamat.min' => 'Harus diisi',
    ];
}
