@extends('layouts.master')
@section('title', 'Penilaian')
@section('header', 'Data Penilaian ')
@section('breadcrumb', 'Penilaian')
@section('container-fluid')

    <div class="card">
        <div class="card-header">
            <a href="{{ url('nilai-triwulan/create') }}" class="btn btn-outline-success">
                <i class="fa-solid fas fa-plus"></i> Tambah Penilaian
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PPNPN</th>
                            <th>Periode</th>
                            <th>Kriteria </th>
                            <th>Nilai</th>
                            <th>Nilai Konversi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiTriwulan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['PPNPN']->namaPPNPN ?? '-' }}</td>
                                <td>{{ $item['Periode']->namaPr ?? '-' }}</td>
                                <td>{{ $item['Kriteria']->nmKr ?? '-' }}</td>
                                <td>{{ $item->nilai ?? '-' }}</td>
                                <td>{{ $item->nilai_konversi ?? '-' }}</td>
                                {{-- @php
                                dd($item['Periode']);
                                @endphp --}}
                                <td>
                                    <div class="d-flex ">
                                        <form action="{{ url('konversi/' . $item->idNtr) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="nilai_konversi" value="{{ $item->idNtr }}">
                                            <button type="submit" class="btn btn-warning btn-sm  " title="konversi">
                                                <i class="fas fa-sort-numeric-up-alt"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-info btn-sm mx-2" data-bs-toggle="modal"
                                            data-bs-target="#btn-edit{{ $item->idNtr }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        @if (auth()->user()->role == 'Admin')
                                            <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                                data-id="{{ $item->idNtr }}" title="Hapus">
                                                <i class="fa-solid fas fa-trash"></i>
                                            </a>
                                        @endif

                                    </div>
                            </tr>
                            <div class="modal fade" id="btn-edit{{ $item->idNtr }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit Penilaian</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/nilai-triwulan/' . $item->idNtr) }}" method="post">
                                                @csrf
                                                @method('PUT') <!-- Add this line for a PUT request -->

                                                <div class="form-group">
                                                    <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                                                    <label for="namaPPNPN">Nama PPNPN</label>
                                                    {{-- <input type="text" name="idPPNPN" class="form-control"
                                                        value="{{ $item['PPNPN']->idPPNPN }}" readonly> --}}
                                                    <select name="idPPNPN" class="form-control">
                                                        @foreach ($namaPPNPN as $value)
                                                            {{-- @php
                                                             dd($item);   
                                                            @endphp --}}
                                                            <option value="{{ $value->idPPNPN }}"
                                                                {{ $item['PPNPN']->idPPNPN == $value->idPPNPN ? 'selected' : '' }}>
                                                                {{ $value->namaPPNPN }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="namaPr">Periode</label>
                                                    <select name="idPr" class="form-control">
                                                        @foreach ($periode as $value)
                                                            {{-- @php
                                                         dd($item);   
                                                        @endphp --}}
                                                            <option value="{{ $value->idPr }}"
                                                                {{ $item['Periode']->idPr == $value->idPr ? 'selected' : '' }}>
                                                                {{ $value->namaPr }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="id">Kriteria</label>
                                                    <select name="idKr" class="form-control">
                                                        @foreach ($kriteria as $value)
                                                            {{-- @php
                                                         dd($item);   
                                                        @endphp --}}
                                                            <option value="{{ $value->idKr }}"
                                                                {{ $item['Kriteria']->idKr == $value->idKr ? 'selected' : '' }}>
                                                                {{ $value->nmKr }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nilai">Nilai</label>
                                                    <input type="text" name="nilai" class="form-control"
                                                        value="{{ $item->nilai }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nilai_konversi">Nilai Konversi</label>
                                                    <input type="text" name="nilai_konversi" class="form-control"
                                                        value="{{ $item->nilai_konversi }}">
                                                </div>

                                                <!-- Your existing submit button -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        $(document).on('click', '#btn-hapus', function(e) {
            e.preventDefault();
            var link = $(this).attr('data-id');
            console.log(link);

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Akan di Hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/ppnpn" + "/delete/" + link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endsection
