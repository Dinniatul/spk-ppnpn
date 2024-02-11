@extends('layouts.master')
@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('container-fluid')

    <div class="card card-outline card-warning mb-5">
        <div class="card-header text-center">
            <h4>Grafik Nilai PPNPN</h4>
        </div>
        <canvas id="perangkinganChart" width="700" height="300"></canvas>
    </div>
    <div class="card card-outline card-warning">
        <div class="card-header text-center">
            <h4>Hasil Perangkingan PPNPN</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Rangking</th>
                            <th>Nama PPNPN</th>
                            <th>Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mendefinisikan array untuk menyimpan total nilai dan nama PPNPN
                        $perangkingan = [];
                        
                        // Memasukkan data hasil normalisasi terbobot ke dalam array perangkingan
                        foreach ($namaPPNPN as $index => $ppnpn) {
                            $totalNilai = 0;
                            foreach ($matriksNormalisasiTerbobot[$index] as $key => $nilai) {
                                $totalNilai += $nilai;
                            }
                            $perangkingan[] = ['namaPPNPN' => $ppnpn->namaPPNPN, 'totalNilai' => $totalNilai];
                        }
                        
                        // Fungsi untuk melakukan pengurutan berdasarkan totalNilai dari yang tertinggi ke terendah
                        usort($perangkingan, function ($a, $b) {
                            return $b['totalNilai'] <=> $a['totalNilai'];
                        });
                        ?>

                        @foreach ($perangkingan as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data['namaPPNPN'] }}</td>
                                <td>{{ number_format($data['totalNilai'], 5) }}</td>
                            </tr>
                        @endforeach

                    </tbody>


                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('perangkinganChart').getContext('2d');
            var perangkinganData = @json($perangkingan);
            var namaPPNPN = perangkinganData.map(function(data) {
                return data.namaPPNPN;
            });
            var totalNilai = perangkinganData.map(function(data) {
                return data.totalNilai;
            });

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: namaPPNPN,
                    datasets: [{
                        label: 'Total Nilai',
                        data: totalNilai,
                        backgroundColor: 'rgb(255, 165, 0)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

@endsection
