@extends('dashboard.layout.main')
@section('content')
<div class="container">
    <div class="card mb-3 py-3 px-4">
        <div class="mb-3 bg-light rounded">
            <div class="row" id="contentHeader">
                <div class="col-9">
                    <div class="h3 mt-3 ms-3 fw-bold">
                        Rangkuman
                    </div>
                    <div class="h5 ms-3">
                        SMKN 1 Labang Bangkalan
                    </div>
                    <div class="container">
                        @if (Auth::user())
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle px-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Hello, {{Auth::user()->fullname}}</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item btnProfile" data-id="{{Auth::id()}}" href="javascript:void"><i class="bi bi-person"></i> Profile</a>
                                </li>
                                <li>
                                    <form action="{{url('/logout')}}" method="POST" class="">
                                        @csrf
                                        <button type="submit" class="dropdown-item" onclick="return confirm('are you sure?')"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                          </div>
                        @endif
                    </div>
                </div>
                <div class="col-3">
                    <img src="{{asset('/images/assets/vector1.png')}}" alt="" srcset="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg col-md-12 text-center">
            <div class="card py-2">
                <h3 class="fw-bold">{{$totGuru}}</h3>
                <span>Guru</span>
            </div>
        </div>
        <div class="col-lg col-md-12 text-center">
            <div class="card py-2">
                <h3 class="fw-bold">{{$totPelanggaran}}</h3>
                <span>master Pelanggaran</span>
            </div>
        </div>
        <div class="col-lg col-md-12 text-center">
            <div class="card py-2">
                <h3 class="fw-bold">{{$totSanksi}}</h3>
                <span>Sanksi</span>
            </div>
        </div>
        <div class="col-lg col-md-12 text-center">
            <div class="card py-2">
                <h3 class="fw-bold">{{$jmlSiswaPria + $jmlSiswaWanita}}</h3>
                <span>Siswa</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card" style="min-height: 420px;">
                <div class="card-body">
                    <h4 class="card-title">Total Siswa</h4>
                    <canvas id="doughnutChart" class="mt-2" style="height:283px; width:100%;"></canvas>
                    <ul class="list-style-none mb-0 mt-3"style="list-style-type:none;">
                        <li>
                            <i class="fas fa-circle text-primary font-10 mr-2"></i>
                            <span class="text-muted">Perempuan</span>
                            <span id="perempuan" class="text-dark float-right font-weight-medium">{{$jmlSiswaPria}}</span>
                        </li>
                        <li class="mt-3">
                            <i class="fas fa-circle text-danger font-10 mr-2"></i>
                            <span class="text-muted">Laki-Laki</span>
                            <span id="laki" class="text-dark float-right font-weight-medium">{{$jmlSiswaWanita}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card" style="min-height: 420px;">
                <div class="card-body">
                    <h4 class="card-title">Data Pelanggaran</h4>
                    <canvas id="barChart" class="mt-2" style="height:283px; width:100%;"></canvas>
                    <span>All time data</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card" style="min-height: 420px;">
                <div class="card-body">
                    <h4 class="card-title">Total Pengguna</h4>
                    <canvas id="pieChart" class="mt-2" style="height:283px; width:100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
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
                                    @foreach($siswas as $key => $value)
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".btnProfile").click(function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            $('#modal-lg').modal("show");
            $('#modal-lg-label').text("Profil Admin");
            $('.modal-lg-body').load('/dashboard/admin/'+id)
        });


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
    });


</script>
@endsection