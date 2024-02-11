<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\NilaiTriwulan;
use App\Models\Periode;
use App\Models\PPNPN;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        $periode = Periode::all();
        $namaPPNPN = PPNPN::all();

        $nilaiTriwulans = NilaiTriwulan::with(['PPNPN', 'Periode', 'Kriteria'])->get();

        // Membuat matriks keputusan
        $matriksKeputusan = [];

        foreach ($namaPPNPN as $ppnpn) {
            $baris = [];
            foreach ($kriteria as $kriteriaItem) {
                $nilaiKonversi = $nilaiTriwulans
                    ->where('idPPNPN', $ppnpn->idPPNPN)
                    ->where('idKr', $kriteriaItem->idKr)
                    ->first();

                $baris[] = $nilaiKonversi ? $nilaiKonversi->nilai_konversi : 0;
            }
            $matriksKeputusan[] = $baris;
        }

        // Melakukan normalisasi matriks
        $jumlahBaris = count($matriksKeputusan);
        $jumlahKolom = count($matriksKeputusan[0]);

        for ($j = 0; $j < $jumlahKolom; $j++) {
            $sumSquared = 0;
            for ($i = 0; $i < $jumlahBaris; $i++) {
                $sumSquared += pow($matriksKeputusan[$i][$j], 2);
            }

            $pembagi = sqrt($sumSquared);

            for ($i = 0; $i < $jumlahBaris; $i++) {
                $matriksKeputusan[$i][$j] /= $pembagi;
            }
        }


        // Bobot Kriteria
        $bobotKriteria = Kriteria::pluck('bobotKr', 'idKr')->toArray();

        // Normalisasi Terbobot
        $matriksNormalisasiTerbobot = [];

        for ($i = 0; $i < $jumlahBaris; $i++) {
            $baris = [];
            for ($j = 0; $j < $jumlahKolom; $j++) {
                $baris[] = $matriksKeputusan[$i][$j] * $bobotKriteria[$kriteria[$j]->idKr];
            }
            $matriksNormalisasiTerbobot[] = $baris;
        }
        // dd($matriksNormalisasiTerbobot);

        return view('laporan.index', [
            'nilaiTriwulan' => $nilaiTriwulans,
            'namaPPNPN' => $namaPPNPN,
            'periode' => $periode,
            'kriteria' => $kriteria,
            'matriksKeputusan' => $matriksKeputusan,
            'matriksNormalisasiTerbobot' => $matriksNormalisasiTerbobot,

        ]);
    }
}
