@extends('layouts.master')

@section('title', 'Users')
@section('header', 'Data Users')
@section('breadcrumb', 'Users')

@section('container-fluid')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="{{ url('users-create') }}" class="btn btn-outline-success">
                    <i class="fa-solid fas fa-plus"></i> Tambah Users
                </a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="example1_wrapper">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->username }}</td>
                                            <td>{{ $value->role }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm mx-2"
                                                    data-bs-toggle="modal" data-bs-target="#btn-edit{{ $value->id }}"
                                                    title="edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                                    data-id="{{ $value->id }}" title="Hapus">
                                                    <i class="fa-solid fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="btn-edit{{ $value->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h5 class="modal-title text-center" id="exampleModalLabel">Form Edit
                                                            PPNPN</h5>
                                                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/users/' . $value->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT') <!-- Add this line for a PUT request -->
                                                            <div class="form-group">
                                                                <label for="name">Nama</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $value->name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="username">Username</label>
                                                                <input type="text" name="username" class="form-control"
                                                                    value="{{ $value->username }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">Role</label>
                                                                <select class="form-control" id="role" name="role">
                                                                    <option value="Atasan Langsung"
                                                                        {{ $value->role === 'Admin' ? 'selected' : '' }}>
                                                                        Admin</option>
                                                                    <option value="Atasan Langsung"
                                                                        {{ $value->role === 'Atasan Langsung' ? 'selected' : '' }}>
                                                                        Atasan Langsung</option>
                                                                    <option value="Kepegawaian"
                                                                        {{ $value->role === 'Kepegawaian' ? 'selected' : '' }}>
                                                                        Kepegawaian</option>
                                                                    <option value="Sekretaris"
                                                                        {{ $value->role === 'Sekretaris' ? 'selected' : '' }}>
                                                                        Sekretaris</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">Password</label>
                                                                <input type="text" name="password" class="form-control"
                                                                    >
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
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        // --------------DELETE USER----------------
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
                    window.location = "/penduduk" + "/delete/" + link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>

    <script>
        function printSurat(id) {
            // Logika untuk mengarahkan ke halaman cetak surat berdasarkan ID
            window.location.href = '{{ url('/cetak-surat') }}/' + id;
        }
    </script>



@endsection
