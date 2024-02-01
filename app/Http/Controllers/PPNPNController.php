<?php

namespace App\Http\Controllers;

use App\Models\PPNPN;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PPNPNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ppnpn = PPNPN::all();
        return view('ppnpn.index',[
            'ppnpn' => $ppnpn
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
            'namaPPNPN' => 'required',
        ], [
            'namaPPNPN.required' => 'Tidak Boleh Kosong',
           
        ]);

        // dd($validate);

        try {
            PPNPN::create($validate);
            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return redirect('/ppnpn');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect('/ppnpn');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PPNPN  $pPNPN
     * @return \Illuminate\Http\Response
     */
    public function show(PPNPN $pPNPN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PPNPN  $pPNPN
     * @return \Illuminate\Http\Response
     */
    public function edit(PPNPN $pPNPN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PPNPN  $pPNPN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idPPNPN)
    {
        
        $ppnpn = PPNPN::findOrFail($idPPNPN);
        $validate=$request->validate([
            'namaPPNPN' => 'required', 
        ]);

        
        $ppnpn->update([
            'namaPPNPN' => $request->input('namaPPNPN')
        ]);

        try {
            $ppnpn->update($validate);
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/ppnpn');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/ppnpn');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PPNPN  $pPNPN
     * @return \Illuminate\Http\Response
     */
    public function destroy($idPPNPN)
    {
        try {
            $ppnpn = PPNPN::findOrFail($idPPNPN);
            $ppnpn->delete();
            return redirect('/ppnpn');
        } catch (\Exception $e) {
            Alert::toast('Berhasil mengahapus data',);
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
