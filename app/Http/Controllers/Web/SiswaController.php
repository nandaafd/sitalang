<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\Token;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $nama = $request->nama;
            $filkelas = $request->kelas_id;
            $kelas = Kelas::where('is_deleted',false)->get();
            $siswa = Siswa::with("user")->where('is_deleted',false)->where('kelas_id','LIKE', '%'.$filkelas.'%')->whereHas('user', function ($query) use ($nama) {
                $query->where('fullname', 'LIKE', '%'.$nama.'%');
            })->paginate(10);
        } catch (Exception $ex) {
            $siswa = new LengthAwarePaginator([], 0, 10);
            // session()->flash('err', $ex->getMessage());
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
        }
        return view('web.siswa.index',compact('siswa','nama','filkelas','kelas'));
    }
    
    public function show(string $id)
    {
        try {
            $data = Siswa::find($id);
            if (!$data) {
                throw new Exception("gagal mendapatkan data siswa", 1);
            }
        } catch (Exception $ex) {
            $data =  new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
            return view('web.siswa.index', compact('data'));
        }
        return view('web.siswa.show', compact('data'));
    }


}
