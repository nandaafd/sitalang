@extends('web.layout.page')
@section('content')
<div id="profil-page" class="mx-auto mb-5">
    <h2 class="">Edit Profile</h2>
    @if (Auth::user()->role->name == 'siswa')
        @foreach ($siswa as $data)
        <form action="{{route('profile.update',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="text" hidden name="siswa_form" id="" value="siswa_form">
            <input type="text" hidden name="oldImage" value="{{$data->foto}}">
            <input type="text" hidden name="id" value="{{$data->id}}">
            <input type="text" hidden name="user_id" value="{{$data->user_id}}">
            <div class="mb-3">
              <label for="nama_lengkap" class="form-label">Nama Lengkap</label> 
              <input type="text" class="form-control" id="nama" name="nama_lengkap" value="{{$data->user->fullname}}">
            </div>
            <div class="mb-3">
              <label for="nama_panggilan" class="form-label">Nama Panggilan</label> 
              <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{$data->user->nickname}}">
            </div>
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" class="form-control" id="nisn" name="nisn" value="{{$data->nisn}}">
              </div>
              <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select" aria-label="Default select example" name="kelas">
                  @if ($data->kelas_id == null)
                    <option value="">Belum punya kelas</option>
                    @foreach ($kelas as $kls) 
                    <option value="{{$kls->id}}">{{$kls->name}}</option>
                    @endforeach
                  @else
                    @foreach ($kelas as $kls) 
                    <option value="{{$kls->id}}" {{$kls->id == $data->kelas->id ? 'selected' : ''}}>{{$kls->name}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{$data->alamat}}">
              </div>
              <div class="mb-3">
                <label for="no_telpon" class="form-label">No Telpon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="{{$data->no_telpon}}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$data->user->email}}">
              </div>
              <div class="mb-3">
                <label for="foto_profil" class="form-label">Foto Profil <span style="font-size:12px;">*jika ada/tidak wajib</span></label>
                @if ($data->foto == null)
                  <p class="">data ini tidak memiliki gambar</p>
                @else
                  <img src="{{asset('storage/'. $data->foto)}}" alt="" class="d-block mb-3" style="max-width:170px;">
                @endif
                <input type="file" class="form-control" id="foto_profil" name="foto_profil">
              </div>
              <p>Pastikan data yang anda masukkan sudah benar!
                </p>    
              <button type="submit" id="btn-ubahpass" class="btn btn-primary w-100">Simpan</button>
          </form> 
        @endforeach
    @elseif(Auth::user()->role->name == 'guru')
        @foreach ($guru as $data)
        <form action="{{route('profile.update',$data->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="text" name="oldImage" value="{{$data->foto}}" id="" hidden>
            <input type="text" hidden name="user_id" id="user_id" value="{{$data->user_id}}">
            <input type="text" hidden name="guru_form" id="" value="guru_form">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label> 
              <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{$data->user->fullname}}">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Panggilan</label> 
                <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{$data->user->nickname}}">
              </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP/NIY</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{$data->nip}}">
              </div>
              <div class="mb-3">
                <label for="no_telpon" class="form-label">No Telpon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="{{$data->no_telpon}}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$data->user->email}}">
              </div>
              <div class="mb-3">
                <label for="foto_profil" class="form-label">Foto Profil <span style="font-size:12px;">*jika ada/tidak wajib</span></label>
                @if ($data->foto == null)
                  <p class="">data ini tidak memiliki gambar</p>
                @else
                  <img src="{{asset('storage/'. $data->foto)}}" alt="" class="d-block mb-3" style="max-width:170px;">
                @endif
                <input type="file" class="form-control" id="foto_profil" name="foto_profil">
              </div>  
              <button type="submit" id="btn-ubahpass" class="btn btn-primary w-100">Simpan</button>
          </form>
        @endforeach

    @endif
    <a href="{{url('/ubah-password')}}" class="btn btn-outline-danger my-2 w-100">Ubah Password</a>
</div>
</div>

@endsection