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
            <h4 class="mb-3">Tambah Data Sanksi</h4>
            
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
            
            <form action="{{route('data-sanksi.update', $data->id)}}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="range_poin" class="form-label">Pada Poin</label>
                    <input type="number" class="form-control @error('range_poin') is-invalid @enderror" value="{{$data->range_poin}}" name="range_poin" placeholder="Tuliskan range poin maksimal..">
                    @error('range_poin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="sanksi" class="form-label">Sanksi</label>
                    <input type="text" class="form-control @error('sanksi') is-invalid @enderror" value="{{$data->sanksi}}" name="sanksi" placeholder="Tuliskan sanksi disini..">
                    @error('sanksi')
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