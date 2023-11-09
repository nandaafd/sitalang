<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPelanggaran extends Model
{
    use HasFactory;
    protected $table = 'master_pelanggaran';
    protected $guarded = ['id'];

    public function kategori(){
        $this->belongsTo(Kategori::class);
    }
}
