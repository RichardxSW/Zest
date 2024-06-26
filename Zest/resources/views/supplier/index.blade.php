@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/css/customer.css') }}" rel="stylesheet">
<style>
    .dt-length .dt-input {
        margin-right: 10px !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col">
            <h3>List of Suppliers</h3>
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
    <div class="row mb-1 justify-content-between">
        <div class="col-auto">
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addSupplierModal"><i class="fas fa-plus"></i> Add New Supplier</button>
            <button type="button" class="btn btn-danger mb-2" onclick="window.location.href='{{ route('supplier.exportPdf') }}'">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
            <button type="button" class="btn btn-primary mb-2" onclick="window.location.href='{{ route('supplier.exportXls') }}'">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
    </div>
    <div class="box-body">
        <table id="supTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="5%" scope="col">ID</th>
                    <th width="18%" scope="col">Name</th>
                    <th width="18%" scope="col">Address</th>
                    <th width="18%" scope="col">Email</th>
                    <th width="18%" scope="col">Contact</th>
                    <th width="26%" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($supplier as $sup)
                <tr>
                    <td>{{ $sup->id }}</td>
                    <td>{{ ucwords($sup->name) }}</td>
                    <td>{{ ucwords($sup->address) }}</td>
                    <td>{{ $sup->email }}</td>
                    <td>{{ $sup->contact }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSupplierModal{{ $sup->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>
                        <form action="{{ route('supplier.delete', $sup->id) }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container-fluid mt-5" id="importSupplierContainer">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" id="importSupplierModalLabel">Import Suppliers</h3>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('supplier.import') }}" method="post" enctype="multipart/form-data">
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

<!-- Add Supplier Modal -->
@include('supplier.create')
<!-- Edit Supplier Modal -->
@include('supplier.edit')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#supTable').DataTable();
    });
</script>
<script>
    setTimeout(function(){
        $('.alert').fadeOut('slow');
    }, 5000);
</script>


@endsection