<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelanggaranSiswa extends Model
{
    use HasFactory;
    protected $table = 'pelanggaran_siswa';
    protected $guarded = ['id'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
    public function pelanggaran(){
        return $this->belongsTo(MasterPelanggaran::class);
    }
    public function sanksi(){
        return $this->belongsTo(Sanksi::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
