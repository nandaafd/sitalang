@extends('dashboard.layout.main')
@section('content')
    
<div>
    <div class="container mb-3 bg-light rounded">
        <div class="row" id="contentHeader">
            <div class="col-9">
                <div class="h3 mt-3 ms-3">
                    Data Siswa
                </div>
                <div class="h5 ms-3">
                    SMKN 1 Labang Bangkalan
                </div>
                <div class="container">
                    {{ Breadcrumbs::render() }}
                </div>
            </div>
            <div class="col-3">
                <img src="{{asset('/images/assets/vector1.png')}}" alt="" srcset="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container bg-light py-3 rounded px-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('err'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('err') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-10">
                <form action="" id="frmFilter" method="get">
                    <ul id="filterField">
                        <li class="mr-2">
                            <input type="text" id="filterName" name="nama" class="form-control form-control-sm" value="{{$nama ?? ''}}" id="" placeholder="Cari nama siswa..">
                        </li>
                        <li class="mr-2">
                            <select name="kelas_id" id="filter_kelas" class="form-select form-select-sm">
                                <option value="">--pilih kelas--</option>
                                @forelse ($kelas as $item)
                                    <option value="{{$item->id}}" {{$filkelas == $item->id ? 'selected':''}}>{{$item->name}}</option>
                                @empty
                                <option value="">--no data--</option>
                                @endforelse
                            </select>
                        </li>
                        <li class="mr-2">
                            <button class="btn btn-primary btn-sm" type="submit">Cari</a>
                        </li>
                        <li class="mr-2">
                            <button class="btn btn-secondary btn-sm" type="submit" id="btnReset">Reset</a>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="col-2 text-end">
                <a class="btn btn-primary" href="{{route('siswa.create')}}" title="Tambah data siswa"><i class="bi bi-plus"></i></a>
            </div>
        </div>
        
        <div class="">
            <div class="table-responsive">
                @isset($siswa)
                <table class="table table-hover">
                    <thead>
                        <tr class="">
                            <th>No</th>
                            <th class="">Nama</th>
                            <th class="">Email</th>
                            <th class="">Kelas</th>
                            <th class="">Terblokir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->user->fullname}}</td>
                                <td>{{$data->user->email}}</td>
                                <td>{{$data->kelas->name}}</td>
                                <td class="text-center">
                                    <form action="{{route('block',$data->user_id)}}" method="post" id="formBlokir-{{$data->id}}">
                                        @csrf @method('put')
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="user_id" value="{{$data->user_id}}">
                                            <input class="form-check-input flexSwitchCheckChecked-{{$data->id}}" name="is_blocked" value="{{$data->user->is_blocked}}" onchange="toggleConfirmation({{$data->id}}, '{{ $data->user->fullname}}')" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{$data->user->is_blocked == true ? 'checked':''}}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">{{$data->user->is_blocked == true ? 'Yes':'No'}}</label>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <div class="dropdown" id="dropdownMore">
                                        <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li>
                                            <form action="{{ route('siswa.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" title="Hapus data" onclick="return confirm('Apakah anda yakin ingin menghapus?')"><i class="bi bi-trash3-fill mr-2"></i> Hapus</button>
                                              </form>
                                          </li>
                                          <li><a href="{{route('siswa.edit', $data->id)}}" class="dropdown-item text-success" title="edit"><i class="bi bi-pencil mr-2"></i> Edit</a></li>
                                          <li><a href="{{route('siswa.show', $data->id)}}" data-id="{{$data->id}}" class="dropdown-item text-primary btn-detail" title="detail"><i class="bi bi-card-list mr-2"></i> Lihat Detail</a></li>
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
                {{ $siswa->links() ?? '' }}
                @endisset
            </div>
        </div>
    </div>
</div>
<script>
    $(".btn-detail").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $('#modal-lg').modal("show");
        $('#modal-lg-label').text("Profil Siswa");
        $('.modal-lg-body').load('/dashboard/siswa/'+id)
    });
    $(document).ready(function(e) {
        $('#btnReset').click(function (e) {
            e.preventDefault();
            $('#filterKategori').val('')
            $('#filter_kelas').val('')
            $('#filterName').val('')
            setTimeout(function() {
                $("#frmFilter").off("submit").submit();
            }, 300);
        })
    })

    function toggleConfirmation(id, name) {
        var isBlocked = $('.flexSwitchCheckChecked-'+id).prop('checked');
        var message = isBlocked ? "Apakah kamu yakin ingin memblokir "+name+"?" : "Apakah kamu yakin akan membuka blokir "+name+"?";
        if (confirm(message)) {
            $('#formBlokir-'+id).submit();
        } else {
            $('.flexSwitchCheckChecked-'+id).prop('checked', !isBlocked);
        }
    }
</script>
@endsection