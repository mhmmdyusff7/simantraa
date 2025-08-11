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
        'telepon' => 'required | numeric | unique:tb_opd',
        'email' => 'required | email | unique:tb_opd',
        'alamat' => 'required',
        'password' => 'required',
    ];
    static $message = [
        'nama.required' => 'Inputan tidak boleh kosong.',
        'telepon.required' => 'Inputan tidak boleh kosong.',
        'telepon.numeric' => 'Inputan harus berupa angka.',
        'telepon.unique' => 'Nomor telepon sudah digunakan.',
        'email.email' => 'Inputan harus berupa email yang valid.',
        'email.unique' => 'Email sudah digunakan.',
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

    public function perangkat()
    {
        return $this->hasMany(Perangkat::class, 'opd_id');
    }
}
