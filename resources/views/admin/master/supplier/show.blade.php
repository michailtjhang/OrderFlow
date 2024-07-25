@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Daftar Supplier</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Product</li>
            </ol>
        </nav>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Product</th>
                            <th>Nama Product</th>
                            <th>Harga Satuan</th>
                            <th>Stok Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $row->id_product }}</td>
                                <td>{{ $row->name_product }}</td>
                                <td>Rp. {{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                                <td>{{ $row->stok_product }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
