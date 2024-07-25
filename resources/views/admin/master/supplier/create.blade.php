@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Daftar Supplier</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Daftar Supplier</li>
            </ol>
          </nav>
        <div class="card-body">
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Supplier</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Isikan Nama">

                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="alamat">Alamat Supplier</label>
                    <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Isikan Alamat Supplier">

                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="telp">No Telp Supplier</label>
                    <input type="text" inputmode="numeric" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror"
                        placeholder="Isikan No Telp">

                    @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="email">Email Supplier</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Isikan Email">

                    @error('email')
                        <div class="invalid-feedback">z
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="password">Password Akun Supplier</label>
                    <input type="password" inputmode="numeric" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Isikan Password">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
@endsection
