<div class="container">
    <div class="row rounded mx-3 my-3 py-4" id="profil-head">
        <div class="row">
            <div class="col">
                @if($data->user->is_blocked == true)
                    <div class="rounded-pill blocked pe-3">
                        <ul><li>Blocked</li></ul>
                    </div>
                @else
                    <div class="rounded-pill active pe-3">
                        <ul><li>Active</li></ul>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-end col">
                <div class="dropdown">
                    <button class="btn dropdown-toggle text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear text-light"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('admin.edit',$data->id)}}">Edit Profile</a></li>
                    </ul>
                  </div>
            </div>
        </div>
        <div class="w-100 text-center">
            <img src="{{asset('/images/assets/blank-profile-picture.jpg')}}" onerror="this.src='{{asset('/images/assets/blank-profile-picture.jpg')}}'" alt="" class="img-fluid rounded-circle" srcset="" id="img-detail">
        </div>
        <div class="text-center mt-3">
            <div class="h5 text-light">{{$data->user->fullname}} <span>({{$data->user->nickname}})</span></div>
            <div class="text-light"> Admin <span>|</span> {{$data->code}}</div>
            <p style="font-size: 12px; color:rgb(175, 175, 255)">Last seen {{$data->user->last_login != null ? \Carbon\Carbon::parse($data->user->last_login)->format('H:m, d-M-Y') : 'unknown'}}</p>
        </div>
    </div>
    <div class="row mx-4 my-3 py-4">
        <div class="col-lg-6 col-md-12 mb-3">
            <label for=""><i class="bi bi-envelope-paper mr-2"></i> Email</label>
            <div class="">{{$data->user->email}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
        <div class="col-lg-6 col-md-12 mb-3">
            <label for=""><i class="bi bi-card-text mr-2"></i>Admin Code</label>
            <div class="">{{$data->code}}</div>
            <hr class="w-100" style="border: 1px solid black"/>
        </div>
    </div>
    <div class="text-center mb-3 mx-4">
        <a href="javascript:void" class="btn btn-outline-danger w-100 changePassword" data-id="{{$data->user_id}}" >
            Ganti Password
        </a>
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