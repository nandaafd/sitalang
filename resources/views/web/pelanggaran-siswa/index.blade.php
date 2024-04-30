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
            
            <div class="row mb-3">
                <div class="col-10">
                    <form action="" id="frmFilter" method="get">
                        <ul id="filterField">
                            <li class="me-2">
                                <input type="text" id="filterName" name="nama" class="form-control form-control-sm" value="{{$nama ?? ''}}" id="" placeholder="Cari nama siswa..">
                            </li>
                            <li class="me-2">
                                <select name="pelanggaran_id" id="filterPelanggaran" class="form-control form-control-sm">
                                    <option value="">--pilih pelanggaran--</option>
                                    @foreach ($pelanggaran as $item)
                                        <option {{$pel == $item->id ? 'selected':''}} value="{{$item->id}}">{{$item->nama_pelanggaran}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="me-2">
                                <select name="kategori_id" id="filterKategori" class="form-control form-control-sm">
                                    <option value="">--pilih kategori--</option>
                                    @foreach ($kategori as $item)
                                        <option {{$kat == $item->id ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="me-2">
                                <button class="btn btn-primary btn-sm" type="submit">Cari</a>
                            </li>
                            <li class="me-2">
                                <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="col-2 text-end">
                    <a class="btn btn-primary" href="{{route('pelanggaran-siswa.create')}}" title="Tambah data pelanggaran siswa"><i class="bi bi-plus"></i></a>
                </div>
            </div>
            <div class="row w-50 mb-3">
                <div class="col">
                    <ul id="filterMenu">
                        <li class="me-2">
                            <form action="" method="get">
                                <input type="submit" id="btnPsSemua" name="semua" class="btn btn-outline-secondary btn-sm {{ request()->has('semua') ? 'active' : '' }}" value="Semua">
                            </form>
                        </li>
                        <li class="me-2">
                            <form action="" method="get">
                                <input type="submit" id="btnPsSemua" name="this_year" class="btn btn-outline-secondary btn-sm {{ request()->has('this_year') ? 'active' : '' }}" value="Tahun Ini">
                            </form>
                        </li>
                        <li class="me-2">
                            <form action="" method="get">
                                <input type="submit" id="btnPsSemua" name="this_month" class="btn btn-outline-secondary btn-sm {{ request()->has('this_month') ? 'active' : '' }}" value="Bulan Ini">
                            </form>
                        </li>
                        <li class="me-2">
                            <form action="" method="get">
                                <div class="dropdown">
                                    <button id="btnPsSemua" class="btn btn-outline-secondary btn-sm dropdown-toggle {{ request()->has('other') ? 'active' : '' }}" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Lainnya
                                    </button>
                                    <ul class="dropdown-menu" id="pillBtn">
                                      <li><input type="submit" name="other" class="btn w-100 {{ request('other') == 'Minggu ini' ? 'active' : '' }}" value="Minggu ini"></li>
                                      <li><input type="submit" name="other" class="btn w-100 {{ request('other') == 'Bulan lalu' ? 'active' : '' }}" value="Bulan lalu"></li>
                                      <li><input type="submit" name="other" class="btn w-100 {{ request('other') == 'Tahun lalu' ? 'active' : '' }}" value="Tahun lalu"></li>
                                    </ul>
                                  </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    @isset($pelsis)
                    <table class="table table-hover">
                        <thead>
                            <tr class="">
                                <th>No</th>
                                <th class="">Nama Siswa</th>
                                <th class="">Tanggal</th>
                                <th class="">Pelanggaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pelsis as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="javascript:void" class="btn-detail" data-id="{{$data->siswa_id}}">{{$data->siswa->user->fullname}}</a></td>
                                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('l, d-M-Y') }}</td>
                                    <td>{{$data->pelanggaran->nama_pelanggaran}}</td>
                                    <td>
                                        <div class="dropdown" id="dropdownMore">
                                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                              <li>
                                                <form action="{{ route('pelanggaransiswa.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill mr-2"></i> Hapus</button>
                                                  </form>
                                              </li>
                                              <li><a href="{{route('pelanggaran-siswa.edit', $data->id)}}" class="dropdown-item text-success" title="edit"><i class="bi bi-pencil mr-2"></i> Edit</a></li>
                                              <li><a href="{{route('pelanggaran-siswa.show', $data->id)}}" class="dropdown-item text-primary" title="detail"><i class="bi bi-card-list mr-2"></i> Lihat Detail</a></li>
                                            </ul>
                                          </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">--Tidak ada data--</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $pelsis->links() ?? '' }}
                    @endisset
                </div>
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