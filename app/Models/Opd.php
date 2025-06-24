<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Opd extends Authenticatable
{
    use SoftDeletes,  HasFactory, Notifiable;

    protected $table = 'tb_opd';
    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'alamat',
        'password',
    ];

    static $rules = [
        'nama' => 'required',
        'telepon' => 'required',
        'email' => 'required',
        'alamat' => 'required',
        'password' => 'required',
    ];
    static $message = [
        'nama.required' => 'Inputan tidak boleh kosong.',
        'telepon.required' => 'Inputan tidak boleh kosong.',
        'email.required' => 'Inputan tidak boleh kosong.',
        'alamat.required' => 'Inputan tidak boleh kosong.',
        'password.required' => 'Inputan tidak boleh kosong.',
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
