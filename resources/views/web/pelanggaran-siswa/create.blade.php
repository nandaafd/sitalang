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
            <h4 class="mb-3">Tambah Pelanggaran Siswa</h4>
            
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
            
            <form action="{{route('pelanggaran-siswa.store')}}" method="post">
                @method('post')
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <div class="mb-3">
                    <label for="siswa_id" class="form-label">Nama Siswa</label>
                    <select name="siswa_id" id="" class="form-select @error('siswa_id') is-invalid @enderror">
                        <option value="">Pilih siswa</option>
                        @foreach($siswa as $key => $value)
                            <option value="{{$value->id}}">{{$value->user->fullname}}</option>
                        @endforeach
                    </select>
                    @error('siswa_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" value="{{old('tanggal')}}" name="tanggal">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pelanggaran_id" class="form-label">Pelanggaran</label>
                    <select name="pelanggaran_id" id="" class="form-select @error('pelanggaran_id') is-invalid @enderror">
                        <option value="">Pilih Pelanggaran</option>
                        @foreach ($pelanggaran as $data)
                            <option value="{{$data->id}}">{{$data->nama_pelanggaran}}</option>
                        @endforeach
                    </select>
                    @error('pelanggaran_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sanksi_id" class="form-label">Sanksi</label>
                    <select name="sanksi_id" id="" class="form-select @error('sanksi_id') is-invalid @enderror">
                        <option value="">Pilih Sanksi</option>
                        @foreach ($sanksi as $data)
                            <option value="{{$data->id}}">{{$data->sanksi}}</option>
                        @endforeach
                    </select>
                    @error('sanksi_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Tambah</button>
            </form>
            
        </div>
    </div>
</div>
@endsection