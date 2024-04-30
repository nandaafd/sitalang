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
            <h4 class="mb-3">Data Sanksi</h4>
            
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
            
            <div class="row mb-3">
                <div class="col-10">
                    <form action="" method="get">
                        <div class="row">
                            <div class="input-group w-50">
                                <input type="text" name="filter" class="form-control form-control-sm" value="{{$filter}}" id="" placeholder="Cari sanksi..">
                                <button class="btn btn-primary btn-sm mr-1" type="submit"><i class="bi bi-search"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2 text-end">
                    <a class="btn btn-primary" href="{{route('data-sanksi.create')}}" title="Tambah data sanksi"><i class="bi bi-plus"></i></a>
                </div>
            </div>
            <div class="">
                @isset($sanksi)
                <table class="table table-hover">
                    <thead>
                        <tr class="">
                            <th>No</th>
                            <th class="">Range Poin</th>
                            <th class="w-50">Sanksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sanksi as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->range_poin}}</td>
                                <td>{{$data->sanksi}}</td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('data-sanksi.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill"></i></button>
                                          </form>  
                                          <a href="{{route('data-sanksi.edit', $data->id)}}" class="btn btn-success btn-sm" title="edit"><i class="bi bi-pencil"></i></a>            
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">--Tidak ada data--</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $sanksi->links() ?? '' }}
                @endisset
            </div>
            
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