<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            ['name'=>'Pelanggaran Ringan'],
            ['name'=>'Pelanggaran Sedang'],
            ['name'=>'Pelanggaran Berat'],
        ];
        foreach ($data as $key => $value) {
            Kategori::create($value);
        }
    }
}
