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
            <form action="{{ route('product.update', $data->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="nama">Nama Product</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                        placeholder="Isikan Nama" value="{{ $data->name_product }}">

                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="harga">Harga Satuan Product</label>
                    <input type="text" inputmode="numeric" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror"
                        placeholder="Isikan Harga Satuan Product" value="{{ $data->harga_satuan }}">

                    @error('harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="stok">Stok Product</label>
                    <input type="text" inputmode="numeric" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror"
                        placeholder="Isikan Harga Satuan Product" value="{{ $data->stok_product }}">

                    @error('stok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                @if (Auth::user()->role == 'supplier')
                <button type="submit" class="btn btn-warning">Ubah</button>
                @else
                <button type="submit" class="btn btn-warning" disabled>Ubah</button>
                @endif
            </form>
        </div>
    </div>
@endsection
@section('js')
@endsection
