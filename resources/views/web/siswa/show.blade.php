@php use Carbon\Carbon; @endphp
<div class="container">
    <div class="row rounded mx-3 my-3 py-4" id="profil-head">
        <div class="w-100 text-center">
            @if($data->foto == null)
                <img src="{{asset('/images/assets/blank-profile-picture.jpg')}}" onerror="this.src='{{asset('/images/assets/blank-profile-picture.jpg')}}'" alt="" class="img-fluid rounded-circle" srcset="" id="img-detail">
            @else
                <img src="{{asset('storage/'. $data->foto)}}" onerror="this.src='{{asset('/images/assets/blank-profile-picture.jpg')}}'" alt="" class="img-fluid rounded-circle" srcset="" id="img-detail">
            @endif
        </div>
        <div class="text-center mt-3">
            <div class="h5 text-light">{{$data->user->fullname}} <span>({{$data->user->nickname}})</span></div>
            <div class="text-light"> Siswa <span>|</span> {{$data->jenis_kelamin}} | {{ \Carbon\Carbon::parse($data->tanggal_lahir)->diffInYears(Carbon::now())}} tahun</div>
            <p style="font-size: 12px; color:rgb(175, 175, 255)">Last seen {{$data->user->last_login != null ? \Carbon\Carbon::parse($data->user->last_login)->format('H:m, d-M-Y') : 'unknown'}}</p>
        </div>
    </div>
    <div class="row mx-4 my-3 py-4">
        <div class="col col-md-12 mb-3">
            <label for=""><i class="bi bi-envelope-paper mr-2"></i> Email</label>
            <div class="">{{$data->user->email}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
        <div class="col col-md-12 mb-3">
            <label for=""><i class="bi bi-geo-alt mr-2"></i> Tempat, Tanggal Lahir</label>
            <div class="">{{$data->tempat_lahir}}, {{\Carbon\Carbon::parse($data->tanggal_lahir)->format('d-M-Y')}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
        <div class="col col-md-12 mb-3">
            <label for=""><i class="bi bi-card-text mr-2"></i>Kelas</label>
            <div class="">{{$data->kelas->name}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
        <div class="col col-md-12 mb-3">
            <label for=""><i class="bi bi-telephone-forward mr-2"></i> Phone</label>
            <div class="">{{$data->no_telp}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
        <div class="col col-md-12 mb-3">
            <label for=""><i class="bi bi-geo-alt mr-2"></i> Alamat</label>
            <div class="">{{$data->alamat}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
        <div class="col col-md-12 mb-3">
            <label for=""><i class="bi bi-geo-alt mr-2"></i> Wali</label>
            <div class="">{{$data->nama_ortu}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
        <div class="col col-md-12 mb-3">
            <label for=""><i class="bi bi-geo-alt mr-2"></i> Telepon Wali</label>
            <div class="">{{$data->telp_ortu}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
    </div>
</div>
<script>
    $(".changePassword").click(function (e) {
        var id = $(this).data("id");
        $('#modal-md').modal("show");
        $('#modal-lg').modal("hide");
        $('#modal-md-label').text("Ganti Password");
        $('.modal-md-body').load('/dashboard/change-password/'+id)
    })
</script>