@extends('web.layout.page')
@section('content')
<div class="row">
    <div class="col" id="sitalang-header">
        <div class="row">
          <div class="col-9">
                <div style="font-weight: 600;" class="headerQuote"> "<span style="color:#FF6B00;">Disiplin</span> 
                        diri adalah  <span style="color:#FF6B00;">kekuatan ajaib</span>  Kegiatanmu 
                        yang membuat kamu benar-benar tak terhentikan".
                </div>
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
            <div class="mb-3 pageTittle">Tambah Master Pelanggaran</div>
            
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
            
            <form action="{{route('pelanggaran.store')}}" method="post">
                @method('post')
                @csrf
                <div class="mb-3">
                    <label for="range_poin" class="form-label">Nama Pelanggaran</label>
                    <input type="text" class="form-control @error('nama_pelanggaran') is-invalid @enderror" value="{{old('nama_pelanggaran')}}" name="nama_pelanggaran" placeholder="Tuliskan nama pelanggaran..">
                    @error('nama_pelanggaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="poin" class="form-label">Poin</label>
                    <input type="number" class="form-control @error('poin') is-invalid @enderror" value="{{old('poin')}}" name="poin" placeholder="Tuliskan poin disini..">
                    @error('poin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select name="kategori_id" id="" class="form-select @error('kategori_id') is-invalid @enderror">
                        <option value="">--Pilih Kategori--</option>
                        @foreach ($kategori as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
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