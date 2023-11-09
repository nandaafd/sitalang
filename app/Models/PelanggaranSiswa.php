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
        $this->belongsTo(Siswa::class);
    }
    public function master_pelanggaran(){
        $this->belongsTo(MasterPelanggaran::class);
    }
    public function sanksi(){
        $this->belongsTo(Sanksi::class);
    }
    public function user(){
        $this->belongsTo(User::class);
    }
}
