@extends('web.layout.page')
@section('content')
<div class="row">
    <div class="col" id="sitalang-header">
        <div class="row">
          <div class="col-9">
            <h4 style="font-weight: 600;"> "Jika <span style="color:#FF6B00;">keadilan</span> 
                binasa, kehidupan <span style="color:#FF6B00;">manusia</span>  
                  di bumi telah kehilangan maknanya"
            </h4>
            <div class="container">
                {{ Breadcrumbs::render() }}
            </div>
          </div>
          <div class="col-3">
            <img id="vector2" class="img-fluid" src="{{asset('images/assets/vector3.png')}}" alt="" srcset="">
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id="masterpelanggaran-page" class="">
            <h4 class="mb-3">Pelanggaran Siswa</h4>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('err'))
                <div class="alert alert-danger">
                    {{ session('err') }}
                </div>
            @endif
            @if(session('messageWarning'))
                <div class="col text-center mt-5">
                    {{ session('messageWarning') }}
                </div>  
            @endif
            
            <div class="">
                <div class="row py-3">
                    <div class="col-4 col-md-4 text-center">
                        @if($pelsis->siswa->foto != null || $pelsis->siswa->foto != "")
                            <img src="{{asset('/images/assets/blank-profile-picture.jpg')}}" onerror="this.src='{{asset('/images/assets/blank-profile-picture.jpg')}}'" alt="" class="img-fluid" srcset="" id="img-detail">
                        @else
                            <img src="{{asset('storage/'. $pelsis->siswa->foto)}}" onerror="this.src='{{asset('/images/assets/blank-profile-picture.jpg')}}'" alt="" class="img-fluid" srcset="" id="img-detail">
                        @endif
                        <div class="fw-bold mt-3">{{$pelsis->siswa->user->fullname}} ({{$pelsis->siswa->jenis_kelamin}})</div>
                        <div class="">{{$pelsis->siswa->kelas->name}}</div>
                        <div class="">{{$pelsis->siswa->tempat_lahir}}, {{\Carbon\Carbon::parse($pelsis->siswa->tanggal_lahir)->format('d-M-Y')}}</div>
                    </div>
                    <div class="col-8 col-md-8">
                        <div>
                            <table class="" id="tbl-detail">
                                <tr>
                                    <td class="pe-3">Pelanggaran yang di dapat</td>
                                    <td class=""> : </td>
                                    <td class="ms-3 d-flex justify-content-start">{{$pelsis->pelanggaran->nama_pelanggaran}}</td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Tanggal pelanggaran</td>
                                    <td class=""> : </td>
                                    <td class="ms-3 d-flex justify-content-start">{{ \Carbon\Carbon::parse($pelsis->tanggal)->format('l, d-M-Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Poin</td>
                                    <td class=""> : </td>
                                    <td class="ms-3 d-flex justify-content-start">{{$pelsis->pelanggaran->poin}}</td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Kategori pelanggaran</td>
                                    <td class=""> : </td>
                                    <td class="ms-3 d-flex justify-content-start">{{$pelsis->pelanggaran->kategori->name}}</td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Sanksi didapat</td>
                                    <td class=""> : </td>
                                    <td class="ms-3 d-flex justify-content-start">{{$pelsis->sanksi->sanksi}}</td>
                                </tr>
                                <tr>
                                    <td class="pe-3">Pemberi pelanggaran</td>
                                    <td class=""> : </td>
                                    <td class="ms-3 d-flex justify-content-start">{{$pelsis->user->fullname}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection