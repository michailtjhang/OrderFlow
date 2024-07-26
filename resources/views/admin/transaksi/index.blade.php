@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('export-pdf') }}" class="btn btn-danger mb-2 btn-sm">Export PDF</a>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Items</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->id_transaksi }}</td>
                                <td>
                                    <ol>
                                        @foreach ($row->item as $item)
                                            <li>{{ $item->nama }} ({{ $item->quantity }})</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>Rp. {{ number_format($row->total_harga) }}</td>
                                <td>{{ $row->tgl_beli }}</td>
                                <td>
                                    <a href="{{ url('admin/export-items-pdf', $row->id_transaksi) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-fw fa-file-pdf"></i>
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
@endsection