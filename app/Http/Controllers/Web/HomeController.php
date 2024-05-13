<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kategori;
use App\Models\MasterPelanggaran;
use App\Models\PelanggaranSiswa;
use App\Models\Role;
use App\Models\Sanksi;
use App\Models\Siswa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    public function index()
    {
        try{
            $totPelanggaran = MasterPelanggaran::count() ?? 0;
            $totGuru = Guru::count() ?? 0;
            $totSanksi = Sanksi::count() ?? 0;
            $jmlSiswaPria = Siswa::where('jenis_kelamin','pria')->get()->count() ?? 0;
            $jmlSiswaWanita = Siswa::where('jenis_kelamin','wanita')->get()->count() ?? 0;
    
            //get total user role
            $user = User::select('role_id', DB::raw('count(*) as total'))->groupBy('role_id')->get();
            $userAdmin = $user->where('role_id',Role::where('name','like','%admin%')->value('id'))->first()->total ?? 0;
            $userGuru = $user->where('role_id',Role::where('name','like','%guru%')->value('id'))->first()->total ?? 0;
            $userSiswa = $user->where('role_id',Role::where('name','like','%siswa%')->value('id'))->first()->total ?? 0;

            //get total pelanggaran by kategori
            $pel = MasterPelanggaran::select('kategori_id', DB::raw('count(*) as total'))->groupBy('kategori_id')->get();
            $pelRingan = $pel->where('kategori_id',Kategori::where('name','like','%ringan%')->value('id'))->first()->total ?? 0;
            $pelSedang = $pel->where('kategori_id',Kategori::where('name','like','%sedang%')->value('id'))->first()->total ?? 0;
            $pelBerat = $pel->where('kategori_id',Kategori::where('name','like','%berat%')->value('id'))->first()->total ?? 0;
    
            //get top 10 pelanggaran terbanyak
            $siswas = PelanggaranSiswa::select('siswa_id', DB::raw('count(*) as total'))
                    ->where('is_deleted',false)
                    ->groupBy('siswa_id')
                    ->orderByDesc('total')
                    ->limit(10)
                    ->get();
    
            foreach ($siswas as $siswa) {
                $siswaData = DB::table('siswa')
                            ->join('user', 'siswa.user_id', '=', 'user.id')
                            ->join('kelas', 'siswa.kelas_id','=','kelas.id')
                            ->select('siswa.*', 'user.*','kelas.*')
                            ->where('siswa.id', $siswa->siswa_id)
                            ->first();
    
                if ($siswaData) {
                    $siswa->fullname = $siswaData->fullname;
                    $siswa->foto = $siswaData->foto;
                    $siswa->email = $siswaData->email;
                    $siswa->kelas = $siswaData->name;
                }
            }
        }catch(Exception $ex){
            $totGuru = 0; $totPelanggaran = 0; $totSanksi = 0; $jmlSiswaPria = 0; $jmlSiswaWanita = 0;
            $userAdmin = 0; $userGuru = 0; $userSiswa = 0;
            $pelRingan = 0; $pelSedang = 0; $pelBerat = 0;
        }
        
        // return $pelRingan;
        return view('Web.index',compact(
            'jmlSiswaPria',
            'jmlSiswaWanita',
            'siswas',
            'totGuru',
            'totPelanggaran',
            'totSanksi',
            'pelBerat',
            'pelRingan',
            'pelSedang',
            'userAdmin',
            'userGuru',
            'userSiswa'
        ));
    }

}
