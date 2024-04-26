@extends('web.layout.page')
@section('content')

        <div id="profil-page" class="mx-auto mb-5 text-center">
            <h2 class="mt-3">Profile</h2>
            @if(session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
            @if (Auth::user()->role->name == 'siswa')
                @foreach ($siswa as $data)
                    @if ($data->foto == null)
                        <img class="my-3 mx-auto" id="foto-profil" src="https://api.multiavatar.com/Binx Bond.png" alt="">
                    @else
                        <img class="my-3 mx-auto" id="foto-profil" src="{{asset('storage/'. $data->foto)}}" alt="">
                    @endif
                    <ul>
                        <li><span> Nama Lengkap :</span> {{$data->user->fullname}}</li>
                        <li><span>Nama Panggilan :</span>  {{$data->user->nickname}}</li>
                        <li><span> Jenis Kelamin :</span> {{$data->jenis_kelamin}}</li>
                        <li><span>Kelas :</span>  {{$data->kelas->name}}</li>
                        <li><span>Alamat :</span>  {{$data->alamat}}</li>
                        <li><span>Email :</span>  {{$data->user->email}}</li>
                        <li><span>No Telpon :</span>  {{$data->no_telp}}</li>
                    </ul>
                @endforeach
            @elseif(Auth::user()->role->name == 'guru')
                @foreach ($guru as $data)
                    @if ($data->foto == null)
                        <img class="my-3 mx-auto" id="foto-profil" src="https://api.multiavatar.com/Binx Bond.png" alt="">
                    @else
                        <img class="my-3 mx-auto" id="foto-profil" src="{{asset('storage/'. $data->foto)}}" alt="">
                    @endif
                    <ul>
                        <li><span> Nama Lengkap :</span> {{$data->user->fullname}}</li>
                        <li><span>Nama Panggilan :</span>  {{$data->user->nickname}}</li>
                        <li><span> NIP :</span> {{$data->nip_niy}}</li>
                        <li><span>Alamat :</span>  {{$data->alamat}}</li>
                        <li><span>Email :</span>  {{$data->user->email}}</li>
                        <li><span>No Telpon :</span>  {{$data->no_telp}}</li>
                    </ul>
                @endforeach
            @endif
            <a href="{{route('profile.edit',Auth::user()->id)}}" class="btn btn-primary my-2" id="btn-editprofil">Edit Profile</a>
            <div class="mb-3">
                <form action="{{url('/logout')}}" method="POST" class="">
                    @csrf
                    <button type="submit" class="btn btn-outline-dark mt-2 mb-3" id="btn-logoutprofil" onclick="return confirm('are you sure?')"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </div>
</div>

@endsection