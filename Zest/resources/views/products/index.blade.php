@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<style>
    .dt-length .dt-input {
        margin-right: 10px !important;
    }
    table.dataTable th.dt-type-numeric,table.dataTable th.dt-type-date,table.dataTable td.dt-type-numeric,table.dataTable td.dt-type-date {
        text-align: left;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col">
            <h3>List of Products</h3>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row mb-2 justify-content-between">
        <div class="col-auto">
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fas fa-plus"></i> Add New Product</button>
            <button type="button" class="btn btn-danger mb-2" onclick="window.location.href='{{ route('products.exportPdf') }}'">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
            <button type="button" class="btn btn-primary mb-2" onclick="window.location.href='{{ route('products.exportXls') }}'">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-info mb-2 position-relative" data-bs-toggle="modal" data-bs-target="#requestPurchaseModal">
                <i class="fas fa-arrow-circle-down"></i> Request Purchase
                @if ($pendingRequestPurchase > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <span class="badge">{{ $pendingRequestPurchase }}
                        </span>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                @endif
            </button>

            <button type="button" class="btn btn-warning mb-2 position-relative" data-bs-toggle="modal" data-bs-target="#requestSellModal">
                <i class="fas fa-arrow-circle-down"></i> Request Sell
                @if ($pendingRequestSell > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <span class="badge">{{ $pendingRequestSell }}
                        </span>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                @endif
            </button>
        </div>
    </div>

    <div class="box-body">
        <table id="productTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price (IDR)</th>
                <th scope="col">Quantity</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $pro)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pro-> nama_produk }}</td>
                        <td>{{ $pro-> harga_produk }} </td>
                        <td>{{ $pro-> jumlah_produk }} </td>
                        <td>{{ $pro-> kategori_produk }} </td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $pro->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>
                            <form action="{{ route('products.delete', $pro->id) }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container-fluid mt-5" id="importProductContainer">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" id="importProductModalLabel">Import Products</h3>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('products.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="file" name="file" class="form-control-file" id="file" required accept=".csv, .xlsx, .xls">
                            <div class="invalid-feedback">Please select a file with CSV, XLSX, or XLS format.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Import Excel</button>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>

@include('products.create')
@include('products.edit')
@include('products.requestPurchase')
@include('products.requestSell')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productTable').DataTable({
            "columnDefs": [
                { 
                    "searchable": false,
                    "targets": [0,5]
                }, 
            ]
        });
    });
</script>
<script>
    setTimeout(function(){
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endsection