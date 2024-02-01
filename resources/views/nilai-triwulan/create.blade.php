@extends('layouts.master')
@section('title', 'Nilai Triwulan')
@section('header', 'Data Nilai Triwulan')
@section('breadcrumb', 'Nilai Triwulan')
@section('container-fluid')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('nilai-triwulan') }}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                    <label for="name" class="form-label">Nama PPNPN</label>
                                    <select name="idPPNPN" class="form-control" id="idPPNPN">
                                        <option>--Pilih Nama PPNPN--</option>
                                        @foreach ($namaPPNPN as $nm)
                                            <option value="{{ $nm->idPPNPN }}">{{ $nm->namaPPNPN }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="text" class="form-label">Periode</label>
                                    <select name="idPr" class="form-control" id="idPr">
                                        <option>--Pilih Periode--</option>
                                        @foreach ($periode as $pr)
                                            <option value="{{ $pr->idPr }}">{{ $pr->namaPr }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">

                                    <label for="kriteria">Kriteria</label>
                                    <select name="idKr" class="form-control" id="idKr">
                                        <option>--Pilih Kriteria--</option>
                                        @foreach ($kriteria as $kr)
                                            <option value="{{ $kr->idKr }}">{{ $kr->nmKr }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input type="text" class="form-control" id="nilai" value="{{ old('nilai') }}"
                                        name="nilai">
                                    @error('nilai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary mr-2">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
