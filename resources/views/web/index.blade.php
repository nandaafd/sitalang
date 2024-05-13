@extends('web.layout.main')
@section('content')

<section id="hero" class="mx-auto">
  <div class="row">
    @if(!Auth::user())
        <div class="col-md-6" id="tagline">
            <h1 class="text">
                Tak Perlu  <span class="fw-bold"> Cemas</span>, 
                Kini Anda Dapat Melihat  <span class="fw-bold">Pelanggaran Anda</span> Dengan Sangat Mudah</span>
            </h1>
            <p class="text">Kini anda tak perlu repot untuk meilhat rekap pelanggaran anda, karena kini 
                anda dapat melihatnya dengan sangat mudah, kapan saja, dan dimana saja.
            </p>
            <a href="{{url('/pelanggaran-siswa')}}" class="btn btn-primary" id="btn-daftar-hero">Lihat Sekarang</a>
        </div>
        <img src="{{asset('images/assets/hero-person.png')}}" alt="" srcset="" id="person-hero" class="position-absolute end-0">
        <img src="{{asset('images/assets/eclipse.png')}}" alt="" srcset="" id="eclipse" class="position-absolute">
    @elseif(Auth::user()->role->name == 'guru')
        <div class="col-md-6" id="tagline">
            <h1 class="text">
                Tak Perlu  <span class="fw-bold"> Cemas</span>, 
                Kini Anda Dapat Mencatat  <span class="fw-bold">Pelanggaran Siswa</span> Dengan Sangat Mudah</span>
            </h1>
            <p class="text">Kini anda tak perlu repot untuk mencatat pelanggaran siswa, karena kini 
                anda dapat mencatat dan melihat pelanggaran siswa dengan sangat mudah dan dimana saja.
            </p>
            <a href="{{url('/pelanggaran-siswa/create')}}" class="btn btn-primary" id="btn-daftar-hero">Catat Sekarang</a>
        </div>
        <img src="{{asset('images/assets/hero-person.png')}}" alt="" srcset="" id="person-hero" class="position-absolute end-0">
        <img src="{{asset('images/assets/eclipse.png')}}" alt="" srcset="" id="eclipse" class="position-absolute">
    @elseif(Auth::user()->role->name == 'siswa') 
        <div class="col-md-6" id="tagline">
            <h1 class="text">
                Tak Perlu  <span class="fw-bold"> Cemas</span>, 
                Kini Anda Dapat Melihat  <span class="fw-bold">Pelanggaran Anda</span> Dengan Sangat Mudah</span>
            </h1>
            <p class="text">Kini anda tak perlu repot untuk meilhat rekap pelanggaran anda, karena kini 
                anda dapat melihatnya dengan sangat mudah, kapan saja, dan dimana saja.
            </p>
            <a href="{{url('/pelanggaran-siswa')}}" class="btn btn-primary" id="btn-daftar-hero">Lihat Sekarang</a>
        </div>
        <img src="{{asset('images/assets/hero-person.png')}}" alt="" srcset="" id="person-hero" class="position-absolute end-0">
        <img src="{{asset('images/assets/eclipse.png')}}" alt="" srcset="" id="eclipse" class="position-absolute">  
    @endif
  </div>
</section>  
<section id="menu-area" class="my-4">
  <div class="row text-center mx-auto py-4 menu">
    <div class="col">
      <div class="menu-box mx-auto py-1">
        <a href="{{url('/pelanggaran-siswa')}}" class="text-center mx-auto">
          <img src="{{asset('images/assets/icons/prisoner.gif')}}" alt="" class="ikon-daftar img-fluid">
          <p>Pelanggaran Siswa</p>
        </a>
      </div>
    </div>
    @can('guru')
        <div class="col">
        <div class="menu-box mx-auto py-1">
            <a href="{{url('/pelanggaran')}}" class="text-center mx-auto">
            <img src="{{asset('images/assets/icons/folder.gif')}}" alt="" class="ikon-daftar img-fluid">
            <p>Master Pelanggaran</p>
            </a>
        </div>
        </div>
        <div class="col">
        <div class="menu-box mx-auto py-1">
            <a href="{{url('/data-sanksi')}}" class="text-center mx-auto">
            <img src="{{asset('images/assets/icons/curriculum.gif')}}" alt="" class="ikon-daftar img-fluid">
            <p>Master Sanksi</p>
            </a>
        </div>
        </div>
    @endcan
    <div class="col">
      <div class="menu-box mx-auto py-1">
        <a href="#footer" class="text-center mx-auto">
          <img src="{{asset('images/assets/icons/contacts.gif')}}" alt="" class="ikon-daftar img img-fluid">
          <p>Kontak</p>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="menu-box mx-auto py-1">
        <a href="{{url('/')}}" class="text-center mx-auto">
          <img src="{{asset('images/assets/icons/information.gif')}}" alt="" class="ikon-daftar img-fluid">
          <p>Informasi</p>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="menu-box mx-auto py-1">
        <a href="javascript:void(0)" class="text-center mx-auto" data-bs-target="#modal-menu" data-bs-toggle="modal" id="btn-lainnya">
          <img src="{{asset('images/assets/icons/menu.gif')}}" alt="" class="ikon-daftar img-fluid">
          <p>Lainnya</p>
        </a>
      </div>
    </div>
  </div>
</section>
@if(Auth::id())
<section id="rangkuman-area" class="pb-4">
    <h3 class=" pt-3 ms-5" id="tittle-rangkuman">Rangkuman Data</h3>
      <p class="ms-5" id="subtittle-rangkuman">Ranguman data terbaru tersedia disini!</p>
        <div class="row mx-auto" id="rangkuman">
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card" style="min-height: 500px;">
                        <div class="card-body">
                            <h4 class="card-title">Total Siswa</h4>
                            <canvas id="doughnutChart" class="mt-2" style="height:283px; width:100%;"></canvas>
                            <ul class="list-style-none mb-0 mt-3"style="list-style-type:none;">
                                <li>
                                    <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                    <span class="text-muted">Perempuan</span>
                                    {{-- <span id="perempuan" class="text-dark float-right font-weight-medium">{{$jmlSiswaPria}}</span> --}}
                                </li>
                                <li class="mt-3">
                                    <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                    <span class="text-muted">Laki-Laki</span>
                                    {{-- <span id="laki" class="text-dark float-right font-weight-medium">{{$jmlSiswaWanita}}</span> --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card" style="min-height: 500px;">
                        <div class="card-body">
                            <h4 class="card-title">Data Pelanggaran</h4>
                            <canvas id="barChart" class="mt-2" style="height:283px; width:100%;"></canvas>
                            <span>All time data</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card" style="min-height: 500px;">
                        <div class="card-body">
                            <h4 class="card-title">Total Pengguna</h4>
                            <canvas id="pieChart" class="mt-2" style="height:283px; width:100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="card mx-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h4 class="card-title">Top 10 Pelanggar Terbanyak</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap v-middle mb-0">
                                    <thead>
                                        <tr class="border-0">
                                            <th class="border-0 font-14 font-weight-medium text-muted">Nama Siswa
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted px-2">Total Melanggar
                                            </th>
                                            <th class="border-0 font-14 font-weight-medium text-muted">Kelas</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($siswas as $key => $value)
                                            @if($value->fullname)
                                                <tr>
                                                    <td class="border-top-0 px-2 py-4">
                                                        <div class="d-flex no-block align-items-center">
                                                            <div class="mr-3"><img
                                                                src="{{asset('storage/'.$value->foto)}}"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" onerror="this.src='{{asset('/images/assets/blank-profile-picture.jpg')}}'"/></div>
                                                                <div class="">
                                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                                        {{$value->fullname}}
                                                                    </h5>
                                                                    <span class="text-muted font-14">{{$value->email}}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{$value->total}} kali</td>
                                                        <td class="border-top-0 text-muted px-2 py-4 font-14">{{$value->kelas}}</td>
                                                    </tr>
                                            @endif
                                        @empty
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </section>
@endif

  <script>
    $(document).ready(function () {

        $('#btn-lainnya').click(function (e) {
            $("#modal-menu").modal('show');
        })
        
        // Fungsi untuk memperbarui chart
        function updateChart() {
            // Data untuk doughnut chart
            const data = {
                labels: ['Perempuan', 'Laki-Laki'],
                datasets: [{
                    data: [{{$jmlSiswaWanita}}, {{$jmlSiswaPria}}],
                    backgroundColor: ['#007bff', '#dc3545']
                }]
            };

            // Konfigurasi untuk doughnut chart
            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: false,
                        }
                    }
                },
            };

            // Membuat chart
            var myDoughnutChart = new Chart(
                $('#doughnutChart')[0].getContext('2d'),
                config
            );

            // Update nilai penjualan
            $('#perempuan').text(+ data.datasets[0].data[0]);
            $('#laki').text(+ data.datasets[0].data[1]);
        }

        // Memanggil fungsi updateChart
        updateChart();


        //bar chart
        // Data pelanggaran
        const dataBar = {
            labels: ['Berat', 'Sedang', 'Ringan'],
            datasets: [{
                label: 'Jumlah Pelanggaran',
                data: [{{$pelBerat}}, {{$pelSedang}}, {{$pelRingan}}], // Misal: 10 pelanggaran berat, 20 pelanggaran sedang, 30 pelanggaran ringan
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 205, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                ],
                borderWidth: 1
            }]
        };

        // Opsi chart
        const options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Membuat bar chart
        const ctx = document.getElementById('barChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: dataBar,
            options: options
        });

        //pie chart
        const dataPie = {
            labels: ['Admin', 'Guru', 'Siswa'],
            datasets: [{
                label: 'Total Pengguna',
                data: [{{$userAdmin}}, {{$userGuru}}, {{$userSiswa}}], // Misal: 10 pelanggaran berat, 20 pelanggaran sedang, 30 pelanggaran ringan
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 205, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 205, 86, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Opsi chart
        const optionsPie = {
            scales: {},
            plugins: {
                legend: {
                    position: 'bottom',
                },
            }
        };

        // Membuat pie chart
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        const myPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: dataPie,
            options: options
        });
    })
  </script>
@push('js')
@endpush
@endsection