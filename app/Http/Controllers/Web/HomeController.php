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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totGuru = Guru::count();
        $totPelanggaran = MasterPelanggaran::count();
        $totSanksi = Sanksi::count();
        $jmlSiswaPria = Siswa::where('jenis_kelamin','pria')->get()->count();
        $jmlSiswaWanita = Siswa::where('jenis_kelamin','wanita')->get()->count();

        //get total user role
        $user = User::select('role_id', DB::raw('count(*) as total'))->groupBy('role_id')->get();
        $userAdmin = $user->where('role_id',Role::where('name','like','%admin%')->value('id'))->first()->total;
        $userGuru = $user->where('role_id',Role::where('name','like','%guru%')->value('id'))->first()->total;
        $userSiswa = $user->where('role_id',Role::where('name','like','%siswa%')->value('id'))->first()->total;

        //get total pelanggaran by kategori
        $pel = MasterPelanggaran::select('kategori_id', DB::raw('count(*) as total'))->groupBy('kategori_id')->get();
        $pelRingan = $pel->where('kategori_id',Kategori::where('name','like','%ringan%')->value('id'))->first()->total;
        $pelSedang = $pel->where('kategori_id',Kategori::where('name','like','%sedang%')->value('id'))->first()->total;
        $pelBerat = $pel->where('kategori_id',Kategori::where('name','like','%berat%')->value('id'))->first()->total;

        //get top 10 pelanggaran terbanyak
        $siswas = PelanggaranSiswa::select('siswa_id', DB::raw('count(*) as total'))
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
