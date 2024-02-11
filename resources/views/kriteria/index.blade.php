@extends('layouts.master')
@section('title', 'Kriteria')
@section('header', 'Data Kriteria')
@section('breadcrumb', 'Kriteria')
@section('container-fluid')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalTambahKriteria">
                <i class="fas fa-plus"></i> Tambah Kriteria
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kriteria</th>
                            <th>Jenis Kriteria</th>
                            <th>Bobot Kriteria </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriterias as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nmKr ?? '-' }}</td>
                                <td>{{ $item->jenisKr ?? '-' }}</td>
                                <td>{{ $item->bobotKr ?? '-' }}</td>
                                <td>
                                    <div class="">
                                        <button type="button" class="btn btn-info btn-sm mx-2" data-bs-toggle="modal"
                                            data-bs-target="#btn-edit{{ $item->idKr }}" title="edit">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                            data-id="{{ $item->idKr }}" title="Hapus">
                                            <i class="fa-solid fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="btn-edit{{ $item->idKr }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit Kriteria
                                            </h5>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/kriteria/' . $item->idKr) }}" method="post">
                                                @csrf
                                                @method('PUT') <!-- Add this line for a PUT request -->


                                                <div class="form-group">
                                                    <label for="nmKr">Nama Kriteria</label>
                                                    <input type="text" name="nmKr" class="form-control"
                                                        value="{{ $item->nmKr }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenisKr">Jenis Kriteria</label>
                                                    <input type="text" name="jenisKr" class="form-control"
                                                        value="{{ $item->jenisKr }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="bobotKr">Bobot Kriteria</label>
                                                    <input type="text" name="bobotKr" class="form-control"
                                                        value="{{ $item->bobotKr }}">
                                                </div>
                                                <!-- Your existing submit button -->
                                                <div class="row">
                                                    <div class="col-sm-4 mx-auto">
                                                        <button type="submit" class="btn btn-info btn-block"><i
                                                                class="fas fa-save"></i> Update</button>
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

    <!-- Modal for adding criteria -->
    <!-- Modal for adding criteria -->
    <div class="modal fade" id="modalTambahKriteria" tabindex="-1" role="dialog"
        aria-labelledby="modalTambahKriteriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahKriteriaLabel">Form Tambah Kriteria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/kriteria') }}" method="post" id="formTambahKriteria">
                        @csrf
                        <div class="form-group">
                            <label for="nmKr">Nama Kriteria</label>
                            <input type="text" name="nmKr" class="form-control" id="nmKr"
                                placeholder="Enter Nama Kriteria">
                        </div>

                        <div class="form-group">
                            <label for="jenisKr">Jenis Kriteria</label>
                            <select name="jenisKr" class="form-control" id="jenisKr">
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bobotKr">Bobot Kriteria</label>
                            <input type="text" name="bobotKr" class="form-control" id="bobotKr"
                                placeholder="Enter Bobot Kriteria">
                            @error('bobotKr')
                                <div class="text-danger" style="font-size:12px;">*{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Your existing submit button -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-block">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal -->



    <!-- End modal -->

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
                    window.location = "/kriteria" + "/delete/" + link;
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
