@extends('web.layout.page')
@section('content')
<div class="row">
    <div class="col" id="sitalang-header">
        <div class="row">
          <div class="col-9">
                <h4 style="font-weight: 600;"> "<span style="color:#FF6B00;">Disiplin</span> 
                    diri adalah  <span style="color:#FF6B00;">kekuatan ajaib</span>  Kegiatanmu 
                     yang membuat kamu benar-benar tak terhentikan".
                </h4>
                <div class="container">
                    {{ Breadcrumbs::render() }}
                </div>
          </div>
          <div class="col-3">
            <img id="vector2" class="img-fluid" src="{{asset('images/assets/vector2.png')}}" alt="" srcset="">
          </div>
        </div>
    </div>
    <div class="row">
        {{-- {{Auth::user()->siswa[0]['pembimbing_lapangan_id']}} --}}
        <div class="col" id="masterpelanggaran-page" class="">
            <h4 class="mb-3">Edit Master Pelanggaran</h4>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('messageWarning'))
                <div class="col text-center mt-5">
                    {{ session('messageWarning') }}
                </div>  
            @endif
            
            <form action="{{route('pelanggaran.update',$pelanggaran->id)}}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="range_poin" class="form-label">Nama Pelanggaran</label>
                    <input type="text" class="form-control @error('nama_pelanggaran') is-invalid @enderror" value="{{$pelanggaran->nama_pelanggaran}}" name="nama_pelanggaran" placeholder="Tuliskan range poin maksimal..">
                    @error('nama_pelanggaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="poin" class="form-label">Poin</label>
                    <input type="number" class="form-control @error('name') is-invalid @enderror" value="{{$pelanggaran->poin}}" name="poin" placeholder="Tuliskan sanksi disini..">
                    @error('poin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori_id" id="" class="form-select @error('kategori_id') is-invalid @enderror">
                        @foreach ($kategori as $data)
                            <option {{$pelanggaran->kategori_id == $data->id ? 'selected' : ''}} value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        $('#btnReset').click(function (e) {
            e.preventDefault();
            $('#filterKategori').val('')
            $('#filterName').val('')
            setTimeout(function() {
                $("#frmFilter").off("submit").submit();
            }, 300);
        })
    })
</script>
@endsection