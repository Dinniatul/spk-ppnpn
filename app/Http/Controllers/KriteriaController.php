<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', [
            'kriterias' => $kriterias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nmKr' => 'required',
            'jenisKr' => 'required',
            'bobotKr' => 'required',


        ], [
            'nmKr.required' => 'Tidak Boleh Kosong',
            'jenisKr.required' => 'Tidak Boleh Kosong',
            'bobotKr.required' => 'Gunakan Karakter .',

        ]);

        // dd($validate);

        try {
            Kriteria::create($validate);
            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return redirect('/kriteria');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect('/kriteria');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $idKr)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idKr)
    {
        $kriteria = Kriteria::findOrFail($idKr);
        $validate=$request->validate([
            'nmKr' => 'required', 
            'jenisKr' => 'required', 
            'bobotKr' => 'required', 
        ]);

        
        $kriteria->update([
            'nmKr' => $request->input('nmKr'),
            'jenisKr' => $request->input('jenisKr'),
            'bobotKr' => $request->input('bobotKr')
        ]);

        try {
            $kriteria->update($validate);
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/kriteria');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/kriteria');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($idKr)
    {
        {
            try {
                $kriteria = Kriteria::findOrFail($idKr);
                $kriteria->delete();
                return redirect('/kriteria');
            } catch (\Exception $e) {
                Alert::toast('Berhasil mengahapus data',);
                return back()->withErrors(['error' => 'Gagal menghapus data.']);
            }
        }
    }
}
