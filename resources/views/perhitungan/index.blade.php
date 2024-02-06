@extends('layouts.master')
@section('title', 'Perhitungan')
@section('header', 'Perhitungan')
@section('breadcrumb', 'Perhitungan')
@section('container-fluid')

    <div class="card card-outline card-warning">
        <div class="card-header text-center">
            <h4>Konversi Data Penilaian</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PPNPN</th>
                            @foreach ($kriteria as $item)
                                <th>{{ $item->nmKr }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($namaPPNPN as $index => $ppnpn)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ppnpn->namaPPNPN }}</td>
                                @foreach ($kriteria as $kriteriaItem)
                                    @php
                                        $nilaiKonversi = $nilaiTriwulan
                                            ->where('idPPNPN', $ppnpn->idPPNPN)
                                            ->where('idKr', $kriteriaItem->idKr)
                                            ->first();
                                    @endphp
                                    <td>{{ $nilaiKonversi ? $nilaiKonversi->nilai_konversi : '-' }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header text-center">
            <h4>Hasil Normalisasi PPNPN</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PPNPN</th>
                            @foreach ($kriteria as $item)
                                <th>{{ $item->nmKr }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($namaPPNPN as $index => $ppnpn)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ppnpn->namaPPNPN }}</td>
                                @foreach ($matriksKeputusan[$index] as $nilai)
                                    <td>{{ number_format($nilai, 6) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header text-center">
            <h4>Hasil Normalisasi terbobot PPNPN</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PPNPN</th>
                            @foreach ($kriteria as $item)
                                <th>{{ $item->nmKr }}</th>
                            @endforeach
                            <th>Optimasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($namaPPNPN as $index => $ppnpn)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ppnpn->namaPPNPN }}</td>
                                @php
                                    $totalNilai = 0;
                                @endphp
                                @foreach ($matriksNormalisasiTerbobot[$index] as $key => $nilai)
                                    @php
                                        $totalNilai += $nilai;
                                    @endphp
                                    <td>{{ number_format($nilai, 6) }}</td>
                                @endforeach
                                <!-- Menampilkan total nilai -->
                                <td>{{ number_format($totalNilai, 5) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header text-center">
            <h4>Tabel Perangkangingan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
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
        $(function() {
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
        $(function() {
            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
    </script>
@endsection
