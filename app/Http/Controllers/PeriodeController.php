<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::all();
        return view('periode.index',[
            'periode' => $periode
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
            'namaPr' => 'required',
        ], [
            'namaPr.required' => 'Tidak Boleh Kosong',
           
        ]);

        // dd($validate);

        try {
            Periode::create($validate);
            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return redirect('/periode');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect('/periode');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idPr)
    {
        $periode = Periode::findOrFail($idPr);
        $validate=$request->validate([
            'namaPr' => 'required', 
            
        ]);

        
        $periode->update([
            'namaPr' => $request->input('namaPr'),
           
        ]);

        try {
            $periode->update($validate);
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/periode');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/periode');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPr)
    {
        try {
            $periode = Periode::findOrFail($idPr);
            $periode->delete();
            return redirect('/periode');
        } catch (\Exception $e) {
            Alert::toast('Berhasil mengahapus data',);
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
