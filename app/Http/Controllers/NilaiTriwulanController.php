<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\NilaiTriwulan;
use App\Models\Periode;
use App\Models\PPNPN;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiTriwulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = [];
        $periode = Periode::all();
        $namaPPNPN = PPNPN::all();
        $role = auth()->user()->role;
        if ($role == 'Atasan Langsung') {
            $kriteria = Kriteria::where('idKr', '!=', 6)->get();
            // dd($kriteria);
        } elseif ($role == 'Kepegawaian') {
            $kriteria = Kriteria::where('idKr', 6)->get();
        } else {
            $kriteria = Kriteria::all();
        }
        if ($role == 'Admin') {
            $nilaiTriwulans = NilaiTriwulan::with(['PPNPN', 'Periode', 'Kriteria'])->get();
        } else {
            $currentUser = auth()->user();
            $nilaiTriwulans = NilaiTriwulan::with(['PPNPN', 'Periode', 'Kriteria'])
                ->where('user_id', $currentUser->id)
                ->get();
        }
        // dd($kriteria);
        
        return view('nilai-triwulan.index', [
            'nilaiTriwulan' => $nilaiTriwulans,
            'namaPPNPN' => $namaPPNPN,
            'periode' => $periode,
            'kriteria' => $kriteria

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = auth()->user()->role;
        // dd($role);
        $kriteria = [];
        $namaPPNPN = PPNPN::all();
        $periode = Periode::all();
        if ($role == 'Atasan Langsung') {
            $kriteria = Kriteria::where('idKr', '!=', 6)->get();
            // dd($kriteria);
        } elseif ($role == 'Kepegawaian') {
            $kriteria = Kriteria::where('idKr', 6)->get();
        } else {
            $kriteria = Kriteria::all();
        }

        return view('nilai-triwulan.create', [
            'namaPPNPN' => $namaPPNPN,
            'periode' => $periode,
            'kriteria' => $kriteria,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'idPPNPN' => 'required',
            'idPr' => 'required',
            'idKr' => 'required',
            'nilai' => 'required',
            'nilai_konversi' => 'nullable',
        ]);

        try {
            // Dapatkan ID pengguna yang saat ini terotentikasi
            $user_id = auth()->id();

            // Tetapkan nilai konversi ke null saat membuat data baru
            $validate['nilai_konversi'] = null;

            // Tambahkan ID pengguna ke dalam data yang akan disimpan
            $validate['user_id'] = $user_id;

            NilaiTriwulan::create($validate);
            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return redirect('/nilai-triwulan');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect('/nilai-triwulan');
        }
    }


    // Fungsi untuk menghitung nilai konversi
    private function hitungKonversi($nilai)
    {
        if ($nilai >= 91) {
            return 5;
        } elseif ($nilai >= 76) {
            return 4;
        } elseif ($nilai >= 61) {
            return 3;
        } elseif ($nilai >= 51) {
            return 2;
        } else {
            return 1;
        }
    }


    public function konversi($idNtr)
    {
        $nilaiTriwulan = NilaiTriwulan::find($idNtr);

        if ($nilaiTriwulan) {
            // Hitung nilai konversi berdasarkan rentang yang Anda tentukan
            $nilai_konversi = $this->hitungKonversi($nilaiTriwulan->nilai);

            // Update nilai konversi pada record NilaiTriwulan
            $nilaiTriwulan->update(['nilai_konversi' => $nilai_konversi]);

            // Redirect atau lakukan sesuatu setelah konversi berhasil
            Alert::success('Berhasil', 'Konversi nilai berhasil');
            return redirect('/nilai-triwulan');
        } else {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect('/nilai-triwulan');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiTriwulan  $nilaiTriwulan
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiTriwulan $nilaiTriwulan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiTriwulan  $nilaiTriwulan
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiTriwulan $nilaiTriwulan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiTriwulan  $nilaiTriwulan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idNtr)
    {
        
        $nilaiTriwulan = NilaiTriwulan::findOrFail($idNtr);
        $validate = $request->validate([
            'user_id' => 'required',
            'idPPNPN' => 'required',
            'idPr' => 'required',
            'idPr' => 'required',
            'idKr' => 'required',
            'nilai' => 'required',
            'nilai_konversi' => 'nullable',
        ]);

        $nilaiTriwulan->update([
            'user_id' => $request->input('user_id'),
            'idPPNPN' => $request->input('idPPNPN'),
            'idPr' => $request->input('idPr'),
            'idKr' => $request->input('idKr'),
            'nilai' => $request->input('nilai'),
            'nilai_konversi' => $request->input('nilai_konversi'),
        ]);

        try {
            $nilaiTriwulan->update($validate);
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/nilai-triwulan');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/nilai-triwulan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiTriwulan  $nilaiTriwulan
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiTriwulan $nilaiTriwulan)
    {
        //
    }
}
