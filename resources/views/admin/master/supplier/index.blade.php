@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Supplier</li>
            </ol>
        </nav>
        <div class="card-body">
            <div class="table-responsive">
                @if (Auth()->user()->role == 'admin')
                    <a href="{{ route('supplier.create') }}" class="btn btn-success mb-2 btn-sm">Tambah Daftar
                        Supplier</a>
                @endif
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat Supplier</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $row->name_supplier }}</td>
                                <td>{{ $row->address_supplier }}</td>
                                <td>{{ $row->phone_supplier }}</td>
                                <td>{{ $row->email_supplier }}</td>
                                <td>
                                    <a href="{{ route('supplier.show', $row->id_user) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-fw fa-eye"></i>
                                    </a>
                                </td>
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
