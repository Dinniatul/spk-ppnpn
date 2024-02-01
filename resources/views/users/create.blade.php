@extends('layouts.master')
@section('title', 'Create User')
@section('header', ' Form Tambah Data Users')
@section('link')
    <a href="{{ url('pengguna') }}">Users</a>
@endsection
@section('breadcrumb', 'Tambah Users')

@section('container-fluid')
    <!-- Loading Modal -->

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('users') }}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" value="{{ old('name') }}" name="name"
                                        placeholder="Masukkan nama lengkap" autofocus required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="text" class="form-label">Username</label>
                                    <input type="text" class="form-control " id="username" value="{{ old('username') }}"
                                        name="username" placeholder="Masukkan username user" autofocus required>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="role">Role</label>
                                    <div class="input-group">
                                        <select class="form-control" id="role" name="role" class="btn btn-info">
                                            <option value="Atasan Langsung">Atasan Langsung</option>
                                            <option value="Kepegawaian">Kepegawaian</option>
                                            <option value="Sekretaris">Sekretaris</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" value="{{ old('password') }}"
                                        name="password" >
                                    @error('password')
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
                        <button type="submit" class="btn btn-primary" onclick="showLoadingModal()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
