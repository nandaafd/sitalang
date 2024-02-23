<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanksi extends Model
{
    use HasFactory;
    protected $table = 'sanksi';
    protected $guarded = ['id'];

    public function pelanggaran_siswa(){
        return $this->hasMany(PelanggaranSiswa::class);
    }
}
