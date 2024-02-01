@extends('layouts.master')
@section('title', 'PPNPN')
@section('header', 'Data PPNPN')
@section('breadcrumb', 'PPNPN')
@section('container-fluid')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalTambahKriteria">
                <i class="fas fa-plus"></i> Tambah PPNPN
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama PPNPN</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ppnpn as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->namaPPNPN ?? '-' }}</td>
                                <td>
                                    <div class="">
                                        <button type="button" class="btn btn-info btn-sm mx-2" data-bs-toggle="modal"
                                            data-bs-target="#btn-edit{{ $item->idPPNPN }}" title="edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                            data-id="{{ $item->idPPNPN }}" title="Hapus">
                                            <i class="fa-solid fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="btn-edit{{ $item->idPPNPN }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit PPNPN</h5>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/ppnpn/' . $item->idPPNPN) }}" method="post">
                                                @csrf
                                                @method('PUT') <!-- Add this line for a PUT request -->
                                                <div class="form-group">
                                                    <label for="namaPPNPN">Nama PPNPN</label>
                                                    <input type="text" name="namaPPNPN" class="form-control"
                                                        value="{{ $item->namaPPNPN }}">
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
    <div class="modal fade" id="modalTambahKriteria" tabindex="-1" role="dialog"
        aria-labelledby="modalTambahKriteriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahKriteriaLabel">Form Tambah PPNPN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/ppnpn') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="namaPPNPN">Nama PPNPN</label>
                            <input type="text" name="namaPPNPN" class="form-control" id="namaPPNPN"
                                placeholder="Enter Nama PPNPN">
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
