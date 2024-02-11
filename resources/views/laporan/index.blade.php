<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="{{ asset('kota-pariaman.png') }}" />
    <title>Laporan Hasil Nilai PPNPN</title>
    <style>
        /* Gaya untuk elemen-elemen surat */
        body {
            font-family: "Times New Roman", Times, serif;
            width: 700px;
            font-size: 12pt;
            height: 544px;
            padding: 38px 76px 26px 95px;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 5px solid #000;
            /* Atur warna dan ukuran garis sesuai preferensi Anda */
            padding-bottom: 5px;
            /* Berikan sedikit jarak antara header dan konten di bawahnya */
            margin-bottom: 25px;
        }

        .brand-image {
            margin-right: -2rem;
            /* Menggeser logo ke kiri */
            height: 100px;
            /* padding-right: -4rem; */
        }

        h3 {
            margin: 0;
            text-align: center;
        }

        h2 {
            margin: 0;
            text-align: center;
        }

        .content {
            font-size: 12pt;
        }

        /* Tambahkan gaya lainnya sesuai kebutuhan Anda */
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('AdminLTE') }}/dist/img/logo-laporan.jpg" alt="logo" class="brand-image ">
            <div class="header-content" style="text-align: center; font-size: 14px; ">
                <h2>MAHKAMAH AGUNG REPUBLIK INDONESIA</h2>
                <h2>DIREKTORAT JENDRAL BADAN PERADILAN MILITER DAN PERADILAN TATA USAHA NEGARA</h2>
                <h2>PENGADILAN TINGGI TATA USAHA NEGARA MEDAN</h2>
                <h2>PENGADILAN TATA USAHA NEGARA PADANG</h2>
                <p style="margin: 0;">Jalan Diponegoro Nomor 8, Kel. Belakang Tangsi, Kec. Padang Barat, Kota Padang,
                    Sumatera Barat 25117. www.ptun-padang.go.id, peratun@ptun-padang.go.id
                </p>
            </div>
        </div>

        <div class="content text-center">
            <div class="card card-outline card-warning text-center">
                <div class="card-header text-center">
                    <h4>Hasil Perangkingan PPNPN</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table border="1" cellspacing="0" cellpadding="5" width="100%">
                            <thead>
                                <tr>
                                    <th>Rangking</th>
                                    <th>Nama PPNPN</th>
                                    <th>Total Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
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

        </div>
        <div style="text-align: right;">
            <p style="margin-right: 45px; margin-top:50px; margin-bottom:60px;">Sekretaris</p>
            <p style="font-weight: bold">ANDI EFFENDI, SE</p>
        </div>

    </div>
</body>

</html>
<script>
    window.print();
    // When printing is done, navigate back
    window.onafterprint = function() {
        window.history.back();
    };
</script>
