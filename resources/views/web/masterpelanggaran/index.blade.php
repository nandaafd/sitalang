@extends('web.layout.page')
@section('content')
<div class="row">
    <div class="col" id="sitalang-header">
        <div class="row">
          <div class="col-9">
            {{-- @can('siswa')
                <h2 style="font-weight: 600;">Bagaimana <span style="color:#FF6B00;">Kegiatanmu</span> Hari Ini?<br>
                    Ayo <span style="color:#FF6B00;">Ekspresikan</span>  Kegiatanmu 
                    Di Logbook Sekarang Juga!</h4>
                <h5>Logbook adalah catatan sejarahmu selama mengikuti prakerin, yuk isi sekarang.</h5>
            @endcan
            @can('pembimbing-lapangan')
            <h2 style="font-weight: 600;">Dengan <span style="color:#FF6B00;">Logbook</span>, Anda Dapat Memantau Kegiatan Siswa <span style="color:#FF6B00;">Setiap Hari</span> Dengan Mudah!</h4>
                <h4>Logbook adalah wahana ekspresi siswa selama mengikuti prakerin.</h4>
            @endcan
            @can('guru')
            <h2 style="font-weight: 600;">Dengan <span style="color:#FF6B00;">Logbook</span>, Anda Dapat Memantau Kegiatan Siswa <span style="color:#FF6B00;">Setiap Hari</span> Dengan Mudah!</h4>
                <h4>Logbook adalah wahana ekspresi siswa selama mengikuti prakerin.</h4>
            @endcan --}}
          </div>
          <div class="col-3">
            <img id="vector2" class="img-fluid" src="{{asset('images/assets/vector2.png')}}" alt="" srcset="">
          </div>
        </div>
    </div>
    <div class="row">
        {{-- {{Auth::user()->siswa[0]['pembimbing_lapangan_id']}} --}}
        <div class="col" id="masterpelanggaran-page" class="">
            <h4 class="mb-3">Data Master Pelanggaran</h4>
            
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
            
            <div class="row mb-3">
                <div class="col-10">
                    <form action="" id="frmFilter" method="get">
                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li class="mr-2">
                                        <input type="text" id="filterName" name="nama" class="form-control form-control-sm" value="{{$nama ?? ''}}" id="" placeholder="Cari nama pelanggaran..">
                                    </li>
                                    <li class="mr-2">
                                        <select name="kategori_id" id="filterKategori" class="form-control form-control-sm">
                                            <option value="">--pilih kategori--</option>
                                            @foreach ($kategori as $item)
                                                <option {{$kat == $item->id ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li class="mr-2">
                                        <button class="btn btn-primary btn-sm mr-1" type="submit">Cari</a>
                                        <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-2 text-end">
                    <a class="btn btn-primary" href="{{route('pelanggaran.create')}}" title="Tambah data master pelanggaran"><i class="bi bi-plus"></i></a>
                </div>
            </div>
            <div class="">
                @isset($pelanggaran)
                <table class="table table-hover">
                    <thead>
                        <tr class="">
                            <th>No</th>
                            <th class="w-50">Nama Pelanggaran</th>
                            <th class="">Poin</th>
                            <th class="">Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggaran as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->nama_pelanggaran}}</td>
                                <td>{{$data->poin}}</td>
                                <td>{{$data->Kategori->name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('masterpelanggaran.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill"></i></button>
                                          </form>  
                                          <a href="{{route('masterpelanggaran.edit', $data->id)}}" class="btn btn-success btn-sm" title="edit"><i class="bi bi-pencil"></i></a>            
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
                {{ $pelanggaran->links() ?? '' }}
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