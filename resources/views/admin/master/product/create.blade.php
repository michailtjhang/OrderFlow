@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Daftar Product</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Daftar Product</li>
            </ol>
          </nav>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Product</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Isikan Nama" value="{{ old('nama') }}">

                    @error('nama')
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
