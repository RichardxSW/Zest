@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('/css/customer.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h2>List of Customers</h2>
        </div>
    </div>
    <div class="row mb-3 justify-content-between">
        <div class="col-auto">
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addCustomerModal"><i class="fas fa-plus"></i> Add New Customer</button>
            <button type="button" class="btn btn-danger mb-3"><i class="fas fa-file-pdf"></i> Export PDF</button>
            <button type="button" class="btn btn-primary mb-3"><i class="fas fa-file-excel"></i> Export Excel</button>
        </div>
    </div>
    <div class="box-body">
        <table id="cusTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th width="5%" scope="col">ID</th>
                <th width="18%" scope="col">Name</th>
                <th width="18%" scope="col">Item</th>
                <th width="18%" scope="col">Item Quantity</th>
                <th width="26%" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($customer as $cus)
                <tr>
                    <td>{{ $cus->id }}</td>
                    <td>{{ $cus->nama_customer }}</td>
                    <td>{{ $cus->item_customer }}</td>
                    <td>{{ $cus->quantity_customer }}</td>
                    <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editCustomerModal{{ $cus->id }}"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <form action="{{ route('customers.delete', $cus->id) }}" method="POST" class="d-inline">
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

<!-- Add Customer Modal -->
@include('customers.formAdd')
@include('customers.formEdit')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cusTable').DataTable();
    });
</script>

@endsection