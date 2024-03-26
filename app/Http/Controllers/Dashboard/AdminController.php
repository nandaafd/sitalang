<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    
    public function index(Request $request)
    {
        try {
            $nama = $request->nama;
            $admin = Admin::with("user")->where('is_deleted',false)->whereHas('user', function ($query) use ($nama) {
                $query->where('fullname', 'LIKE', '%'.$nama.'%');
            })->paginate(10);
        } catch (Exception $ex) {
            $admin = new LengthAwarePaginator([], 0, 10);
            // session()->flash('err', $ex->getMessage());
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
        }
        
        return view("dashboard.admin.index", compact("admin","nama"));
    }

    
    public function create()
    {
        return view("dashboard.admin.create");
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "fullname"=> "required",
                "nickname"=>"required",
                "email"=>"required",
                "password"=> "required",
                "confirm_password"=>"required"
            ]);
            if (!$validator->fails()) {
                if ($request->password === $request->confirm_password) {
                    
                    $user = new User;
                    $user->fullname = $request->fullname;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $user->role_id = 1; //id role admin
                    $user->save();
    
                    $admin = new Admin;
                    $admin->user_id = $user->id;    
                    $admin->code = 'ADM-SITALANG-'.$user->id;
                    $admin->save();
                }
                else{
                    return redirect()->back()->with('err','gagal mendaftar password tidak sama');
                }
            }
            else{
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
        return redirect()->route('admin.index')->with('success','berhasil menambah data admin');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        try{
            $data = Admin::find($id);
        }
        catch(Exception $ex){
            $data =  new LengthAwarePaginator([], 0, 10);
            session()->flash('err', 'gagal tersambung dengan database, server database tidak bisa dihubungi');
            return view('dashboard.admin.index', compact('data')); 
        }
        return view("dashboard.admin.edit", compact("data"));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(),[
                "fullname"=> "required",
                "nickname"=>"required",
            ]);
            if (!$validator->fails()) {
                User::where('id',$id)->update([
                    'fullname'=>$request->fullname,
                    'nickname'=>$request->nickname
                ]);
            }
            else{
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } catch (Exception $ex) {
            return redirect()->route('pelanggaransiswa.index')->with('err','gagal edit data, internal server error');
        }
        return redirect()->route('admin.index')->with('success','berhasil mengedit data admin');
    }

    public function destroy(string $id)
    {
        
    }
}
