<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'user';
    protected $guarded = ['id'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function guru() {
        return $this->hasMany(Guru::class);
    }
    public function siswa() {
        return $this->hasMany(Siswa::class);
    }
    public function pelanggaran_siswa(){
        return $this->hasMany(PelanggaranSiswa::class);
    }
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
