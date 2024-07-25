@extends('layouts.admin')
@section('css')
@endsection
@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Product</li>
            </ol>
        </nav>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('product.create') }}" class="btn btn-success mb-2 btn-sm">Tambah Daftar
                    Product</a>
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Product</th>
                            <th>Nama Product</th>
                            <th>Harga Satuan</th>
                            <th>Stok Product</th>
                            <th>Aksi</th>
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
                                <td>
                                    <a href="{{ route('product.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-fw fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $row->id }}, '{{ $row->name_product }}')">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </button>
                                    
                                    <script>
                                    function confirmDelete(id, productName) {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: `You won't be able to revert this! This will delete "${productName}".`,
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#d33",
                                            cancelButtonColor: "#3085d6",
                                            confirmButtonText: "Yes, delete it!"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Create a form dynamically
                                                var form = document.createElement('form');
                                                form.method = 'POST';
                                                form.action = ''; // Add your delete route here
                                    
                                                // Add CSRF token
                                                var csrfToken = document.createElement('input');
                                                csrfToken.type = 'hidden';
                                                csrfToken.name = '_token';
                                                csrfToken.value = '{{ csrf_token() }}';
                                                form.appendChild(csrfToken);
                                    
                                                // Add method spoofing for DELETE
                                                var methodField = document.createElement('input');
                                                methodField.type = 'hidden';
                                                methodField.name = '_method';
                                                methodField.value = 'DELETE';
                                                form.appendChild(methodField);
                                    
                                                // Add ID if needed
                                                var idField = document.createElement('input');
                                                idField.type = 'hidden';
                                                idField.name = 'id';
                                                idField.value = id;
                                                form.appendChild(idField);
                                    
                                                // Append form to body and submit
                                                document.body.appendChild(form);
                                                form.submit();
                                    
                                                Swal.fire({
                                                    title: "Deleted!",
                                                    text: "Your file has been deleted.",
                                                    icon: "success"
                                                });
                                            }
                                        });
                                    }
                                    </script>
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
