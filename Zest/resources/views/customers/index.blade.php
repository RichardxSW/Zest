@extends('layouts.template')

@push('styles')
<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addCustomerModal"><i class="fas fa-plus"></i> Add New Customer</button>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
              <th width="10%" scope="col">ID</th>
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

@include('customers.formAdd')
@include('customers.formEdit')

@endsection