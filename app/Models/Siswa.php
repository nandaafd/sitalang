<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $guarded = ['id'];

    public function user(){
        $this->belongsTo(User::class);
    }
    public function pelanggaran(){
        $this->hasMany(PelanggaranSiswa::class);
    }
}
