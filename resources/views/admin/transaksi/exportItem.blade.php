<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice #{{ $id_invoice }}</title>
    <style>
        body {
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
            padding: 20px;
        }

        .invoice-title h4 {
            margin-bottom: 0;
        }

        .invoice-title h2 {
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            text-align: center;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .text-end {
            text-align: right !important;
        }

        .border-0 {
            border: 0 !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-1 {
            margin-bottom: .25rem !important;
        }

        .ms-2 {
            margin-left: .5rem !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">Invoice #{{ $id_invoice }} <span
                                    class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                            <div class="mb-4">
                                <h2 class="mb-1 text-muted">{{ config('app.name') }}</h2>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="py-2">
                            <h5 class="font-size-15">Order Product</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th class="text-end" style="width: 120px;">Total</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($data as $row)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $row->nama }}</td>
                                                <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                                                <td>{{ $row->quantity }}</td>
                                                @php
                                                    $total_harga = $row->quantity * $row->harga;
                                                @endphp
                                                <td class="text-end">Rp {{ number_format($total_harga, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            @php
                                                $total += $total_harga;
                                            @endphp
                                        @endforeach
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0 fw-semibold">Rp {{ number_format($total, 0, ',', '.') }}
                                                </h4>
                                            </td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
    </div>
</body>

</html>
